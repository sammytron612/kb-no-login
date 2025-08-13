<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

<script>

    const CKeditors = {}
    var mentionArray = []
    var EditorContent = ''

    document.addEventListener("DOMContentLoaded", function() {

            fetchAgents()

            createNewEditor(0)
    })


    function createNewEditor(id){
                    return ClassicEditor
                    .create( document.querySelector( '#body' + id ),{
                    alignment: {
                                    options: [ 'left', 'center','right' ]
                                },
                    link: {
                    addTargetToExternalLinks: true
                    },
                    mention: {
                        dropdownLimit: 4,
                            feeds: [
                                {
                                    marker: '@',
                                    feed: getFeedItems,
                                    itemRenderer: customItemRenderer
                                }
                        ]

                    },
                        extraPlugins: [ MyCustomUploadAdapterPlugin, MentionCustomization ]
                        }).then( newEditor => {
                            CKeditors[ 'comment' + id ] = newEditor
                            EditorContent = CKeditors[ 'comment' + id ].getData()

                        })
                        .catch( error => {
                            console.error( );
                        })
                }

    function MentionCustomization( editor ) {
    // The upcast converter will convert <a class="mention" href="" data-user-id="">
    // elements to the model 'mention' attribute.
    editor.conversion.for( 'upcast' ).elementToAttribute( {
        view: {
            name: 'span',
            key: 'data-mention',
            classes: 'mention',
            attributes: {
                'data-user-id': true
            }
        },
        model: {
            key: 'mention',
            value: viewItem => {
                // The mention feature expects that the mention attribute value
                // in the model is a plain object with a set of additional attributes.
                // In order to create a proper object, use the toMentionAttribute helper method:
                const mentionAttribute = editor.plugins.get( 'Mention' ).toMentionAttribute( viewItem, {
                    // Add any other properties that you need.
                    link: viewItem.getAttribute( 'href' ),
                    userId: viewItem.getAttribute( 'data-user-id' )
                } );

                return mentionAttribute;
            }
        },
        converterPriority: 'high'
    } );

    // Downcast the model 'mention' text attribute to a view <a> element.
    editor.conversion.for( 'downcast' ).attributeToElement( {
        model: 'mention',
        view: ( modelAttributeValue, { writer } ) => {
            // Do not convert empty attributes (lack of value means no mention).
            if ( !modelAttributeValue ) {
                return;
            }

            return writer.createAttributeElement( 'a', {
                class: 'mention',
                'data-mention': modelAttributeValue.id,
                'data-user-id': modelAttributeValue.userId,

            }, {
                // Make mention attribute to be wrapped by other attribute elements.
                priority: 20,
                // Prevent merging mentions together.
                id: modelAttributeValue.uid
            } );
        },
        converterPriority: 'high'
    } );
}

var items = [];

function getFeedItems( queryText ) {
    // As an example of an asynchronous action, return a promise
    // that resolves after a 100ms timeout.
    // This can be a server request or any sort of delayed action.
    return new Promise( resolve => {
        setTimeout( () => {
            const itemsToDisplay = items
                // Filter out the full list of all items to only those matching the query text.
                .filter( isItemMatching )
                // Return 10 items max - needed for generic queries when the list may contain hundreds of elements.
                .slice( 0, 10 );

            resolve( itemsToDisplay );
        }, 100 );
    } );

    // Filtering function - it uses `name` and `username` properties of an item to find a match.
    function isItemMatching( item ) {
        // Make the search case-insensitive.
        const searchString = queryText.toLowerCase();

        // Include an item in the search results if name or username includes the current user input.
        return (
            item.name.toLowerCase().includes( searchString ) ||
            item.id.toLowerCase().includes( searchString )
        );
    }
}

