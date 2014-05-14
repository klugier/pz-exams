<?php
	
	include_once("lib/Lib.php");
	
	$title = "$appName - Pomoc";
	$scripts = array("js/LicenceHelp.js");
	include("html/Begin.php");

	echo '<div class="container">
		<h2>Licencje użytych technologii</h2>';
	echo '<p>' . $appName . ' to projekt wykorzystujący najnowocześniejsze technologię open source. Na nimniejszej stronie znajduje się ich kompletna lista.' . '</p>';
	echo '<hr />';
	
	
	echo '<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">BSD</h3>
			</div>
			<div class="panel-body">';

		echo '<div class="panel panel-default">
			<div class="panel-heading" id="0">
				<h3 class="panel-title">SecureImage<i id="g0" style="cursor: pointer" class="glyphicon glyphicon-list pull-right"></i></h3>
			</div>
			<div class="panel-body" id="b0" style="display: none;">';
				$filename = "lib\SecureImage\LICENSE.txt";
				$fp = fopen($filename, "r");
				$content = fread($fp, filesize($filename));
				$lines = explode("\n", $content);
				fclose($fp);
				foreach ($lines as $line) {
					echo $line . "<br>";
				}
		echo'</div></div>';
	echo'</div></div>';

	echo '<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">LGPL</h3>
			</div>
			<div class="panel-body">';

		echo '<div class="panel panel-default">
			<div class="panel-heading" id="1">
				<h3 class="panel-title">PHPMailer<i id="g1" style="cursor: pointer" class="glyphicon glyphicon-list pull-right"></i></h3>
			</div>
			<div class="panel-body" id="b1" style="display: none;">
			PHPMailer was originally written in 2001 by Brent R. Matzelle as a [SourceForge project](<a href="http://sourceforge.net/projects/phpmailer/">http://sourceforge.net/projects/phpmailer/</a>).<br>
			Marcus Bointon (coolbru on SF) and Andy Prevost (codeworxtech) took over the project in 2004.<br>
			Became an Apache incubator project on Google Code in 2010, managed by Jim Jagielski.<br>
			Marcus created his fork on [GitHub](<a href="https://github.com/Synchro/PHPMailer">https://github.com/Synchro/PHPMailer</a>).<br>
			Jim and Marcus decide to join forces and use GitHub as the canonical and official repo for PHPMailer.<br>
			PHPMailer moves to the [PHPMailer organisation](<a href="https://github.com/PHPMailer">https://github.com/PHPMailer</a>) on GitHub.<br><br>
			This software is licenced under the [LGPL 2.1](<a href="http://www.gnu.org/licenses/lgpl-2.1.html">http://www.gnu.org/licenses/lgpl-2.1.html</a>). Please read LICENSE for information on the
			software availability and distribution.<br>
			
			</div></div>';

		echo '<div class="panel panel-default">
			<div class="panel-heading" id="2">
				<h3 class="panel-title">tFPDF<i id="g2" style="cursor: pointer" class="glyphicon glyphicon-list pull-right"></i></h3>
			</div>
			<div class="panel-body" id="b2" style="display: none;">';
				$filename = "lib/Utility/PDF/info.htm";
				$fp = fopen($filename, "r");
				$content = fread($fp, filesize($filename));
				$lines = explode("\n", $content);
				fclose($fp);
				foreach ($lines as $line) {
					echo $line;
				}
		echo'</div></div>';
	echo'</div></div>';
	
	echo '<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Apache 2.0</h3>
			</div>
			<div class="panel-body">';

		echo '<div class="panel panel-default">
			<div class="panel-heading" id="3">
				<h3 class="panel-title">Bootstrap<i id="g3" style="cursor: pointer" class="glyphicon glyphicon-list pull-right"></i></h3>
			</div>
			<div class="panel-body" id="b3" style="display: none;">
				Bootstrap.js by @fat & @mdo<br>
				Copyright 2013 Twitter, Inc.<br>
				<a href="http://www.apache.org/licenses/LICENSE-2.0.txt">http://www.apache.org/licenses/LICENSE-2.0.txt</a><br>
				</div></div>';

		echo '<div class="panel panel-default">
			<div class="panel-heading" id="5">
				<h3 class="panel-title">Bootstrap-datetimepicker<i id="g5" style="cursor: pointer" class="glyphicon glyphicon-list pull-right"></i></h3>
			</div>
			<div class="panel-body" id="b5" style="display: none;">
				Copyright 2012 Stefan Petre<br>
				Improvements by Andrew Rowls<br>
				Improvements by Sébastien Malot<br>
				Improvements by Yun Lai<br>
				Project URL : <a href="http://www.malot.fr/bootstrap-datetimepicker">http://www.malot.fr/bootstrap-datetimepicker</a><br>
				<a href="http://www.apache.org/licenses/LICENSE-2.0.txt">http://www.apache.org/licenses/LICENSE-2.0.txt</a><br>
				</div></div>';
	echo'</div></div>';

	echo '<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">MIT License</h3>
			</div>
			<div class="panel-body">';

		echo '<div class="panel panel-default">
			<div class="panel-heading" id="4">
				<h3 class="panel-title">Bootbox<i id="g4" style="cursor: pointer" class="glyphicon glyphicon-list pull-right"></i></h3>
			</div>
			<div class="panel-body" id="b4" style="display: none;">
				bootbox.js v4.2.0<br>
				<a href="http://bootboxjs.com/license.txt">http://bootboxjs.com/license.txt</a><br>
				</div></div>';
		echo '<div class="panel panel-default">
			<div class="panel-heading" id="6">
				<h3 class="panel-title">jQuery v1.11.0<i id="g6" style="cursor: pointer" class="glyphicon glyphicon-list pull-right"></i></h3>
			</div>
			<div class="panel-body" id="b6" style="display: none;">
				jQuery v1.11.0<br>
				(c) 2005, 2014 jQuery Foundation, Inc.<br>
				<a href="http://jquery.org/license">http://jquery.org/license</a>
				</div></div>';
		echo '<div class="panel panel-default">
			<div class="panel-heading" id="7">
				<h3 class="panel-title">Ladda<i id="g7" style="cursor: pointer" class="glyphicon glyphicon-list pull-right"></i></h3>
			</div>
			<div class="panel-body" id="b7" style="display: none;">
				Ladda<br>
				<a href="http://lab.hakim.se/ladda">http://lab.hakim.se/ladda</a><br>
				MIT licensed<br>
				Copyright (C) 2013 Hakim El Hattab, <a href="http://hakim.se">http://hakim.se</a>
				</div></div>';
	echo'</div></div>';

	echo '<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">CC0</h3>
			</div>
			<div class="panel-body">';

		echo '<div class="panel panel-default">
			<div class="panel-heading" id="8">
				<h3 class="panel-title">Images<i style="cursor: pointer" id="g8" class="glyphicon glyphicon-list pull-right"></i></h3>
			</div>
			<div class="panel-body" id="b8" style="display: none;">
			Copyright (C) 2014 Michał Svitleslav Gawryluk
			</div></div>';
	echo'</div></div>';

	echo '</div>';

	include ("html/End.php");
?>