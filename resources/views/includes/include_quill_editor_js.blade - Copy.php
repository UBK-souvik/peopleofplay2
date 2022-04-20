<script language="javascript" type="text/javascript">

/*var quill = new Quill('#editor-container', {
                modules: {
                toolbar: [
                ['bold', 'italic'],
                ['link', 'blockquote', 'code-block', 'image'],
                [{ list: 'ordered' }, { list: 'bullet' }]
                ]
                },
                //placeholder: 'Compose an epic...',
                theme: 'snow' 
                }); */
				
var quill = new Quill('#editor-container', {
    modules: {
	videoResize: {
                modules: [ 'Resize', 'DisplaySize', 'Toolbar' ],
                tagName: 'iframe', // iframe | video
        	},	
    imageResize: {
	   displaySize: true
	  },	
      syntax: true,
      toolbar: '#toolbar-container'
    },
    
    //placeholder: 'Compose an epic...',
    theme: 'snow',
    bounds: quill
  });

//import Quill from 'quill';
// BEGIN allow image alignment styles
const ImageFormatAttributesList = [
  'alt',
  'height',
  'width',
  'style'
];

const BaseImageFormat = Quill.import('formats/image');
class ImageFormat extends BaseImageFormat {
  static formats(domNode) {
    return ImageFormatAttributesList.reduce(function(formats, attribute) {
      if (domNode.hasAttribute(attribute)) {
        formats[attribute] = domNode.getAttribute(attribute);
      }
      return formats;
    }, {});
  }
  format(name, value) {
    if (ImageFormatAttributesList.indexOf(name) > -1) {
      if (value) {
        this.domNode.setAttribute(name, value);
      } else {
        this.domNode.removeAttribute(name);
      }
    } else {
      super.format(name, value);
    }
  }
}

Quill.register(ImageFormat, true);
// END allow image alignment styles


  
</script>	


<script type="module">
// Import the format
//import { Video } from '{{ URL::to("backend/js/quill-video-resize.js") }}'
import { Video } from '{{ URL::to("backend/js/quill-video-resize.js") }}';
//Video = require('{{ URL::to("backend/js/quill-video-resize.js") }}');

// register with Quill
Quill.register({ 'formats/video': Video });

// Build the editor
//quill = new Quill(domElem, config);

// You must add the editor to the root element after the editor was created and before the video embed!
quill.root.quill = quill;

// Embed the video into the editor:
//let src = 'https://www.youtube.com/embed/o-KdQiObAGM'
//quill.insertEmbed(index, 'video', src, 'user');
</script>