<script src="{{asset('js/ckeditor.js')}}"></script>

<script>

        ClassicEditor
            .create( document.querySelector( '#solution' ),{
                toolbar: [],
                link: {
                addTargetToExternalLinks: true
            },

                }).then( newEditor => {
                    newEditor.enableReadOnlyMode("solution")


                })
                .catch( error => {
                    console.error( );
                })
</script>
