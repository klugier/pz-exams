<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-xs-6 col-sm-3 nav nav-pills nav-stacked span2" id="sidebar" role="navigation">
			<nav>
				<ul class="nav nav-pills nav-stacked span2">
					<?php
						echo '<li id="exam_option1" style="font-weight: bold;"><a href="#">';
						if ($examSideMenuAcctualStep == 0) {
							echo '1. Podstawowe dane';
						} else {
							echo '1. Podstawowe dane';
						}
						echo '</a></li>';
						
						echo '<li id="exam_option2"><a href="#">';
						if ($examSideMenuAcctualStep == 1) {
							echo '2. Harmonogram';
						} else {
							echo '2. Harmonogram';
						}
						echo '</a></li>';
						
						echo '<li id="exam_option3"><a href="#">';
						if ($examSideMenuAcctualStep == 2) {
							echo '3. Lista studentów';
						} else {
							echo '3. Lista studentów';
						}
						echo '</a></li>';
					?>
				</ul>
			</nav>
		</div>
		<div class="col-xs-12 col-sm-9">
		