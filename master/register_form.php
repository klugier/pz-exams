<?php include("html/html_begin.php"); ?>  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/validate_form.js" defer></script> 
<?php include("html/html_begin_1.php"); ?>  
	<div class="container"> 
		<form class="form-horizontal" role="form">
			<div class="form-group">
				<h2 class="col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-xs-5 col-sm-5 col-md-5"> Zarejestruj Konto </h2>
			</div> 
			<div class="form-group">
				<label for="email" class="col-xs-2 col-sm-2 col-md-2 control-label">E-mail </label>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<input type="email" required class="form-control" id="email" placeholder="Wprowadź e-mail" title="">
				</div> 
				<span class="help-block" id="email-error-message" style="visibility:hidden">
						<span style="background-color:#F13333;" class="badge pull-left ">!</span>
					  <span style="padding:5px"> Nieprawidłowy adress.</span>
				</span>
			</div>
			<div class="form-group">
				<label for="passwd" class="col-xs-2 col-sm-2 col-md-2 control-label"> Hasło </label>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<input type="password" class="form-control inputPassword" id="passwd" placeholder="Wprowadź Haslo">
				</div>
			</div>
			<div class="form-group">
				<label for="passwd-repat" class="col-xs-2 col-sm-2 col-md-2 control-label"> Potwierdź </label>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<input type="password" class="form-control inputPassword" id="passwd-repeat" placeholder="Wprowadź Ponownie Haslo">
				</div>
				<span class="help-block" id="passwd-repat-error-message" style="visibility:hidden">
						<span style="background-color:#F13333;" class="badge pull-left ">!</span>
					  <span style="padding:5px"> Hasło różni się od pierwotnego </span>
				</span>
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
					<input type="text" class="form-control" id="lastname" placeholder="Wprowadź Nazwisko">
				</div>
			</div>  
			<div class="form-group">
				<label for="gender"  class="col-xs-2 col-sm-2 col-md-2 control-label"> Płeć </label>
				<div class="col-xs-3 col-sm-3 col-md-3" >
					<select class="form-control" id="gender">
						<option>Kobieta</option>
						<option>Mężczyzna</option>
					</select>
				</div> 
			</div>
			<div class="form-group">
				<div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-4 col-sm-4 col-md-4">
					<button type="submit" class="btn btn-default">Zarejestruj konto</button>
				</div>
			</div>
		</form>
	</div>  
<?php include ( "html/html_end.php"); ?> 
