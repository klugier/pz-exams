<?php 
	include_once("lib/Lib.php");

	$title = "$appName - Pomoc";
	include("html/Begin.php");
?> 

<div class="container"> 
	<h3>Obsługiwane domeny</h3>
	
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
	<h3>Spis treści</h3>
	
	<ol>
		<li><a href="#pierwsze">Pierwsze kroki w systemie</a></li>
		<ol>
			<li><a href="#powitalny">Ekran powitalny</a></li>
			<li><a href="#aktywacja">Kod aktywacyjny</a></li>
			<li><a href="#rejestracja_formularz">Rejestracja w systemie</a></li>
			<li><a href="#logowanie">Logowanie</a></li>				
			<li><a href="#po_zalogowaniu">Po zalogowaniu</a></li>
			<li><a href="#menu_rozwijane">Menu rozwijane</a></li>
		</ol>
		<li><a href="#tworzenie">Tworzenie egzaminów egzaminów</a></li>
		<ol>
			<li><a href="#dodaj_egzamin">Dodawanie egzaminu</a></li>
			<li><a href="#dodaj_termin">Dodawanie terminów do egzaminu</a></li>
			<li><a href="#dodawanie_studentow_pierwszy">Formularz dodawania studentów do egzaminu</a></li>
			<li><a href="#zmiana_formatu_email">Zmiana formatu wprowadzanego adresu e-mail</a></li>
			<li><a href="#dodawanie_maili">Dodawanie studentów do egzaminu</a></li>
		</ol>
		<li><a href="#zarzadzanie">Zarządzanie aktualnymi egzaminami</a></li>
		<ol>
			<li><a href="#lista_aktualnych_egzaminow">Lista aktualnych egzaminów</a></li>
			<li><a href="#lista_studentow_dla_egzaminu">Lista studentów dla egzaminu</a></li>
			<li><a href="#dodaj_kolejnych_do_egzaminu">Dodaj kolejnych studentów do egzaminu</a></li>
			<li><a href="#edycja_egzaminu">Edycja egzaminu</a></li>
		</ol>	
		<li><a href="#archiwalna">Archiwalne egzaminy</a></li>
		<li><a href="#edytuj_profil">Edycja profilu</a></li>
		<li><a href="#kontaktowy">Formularz kontaktowy</a></li>
	</ol>
</div>

<h2>Pierwsze kroki w systemie</h2>
<a name="pierwsze"></a>
<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="powitalny"></a>
	<h3>Ekran powitalny</h3>
	<img src="img/help/01_poczatek.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">
		<div class="container col-xs-12 col-sm-12 col-md-12">
			<ol>
				<li><a href="#kontaktowy">Formularz kontaktowy.</a></li>
				<li>Strona zawierająca informacje o autorach.</li>
				<li>Pomoc ( aktualnie przęglądana ).</li>
				<li><a href="#logowanie">Menu logowania.</a></li>
				<li>Rejestracja w systemie.</li>
				<li>Lista technologii wykorzystanych przy realizacji.</li>
				<li>Link do repozytorium z kodem źródłowym projektu.</li>
			</ol>
		</div>
	</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="aktywacja"></a>
	<h3>Kod aktywacyjny</h3>		
	
	<img src="img/help/01_kod_aktywacyjny.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Administrator mógł zablokować dostę do <a href="#rejestracja_formularz">formularza rejestracyjnego</a>. Aby uzyskać do niego dostęp proszę skontaktować się z administratorem, w celu uzyskania kodu dostępu.</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="rejestracja_formularz"></a>
	<h3>Formularz rejestracji</h3>		
	
	<img src="img/help/01_formularz_rejestracji.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">
		W formularzu proszę podać wymagane dane, które umożliwią rejestrację w systemie. Po wypełnieni wszystkich wymaganych pól, na podany w formularzu adres e-mail zostanie wysłany odnośnik aktywacyjny. Po otrzymaniu odnośnika i weryfikacji rejestracji, należy przejść do <a href="#logowanie">menu logowania</a>.
	</p>
</div>				

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="logowanie"></a>
	<h3>Menu logowania</h3>		
	
	<img src="img/help/01_logowanie.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Proszę podać adres e-mail, na który była przeprowadzona <a href="#rejestracja_formularz">rejestracja</a>.</p>
