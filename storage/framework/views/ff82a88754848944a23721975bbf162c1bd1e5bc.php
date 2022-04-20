<script>
  function myFunction() {
      var dots = document.getElementById("dots");
      var moreText = document.getElementById("more");
      var btnText = document.getElementById("myBtn");

      if (dots.style.display == "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Expand >>"; 
        moreText.style.display = "none";
      } else {
        dots.style.display = "none";
        btnText.innerHTML = "<< Collapse"; 
        moreText.style.display = "contents";
      }
    }

    function myFunctionSocialMedia() {
      var dots = document.getElementById("dots");
      var moreText = document.getElementById("more");
      var btnText = document.getElementById("myBtn");

      if (dots.style.display == "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Expand >>"; 
        moreText.style.display = "none";
      } else {
        dots.style.display = "none";
        btnText.innerHTML = "<< Collapse"; 
        moreText.style.display = "contents";
      }
    }

    function a_myFunction() {
     var dots = document.getElementById("a_dots");
     var moreText = document.getElementById("a_more");
     var btnText = document.getElementById("a_myBtn");
   
     if (dots.style.display == "none") {
       dots.style.display = "inline";
       btnText.innerHTML = "Expand >>"; 
       moreText.style.display = "none";
     } else {
       dots.style.display = "none";
       btnText.innerHTML = "<< Collapse"; 
       moreText.style.display = "contents";
     }
   }
   function award_mobile_myFunction() {
     var dots = document.getElementById("award_mobile_dots");
     var moreText = document.getElementById("award_mobile_more");
     var btnText = document.getElementById("award_mobile_myBtn");
   
     if (dots.style.display == "none") {
       dots.style.display = "inline";
       btnText.innerHTML = "Expand >>"; 
       moreText.style.display = "none";
     } else {
       dots.style.display = "none";
       btnText.innerHTML = "<< Collapse"; 
       moreText.style.display = "contents";
     }
   }
  </script>
  <script>
  
  
   // delete the empty divs with no content in it for product slide show
   function delete_empty_row_divs(div_id)
   {
    $("#"+div_id + " .owl-stage-outer .owl-stage .owl-item").each(function(){
        
			  $(this).children().each(function(){
			
			  var str_children_div =  $(this).children().children();
				   
			  var str_children_div_class =  str_children_div.attr("class");
			
			  if(str_children_div_class == 'undefined' || str_children_div_class == undefined)
			  {
				  
			  }
			
			  if(str_children_div.attr("class") == undefined || str_children_div.attr("class") == 'undefined')
			  {
				  
			  }
			  
			  var str_child_content_new =  str_children_div.html();

			 });
			
			  var str_child_div_id_new = $(this).children().attr("id");
			  
			  if(str_child_div_id_new == undefined || str_child_div_id_new == "undefined")
			  {
				  $(this).remove();
			  }
		
         });
     } 
	 
	 
	 function  delete_slide_show_empty_rows_main(str_main_div_id)
	 {
	 // when next is clicked in the product slide show 
		$('body').on('click','#'+str_main_div_id + ' button.owl-next span',function(e){
			
		 delete_empty_row_divs(str_main_div_id);
		
	    });
		
		// when previous is clicked in the  product slide show
		$('body').on('click','#'+str_main_div_id + ' button.owl-prev span',function(e){
			
		 delete_empty_row_divs(str_main_div_id);
		
	    });
		
		// delete the empty divs with no content in it on page load
		delete_empty_row_divs(str_main_div_id);
	 
	 }
  
    $(document).ready(function() {
      // var owl_loop_items = false;


      var user_product_list_loop = false;
       if(typeof user_product_list_count !== 'undefined' && user_product_list_count >5) {
         var user_product_list_loop = true;
        }
      var user_media_list_loop = false;
       if(typeof user_media_list_count !== 'undefined' && user_media_list_count >5) {
         var user_media_list_loop = true;
        }
      var user_brand_list_loop = false;
       if(typeof user_brand_list_count !== 'undefined' && user_brand_list_count >5) {
         var user_brand_list_loop = true;
        }
      var user_blog_list_loop = false;
      if(typeof user_blog_list_count !== 'undefined' && user_blog_list_count >5) {
         var user_blog_list_loop = true;
        }
       var user_award_list_loop = false;
      if(typeof user_award_list_count !== 'undefined' &&  user_award_list_count > 5) {
        var user_award_list_loop = true;
      }
       

   
		
		/*$("#user-product-slider-div").find(".button").click(function () {
        alert("hi there");
        return false;
        });    */

  render_owl_slide_show('userProductSlider',1, 3, 3, 4, 5,user_product_list_loop);
  render_owl_slide_show('userMediaSlider', 1, 3, 3, 4, 5,user_media_list_loop);
  render_owl_slide_show('userBrandSlider', 1, 2, 2, 2, 4,user_brand_list_loop);
  render_owl_slide_show('userBlogSlider', 1, 3, 3, 4, 5,user_blog_list_loop);
  render_owl_slide_show('userAwardSlider', 1, 3, 3, 4, 5,user_award_list_loop);



on_change_owl_slider('userProductSlider', 'user-product-slider-div');

on_change_owl_slider('userBrandSlider', 'user-brand-slider-div');

		
		  delete_slide_show_empty_rows_main('user-product-slider-div');

          delete_slide_show_empty_rows_main('user-brand-slider-div');		  
		  
          $(".full_award_list").hide();

          $(".see_full_award_list").click(function(eve) {
              eve.preventDefault();
              $(".full_award_list, .short_award_list").toggle();
          });
    });

  </script>


  <script>


