<?php
	include("lib/Lib.php");
	
	$title = "$appName - Autorzy projektu";
	include("html/Begin.php");
?>

<div class="container">
    <h1 style="color:#ACACAC; text-shadow: 1px 1px #838996;"><b>Autorzy projektu</b></h1>
	<ul>
		<li id="author"><b>Project Owner:</b>
            <ul id="creator"><li>Zbigniew Rębacz</li></ul>
        </li>
    </ul>
    <br/>
    <ul>
		<li id="author"><b>SCRUM Master:</b>
            <ul id="creator"><li>Michał Pachel</li></ul>
        </li>
    </ul>
    <br/>
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
