<?php
   include("lib/Lib.php");
   
   $title = "$appName - Kontakt";
   include("html/Begin.php");
?>

<form id="contactForm" class="form-horizontal" action="./php/mail.php" method="post">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
      <input type="text" name="email" id="inputEmail" placeholder="Email">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputSubject">Temat</label>
    <div class="controls">
      <input type="text" name="subject" id="inputSubject" placeholder="Temat">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputMessage">Wiadomosc</label>
    <div class="controls">
      <textarea type="text" name="message" id="Message" placeholder="Wiadomosc" rows="20"></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-primary">Wyslij</button>
    </div>
  </div>
</form>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
  
<script src="js/main.js"></script>
  
<script>
    $("#contactForm").validate({
    errorClass: "text-error",
    rules: {
    subject: "required",
    message: "required",
    email: {
    required: true,
    email: true,
    message:true
    }
    },
    messages: {
    subject: "Prosz podac temat",
    message: "Prosze wpisac tresc wiadomosci",
    email: {
    required: "Prosze podac swoj kontaktowy adres e-mail",
    email: "Adres powinien posiadac format name@domain.com"
    }
    }
    });
</script>
<?php include ("html/End.php"); ?>
