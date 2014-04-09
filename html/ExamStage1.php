<div id="stage1">

 	<h2>Dane o egzaminie</h2>

	<div class="container col-md-12">

	<form role="form" class="form-horizontal" style="margin-top: 20px;">

	<div class="form-group" id="exam_name_group">
		<label for="exam_name" class="control-label col-sm-3 col-md-3">Nazwa egzaminu</label>
		<div class="col-sm-6 col-md-5">
			<input type="text" class="form-control" id="exam_name" placeholder="" maxlength="120">
		</div>
	</div>


	<div class="form-group" id="duration_group">
		<label for="duration" class="control-label col-sm-3 col-md-6">Czas trwania egzaminu (minuty)</label>

		<div class="col-sm-4 col-md-2">
			<input type="number" name="duration" class="form-control" id="exam_duration" placeholder="" maxlength="2" value="20" min="0" max="100">
		</div>
	</div>


	</form>
	</form>
	
	<div class="row"> 
		<div id="calendar-control"> 
			
		</div> 
	</div>
	<?php
	include("lib/Dialog/ModalButton.php");
	?>
	<div class="container col-md-12" style="margin-top: 20px; padding-left: 0px; padding-right: 0px;">
		
<hr/>

<span class="pull-right">
		<button type="button" class="btn btn-primary" id="next1" style="padding-left: 30px; padding-right: 30px;">Dalej</button>
	</span>
</div>

	</div>

</div>