<script>
var base_url_new = "{{ url('/') }}";
		var ajax_csrf_token_new = '{!! csrf_token() !!}';
		var image_upload_path_new = '{{ App\Helpers\Utilities::get_images_upload_folder_path()}}';
		
		var slug_user_prefix_new = '{{ App\Helpers\Utilities::get_folder_prefix_data(1, "folder_prefix")}}';
		var slug_product_prefix_new = '{{ App\Helpers\Utilities::get_folder_prefix_data(2, "folder_prefix")}}';
		var slug_event_prefix_new = '{{ App\Helpers\Utilities::get_folder_prefix_data(3, "folder_prefix")}}';
		var slug_brand_prefix_new = '{{ App\Helpers\Utilities::get_folder_prefix_data(5, "folder_prefix")}}';
		var slug_blog_prefix_new = '{{ App\Helpers\Utilities::get_folder_prefix_data(6, "folder_prefix")}}';
		
		var str_get_def_image_new = '{{@imageBasePath("")}}';
        var str_prod_event_get_def_image_new = '{{@prodEventImageBasePath("")}}';
		var str_blog_news_get_def_image_new = '{{@newsBlogImageBasePath("")}}';
		var get_current_screen_size;
		get_current_screen_size = $(window).width();
</script>		