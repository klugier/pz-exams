<?php
    include_once("lib/Lib.php");
	$title = "$appName - Edycja Danych";
	include("html/Begin.php");
	include("html/UserPanel.php");
?>

<ul class="nav nav-pills nav-stacked" style="width:200px; background-color:grey; border-radius:5px;">
	<h3 style="display:block; border-bottom:3px solid; text-align:center; margin-bottom:0px;font-weight:bold;">Menu edycji</h3>
	<li><a href="UserEdit.php?ed=1" id="test" style="color:blue; font-weight:bold;">Zmiana imienia</a></li>
	<li><a href="UserEdit.php?ed=2" id="test" style="color:blue; font-weight:bold;">Zmiana nazwiska</a></li>
	<li><a href="UserEdit.php?ed=3" id="test" style="color:blue; font-weight:bold;">Zmiana hasla</a></li>
	<li><a href="UserEdit.php?ed=4" id="test" style="color:blue; font-weight:bold;">Zmiana loginu</a></li>
	<li><a href="UserEdit.php?ed=5" id="test" style="color:blue; font-weight:bold;">Zmiana e-mail</a></li>
	<li><a href="UserEdit.php?ed=6" id="test" style="color:blue; font-weight:bold;">Zmiana uniwersytetu</a></li>
	<li><a href="UserEdit.php?ed=7" id="test" style="color:blue; font-weight:bold;">Zmiana telefonu</a></li>
	<li><a href="UserEdit.php?ed=8" id="test" style="color:blue; font-weight:bold;">Zmiana strony www</a></li>
</ul>

<?php include ("html/End.php"); ?>
