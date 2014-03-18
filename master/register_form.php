<?php include("html/html_begin.php"); ?>  
 <div class="container"> 
	 <form class="form-horizontal" role="form">
	   <div class="form-group">
			<h2 class="col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-xs-5 col-sm-5 col-md-5"> Zarejestruj Konto </h2>
	   </div> 
	   <div class="form-group">
		  <label for="login" class="col-xs-2 col-sm-2 col-md-2 control-label">Login </label>
		  <div class="col-xs-4 col-sm-4 col-md-4">
			 <input type="text" class="form-control" id="login" placeholder="Wprowadź Login">
		  </div>
	   </div>
	   <div class="form-group">
		  <label for="email" class="col-xs-2 col-sm-2 col-md-2 control-label">E-mail </label>
		  <div class="col-xs-4 col-sm-4 col-md-4">
			 <input type="email" required class="form-control" id="email" placeholder="Wprowadź e-mail" title="">
		  </div>
	   </div>
	   <div class="form-group">
		  <label for="firstname" class="col-xs-2 col-sm-2 col-md-2 control-label">Imie </label>
		  <div class="col-xs-4 col-sm-4 col-md-4">
			 <input type="text" class="form-control" id="firstname" placeholder="Wprowadź Imię">
		  </div>
	   </div>
	   <div class="form-group">
		  <label for="lastname" class="col-xs-2 col-sm-2 col-md-2 control-label">Nazwisko</label>
		  <div class="col-xs-4 col-sm-4 col-md-4">
			 <input type="text" class="form-control" id="lastname" 
				placeholder="Wprowadź Nazwisko">
		  </div>
	   </div>
	   <div class="form-group">
		  <label for="passwd" class="col-xs-2 col-sm-2 col-md-2 control-label"> Hasło </label>
		  <div class="col-xs-4 col-sm-4 col-md-4">
			 <input type="password" class="form-control inputPassword" id="passwd" placeholder="Wprowadź Haslo">
		  </div>
	   </div>
	   <div class="form-group">
		  <div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-4 col-sm-4 col-md-4">
			 <button type="submit" class="btn btn-default">Zarejestruj konto</button>
		  </div>
	   </div>
	</form>
</div>  
 <script> 
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
 </script> 
<?php include ( "html/html_end.php"); ?> 
