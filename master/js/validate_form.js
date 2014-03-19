// validate register form functionality 
$(document).ready() 
{
	$("#email").focusout( function ( event){
		var email = $(this).val();
		var $formGroup = $(this).closest('div[class^="form-group"]') ;
		if ( email.length == 0 )
		{ 
			// alert("email length ");
			$formGroup.removeClass('has-error');
			$formGroup.removeClass('has-success');
			return ; 
		} 
		var regex_pattern =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		 
		if ( !regex_pattern.test(email) ) 
		{ 
			// alert() ;
			$formGroup.removeClass('has-success');
			$formGroup.addClass('has-error');
		} 
		else 
		{
			//alert($(this).val()) ;
			$formGroup.removeClass('has-error');
			$formGroup.addClass('has-success');
		}
	} ); 
}
