<?php
	include_once("lib/Lib.php");

	$title = "$appName";
	include("html/Begin.php");
?>

<?php 
	if (isset($_SESSION['formSuccessCode'])) {
		echo '<div class="alert alert-success">' ;
		echo '<a href="#" class="close" data-dismiss="alert"> &times; </a>' ; 
		echo '<strong>Użytownik zarejestrowany poprawnie. E-mail z linkiem aktywacyjnym został wysłany. </strong>'; 			
		echo '</div>' ; 
		unset($_SESSION['formSuccessCode']);
	}
	
	if (isset($_GET['error'])) {
		echo '<div class="alert alert-danger">' ;
		echo '<a href="#" class="close" data-dismiss="alert"> &times; </a>' ; 
		
		if($_GET['error'] == '1') {
			echo '<strong>Nie ma takiego użytkownika w bazie!</strong>';
		}
		elseif ($_GET['error'] == '2') {
			echo '<strong>Podane hasło jest niepoprawne!</strong>';
		}
		echo '</div>' ;
	}
?> 
<div class="container">
	<div id="karuzela" class="carousel slide">
		<!-- Kropki -->
		<ol class="carousel-indicators">
			<li data-target="#karuzela" data-slide-to="0" class="active"></li>
			<li data-target="#karuzela" data-slide-to="1"></li>
			<li data-target="#karuzela" data-slide-to="2"></li>
		</ol>
    
		<!-- Slajdy -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="img/Rejestracja.jpg" alt="">
				<!-- Opis slajdu -->
				<div class="carousel-caption">
					<h4>Rejestracja</h4>
					<p>formularz rejestracji w systemie</p>
				</div>
			</div>
	      	<div class="item">
			<img src="img/Pomoc.jpg" alt="">
			<!-- Opis slajdu -->
			<div class="carousel-caption">
				<h4>Pomoc</h4>
				<p>Tu uzyskasz pomoc</p>
			</div>
		</div>
	      
		<div class="item">
			<img src="img/Autorzy.jpg" alt="">
			<!-- Opis slajdu -->
			<div class="carousel-caption">
				<h4>Autorzy</h4>
				<p>Informacje na temat autorów</p>
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

<div class="container">
<h3>Witaj!</h3>
<p style="text-align: justify; margin-top: 30px;">
PZ-exams to platforma rejestracji na egzaminy, na ktrej moga polegac zarowno wykladowcy jak i studenci.
<p>
</div>
<?php include("html/End.php"); ?>
