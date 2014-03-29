<?php 
	include_once("lib/Lib.php");
	$title = "$appName - Rejestracja";
	$scriptsDefer = array("js/ValidateForm.js");
	include("html/Begin.php"); 
?>
	<div class="container"> 
		<?php 
			if ((isset($_GET['formErrorCode']))
				 and ( $_GET['formErrorCode'] == 'invalidCaptcha' ) 
			) {
				echo '<div class="alert alert-danger">' ;
				echo '<a href="#" class="close" data-dismiss="alert"> &times; </a>' ; 
				echo '<strong>Uwaga!!!</strong> Wprowadzono nieprawidłowy kod CAPTCHA.'; 
				echo '</div>' ; 
			}
		?> 
		
		<form class="form-horizontal" role="form" id="register_form" method="post" action="HandlingRegisterForm.php">
			<div class="form-group">
			<fieldset>
			<legend>Zarejestruj się</legend>
				
				<!--<div class="row">
					<h2 class="col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-xs-5 col-sm-5 col-md-5"> Zarejestruj Konto </h2>
				</div>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-xs-5 col-sm-5 col-md-5">  <hr style="color: #123455;">  </div>
				</div> -->
			</div>
			
			<div class="form-group">
				<label for="email" class="col-xs-2 col-sm-2 col-md-2 control-label">E-mail </label>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<input type="email" required class="form-control" id="email" placeholder="Wprowadź e-mail" title="" name="email" value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email']; } else { echo '';  }?>">
				</div> 
				<span class="help-block" id="email-error-message" style="visibility:hidden">
						<span style="background-color:#F13333;" class="badge pull-left ">!</span>
					<span style="padding:5px"> Nieprawidłowy adres.</span>
				</span>
			</div>
			<!-- <div class="form-group">
				<label for="email-repet" class="col-xs-2 col-sm-2 col-md-2 control-label">Potwierdź e-mail </label>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<input type="email" required class="form-control" id="email" placeholder="Wprowadź ponownie e-mail" title="">
				</div> 
				<span class="help-block" id="email-error-message" style="visibility:hidden">
						<span style="background-color:#F13333;" class="badge pull-left ">!</span>
					<span style="padding:5px"> Nieprawidłowy adress.</span>
				</span>
			</div> --> 
			<div class="form-group">
				<label for="passwd" class="col-xs-2 col-sm-2 col-md-2 control-label"> Hasło </label>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<input type="password" required class="form-control inputPassword" id="passwd" name="passwd" placeholder="Wprowadź Haslo" title="">
				</div>
			</div>
			<div class="form-group">
				<label for="passwd-repat" class="col-xs-2 col-sm-2 col-md-2 control-label"> Potwierdź hasło </label>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<input type="password" required class="form-control inputPassword" id="passwd-repeat" placeholder="Powtórz Haslo" title="">
				</div>
				<span class="help-block" id="passwd-repat-error-message" style="visibility:hidden">
					<span style="background-color:#F13333;" class="badge pull-left ">!</span>
					<span style="padding:5px"> Podane hasła nie są takie same! </span>
				</span>
			</div>
			<div class="form-group">
				<label for="firstname" class="col-xs-2 col-sm-2 col-md-2 control-label">Imię</label>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<input type="text" class="form-control" id="firstname" placeholder="Wprowadź Imię" name="name" value="<?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; } else { echo '';  }?>">
				</div>
				<label class="control-label"> * </label> 
			</div>
			<div class="form-group">
				<label for="lastname" class="col-xs-2 col-sm-2 col-md-2 control-label">Nazwisko</label>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<input type="text" class="form-control" id="lastname" placeholder="Wprowadź Nazwisko" name="surname" value="<?php if(isset($_SESSION['surname'])){ echo $_SESSION['surname']; } else { echo '';  }?>">
				</div>
				<label class="control-label"> * </label>  
			</div>  
			<div class="form-group">
				<label for="gender"  class="col-xs-2 col-sm-2 col-md-2 control-label"> Płeć </label>
				<div class="col-xs-4 col-sm-4 col-md-4" >
					<select class="form-control" id="gender" name="gender">
						<option>- Wybierz płeć -</option>
						<option>Kobieta</option>
						<option>Mężczyzna</option>
					</select>
				</div> 
				<label class="control-label"> * </label> 
			</div>
			<div class="form-group" > 
				<label class="col-xs-2 col-sm-2 col-md-2 control-label"> Przepisz kod z obrazka </label>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<img id="captcha" src="lib/SecureImage/securimage_show.php"  class="img-thumbnail .img-rounded:2px" alt="CAPTCHA IMAGE" />
				</div> 
				<div class="col-xs-2 col-sm-2 col-md-2">
					<div class="row">
						<a href="#" onclick="document.getElementById('captcha').src = 'lib/SecureImage/securimage_show.php?' + Math.random(); return false"> Odśwież obrazek </a>
					</div> 
					<div class="row">
						<input type="text" class="form-control" name="captcha_code" id="captcha_code"/>
					</div> 
					<div class="row"> 
						<span class="help-block" id="captcha-error-message" style="visibility:hidden">
							<span style="background-color:#F13333;" class="badge pull-left">!</span>
							<span style="padding:5px">Długość kodu niepoprawna</span>
						</span>
					</div> 
				</div>
			</div>
			<?php 
				if ((isset($_SESSION['captchaInvalidValue']))
					and ($_SESSION['captchaInvalidValue'] == true ) 
				) {
					echo '<div class="form-group" id="invalid-captcha-code">';
					echo '<div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-4 col-sm-4 col-md-4">';
					echo '<h6 style="color:red">Wprowadzono nieprawidłowy kod CAPTCHA!!! </h6>'; 
					echo '</div>';
					echo '</div>'; 
					$_SESSION['captchaInvalidValue'] == false ; 
				} 
			?>
			
			<div class="form-group">
				<div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-4 col-sm-4 col-md-4">
					<h6> * - pola opcjonalne przy rejestracji </h6> 
				</div> 
			</div> 	
			<div class="form-group">
				<div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-4 col-sm-4 col-md-4">
					<button type="submit" class="btn btn-success btn-lg btn-block">Zarejestruj konto</button>
				</div>
			</div>
			
			</fieldset>
		</form>
	</div>

<?php include ("html/End.php"); ?> 
