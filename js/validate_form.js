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
			$("#email-error-message").css('visibility' , 'hidden');
			return ; 
		} 
		var regex_pattern =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		 
		if ( !regex_pattern.test(email) ) 
		{ 
			// alert() ;
			$("#email-error-message").css('visibility' , 'visible');
			$formGroup.removeClass('has-success');
			$formGroup.addClass('has-error');
		} 
		else 
		{
			//alert($(this).val()) ;
			$("#email-error-message").css('visibility' , 'hidden');
			$formGroup.removeClass('has-error');
			$formGroup.addClass('has-success');
		}
	} ); 

	$("#passwd-repeat").focusout( function (event) { 
		var repeatedPasswd = $(this).val();
		var passwd = $('input[id="passwd"]').val(); 
		var $formGroup = $(this).closest('div[class^="form-group"]') ;
		var $passwdFormGroup = $("#passwd").closest('div[class^="form-group"]') ;
		// alert ( passwd +" -- "+ repeatedPasswd ) ; // only testing purposes 

		if ( repeatedPasswd == 0 )
		{ 
			$("#passwd-repat-error-message").css('visibility' , 'hidden');			
			$formGroup.removeClass('has-error');
			$formGroup.removeClass('has-success');
			$passwdFormGroup.removeClass('has-success');
		} 

		if ( repeatedPasswd != passwd ) 
		{ 
			$("#passwd-repat-error-message").css('visibility' , 'visible');			
			$formGroup.addClass('has-error');
			$formGroup.removeClass('has-success');
			$passwdFormGroup.removeClass('has-success'); 
		}    
		else 
		{ 
			$("#passwd-repat-error-message").css('visibility' , 'hidden');
			$formGroup.removeClass('has-error');
			$passwdFormGroup.addClass('has-success');
			$formGroup.addClass('has-success');
		} 
	} ) ; 
	
	/*$("#passwd-repeat").keyup( function (event) { 
		var repeatedPasswd = $(this).val();
		var passwd = $('input[id="passwd"]').val(); 
		var $formGroup = $(this).closest('div[class^="form-group"]') ;
		// alert ( passwd +" -- "+ repeatedPasswd ) ; // only testing purposes 
		if ( repeatedPasswd != passwd ) 
		{ 
			$formGroup.addClass('has-warning'); 
		}    
	} ) ; */
}
