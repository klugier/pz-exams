jQuery( document ).ready(function( $ ) {
	// enums error service 
	var emailFieldErrorType =  { 
		BAD_DOMAIN : 0 , 
		NOT_AN_EMAIL : 1
	} ;  
	
	var passwdFieldErrorType =  { 
		PASSWD_UNCONFIRMED : 0 , 
		PASSWD_TOO_SHORT : 1
	} ;
	
	// functions error service  
	function deleteSelectorError ( $selector )
	{ 
			$($selector).html("");
	} 
	
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
	
	function PasswordValidationManager ( ) 
	{ 
		this.emailConfirmed = false ; 
		this.emailLenghtProper = false ; 
		this.passwdFormGroup = $("#passwd").closest('div[class^="form-group"]') ;
		this.repeatedPasswdFormGroup = $("#passwd-repeat").closest('div[class^="form-group"]') ;
		
		this.passwordValid  = function ( ) 
		{ 
			return ( this.emailConfirmed && this.emailLenghtProper ) ; 
		} ;
		
		this.passwdLengthInvalid = function ( ) 
		{ 
			this.passwdError ( passwdFieldErrorType.PASSWD_TOO_SHORT ) ; 
			this.passwdFormGroup.addClass('has-error') ;
			this.emailLenghtProper = false ; 
		} ;
		
		this.passwdLengthValid = function ( ) 
		{ 
			this.deletePasswdError ("#passwd-error-message") ; 
			this.passwdFormGroup.attr( "class", "form-group");
			this.passwdFormGroup.addClass('has-success');
			this.emailLenghtProper = true ; 
		} ;
		
		this.passwdsDifferent = function ( ) 
		{ 
			this.passwdError( passwdFieldErrorType.PASSWD_UNCONFIRMED ) ; 
			this.repeatedPasswdFormGroup.attr( "class", "form-group") ;
			this.repeatedPasswdFormGroup.addClass('has-error') ;
			this.emailConfirmed = false ;
		} ;
		
		this.passwdsTheSame = function ( ) 
		{ 
			this.deletePasswdError ("#passwd-repat-error-message") ; 
			this.repeatedPasswdFormGroup.attr( "class", "form-group") ;
			this.repeatedPasswdFormGroup.addClass('has-success') ;
			this.emailConfirmed = true ;
		} ;
		
		this.clearBothFieldStyle = function  ( ) 
		{ 
			this.repeatedPasswdFormGroup.attr( "class", "form-group");
			this.passwdFormGroup.attr( "class", "form-group"); 
			this.deletePasswdError ("#passwd-repat-error-message") ;
			this.deletePasswdError ("#passwd-error-message") ; 
			this.emailConfirmed = false ;
			this.emailLenghtProper = false ; 
		} ;
		
		
		this.passwdError = function  ( $errorCode )
		{ 
			if ($errorCode == passwdFieldErrorType.PASSWD_UNCONFIRMED) {  
				$("#passwd-repat-error-message").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
													'<span style="padding:5px"> Podane hasła nie są takie same. </span>');
				return ; 
			}
			if ($errorCode == passwdFieldErrorType.PASSWD_TOO_SHORT) {  
				$("#passwd-error-message").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
													'<span style="padding:5px"> Podane hasło musi mieć min 6 znaków. </span>');
				return ; 
			}
			
		} ;
		
		this.deletePasswdError = function ( $selector )
		{ 
			$($selector).html("");
		} ;
			
	} 
	
	var passValidationManager = new PasswordValidationManager () ;  
	
	$("#register_form").submit(function(e){
		var regex_pattern =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if (!regex_pattern.test($("#email").val())
			|| ($("#email").val().indexOf("uj.edu.pl") == -1)
		) {
			//alert ("can't  submit email "); 
			return false ;
		} 
		if ( (passValidationManager.emailConfirmed != true)  
			 || (passValidationManager.emailLenghtProper  != true  ) 
		) {  
			//alert ("can not submit password");
			return false ; 
		} 
		if ( $("#captcha_code").val().length != 6 ) { 
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
		var passwdVal = $("#passwd").val();
		var repeatedPasswdVal = $('input[id="passwd-repeat"]').val(); 
		
		if ( passwdVal.length == 0 && repeatedPasswdVal.length == 0  )
		{ 
			passValidationManager.clearBothFieldStyle();
			return ; 
		}
		
		if ( passwdVal != repeatedPasswdVal ) { 
			passValidationManager.passwdsDifferent();
		} 
		else { 
			passValidationManager.passwdsTheSame();
		} 
		
	} ) ; 
	
	$("#passwd").focusout( function (event) { 
		
		var passwdVal = $("#passwd").val();
		var repeatedPasswdVal = $('input[id="passwd-repeat"]').val(); 
		
		if ( passwdVal.length == 0 && repeatedPasswdVal.length == 0  ) { 
			passValidationManager.clearBothFieldStyle();
			return ; 
		}
		
		if ( passwdVal.length > 0 && passwdVal.length < 6  ) { 	
			passValidationManager.passwdLengthInvalid ();
		} else { 
			passValidationManager.passwdLengthValid ();
		}
		
		if ( repeatedPasswdVal.length === 0 ) {  
			return ;  
		} 
		else if ( passwdVal != repeatedPasswdVal  ) { 
			passValidationManager.passwdsDifferent();
		} 
		else { 
			passValidationManager.passwdsTheSame();
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
