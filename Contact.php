<?php
   include_once("lib/Lib.php");
   
   $title = "$appName - Kontakt";
   include("html/Begin.php");
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
  <div class="control-group">
    <div class="form-group">
      <label class="col-xs-2 col-sm-2 col-md-2  control-label" for="inputMessage">Wiadomość</label>
      <div class="col-xs-5 col-sm-5 col-md-5 controls">
	<textarea class="form-control" type="text" name="message" id="message" placeholder="Wiadomość" rows="10"></textarea>	
      </div>
      <span class="help-block col-xs-4 col-sm-4 col-md-4" id="message-error-message" >
      </span>
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
      <div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-4 col-sm-4 col-md-4">
	<input type="text" class="form-control" name="captcha_code" id="captcha_code"> 
      </div>
      <span class="help-block col-xs-4 col-sm-4 col-md-4" id="captcha_code-error-message">
      </span>
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

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

<script>
$("#contactForm").validate({
    errorElement: 'span',
    rules: {
	subject: "required",
	message: "required",
	captcha_code: {
	    required: true,
	    minlength: 6
	},
	email: {
	    required: true,
	    email: true
	}
    },
    messages: {
	subject: "Prosz podac temat",
	message: "Prosze wpisac tresc wiadomosci",
	captcha_code: {
	    required: "Prosze wpisac kod z obrazka",
	    minlength: "Wpisano nieprawidlowa ilosc znakow"
	},
	email: {
	    required: "Prosze podac swoj kontaktowy adres e-mail",
	    email: "Adres powinien posiadac format name@domain.com"
	}
    },
    //odpowiedzialne za umieszcenie komunikatu wewntrz odpowiedniego element
    //o id [element]-error-message, gdzie [element] jest podany jako parametr funkcji
    errorPlacement: function(error, element) {
        var name = $(element).attr("name");
	if(error.length>0){
	    $("#" + name + "-error-message").append("<span class=\"badge pull-left\" style=\"background-color:#F13333;\">!</span>");
	    error.appendTo($("#" + name + "-error-message"));
	    $("#" + name + "-error-message").children("span").eq(1).css(
		{
		    padding: '5px',
		    color: '#B94A48'
		}
	    );
	}else{
	    $("#" + name + "-error-message").empty();
	}
    }
});
</script>

<?php include ("html/End.php"); ?>
