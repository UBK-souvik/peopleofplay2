<?php
  $current_url_new = URL::current();
?>
<script>

  var str_get_tags_data_url ='';
 
  <?php if(strpos($current_url_new,'/admin/')>0): ?>
	 str_get_tags_data_url = "<?php echo e(url('admin/users/skills/getTagsDropdown')); ?>";  
  <?php else: ?>
	 str_get_tags_data_url = "<?php echo e(url('user/profile/getTagsDropdown')); ?>";  
  <?php endif; ?>
 	
 
 $(function () {
        //console.log($('#myTags').tagsValues())
		
		$('#Skills').tagsInput({
					'autocomplete': {
						source: function (query, process) {
							var myString = JSON.stringify(query);
							var obj = JSON.parse(myString);
							var str_term_data =  obj.term;
							return jQuery.get(str_get_tags_data_url , { query: str_term_data }, function(data){  
							    return process(data);              
							});
						},
                        minLength: 3,
					} 
				});
    })
</script>	