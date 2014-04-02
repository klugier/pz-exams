<?php
	include("lib/Lib.php");
	
	$title = "$appName - Autorzy";
	include("html/Begin.php");
?>

<div class="container"> 
	<ul>
		<li id="author"><b>Project Owner:</b>
            <ul id="creator"><li>Zbigniew Rębacz</li></ul>
        </li>
    </ul>
    <ul>
		<li id="author"><b>SCRUM Master:</b>
            <ul id="creator"><li>Michał Pachel</li></ul>
        </li>
    </ul>
    <ul>
		<li id="author"><b>Contributors:</b>
            <ul id="creator">
			    <li>Arkadisz Koszczan</li>
			    <li>Michał Szura</li>
			    <li>Michał Gawryluk</li>
			    <li>Mateusz Jancarz</li>
			    <li>Konrad Welc</li>
		    </ul>
        </li>
	</ul>
</div>

<?php include ("html/End.php"); ?>
