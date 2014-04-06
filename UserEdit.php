<?php
    include_once("lib/Lib.php");
    
    if ($_SESSION['USER'] == "") {
        header('Location: index.php' ); 
    }
    
    $title = "$appName - Edycja Danych";
    $scriptsDefer = array("js/ValidateRegisterForm.js");
    include("html/Begin.php");
    include("html/UserPanel.php");
?>

<form class="form-horizontal" role="form" id="register_form" method="post" action="php/HandlingRegisterForm.php">
    <fieldset>
        <legend>Menu edycji</legend>
        <div class="form-group">
            <label for="passwd" class="col-xs-2 col-sm-2 col-md-2 control-label"> Hasło </label>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="password" required class="form-control inputPassword" id="passwd" name="passwd" placeholder="Wprowadź Haslo" title="">
            </div>
            <span class="help-block" id="passwd-error-message">

            </span>
        </div>
        <div class="form-group">
            <label for="passwd-repat" class="col-xs-2 col-sm-2 col-md-2 control-label"> Potwierdź hasło </label>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="password" required class="form-control inputPassword" id="passwd-repeat" placeholder="Powtórz Haslo" title="">
            </div>
            <span class="help-block" id="passwd-repat-error-message">

            </span>
        </div>
        <div class="form-group">
            <div class="row">
                <span class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-3 col-sm-3 col-md-3">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submitButton" value="submit">Zmień  Hasło</button>
                </span>
                <span class="col-xs-2 col-sm-2 col-md-2">
                    <a href="php/HandlingRegisterForm.php">
                        <button type="button" class="btn btn-lg btn-primary btn-block" name="clearButton">Wyczyść</button>
                    </a>
                </span>
            </div>

        </div>
        <br />
        <div class="form-group">
            <label for="firstname" class="col-xs-2 col-sm-2 col-md-2 control-label">Imię</label>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="text" class="form-control" id="firstname" placeholder="Wprowadź Imię" name="name" value="<?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; } else { echo '';  }?>">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <span class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-3 col-sm-3 col-md-3">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submitButton" value="submit">Zmień  Imię</button>
                </span>
                <span class="col-xs-2 col-sm-2 col-md-2">
                    <a href="php/HandlingRegisterForm.php">
                        <button type="button" class="btn btn-lg btn-primary btn-block" name="clearButton">Wyczyść</button>
                    </a>
                </span>
            </div>

        </div>
        <div class="form-group">
            <label for="lastname" class="col-xs-2 col-sm-2 col-md-2 control-label">Nazwisko</label>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="text" class="form-control" id="lastname" placeholder="Wprowadź Nazwisko" name="surname" value="<?php if(isset($_SESSION['surname'])){ echo $_SESSION['surname']; } else { echo '';  }?>">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <span class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-3 col-sm-3 col-md-3">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submitButton" value="submit">Zmień  Nazwisko</button>
                </span>
                <span class="col-xs-2 col-sm-2 col-md-2">
                    <a href="php/HandlingRegisterForm.php">
                        <button type="button" class="btn btn-lg btn-primary btn-block" name="clearButton">Wyczyść</button>
                    </a>
                </span>
            </div>

        </div>
        <div class="form-group">
            <label for="gender" class="col-xs-2 col-sm-2 col-md-2 control-label"> Płeć </label>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <select class="form-control" id="gender" name="gender">
                    <option>- Wybierz płeć -</option>
                    <option>Kobieta</option>
                    <option>Mężczyzna</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <span class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-3 col-sm-3 col-md-3">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submitButton" value="submit">Zmień  Płeć</button>
                </span>
                <span class="col-xs-2 col-sm-2 col-md-2">
                    <a href="php/HandlingRegisterForm.php">
                        <button type="button" class="btn btn-lg btn-primary btn-block" name="clearButton">Wyczyść</button>
                    </a>
                </span>
            </div>

        </div>
    </fieldset>
</form>

<?php include ("html/End.php"); ?>