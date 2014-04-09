jQuery( document ).ready(function( $ ) {
	// enums error service 
	var emailFieldErrorType =  { 
		BAD_DOMAIN : 0 , 
		NOT_AN_EMAIL : 1 , 
		ADRESS_ALREADY_USED : 2 
	} ;  
	
	var captchaFieldErrorType = { 
		LENGTH_IMPROPER : 0 
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
											'<span style="padding:5px"> Przepraszamy w chwiki opecnej ta domena nie jest obsługiwana.</span>') ; 
			return ; 
		} 
		if  ($errorCode ==  emailFieldErrorType.ADRESS_ALREADY_USED) { 
			$("#email-error-message").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px">Na podany adres zarejestrowano już konto.</span>') ; 
			return ; 
		}
	} 
	
	function captchaError ( $errorCode )
	{ 
		if ( $errorCode == captchaFieldErrorType.LENGTH_IMPROPER  ) { 
			$("#captcha-error-message").html('<span style="background-color:#F13333;" class="badge pull-left">!</span>' + 
											  '<span style="padding:5px">Długość kodu niepoprawna</span>') ; 
			return ; 
		} 
		
	} 
	
	
	function checkDomain($email) {
		var isCorrectDomain = false;
		
		$.ajax({
			url:   'lib/Ajax/AjaxUserDomainRequest.php',
			async: false,
			type:  'post',
			data: { 'email' : $email },
			success:
				function(data, status) {
					if (data.status.trim() === "dataRecived") {
						if (data.domain.trim() === "exists") {
							isCorrectDomain = true;
						}
					}
				}
			,
			error:
				function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus);
				}
		});
		
		return isCorrectDomain;
	}
	
	var passValidationManager = new PasswordValidationManager();
	
	// jQuery events 
	
	$("#register_form").submit(function(e){
		var regex_pattern =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if (!regex_pattern.test($("#email").val())
			|| ($("#email").val().indexOf("uj.edu.pl") == -1)
		) {
			//alert ("can't  submit email "); 
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
			return ; 
		} 
		var emailRegexPattern =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		 
		// alert ( checkIfUserInDatabase(email)   ) ;  
		
		if (!emailRegexPattern.test(email)) { 
			// alert() ;
			emailError ( emailFieldErrorType.NOT_AN_EMAIL  ) ;
			$formGroup.removeClass('has-success');
			$formGroup.addClass('has-error');
		} 
		else if (checkDomain(email) == false) { 
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

	
	
	$("#captcha_code").focusout( function (event) {
		if ( $(this).val().length != 6 &&  $(this).val().length != 0   )  { 
			captchaError ( captchaFieldErrorType.LENGTH_IMPROPER  ) ; 
		} else { 
			deleteSelectorError( "#captcha-error-message");
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