function on_change_owl_slider(str_class_name, str_div_id)
{
	
	   var owl = $('.'+str_class_name);
owl.owlCarousel();
// Listen to owl events:
owl.on('changed.owl.carousel', function(event) {
    delete_empty_row_divs(str_div_id);
})
	
}

  </script>



  <script>
  
  function render_owl_slide_show(str_class_name, item_1, item_2, item_3, item_4, item_5,owl_loop_items=false)
  {

	var str_responsiveClass = false;
	var str_nav = false;
	  
	if(str_class_name == 'userProductSlider')
	{
	  str_responsiveClass = true;
	}
	
	if(str_class_name== 'userProductSlider')
	{
	  //str_nav = false;
	}
	  
	  $('.'+str_class_name).owlCarousel({
         

        margin:10,	
        responsiveClass:str_responsiveClass,
        nav:true,
        dots: false,
        mergeFit: true,
       loop: owl_loop_items,
        // center: true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
         responsive:{
             0:{
                 items:item_1
             },
              400:{
                 items:item_2
             },
             600:{
                 items:item_3
             },
             786:{
                 items:item_4
             },
             1200:{
                 items:item_5
             }
         }
     })
  }


function show_more_than_5_user_roles(int_user_role_flag_new)
{
   if(int_user_role_flag_new == 1)
   {
	 document.getElementById("user_role_data_loop_id_less_than_5").style.display = 'none';
     document.getElementById("user_role_data_loop_id_more_than_5").style.display = 'block'; 
     document.getElementById("user_role_collapse_div_id").style.display = 'block';
     document.getElementById("user_role_expand_div_id").style.display = 'none';	 
   }	   
   
   if(int_user_role_flag_new == 2)
   {
	 document.getElementById("user_role_data_loop_id_less_than_5").style.display = 'block';
     document.getElementById("user_role_data_loop_id_more_than_5").style.display = 'none'; 
     document.getElementById("user_role_collapse_div_id").style.display = 'none';
	 document.getElementById("user_role_expand_div_id").style.display = 'block';
   }
   
}

