<?php 
	include_once("lib/Lib.php");

	$title = "$appName - Pomoc";
	include("html/Begin.php");
?> 

<div class="container"> 
	<h2>Obsługiwane domeny</h2>
	W chwili obecnej obsługujemy użytkowników posiadających adresy e-mail z następujących domen: <br />
	<ul>
		<?php
			$domains = Settings::getDomains();
			if ($domains == null) {
				echo "<li><b>Aktualnie obsługiwane są wszystkie domenu</b></li>";
			} else {
				foreach ($domains as $domain) {
					echo "<li>" . $domain . "</li>\n";
				}
			}
		?>
	</ul>
</div>
<div class="container col-xs-12 col-sm-12 col-md-12">
	<h4>Tytuł</h4>		
	<img src="img/help/06_Rejestracja.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>	
<div class="container col-xs-12 col-sm-12 col-md-12">
	<h4>Tytuł</h4>		
	<img src="img/help/00_logowanie.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>
<div class="container col-xs-12 col-sm-12 col-md-12">
	<h4>Tytuł</h4>		
	<img src="img/help/01_po_zalogowaniu.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>	
<div class="container col-xs-12 col-sm-12 col-md-12">
	<h4>Tytuł</h4>		
	<img src="img/help/03_dodaj_egzamin.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>	
<div class="container col-xs-12 col-sm-12 col-md-12">
	<h4>Tytuł</h4>		
	<img src="img/help/03_01_termin.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>	
<div class="container col-xs-12 col-sm-12 col-md-12">
	<h4>Tytuł</h4>		
	<img src="img/help/03_02_lista_studentow.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>	
<div class="container col-xs-12 col-sm-12 col-md-12">
	<h4>Tytuł</h4>		
	<img src="img/help/04_aktualne_egzaminy.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>	
<div class="container col-xs-12 col-sm-12 col-md-12">
	<h4>Tytuł</h4>		
	<img src="img/help/04_01_edytuj_egzamin.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>	
<div class="container col-xs-12 col-sm-12 col-md-12">
	<h4>Tytuł</h4>		
	<img src="img/help/04_02_lista_studentow.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>	
<div class="container col-xs-12 col-sm-12 col-md-12">
	<h4>Tytuł</h4>		
	<img src="img/help/05_archiwalne_egzaminy.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>	
<?php
	include ("html/End.php");
?>
