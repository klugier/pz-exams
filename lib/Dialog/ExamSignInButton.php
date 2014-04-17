<div class="modal fade modal-sm" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelSO" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content" style="background-color:#BABEC2;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title text-center" id="myModalLabelSO"><b><span id="innerExamName"></span></b></h3>
			</div>
			<form name="modalForm" class="form-signin form-horizontal" id="examSignInForm" role="form" style="margin:10px; margin-right:10px;margin-left:10px" method="post" action="./../../php/StudentSignInOut.php">
				<div class="modal-body">
					<input name="innerIStudentID" id="innerIStudentID" type="hidden">
					<input name="innerIExamID" id="innerIExamID" type="hidden">
					<input name="innerIStudentCode" id="innerIStudentCode" type="hidden">
					

					<?php
						$date = date('m/d/Y h:i:s a', time());
						//echo $date." /\ ";
						//echo "SET as ".$_SESSION['innerIExamID']." ";
						$examDays = ExamUnitDatabase::getExamDays($_SESSION['innerIExamID']);
						$uniqeDays = array_unique($examDays);
						echo "<table class=\"col-md-12 \"><tbody class=\"table-hover\">";
						foreach ($uniqeDays as $day){
							//echo $day." | ";
							echo "<tr><td>";
							echo "<button type=\"submit\" class=\"btn btn-block btn-primary btn-lg\" id=\"date\" name=\"date\" examDate=".$day."\">".$day."</button>";
							echo "</td></tr>";
						}
						echo "<tbody></table>";
					?>
				</div>
				<div class="modal-footer">
					<!--<button type="submit" class="btn btn-success btn-lg" name="date">TEST BUTTON</button>-->
					<button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
				</div>
			</form>
		</div>
	</div>
</div>