function openShowRoleModalPopupNew(div_id, main_parent_div_id){

       var modal_see_more_form = '#' + main_parent_div_id + ' #SeeMore'+div_id;

	   $(modal_see_more_form).show();

	   $(modal_see_more_form).css('display', 'block');

	   $(modal_see_more_form).modal({ show: true });
	   
     }

	 
  </script>
  
  <script>
   function addFavorite(e,type,user_id) {
      $.ajax({
        url: "<?php echo e(route('front.pages.add_to_watch_list')); ?>?type=1&value="+user_id,
        data: {},
        processData: false,
        contentType: false,
        dataType: 'json',
        type: 'GET',
        success: function (data) {
         $('.AddToFavorites').html('');
         $('.AddToFavorites').html('<a type="button"  href="javascript:void(0);" onclick="removeFavorites(this,'+data.id+','+type+','+user_id+');" class="btn NoPaddingWatch "><i class="fa fa-star mr-1" aria-hidden="true" style="color:#652793;"></i> Added to Favorites</a>');
         toastr.success(data.msg);
      }
   });
   }
   
   function removeFavorites(e,id,type,user_id) {
     $.ajax({
        url: "<?php echo e(url('remove-from-watch-list/')); ?>/"+id,
        data: {},
        processData: false,
        contentType: false,
        dataType: 'json',
        type: 'GET',
        success: function (data) {
           $('.AddToFavorites').html('');
           $('.AddToFavorites').html('<a type="button" href="javascript:void(0);" onclick="addFavorite(this,'+type+','+user_id+');" class="btn NoPaddingWatch "><i class="fa fa-star-o mr-1" aria-hidden="true"></i>Add to Favorites</a>');

           toastr.success(data.msg);
        }
     });
  }


  function fun_fact1_readmore() {
   $('.ff1_read_more').show();
   $('.fun_fact_1_btn_less').show();
   $('.ff1_read_less').hide();
  }
    function fun_fact1_readless() {
   $('.ff1_read_less').show();
   $('.fun_fact_1_btn_more').show();
   $('.ff1_read_more').hide();
    $('.fun_fact_1_btn_less').hide();
  }

    function fun_fact2_readmore() {
   $('.ff2_read_more').show();
   $('.fun_fact_2_btn_less').show();
   $('.ff2_read_less').hide();
  }
    function fun_fact2_readless() {
   $('.ff2_read_less').show();
   $('.fun_fact_2_btn_more').show();
   $('.ff2_read_more').hide();
    $('.fun_fact_2_btn_less').hide();
  }


   function fun_fact3_readmore() {
   $('.ff3_read_more').show();
   $('.fun_fact_3_btn_less').show();
   $('.ff3_read_less').hide();
  }
    function fun_fact3_readless() {
   $('.ff3_read_less').show();
   $('.fun_fact_3_btn_more').show();
   $('.ff3_read_more').hide();
    $('.fun_fact_3_btn_less').hide();
  }

  function getIMageGallery(id,type,user_id,show_btn) {

     $.ajax({
        url: "<?php echo e(route('front.gallery.images.modal_list')); ?>",
       data: {
        "_token": "<?php echo e(csrf_token()); ?>",
      'id':id,
      'type':type,
      'user_id':user_id,
      'show_btn':show_btn,
        },
        dataType: 'json',
        type: 'POST',
        success: function (data) {
            $('#DefaultModal').modal('show');
            $('#DefaultModal .modal-content').html(data.view);
        }
     });
  }

  function deleteGallery(id){
   if (confirm('Are you sure delete ?')) {
     $.ajax({
        url: "<?php echo e(route('front.all.videogallery.delete')); ?>",
       data: {
        "_token": "<?php echo e(csrf_token()); ?>",
      'gallery_id':id,
        },
        dataType: 'json',
        type: 'POST',
        success: function (data) {
              $('#DefaultModal').modal('hide');
             $('#DefaultModal .modal-content').html('');
             location.reload();
             //$('#modal-user-role-type-popup-new').modal('hide');
        }
     });
       }else{
      console.log('cancel')
    }
  }
</script>
  <?php echo $__env->make("front.includes.include_read_more_js", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>