
<?php
$current_url_new = URL::current();  

?>
<!DOCTYPE html>
<html>
   <head>
      <title>People Of Play</title>
      <meta charset="utf-8">
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
      <meta http-equiv="Pragma" content="no-cache" />
      <meta http-equiv="Expires" content="0" />
      <meta name="description" content="People Of Play">
      <meta name="keywords" content="People Of Play">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta property="og:url" content="<?php echo e(url('pages/meme/'.$meme->id)); ?>">
      <meta property="og:type" content="Website">
      <meta property="og:title" content="People Of Play">
      <meta property="og:description" content="Meme Of The Day">
      <meta property="og:image" content="<?php echo e(@$str_og_image_new); ?>">
      <meta property="og:image:width" content="200" />
      <meta property="og:image:height" content="200" />
      
      <meta name="twitter:title" content="People Of Play">
      <meta property="twitter:description" content="People Of Play">
      <meta name="twitter:image" content="<?php echo e(@$str_og_image_new); ?>">
      <meta property="twitter:image:width" content="652" />
      <meta property="twitter:image:height" content="480" />
      <link rel="shortcut icon" href="<?php echo e(asset('front/images/mainLogo.png')); ?>" />
     
   <body>
        <script type="text/javascript">
             window.location.href = "<?php echo e(route('front.home')); ?>";
          </script>
   </body>
</html>