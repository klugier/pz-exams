<div class="modal fade modal-sm" id="studentEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelSO" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content container" style="background-color:#BABEC2;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title text-center" id="myModalLabelSO"><b>Edycja danych osobowych studenta.</b></h3>
			</div>
			<form name="modalForm" class="form-signin form-horizontal" id="studentEditForm" role="form" style="margin:10px; margin-right:10px;margin-left:10px" method="post" action="php/StudentSignInOut.php">
				<div class="modal-body" id="studentEditBody">
				</div>
				<div id="signInFooter" class="modal-footer">
					
					<input name="innerEStudentID" id="innerEStudentID" type="hidden">
					<input name="innerEStudentCode" id="innerEStudentCode" type="hidden">
					<button type="submit" class="btn btn-primary btn-lg" name="studentEdit" value="submit">Zapisz</button>
					<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Anuluj</button>
				</div>
			</form>
		</div>
	</div>
</div>