<?php
    include_once("lib/Lib.php");
	$title = "Edycja Danych";
	include("html/Begin.php");
	include("html/UserPanel.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
         <ul class="nav nav-pills nav-stacked" style="width:200px; background-color:grey; border-radius:5px;">
		<h3 style="display:block; border-bottom:3px solid; text-align:center; margin-bottom:0px;font-weight:bold;">Menu edycji</h3>
	    <li><a href="UserEdit.php?ed=1" id="test" style="color:blue; font-weight:bold;">Zmiana imienia</a></li>
	    <li><a href="UserEdit.php?ed=2" id="test" style="color:blue; font-weight:bold;">Zmiana nazwiska</a></li>
	    <li><a href="UserEdit.php?ed=3" id="test" style="color:blue; font-weight:bold;">Zmiana hasła</a></li>
	    </ul>
    </body>
</html>
