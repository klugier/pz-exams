    <div class="navbar navbar-inverse navbar-fixed-top" style="background: rgba(0,0,0,0.75); box-shadow: 2px 2px 20px #444444;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Strona główna</a>
          <a class="navbar-brand" href="index.php">Kontakt</a>
          <a class="navbar-brand" href="authors.php">Autorzy</a>
          <a class="navbar-brand" href="help.php">Pomoc</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown navbar-form">
                    <button type="submit" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><b>Logowanie</b></button>
				    <!--<button type="submit" class="btn btn-danger">Wyloguj</button>-->
                    <ul class="dropdown-menu" style="width:300px; background: rgba(255,255,255,0.8);-webkit-border-radius: 5px; -khtml-border-radius: 5px;-moz-border-radius: 5px; border-radius: 5px;">
                        <li> 
                  	    <form class="form-signin" role="form" style="margin-right:10px;margin-left:10px;" method="post" action="user_panel.php">
      				<h3 style="text-align:center; font-weight:bold;">Wprowadadź login i hasło</h3>
      				<input type="email" class="form-control" placeholder="adres email" required autofocus style="margin-bottom:3px;"">
      				<input type="password" class="form-control" placeholder="hasło" required>
      				<label class="checkbox">
      				<input type="checkbox" value="remember-me"> Zapamiętaj mnie
      				</label>
				<button type="submit" class="btn btn-success btn-lg btn-block" style="margin-top:15px;"><b>Zaloguj</b></button>
      	                    </form>

      		       </li>
                    </ul>
                </li>
                <li class="navbar-form">
      		       	<form  action="register_form.php">
              	 		<button type="submit" class="btn btn-info"><b>Rejestracja</b></button>
			</form>
	      	</li> 
            </ul>
        </div>
      </div>
    </div>
