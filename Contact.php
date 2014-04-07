<?php
   include("lib/Lib.php");
   $title = "$appName - Kontakt";
   $scriptsDefer = array("js/ValidateContactForm.js");
   include("html/Begin.php");
   ?>


  <form id="contactForm" class="form-horizontal" action="./php/mail.php" method="post">
    <div class="form-group">
      <div class="control-group">
	<label class="col-xs-2 col-sm-2 col-md-2  control-label" for="inputEmail">Email</label>
	<div class="col-xs-10 col-sm-10 col-md-10 controls">
	  <input class="form-control" type="text" name="email" id="inputEmail" placeholder="Email">
	</div>
      </div>
      <div class="control-group">
	<label class="col-xs-2 col-sm-2 col-md-2  control-label" for="inputSubject">Temat</label>
	<div class="col-xs-10 col-sm-10 col-md-10 controls">
	  <input class="form-control" type="text" name="subject" id="inputSubject" placeholder="Temat">
	</div>
      </div>
    </div>
    <div class="form-group">
      <div class="control-group">
	<label class="col-xs-2 col-sm-2 col-md-2 control-label" for="inputMessage">Wiadomosc</label>
	<div class="col-xs-10 col-sm-10 col-md-10 controls">
	  <textarea class="form-control" type="text" name="message" id="Message" placeholder="Wiadomosc" rows="20"></textarea>
	</div>
      </div>
    </div>
    <div class="form-group">
      <div class="control-group">
	<div class="col-xs-12 col-sm-12 col-md-12 controls">
	  <button type="submit" class="btn btn-lg btn-block btn-primary">Wyslij</button>
	</div>
      </div>
    </div>
  </form>
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
    
    <script src="js/main.js"></script>
    

<?php include ("html/End.php"); ?>
