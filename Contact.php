<?php
   include_once("lib/Lib.php");
   

   $title = "$appName - Kontakt";
   $scriptsDefer = array("js/ValidateContactForm.js");
   include("html/Begin.php");
   ?>

<?php 
   if (isset($_SESSION['formErrorCode'])) {
      echo '<div class="alert alert-danger">' ;
      echo '<a href="#" class="close" data-dismiss="alert"> &times; </a>' ; 
   if ($_SESSION['formErrorCode'] == 'invalidCaptcha') {  
      echo '<strong>Uwaga!!! Rejestracja nie powiodła się. Wprowadzony kod jest nieprawidłowy. </strong>'; 
      unset($_SESSION['formErrorCode']);
   } 
   else if ($_SESSION['formErrorCode'] == 'userAlreadyInDB') {  
      echo '<strong>Uwaga!!! Rejestracja nie powiodła się. Na podany email już zarejestrowano konto. </strong>';
      unset($_SESSION['formErrorCode']);
   } 
   echo '</div>' ; 
   }
   ?> 

<form id="contactForm" class="form-horizontal" action="./php/HandlingContactForm.php" method="post">

  <div class="form-group">
    <fieldset>
      <legend>Formularz kontaktowy</legend>
    </fieldset>
  </div>
  
  <div class="form-group">
    <div class="control-group">
      <label class="col-xs-2 col-sm-2 col-md-2  control-label" for="inputEmail">Email</label>
      <div class="col-xs-4 col-sm-4 col-md-4 controls">
	<input class="form-control" type="text" name="email" id="email" placeholder="Email">
      </div>
      <span class="help-block col-xs-6 col-sm-6 col-md-6" id="email-error-message" >		      
      </span>
    </div>
  </div>
  <div class="control-group">
    <div class="form-group">
      <label class="col-xs-2 col-sm-2 col-md-2  control-label" for="inputSubject">Temat</label>
      <div class="col-xs-4 col-sm-4 col-md-4 controls">
	<input class="form-control" type="text" name="subject" id="subject" placeholder="Temat">
      </div>
      <span class="help-block col-xs-6 col-sm-6 col-md-6" id="subject-error-message" >
      </span>
    </div>
  </div>
  <div class="form-group">
    <div class="form-group">
      <div class="control-group">
	<label class="col-xs-2 col-sm-2 col-md-2 control-label" for="inputMessage">Wiadomość</label>
	<div class="col-xs-6 col-sm-6 col-md-6 controls">
	  <textarea class="form-control" type="text" name="message" id="message" placeholder="Wiadomość" rows="20"></textarea>
	</div>
	<span class="help-block col-xs-4 col-sm-4 col-md-4" id="message-error-message" >
	</span>
      </div>
    </div>
  </div>
  <div class="form-group" >
    <label class="col-xs-2 col-sm-2 col-md-2 control-label"> Przepisz kod z obrazka </label>
    <div class="col-xs-4 col-sm-4 col-md-4">
      <img id="captcha" src="lib/SecureImage/securimage_show.php"  class="img-thumbnail .img-rounded:2px" style="margin-right:20px;" alt="CAPTCHA IMAGE" />
      <div style="display:inline-block;vertical-align:middle;float:none;">
	<a href="#" onclick="document.getElementById('captcha').src = 'lib/SecureImage/securimage_show.php?' + Math.random(); return false"> 
	  <img id="reload-image" src="lib/SecureImage/images/refresh.png" alt="Odśwież Obrazek" />
	</a> 
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="control-group">
      <div class="col-xs-12 col-sm-12 col-md-12 controls">
	<button type="submit" class="btn btn-lg btn-block btn-primary">Wyślij</button>
      </div>
    </div>
  </div>
</form>
  
<?php include ("html/End.php"); ?>
