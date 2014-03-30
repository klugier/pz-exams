jQuery( document ).ready(function( $ ) {
	
	// enums error service 
	var emailFieldErrorType =  { 
		BAD_DOMAIN : 0 , 
		NOT_AN_EMAIL : 1
	} ;  
	// functions error service  
	function emailError ( $errorCode ) 
	{ 
		if  ($errorCode ==  emailFieldErrorType.NOT_AN_EMAIL) {
			$("#email-error-message").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px">Podany adress nie jest emailem.</span>') ; 
			return ; 
		} 
		if  ($errorCode ==  emailFieldErrorType.BAD_DOMAIN) { 
			$("#email-error-message").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px"> Nieprawidłowa domena( obowiązuje domena uj.edu.pl ).</span>') ; 
			return ; 
		} 
	} 
	
	function deleteSelectorError ( $selector )
	{ 
		$($selector).html("");
	} 
	
	$("#register_form").submit(function(e){
		var regex_pattern =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if (  !regex_pattern.test( $("#email").val() )  )
		{
			//alert ("can't  submit email "); 
			return false ;
		} 
		if ( $('input[id="passwd-repeat"]').val() != $('input[id="passwd"]').val() ) 
		{  
			//alert ("can not submit password");
			return false ; 
		} 
		if ( $("#captcha_code").val().length != 6 ) 
		{ 
			$("#captcha-error-message").css('visibility' , 'visible');	
			return false ; 
		} 
		return true ; 
	}) ; 
	
	
	
	$("#email").focusout( function ( event){
		var email = $(this).val();
		var $formGroup = $(this).closest('div[class^="form-group"]') ;
		if ( email.length == 0 ) {  
			// alert("email length ");
			$formGroup.removeClass('has-error');
			$formGroup.removeClass('has-success');
			deleteSelectorError ( "#email-error-message" );
		} 
		var emailRegexPattern =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		 
		if (!emailRegexPattern.test(email)) { 
			// alert() ;
			emailError ( emailFieldErrorType.NOT_AN_EMAIL  ) ;
			$formGroup.removeClass('has-success');
			$formGroup.addClass('has-error');
		} 
		else if (email.indexOf("uj.edu.pl") == -1) { 
			emailError ( emailFieldErrorType.BAD_DOMAIN  ) ;
			$formGroup.removeClass('has-success');
			$formGroup.addClass('has-error');
		} 
		else 
		{ 
			//alert($(this).val()) ;
			deleteSelectorError ( "#email-error-message" ); 
			$formGroup.removeClass('has-error');
			$formGroup.addClass('has-success');
		}
	} ); 

	$("#passwd-repeat").focusout( function (event) { 
		var repeatedPasswd = $(this).val();
		var passwd = $('input[id="passwd"]').val(); 
		var $repatedPasswdFormGroup = $(this).closest('div[class^="form-group"]') ;
		var $passwdFormGroup = $("#passwd").closest('div[class^="form-group"]') ;
		// alert ( passwd +" -- "+ repeatedPasswd ) ; // only testing purposes 

		if ( repeatedPasswd.length == 0 && passwd.length == 0)
		{  
			$("#passwd-repat-error-message").css('visibility' , 'hidden');			
			$repatedPasswdFormGroup.attr( "class", "form-group");
			$passwdFormGroup.attr( "class", "form-group"); 
		} 
		else if ( repeatedPasswd != passwd ) 
		{ 
			$("#passwd-repat-error-message").css('visibility' , 'visible');
			$repatedPasswdFormGroup.attr( "class", "form-group");
			$passwdFormGroup.attr( "class", "form-group");
			$repatedPasswdFormGroup.addClass('has-error'); 
		}    
		else 
		{  
			$("#passwd-repat-error-message").css('visibility' , 'hidden');
			$repatedPasswdFormGroup.attr( "class", "form-group");
			$passwdFormGroup.attr( "class", "form-group");
			$passwdFormGroup.addClass('has-success');
			$repatedPasswdFormGroup.addClass('has-success');
		} 
	} ) ; 
	
	$("#passwd").focusout( function (event) { 
		var passwd = $(this).val();
		var repeatedPasswd = $('input[id="passwd-repeat"]').val(); 
		var $passwdFormGroup = $(this).closest('div[class^="form-group"]') ;
		var $repeatedPasswdFormGroup = $("#passwd-repeat").closest('div[class^="form-group"]') ;
		if ( repeatedPasswd.length == 0 && passwd.length == 0)
		{ 	
			$("#passwd-repat-error-message").css('visibility' , 'hidden');			
			$passwdFormGroup.attr( "class", "form-group");
			$repeatedPasswdFormGroup.attr( "class", "form-group"); 
		} 
		else if ( repeatedPasswd != passwd )
		{ 
			if ( repeatedPasswd.length === 0  )
			{ 
				$("#passwd-repat-error-message").css('visibility' , 'hidden');			
				$passwdFormGroup.attr( "class", "form-group");
				$repeatedPasswdFormGroup.attr( "class", "form-group");
			} 
			else
			{ 
				$("#passwd-repat-error-message").css('visibility' , 'visible');			
				$repeatedPasswdFormGroup.attr( "class", "form-group");
				$passwdFormGroup.attr( "class", "form-group"); 
				$repeatedPasswdFormGroup.addClass('has-error');
			} 
		}
		else 
		{  
			$("#passwd-repat-error-message").css('visibility' , 'hidden');
			$repeatedPasswdFormGroup.attr( "class", "form-group");
			$passwdFormGroup.attr( "class", "form-group");
			$repeatedPasswdFormGroup.addClass('has-success');
			$passwdFormGroup.addClass('has-success');
		} 
	} ) ; 
	
	
	$("#captcha_code").focusout( function (event) {
		if ( $(this).val().length != 6 &&  $(this).val().length != 0   ) 
		{ 
			$("#captcha-error-message").css('visibility' , 'visible');	
		}
		else 
		{ 
			$("#captcha-error-message").css('visibility' , 'hidden');
		} 
	} ) ; 
	
	$( "div#invalid-captcha-code" ).delay(5000).slideUp("slow");
	
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
}); 
