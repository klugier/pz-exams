<div id="stage3">
	<h2>Lista studentów</h2>
		<p id="exam_info" style="margin-top: 20px;">Podaj listę studentów, którzy będą mogli się rejestrować na ten egzamin.</p>
			<label for="student_list" class="col-sm-12 control-label" style="margin-top: 20px; padding-left: 0px;">Format: imię nazwisko &lt;adres e-mail&gt;</label>
			<div class="container col-md-12 col-sm-12" style="padding-left: 0px; padding-right: 0px;">
	
			<div class="container col-md-12 col-sm-12" style="padding-left: 0px; padding-top: 0px;">
			<textarea class="form-control" rows="3" id="student_list" style="resize: vertical"></textarea>
			<span class="pull-right">
				<button type="button" class="btn btn-primary btn-sm" id="add_students" style="margin-top: 10px;">Dodaj</button>
			</span>
		</div>

		<div class="container col-md-6 col-sm-6" id="student_data" style="padding-right: 0px;"></div>

		</div>

		<div class="container col-md-12" style="margin-top: 20px; padding-left: 0px; padding-right: 0px;">
		
		<hr/>

		<span class="pull-left">
			<button type="button" class="btn btn-primary" id="prev2" style="padding-left: 30px; padding-right: 30px;">Cofnij</button>
		</span>
		
		<span class="pull-right" id="confirm">

			<button id="confirm" class="btn btn-success ladda-button" data-style="expand-right"><span class="ladda-label">Potwierdź</span></button>

		</span>
	</div>
</div>
