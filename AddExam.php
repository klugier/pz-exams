<?php 
	include_once("lib/Lib.php");
	$title = "$appName - Dodawanie egzaminu";
	$scripts = array("js/AddExam.js");
	include("html/Begin.php");
	include("html/UserPanel.php");
?>



<ul class="nav nav-tabs" id="tabs">
  <li id="tab1" class="active"><a href="#data" data-toggle="tab" id="tab1a" class="">1. Dane o egzaminie</a></li>
  <li id="tab2"><a href="#students" data-toggle="tab" id="tab2a" class="">2. Lista studentów</a></li>
</ul>

<div class="tab-content">

  <div class="tab-pane fade in active" id="data" style="padding-left: 20px;">

  <h2>Dane o egzaminie</h2>

  <div class="container col-md-12">

  <form role="form" class="form-horizontal" style="margin-top: 20px;">

  <div class="form-group" id="exam_name_group">
    <label for="exam_name" class="col-sm-3 control-label">Nazwa egzaminu</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="exam_name" placeholder="" maxlength="200">
    </div>
  </div>

  <div class="form-group" id="duration_group">
    <label for="duration" class="col-sm-3 control-label">Czas trwania egzaminu (minuty)</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="duration" placeholder="" maxlength="2">
    </div>
  </div>
  
  <div class="btn-group dropdown">
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" title="Dodaj nowy termin">
      <i class="glyphicon glyphicon-plus" style="font-size:30px; font-weight:bold;"></i>
    </button>

    <ul class="dropdown-menu" role="menu">
      <li>
        <form class="form-signin" role="form" style="margin:10px; margin-right:10px;margin-left:10px;" method="post" action="">
          <label> Czas trawnia</label><input type="number" name="durration" class="form-control" placeholder="czas trwania" required autofocus style="margin-bottom:3px;" value="20">
          <label> Dzień </label><input type="date" name="data" class="form-control" placeholder="Data" required style="margin-bottom:3px;">
          <label> Godzina rozpoczęcia </label><input type="time" name="timeFrom" class="form-control" placeholder="Czas rozpoczęcia" style="margin-bottom:3px;">
          <label> Godzina zakończenia </label><input type="time" name="timeTo" class="form-control" placeholder="Czas zakończenia" style="margin-bottom:3px;">

          <button type="submit" class="btn btn-success btn-lg btn-block" style="margin-top:20px; margin-bottom:5px;"><b>Dodaj termin</b></button>
        </form>
      </li>    
    </ul>
  </div>

  <span class="pull-right">
  	<button type="button" class="btn btn-primary" id="next1">Dalej</button>
  </span>

  </form>

</div>

</div>

<div class="tab-pane fade" id="students" style="padding-left: 20px; padding-right: 20px;">

  <h2>Lista studentów</h2>

  <p id="exam_info" style="margin-top: 20px;"></p>

  <label for="duration" class="col-sm-12 control-label" style="margin-top: 20px; padding-left: 0px;">Format: imię nazwisko &lt;adres e-mail&gt;</label>
  	
  <div class="container col-md-12" style="padding-left: 0px;">
	
	<div class="container col-md-6" style="padding-left: 0px; padding-top: 0px;">
  		<textarea class="form-control" rows="3" id="student_list"></textarea>

  		<span class="pull-right">
  			<button type="button" class="btn btn-primary btn-sm" id="add_students" style="margin-top: 10px;">Dodaj</button>
  		</span>
  	</div>

  	<div class="container col-md-5" id="student_data"></div>

  	</div>

  	<div class="container col-md-12" style="margin-top: 20px; padding-left: 0px; padding-right: 0px;">
  	<hr/>

  	<span class="pull-left">
  		<button type="button" class="btn btn-primary" id="prev1">Cofnij</button>
  	</span>

  	<span class="pull-right">
  		<button type="button" class="btn btn-primary" id="next2">Zatwierdź</button>
  	</span>

  	</div>

  	</div>

  </div>


<?php include ("html/End.php"); ?> 
