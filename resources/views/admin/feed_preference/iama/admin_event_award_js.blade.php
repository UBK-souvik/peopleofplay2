<script type="text/javascript">

$(document).ready(function(){
	
	    		
		if(document.getElementById('txt_nominee_name'))
		{
		  admin_get_event_award_nominee_list('txt_nominee_name', '{{route("admin.user.award.nominee.list")}}', '', 'create-form');
		}
		
		
    });

			
	function admin_get_event_award_nominee_list(div_id_new, url_new, hidden_field_id, form_id_new)
	{	
	
	      var val = $('[name="type"]').val();
             		
	
	     $('#'+div_id_new)
		 // don't navigate away from the field on tab when selecting an item
		.bind( "keydown", function( event ) {
		   if ( event.keyCode === $.ui.keyCode.TAB &&
			 $( this ).autocomplete( "instance" ).menu.active ) {
				event.preventDefault();
			}
		})
		 .autocomplete({
        source: function( request, response ) {
		   // Fetch data
		   $.ajax({
			url: url_new,
			method: 'POST',
			dataType: "json",
			data: {
			 query: request.term,
             type: val,
			 token: ajax_csrf_token_new,
			},
			headers: {
			 'X-CSRF-TOKEN': ajax_csrf_token_new
			},
			success: function( data ) {
			 response( data );
			 if(data.length == 0)
			 {
			    $('#'+hidden_field_id).val(0);	 
			 }
			 
			}
		   });
		  },
	     change: autoCompleteChanged,
		minLength: 1,
		delay: 300,
		appendTo: $('#'+form_id_new),
		select: function( event, ui ) {
		event.preventDefault();
        //console.log( "Selected: " + ui.id + " aka " + ui.text );
		 var terms = split( this.value );
		// remove the current input
		terms.pop();
		// add the selected item
		terms.push( ui.item.text );
		// add placeholder to get the comma-and-space at the end
		terms.push( "" );
		this.value = terms.join( ", " );
			
			var selected_label = ui.item.id;
			var selected_value = ui.item.text;
			
			//var labels = $('#labels').val();
			//var values = $('#values').val();
			
			var labels = $('#hidden_nominee_ids').val();
			var values = $('#hidden_nominee_names').val();
			
			if(labels == "")
			{
				$('#hidden_nominee_ids').val(selected_label);
				$('#hidden_nominee_names').val(selected_value);
			}
			else    
			{
				$('#hidden_nominee_ids').val(labels+","+selected_label);
				$('#hidden_nominee_names').val(values+","+selected_value);
			}   
			
		return false;
		
		
      },
    focus: function(event, ui) {
		// prevent value inserted on focus
        return false;
		//event.preventDefault();
        //$('#'+div_id_new).val(ui.item.text);
    }/*,
	select: function( event, ui ) {

	}*/
		
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		
		var item_text = '';
		item_text = item.text;
		
	    var inner_html = item_text;
		return $( "<li></li>" )
            .data( "item.ui-autocomplete", item )
			.append("<a>" + item_text + "</a>")
            .appendTo( ul );
    }
	
}

function autoCompleteChanged(event, ui) {
    alert(ui);
}
	 
	
	function split( val ) {
return val.split( /,\s*/ );
}
function extractLast( term ) {
return split( term ).pop();
}
    
</script>