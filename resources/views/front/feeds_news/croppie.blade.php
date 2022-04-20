<html lang="en">
<head>
  <title>How to Image Upload and Crop in Laravel with Ajax</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('front/new/js/croppie.js?.time()') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div class="container">
  <div class="card" style="max-height: 500px;">
    <div class="card-header bg-primary text-center text-white">How to Image Upload and Crop in Laravel with Ajax</div>
    <div class="card-body">

      <div class="row">
        <div class="col-md-4 text-center">
        <div id="upload-demo"></div>
        </div>
        <div class="col-md-4" style="padding:5%;">
        <strong>Select image to crop:</strong>
        <input type="file" id="image">

        <button class="btn btn-success btn-block upload-image" style="margin-top:2%; display: none;">Cropping Image</button>
        <button class="btn btn-info btn-block reset-crop" onclick="resetCrop(this);" style="margin-top:2%; display: none;"></button>
        </div>

        <div class="col-md-4">
        <div id="preview-crop-image" style="background:#9d9d9d;width:300px;padding:50px 50px;height:300px;display: none;"></div>
        </div>
      </div>

    </div>
  </div>
</div>


<script type="text/javascript">
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
// var wH = $(window).height();
// var wW = $(window).width();
var resize = $('#upload-demo').croppie({

    enableExif: true,
    enableOrientation: true,    
    viewport: { // Default { width: 100, height: 100, type: 'square' } 
        width: wW / 2,
        height: wH  / 2,
        type: 'square' //square
    },
    boundary: {
        width: wW,
        height: wH
    }
});
$('#image').on('change', function () { 
  $('.upload-image').show();
  var reader = new FileReader();
    reader.onload = function (e) {
      resize.croppie('bind',{
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});
$('.upload-image').on('click', function (ev) {
  resize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
      var formData = new FormData($('#imagefeedForm')[0]);
      formData.append("_token", "{{ csrf_token() }}");
      formData.append("image", img);
    $.ajax({
      url: "{{route('front.feed.croppie-image-post')}}",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        $('#preview-crop-image').show();
        html = '<img src="' + img + '" />';
        $("#preview-crop-image").html(html);
        $('#upload-demo').hide();
        $('.upload-image').hide();
        $('.reset-crop').show();

      }
    });
  });
});

function resetCrop(e) {
   $('#upload-demo').show();
   $('#preview-crop-image').hide();
   $('.reset-crop').hide();
}
</script>


</body>
</html>