<?php 
include_once("lib/Lib.php");
include("html/Begin.php"); 
?>
<h1 style="font-weight:bold;text-decoration:underline;">Panel egzaminatora</h1>
   <div class="navbar navbar-inverse " style="background: rgba(0,0,0,0.75); box-shadow: 2px 2px 20px #444444;">

          <a class="navbar-brand" href="user_panel.php" id="user_m" >Dodaj egzamin</a>
          <a class="navbar-brand" href="user_panel.php" id="user_m">Lista egzaminów</a>
          <a class="navbar-brand" href="user_panel.php?ed=0" id="user_m">Edytuj dane</a>

   </div>

<?php
 if(isset($_GET['ed'])){
 		echo '
	    <ul class="nav nav-pills nav-stacked" style="width:200px; background-color:grey; border-radius:5px;">
		<h3 style="display:block; border-bottom:3px solid; text-align:center; margin-bottom:0px;font-weight:bold;">Menu edycji</h3>
	    <li><a href="user_panel.php?ed=1" id="test" style="color:blue; font-weight:bold;">Zmiana imienia</a></li>
	    <li><a href="user_panel.php?ed=2" id="test" style="color:blue; font-weight:bold;">Zmiana nazwiska</a></li>
	    <li><a href="user_panel.php?ed=3" id="test" style="color:blue; font-weight:bold;">Zmiana hasła</a></li>
	    </ul>
	    ';
 	
 		if($_GET['ed'] == 1){
 			echo 'zmiana imienia';
 		}
 		else if($_GET['ed'] == 2){
 			echo "zmiana nazwiska";
 		}
 		else if($_GET['ed'] == 3){
 			echo "zmiana hasła";
 	
 	}
 
 }
?>
<?php include("html/End.php"); ?>
