	<div	class="navbar	navbar-inverse	navbar-fixed-top"	style="background:	rgba(0,0,0,0.85);	box-shadow:	2px	2px	20px	#444444;">
		<div	class="container	col-md-12"	style="padding:	0px;">
		<div	class="navbar-header"	style="padding-left:	0px;">
			<button	type="button"	class="navbar-toggle"	data-toggle="collapse"	data-target=".navbar-collapse">
			<span	class="icon-bar"></span>
			<span	class="icon-bar"></span>
			<span	class="icon-bar"></span>
			</button>

			<ul	class="nav	navbar-nav	pull-left"	style="padding-right:	0px;">
			<li><a	id="home"	class="navbar-brand"	href="index.php"><img	style	=	"max-width:	100px"	src="img/logo_button.png"></a></li>
			<li><a	class="navbar-brand"	href="Contact.php">Kontakt</a></li>
			<li><a	class="navbar-brand"	href="Authors.php">Autorzy</a></li>
			<li><a	class="navbar-brand"	href="Help.php">Pomoc</a></li>
			</ul>
			<?php
				if	(Settings::getDebug()	==	1)	{
					echo	"<a	class=\"navbar-brand\"	href=\"tests/Tests.php\">Testy</a>\n";
				}
			?>
		</div>
		<div	class="collapse	navbar-collapse"	style="padding:	0px;">
			<ul	class="nav	navbar-nav	pull-right"	style="padding-right:	0px;">
				<?php	if(isset($_SESSION['USER'])	&&	$_SESSION['USER']	!=	""){	?>
				<li	class="navbar-form"	style="padding-right:	0px;">
						  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><b>
							<?php
								if (unserialize($_SESSION['USER'])->getFirstName() != NULL && unserialize($_SESSION['USER'])->getSurname() != NULL){
									echo unserialize($_SESSION['USER'])->getFirstName().' '.unserialize($_SESSION['USER'])->getSurname();
								} else {
									echo	'	'.unserialize($_SESSION['USER'])->getEmail();		
								}
							//	TODO:	Jeżeli	użytkownik	posiada	imie	i/lub	nazwisko	należ	je	tutaj	wyświetlić	zamiast	adresu	email
							
								?> <span class="caret"></span>
						  </b></button>
						  <ul class="dropdown-menu">
							<li><a class="ExamList" href="UserSite.php"><b>Lista Egzaminów</b></a></li>
							<li class="divider"></li>
							<li><a class="Logout" href="controler/LogOff.php"><b>Wyloguj</b></a></li>
						  </ul>
				</li>
		<?php	}	else	{	?>
					
				<li	class="dropdown	navbar-form">
					<button	type="submit"	class="btn	btn-success	dropdown-toggle"	data-toggle="dropdown"><b>Logowanie</b></button>
					
					<ul	class="dropdown-menu"	style="width:250px;	background:	rgba(255,255,255,0.9);-webkit-border-radius:	5px;	-khtml-border-radius:	5px;-moz-border-radius:	5px;	border-radius:	5px;	margin-top:8px;">
						<li>	
							<form	class="form-signin"	role="form"	style="margin-right:10px;margin-left:10px;"	method="post"	action="controler/LogIn.php">
						<h3	style="text-align:center;	font-weight:bold;	padding-bottom:15px;">Logowanie	do	systemu</h3>
						<input	type="email"	name="email"	class="form-control"	placeholder="adres email"	required	autofocus	style="margin-bottom:3px;">
						<input	type="password"	name="pass"	class="form-control"	placeholder="hasło"	required>
						<label	class="checkbox">
						<input	type="checkbox"	value="remember-me">	Zapamiętaj	mnie
						</label>
					<button	type="submit"	class="btn	btn-success	btn-lg	btn-block"	style="margin-top:20px;	margin-bottom:5px;"><b>Zaloguj</b></button>
								</form>

						</li>
					</ul>
				</li>
				<li	class="navbar-form"	style="margin-left:-20px;	padding-right:	0px;">
							<form	action="RegisterForm.php">
								<button	type="submit"	class="btn	btn-info"><b>Rejestracja</b></button>
			</form>
		</li>	
		<?php	}	?>
			</ul>
		</div>
		</div>
	</div>
