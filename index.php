<?php
	include_once("lib/Lib.php");

	$title = "$appName - Strona Główna";
	include("html/Begin.php");
	
	if (isset($_SESSION['formSuccessCode'])) {
		echo '<div class="alert alert-success">';
		echo '<a href="#" class="close" data-dismiss="alert"> &times; </a>'; 
		
		echo '<strong>Użytownik zarejestrowany poprawnie. E-mail z linkiem aktywacyjnym został wysłany. </strong>';
		
		echo '</div>'; 
		
		unset($_SESSION['formSuccessCode']);
	}

	if (isset($_SESSION['ERROR'])) {
		echo '<div class="alert alert-danger">';
		echo '<a href="#" class="close" data-dismiss="alert"> &times; </a>'; 
		if($_SESSION['ERROR'] == '1') {
			echo '<strong>Nie ma takiego użytkownika w bazie!</strong>';
		} elseif ($_SESSION['ERROR'] == '2') {
			echo '<strong>Podane hasło jest niepoprawne!</strong>';
		}
		echo '</div>' ;
		unset($_SESSION['ERROR']);
	}
?>

<div class="container">
	<div id="karuzela" class="carousel slide">
		<!-- Kropki -->
		<ol class="carousel-indicators">
			<li data-target="#karuzela" data-slide-to="0" class="active"></li>
			<li data-target="#karuzela" data-slide-to="1"></li>
			<?php
				if (!(isset($_SESSION['USER'])&&($_SESSION['USER']!=''))) {
					echo '<li data-target="#karuzela" data-slide-to="2"></li>';
				}
			?>
		</ol>
    
		<!-- Slajdy -->
		<div class="carousel-inner">
			<?php
				if (!(isset($_SESSION['USER'])&&($_SESSION['USER']!=''))) {
					echo '
					<div class="item active">

						<a href="RegisterForm.php">
							<img src="img/Rejestracja.jpg" alt="">
						</a>
						<!-- Opis slajdu -->
						<div class="carousel-caption">
							<h4>Rejestracja</h4>
							<p>Dołącz do serwisu, który zmienia szare życie tysięcy egzaminatorów!</p>
						</div>
					</div>';
				}

				if (!(isset($_SESSION['USER'])&&($_SESSION['USER']!=''))) {
					echo'<div class="item">';
				} else { 
					echo'<div class="item active">';
				}
			?>
			<a href="Help.php">
				<img src="img/Pomoc.jpg" alt="">
			</a>
			<!-- Opis slajdu -->
			<div class="carousel-caption">
				<h4>Pomoc</h4>
				<p>Chcesz uzyskać informację na temat naszego systemu? Zajrzyj do obszernej instrukcji przygotowanych przez naszych specjalistów.</p>
			</div>
		</div>
	      
		<div class="item">
			<a href="Authors.php">
				<img src="img/Autorzy.jpg" alt="">
			</a>
			<!-- Opis slajdu -->
			<div class="carousel-caption">
				<h4>Autorzy</h4>
				<p>Chcesz dowiedzieć się więcej o naszej drużynie developerskiej. Zajrzyj tutaj!</p>
			</div>
		</div>      
	</div>
    
	<!-- Strzalki -->
	<a class="left carousel-control" href="#karuzela" data-slide="prev">
		<span class="icon-prev"></span>
	</a>
	<a class="right carousel-control" href="#karuzela" data-slide="next">
		<span class="icon-next"></span>
	</a>
	</div>
</div>

<div class="container text-center">
	<h3>Witaj!</h3>
	<p>
	PZ-exams to platforma rejestracji na egzaminy, na której mogą polegać zarówno wykładowcy jak i studenci.
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="col-xs-4 col-sm-4 col-md-4">
				<button type="button" class="btn btn-primary btn-lg">
					1
				</button>
				<h4>Pierwsza</h4>
				<p>To co ma byc w pierwszej kolumnie</p>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4">
				<button type="button" class="btn btn-primary btn-lg">
					2
				</button>	
				<h4>Druga</h4>
				<p>To co ma byc w drugiej kolumnie</p>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4">
				<button type="button" class="btn btn-primary btn-lg">
					3
				</button>	
				<h4>Trzecia</h4>
				<p>To co ma byc w trzeciej kolumnie</p>
			</div>
		</div>
	</p>
</div>

<?php 
	include("html/End.php");
?>
