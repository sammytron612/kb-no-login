<x-layouts.app>
<div class="container mx-auto py-8">
    @if (session('success'))
        <div class="p-2 bg-green-100 text-green-800 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
                <div class="p-2 bg-red-100 text-red-800 rounded mb-4">{{ $error }}</div>
        @endforeach
    @endif
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <label for="title" class="block font-medium">Title</label>
                <input type="text" name="title" id="title" class="w-full border rounded p-2" required value="{{ old('title') }}" />
                @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="tags" class="block font-medium">Tags</label>
                <input type="text" name="tags" id="tags" class="w-full border rounded p-2" placeholder="Comma separated" value="{{ old('tags') }}" />
                @error('tags') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="section" class="block font-medium">Section</label>
                <input type="text" name="section" id="section" class="w-full border rounded p-2" required value="{{ old('section') }}" />
                @error('section') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="attachments" class="block font-medium">Attachments</label>
                <input type="file" name="attachments[]" id="attachments" multiple class="w-full border rounded p-2" />
                @error('attachments.*') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="scope" class="block font-medium">Scope</label>
                <select name="scope" id="scope" class="w-full border rounded p-2">
                    <option value="1" @if(old('scope')==1) selected @endif>Public</option>
                    <option value="2" @if(old('scope')==2) selected @endif>Private</option>
                </select>
                @error('scope') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="status" class="block font-medium">Status</label>
                <select name="status" id="status" class="w-full border rounded p-2">
                    <option value="1" @if(old('status')==1) selected @endif>Publish</option>
                    <option value="0" @if(old('status')==0) selected @endif>Draft</option>
                </select>
                @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="expires" class="block font-medium">Expires</label>
                <input type="date" name="expires" id="expires" class="w-full border rounded p-2" value="{{ old('expires') }}" />
                @error('expires') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div>
            <label for="article_body" class="block font-medium">Body</label>
            <textarea name="article_body" id="editor" class="w-full border rounded p-2 h-32" ></textarea>
            @error('article_body') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <input type="hidden" id="images" name="images" value="~">
        <button type="submit" class="hover:cursor-pointer hover:bg-blue-500 px-4 py-2 bg-blue-600 text-white rounded">Create Article</button>
    </form>

<script src="https://cdn.tiny.cloud/1/qpuriefs0vhoo7azs8ty9kf1lyz69bininv5bq6grbpqpbh7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>

    tinymce.init({
      licence_key: 'qpuriefs0vhoo7azs8ty9kf1lyz69bininv5bq6grbpqpbh7',
      height : "600",
      selector: '#editor',
      plugins: 'template autoresize autolink image fullscreen imagetools emoticons link lists hr paste media table',
      toolbar: 'insert undo redo fullscreen fontsizeselect alignleft aligncenter alignright alignjustify h1 h2 bold italic numlist bullist image link emoticons hr paste table',
      contextmenu: "link image table paste",
      content_style: 'textarea { padding: 20px; }',
      templates: [
    {title: 'Some title 1', description: 'Some desc 1', content: 'My content'},
    {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'},
  ],
      autoresize_bottom_margin: 50,
      images_upload_handler: function (blobInfo, success, failure) {
           var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', '{{ route("image.upload") }}');
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
               json = JSON.parse(xhr.responseText);
               if (!json || typeof json.location != 'string') {
                   failure('Invalid JSON: ' + xhr.responseText);
                   return;
               }
               success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
       }
    });
</script>
</div>
</x-layouts.app>

