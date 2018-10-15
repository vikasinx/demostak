jQuery(function() {
jQuery('#Submit').click(function(e){
	e.preventDefault();	
    var name = jQuery("#vname").val();
    var email = jQuery("#vmail").val();
    var msg = jQuery("#vmsg").val();
    var ajaxurl = jQuery("#ajaxurl").val();
    jQuery.ajax({ 
         data: {action: 'vtest_form_submit', name:name, email:email, msg:msg},
         type: 'post',
         url: ajaxurl,
         success: function(data) {
         	/*alert('asdas');*/
         	jQuery('#test_form')[0].reset();
         	jQuery('.Message').html(data);
        }
    });
    return false;
});
});