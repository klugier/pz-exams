<!-- 				</div> -->
			</div>
		</div>

			<div id="footer" class="container col-md-12">
				<p class="pull-left" style="letter-spacing:1px">PZ-Exams 2014. Wszystkie prawa zastrzeżone ©</p>
				<span class="pull-right" style="margin-top: 1px; margin-left: 80px;">
					<span><a id="contact" href="Contact.php">Kontakt</a></span>
					<span>| <a id="authors" href="Authors.php">Autorzy</a></span>
					<span>| <a id="help" href="Help.php">Pomoc</a></span>
					<span>| <a id="licence" href="Licence.php">Licencje</a></span>
					<?php
						if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
							echo '<span>| <a id="help" href="RegisterForm.php">Rejestracja</a></span>';
						}
					?>
				</span>

			</div>


		</div>
<!-- 		<div id="footer" class="container col-md-8 col-md-offset-2">
			<p class="pull-left" style="letter-spacing:1px">PZ-Exams 2014. Wszystkie prawa zastrzeżone ©</p>
			<span class="pull-right" style="margin-top: 1px; margin-left: 80px;">
				<span><a id="contact" href="?">Kontakt</a></span>
				<span>| <a id="authors" href="Authors.php">Autorzy</a></span>
				<span>| <a id="help" href="Help.php">Pomoc</a></span>
				<span>| <a id="help" href="RegisterForm.php">Rejestracja</a></span>
			</span>
		</div> -->
		
		<script language="javascript" type="text/javascript" src="js/Lib/bootstrap.min.js"></script>
		
	</body>
</html>
