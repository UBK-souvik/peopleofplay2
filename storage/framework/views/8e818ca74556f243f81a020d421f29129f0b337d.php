<script >
    function d_myFunction(div_id_new) {
        if (document.getElementById("div_limit_" + div_id_new)) {
            if (div_id_new == 'fun_fact_1' || div_id_new == 'fun_fact_2' || div_id_new == 'fun_fact_3') {
                d_myFunction_read_more_new('fun_fact_1');
                d_myFunction_read_more_new('fun_fact_2');
                d_myFunction_read_more_new('fun_fact_3');
            } else {
                d_myFunction_read_more_new(div_id_new);
            }
        }
    }

function d_myFunction_read_more_new(div_id_new) {
    if (document.getElementById("div_limit_" + div_id_new) && $('#div_limit_' + div_id_new).css('display') != null) {
        var dots = document.getElementById("d_dots_" + div_id_new);
        var moreText = document.getElementById("d_more_" + div_id_new);
        var btnText = document.getElementById("d_myBtn_" + div_id_new);

        if ($('#d_dots_' + div_id_new).css('display') != null) {
            if (dots.style.display == "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read More";
                moreText.style.display = "none";

                document.getElementById("div_limit_" + div_id_new).style.display = 'block';

                set_div_height_new(div_id_new, 2);

            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read Less";
                moreText.style.display = "contents";

                document.getElementById("div_limit_" + div_id_new).style.display = 'none';

                set_div_height_new(div_id_new, 1);

            }
        }


        //alert('div_id_new: '+$("#d_more_"+div_id_new).css("height", $(window).height()));

    }
}


function get_largest_fun_fact_number_new(int_main_funfact_box_1, int_main_funfact_box_2, int_main_funfact_box_3) {
    var largest = 0;

    if (int_main_funfact_box_1 >= int_main_funfact_box_2 && int_main_funfact_box_1 >= int_main_funfact_box_3) {
        largest = int_main_funfact_box_1;
    } else if (int_main_funfact_box_2 >= int_main_funfact_box_1 && int_main_funfact_box_2 >= int_main_funfact_box_3) {
        largest = int_main_funfact_box_2;
    } else {
        largest = int_main_funfact_box_3;
    }

    return largest;
}


function set_div_height_new(div_id_new, type) {
    /* for funfact boxes only */
    if (div_id_new == 'fun_fact_1' || div_id_new == 'fun_fact_2' || div_id_new == 'fun_fact_3') {
        var int_main_funfact_box_1 = int_fun_fact_word_length_js_1;
        var int_main_funfact_box_2 = int_fun_fact_word_length_js_2;
        var int_main_funfact_box_3 = int_fun_fact_word_length_js_3;

        var int_main_funfact_box_word_size_1 = int_fun_fact_no_of_word_size_js_1;
        var int_main_funfact_box_word_size_2 = int_fun_fact_no_of_word_size_js_2;
        var int_main_funfact_box_word_size_3 = int_fun_fact_no_of_word_size_js_3;

        let largest;
        let largest_word_size;

        var int_max_diff_fun_fact_desc_1 = 30;
        var int_max_diff_fun_fact_desc_2 = 100;
        var int_max_diff_fun_fact_desc_3 = 10;

        // check the condition
        largest = get_largest_fun_fact_number_new(int_main_funfact_box_1, int_main_funfact_box_2, int_main_funfact_box_3);

        largest_word_size = get_largest_fun_fact_number_new(int_main_funfact_box_word_size_1, int_main_funfact_box_word_size_2, int_main_funfact_box_word_size_3);

        if (int_main_funfact_box_1 > 0) {

        }

        // for a mobile
        if (get_current_screen_size < 567) {
            $('.funFactBox').css('height', 'auto');
        } else {
            $('.funFactBox').css('height', 'auto');

            var int_fun_fact_main_div_fun_fact_1_height = $('#fun_fact_main_div_fun_fact_1').height();
            var int_fun_fact_main_div_fun_fact_2_height = $('#fun_fact_main_div_fun_fact_2').height();
            var int_fun_fact_main_div_fun_fact_3_height = $('#fun_fact_main_div_fun_fact_3').height();

            int_fun_fact_main_div_fun_fact_height_largest = get_largest_fun_fact_number_new(int_fun_fact_main_div_fun_fact_1_height, int_fun_fact_main_div_fun_fact_2_height, int_fun_fact_main_div_fun_fact_3_height);

            $(".funFactBox").height(int_fun_fact_main_div_fun_fact_height_largest);

            //alert(moreText.style.display);
            /*if(type == 1)
							   {
								 var int_largest_fraction = largest/1.5; 
								 
								 if((largest - int_main_funfact_box_1) > int_max_diff_fun_fact_desc_2 || (largest - int_main_funfact_box_2) >int_max_diff_fun_fact_desc_2 || (largest - int_main_funfact_box_3) >int_max_diff_fun_fact_desc_2)
								 {
									 //console.log(1);
									 var int_largest_fraction = largest/2;							 
									 largest = largest + int_largest_fraction;
								 }
								 else if((largest - int_main_funfact_box_1) > int_max_diff_fun_fact_desc_1 || (largest - int_main_funfact_box_2) >int_max_diff_fun_fact_desc_1 || (largest - int_main_funfact_box_3) >int_max_diff_fun_fact_desc_1)
								 {
									 //console.log(2);
									 largest = largest + int_largest_fraction + int_max_diff_fun_fact_desc_1;
								 }
								 else if((largest - int_main_funfact_box_1) <= int_max_diff_fun_fact_desc_3 || (largest - int_main_funfact_box_2) <= int_max_diff_fun_fact_desc_3 || (largest - int_main_funfact_box_3)<= int_max_diff_fun_fact_desc_3)
								 {
									 //console.log(3);
									 var int_largest_fraction = largest/2;
									 largest = largest + int_largest_fraction;
								 }						 
								 else
								 {
									 //console.log(4);
									 largest = largest + int_largest_fraction + 60;							 
								 }						 
								 
								  for description with bigger words of size more than 15 
								 if(largest_word_size>0)
								 {
								   largest = largest + largest_word_size + int_fun_fact_word_size_new_js;	 
								 }						 
								 
								 //var int_main_funfact_box = $(".funFactBox").height();
								 $(".funFactBox").height(largest);
							   }
							   else
							   {
								  $(".funFactBox").height(100); 
							   }*/

        }
        //$("#d_more_fun_fact_2").height(largest);
        //$("#d_more_fun_fact_3").height(largest);
    }
}
</script>	