<!-- <script src="https://cdn.tiny.cloud/1/ywqmxeye1bqw640inrzx59t5k336ioq2oad0rc5d4cydjlnt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
<script language="javascript" type="text/javascript">
var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
//alert(ajax_csrf_token_new);
tinymce.init({
  selector: 'textarea.textBlog',
  media_dimensions: false,
    media_alt_source: false,
    media_poster: false,
    paste_block_drop: false, 
  plugins: 'contextmenu print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',

  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample blockquote| ltr rtl | imageupload cut copy paste',
  toolbar_sticky: false,
  autosave_ask_before_unload: true,
  autosave_interval: '30s',
  height: 400,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic underline strikethrough | cut copy paste | quicklink blockquote quickimage quicktable',
  noneditable_noneditable_class: 'mceNonEditable',
   toolbar_mode: 'wrap',
  contextmenu: 'cut copy paste | bold italic underline strikethrough | link image imagetools table',
  skin: useDarkMode ? 'oxide-dark' : 'oxide',
  content_css: useDarkMode ? 'dark' : 'default',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  image_title: true,
  automatic_uploads: true,
  images_upload_url: '{{url("/tinyimage/upload")}}',
  images_upload_credentials: true,
  relative_urls: false,
remove_script_host: false,
  file_picker_types: 'image',
    setup: function (editor) {
      editor.on('ExecCommand', (event) => {
        const command = event.command;
        if (command === 'mceMedia') {
          const tabElems = document.querySelectorAll('div[role="tablist"] .tox-tab');
          tabElems.forEach(tabElem => {
            if (tabElem.innerText === 'Embed') {
                tabElem.style.display = 'none';
            }
          });
        }
      });
    },
 



            //     file_picker_callback: function(cb, value, meta) {
            //     var input = document.createElement('input');
            //     input.setAttribute('type', 'file');
            //     input.setAttribute('accept', 'image/*');
            //     input.onchange = function() {
            //         var file = this.files[0];

            //         var reader = new FileReader();
            //         reader.readAsDataURL(file);
            //         reader.onload = function () {
            //             var id = 'blobid' + (new Date()).getTime();
            //             var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            //             var base64 = reader.result.split(',')[1];
            //             var blobInfo = blobCache.create(id, file, base64);
            //             blobCache.add(blobInfo);
            //             cb(blobInfo.blobUri(), { title: file.name });
            //         };
            //     };

            //     input.click();
            // }




 });

editor.addMenuItem('htmlPaste', {
  text: 'Paste HTML',
  icon: 'paste',
  context: 'file',
  onclick: function() {
    tinymce.activeEditor.setContent('<span>some</span> html');
    editor.notificationManager.open({
      text: 'HTML pasted.',
      type: 'info',
      timeout: 2000,
      closeButton: false
    });
  }
});
editor.addMenuItem('htmlCopy', {
  text: 'Copy HTML',
  icon: 'copy',
  context: 'file',
  onclick: function() {
    editor.notificationManager.open({
      text: 'HTML copied.',
      type: 'info',
      timeout: 2000,
      closeButton: false
    });
  }
});
</script>