function customItemRenderer( item ) {
    const itemElement = document.createElement( 'span' );

    itemElement.classList.add( 'custom-item' );
    itemElement.id = `mention-list-item-id-${ item.userId }`;
    itemElement.textContent = `${ item.name } `;

    const usernameElement = document.createElement( 'span' );

    usernameElement.classList.add( 'custom-item-username' );
    usernameElement.textContent = item.id;

    itemElement.appendChild( usernameElement );

    return itemElement;
}

    function parseMentions(id)
    {
        var comment = CKeditors['comment'+id].getData();
        var parsedHTML = new DOMParser().parseFromString(comment, 'text/html');
        var mentions = parsedHTML.querySelectorAll('.mention');

        mentions.forEach(mention => mentionArray.push([{'id': mention.getAttribute("data-user-id")}, {'name': mention.getAttribute("data-mention").substring(1)}])
        );
        lastMention = mentionArray.at(-1)
        console.log(lastMention)
        return [comment, lastMention]
    }

    function closeEditor(id){
        CKeditors['comment' + id].setData(EditorContent)
    }

    function new_comment(){

        data = parseMentions(0)
        comment = data[0]
        lastMention = data[1]

        if(comment.length == 0){
            alert("A comment cannot be blank!")
            return
        }

        @this.newComment(comment, lastMention)
        clearEditor(0)
        return
    }

    function updateComment(id){

        data = parseMentions(id)
        comment = data[0]
        lastMention = data[1]

        if(comment.length == 0){
                alert("A comment cannot be blank!")
                CKeditors['comment' + id].setData(EditorContent)
                return
            }
        console.log(comment)
        @this.updateComment(id,comment, lastMention)

        return
    }


    const fetchAgents = async () => {
        try {
            const response = await axios.post("/fetch");
            items = response.data.agents
            console.log(items);
        } catch (err) {
            // Handle Error Here
            console.error(err);
        }
    };


    const updateLock = async (id) => {
        try {
            const data = { id: 'id' };
            const response = await axios.post("/update-lock/"+id);
            console.log(response.data);

        } catch (err) {
            // Handle Error Here
            console.error(err);
        }


    };

    function clearEditor(id){

                CKeditors['comment'+ id].setData('')
                return
            }

    function insertKBlink(articleId, title, id){
                    url = "{{url('/kb')}}" + "/"+articleId
                    editor = CKeditors['comment'+ id]
                    editor.model.change( writer => {

                        const insertPosition = editor.model.document.selection.getFirstPosition();
                        console.log(insertPosition)
                        writer.insertText( title, { linkHref: url }, insertPosition );
                    } );
                    return
                }


    function destroyEditor(id){

        CKeditors['comment'+ id].destroy()
        return
    }

    class MyUploadAdapter {
        constructor( loader ) {
            // The file loader instance to use during the upload.
            this.loader = loader;
        }

    // Starts the upload process.
    upload() {
        return this.loader.file
            .then( file => new Promise( ( resolve, reject ) => {
                this._initRequest();
                this._initListeners( resolve, reject, file );
                this._sendRequest( file );
            } ) );
    }

    // Aborts the upload process.
    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }

    // Initializes the XMLHttpRequest object using the URL passed to the constructor.
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        // Note that your request may look different. It is up to you and your editor
        // integration to choose the right communication channel. This example uses
        // a POST request with JSON as a data structure but your configuration
        // could be different.
        xhr.open( 'POST', '{{ route("image.upload")}}', true );
        xhr.setRequestHeader('x-csrf-token','{{ csrf_token() }}');
        xhr.responseType = 'json';
    }

    // Initializes XMLHttpRequest listeners.
    _initListeners( resolve, reject, file ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;

            // This example assumes the XHR server's "response" object will come with
            // an "error" which has its own "message" that can be passed to reject()
            // in the upload promise.
            //
            // Your integration may handle upload errors in a different way so make sure
            // it is done properly. The reject() function must be called when the upload fails.
            if ( !response || response.error ) {
                return reject( response && response.error ? response.error.message : genericErrorText );
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            // This URL will be used to display the image in the content. Learn more in the
            // UploadAdapter#upload documentation.
            resolve(  response );
        } );

        // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
        // properties which are used e.g. to display the upload progress bar in the editor
        // user interface.
        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }

    // Prepares the data and sends the request.
    _sendRequest( file ) {
        // Prepare the form data.
        const data = new FormData();

        data.append( 'upload', file );

        // Important note: This is the right place to implement security mechanisms
        // like authentication and CSRF protection. For instance, you can use
        // XMLHttpRequest.setRequestHeader() to set the request headers containing
        // the CSRF token generated earlier by your application.

        // Send the request.
        this.xhr.send( data );
    }
}

// ...

function MyCustomUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}


</script>
