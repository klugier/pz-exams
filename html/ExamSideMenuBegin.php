<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-xs-6 col-sm-3 nav nav-pills nav-stacked span2" id="sidebar" role="navigation">
			<nav>
				<ul class="nav nav-pills nav-stacked span2">
					<?php
						echo '<li><a href="#">';
						if ($examSideMenuAcctualStep == 0) {
							echo '<b>1. Podastawowe dane</b>';
						} else {
							echo '1. Podastawowe dane';
						}
						echo '</a></li>';
						
						echo '<li><a href="#">';
						if ($examSideMenuAcctualStep == 1) {
							echo '<b>2. Harmonogram</b>';
						} else {
							echo '2. Harmonogram';
						}
						echo '</a></li>';
						
						echo '<li><a href="#">';
						if ($examSideMenuAcctualStep == 2) {
							echo '<b>3. Lista studentów</b>';
						} else {
							echo '3. Lista studentów';
						}
						echo '</a></li>';
					?>
				</ul>
			</nav>
		</div>
		<div class="col-xs-12 col-sm-9">
		