</div>		

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="po_zalogowaniu"></a>
	<h3>Po zalogowaniu</h3>		
	
	<img src="img/help/02_po_zalogowaniu.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Szare menu w środkowym polu strony umożliwia dostęp do stron <a href="#dodaj_egzamin">Dodaj egzamin</a>,
	<a href="#lista_aktualnych_egzaminow">Aktualne egzaminy</a> <a href="#archiwalna">Archiwalne egzaminy</a>. Ikona <img src="img/help/zebatka.jpg" alt="ikona edycji"/> umożliwia <a href="#edytuj_profil">edycję profilu użytkownika</a>.
	<br/>Na stronie dostępne są statystyki.<br/>Przcisk logowania przekształcił się zaś w <a href="#menu_rozwijane">rozwijane menu</a>, ponadto wyświetla imię i nazwisko zalogowanego użytkownika.</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="menu_rozwijane"></a>
	<h3>Menu rozwijane</h3>		
	
	<img src="img/help/02_menu_rozwijane.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Menu umożliwia dostęp do stron <a href="#dodaj_egzamin">Dodaj egzamin</a>,
	<a href="#lista_aktualnych_egzaminow">Aktualne egzaminy</a> <a href="#archiwalna">Archiwalne egzaminy</a> oraz <a href="#edytuj_profil">Edytuj profil</a>  użytkownika.</p>
</div>

<h2>Tworzenie egzaminów</h2>
<a name="tworzenie"></a>
<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="dodaj_egzamin"></a>
	<h3>Dodaj egzamin</h3>		
	
	<img src="img/help/03_dodaj_egzamin.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Należy podać nazwę egzaminu, oraz ilość czasu przeznaczonego na odpytywanie jednego studenta.<br/>Ikona "plus" służy do <a href="dodawanie_terminu">Dodawania terminów egzaminu</a>.</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="dodaj_termin"></a>
	<h3>Dodawanie terminu egzaminu</h3>		
	
	<img src="img/help/03_dodawanie_terminu.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>
<div class="container col-xs-12 col-sm-12 col-md-12">
	<img src="img/help/03_termin_dodano.jpg" alt="" class="col-xs-2 col-sm-2 col-md-2">
	<p class="col-xs-10 col-sm-10 col-md-10">Po dodaniu terminu istieje możliwość jego usunięcia - ikona "minus".</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="dodawanie_studentow_pierwszy"></a>
	<h3>Formularz dodawanie studentów do egzaminu</h3>		
	
	<img src="img/help/03_lista_studentow_pierwszy.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="zmiana_formatu_email"></a>
	<h3>Zmiana formatu wprowadzanych adresów e-mail</h3>		
	
	<img src="img/help/03_lista_studentow_format_mail.jpg" alt="" class="col-xs-4 col-sm-4 col-md-4">
	<p class="col-xs-8 col-sm-8 col-md-8">Treść</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="dodawanie_maili"></a>
	<h3>Dodawanie studentów do egzaminu</h3>
	
	<img src="img/help/03_lista_studentow_dodawanie.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>
<h2>Zarządzanie aktualnymi egzaminami</h2>
<a name="zarzadzanie"></a>
<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="lista_aktualnych_egzaminow"></a>
	<h3>Lista aktualnych egzaminów</h3>		
	
	<img src="img/help/04_lista_aktualnych.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="lista_studentow_dla_egzaminu"></a>	
	<h3>Lista studentów przypisanych do egzaminu, wysyłanie kodów studentom</h3>		
	
	<img src="img/help/04_lista_studentow.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="dodaj_kolejnych_do_egzaminu"></a>
	<h3>Dodaj kolejnych studentów do egzaminu</h3>		
	
	<img src="img/help/04_dodaj_studentow.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="edycja_egzaminu"></a>
	<h3>Edycja egzaminu</h3>		
	
	<img src="img/help/04_edytuj_egzamin.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="archiwalna"></a>
	<h2>Lista archiwalna egzaminów</h2>		
	
	<img src="img/help/05_archiwalne.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="edytuj_profil"></a>
	<h2>Edytuj profil</h2>		
	
	<img src="img/help/06_edytuj_profil.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>

<div class="container col-xs-12 col-sm-12 col-md-12">
	<a name="kontaktowy"></a>
	<h2>Formularz kontaktowy</h2>		
	
	<img src="img/help/07_formularz_kontaktowy.jpg" alt="" class="col-xs-8 col-sm-8 col-md-8">
	<p class="col-xs-4 col-sm-4 col-md-4">Treść</p>
</div>

<?php
	include ("html/End.php");
?>
