<?php
        include_once("lib/Lib.php");
    
       if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
        header('Location: index.php' ); 
    }
    
        $title = "$appName - Edycja Danych";
        $scriptsDefer = array("js/ValidateRegisterForm.js");
        include("html/Begin.php");
        include("html/UserPanel.php");
        /*
        echo $_SESSION['USER']."</br>";
        //$user = unserialize($_SESSION['USER']);
        $user = UserDatabase::getUser(unserialize($_SESSION['USER'])->getID());
        echo "Object User Info <br /> "; 
        echo "Id: "       . $user->getID()        . "<br /> " ;
        echo "Email: "    . $user->getEmail()     . "<br /> " ; 
        echo "Password: " . $user->getPassword()  . "<br /> " ;
        echo "Name: "     . $user->getFirstName() . "<br /> " ;//Not in session User
        echo "Surname: "  . $user->getSurname()   . "<br /> " ;//Not in session User
        echo "Gender: "   . $user->getGender()    . "<br /> " ;//Not in session User
        */
?>

<?php
    
    if (isset($_SESSION['formSuccessCode'])) {
        echo '<div class="alert alert-success">' ;
        echo '<a href="#" class="close" data-dismiss="alert"> &times; </a>' ; 		
    
        if ($_SESSION['formSuccessCode'] == 'passwordChanged') {  
            echo '<strong>Poprawnie zmineiono hasło.</strong>'; 
            unset($_SESSION['formSuccessCode']);
        }
        else if ($_SESSION['formSuccessCode'] == 'nameChanged') {  
            echo '<strong>Poprawnie zmineiono imię.</strong>'; 
            unset($_SESSION['formSuccessCode']);
        }
        else if ($_SESSION['formSuccessCode'] == 'surnameChanged') {  
            echo '<strong>Poprawnie zmineiono nazwisko.</strong>'; 
            unset($_SESSION['formSuccessCode']);
        }
        else if ($_SESSION['formSuccessCode'] == 'genderChanged') {  
            echo '<strong>Poprawnie zmineiono płeć.</strong>'; 
            unset($_SESSION['formSuccessCode']);
        }
        echo '</div>' ; 
    }
    
    if (isset($_SESSION['formErrorCode'])) {
        echo '<div class="alert alert-danger">' ;
        echo '<a href="#" class="close" data-dismiss="alert"> &times; </a>' ; 
        if ($_SESSION['formErrorCode'] == 'passwordIncorrect') {  
            echo '<strong>Uwaga!!! Zmiana Hasła nie powiodła się. Wprowadzone hasło jest nieprawidłowe. </strong>'; 
            unset($_SESSION['formErrorCode']);
        } 
        echo '</div>' ; 
    }
?>

<form class="form-horizontal" role="form" id="passwd_form" method="post" action="php/HandlingUserEdit.php">
    <fieldset>
        <legend>Menu edycji</legend>
        <div class="form-group">
            <label for="passwd" class="col-xs-2 col-sm-2 col-md-2 control-label"> Stare Hasło </label>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="password" required class="form-control inputPassword" id="passwd-old" name="passwd-old" placeholder="Wprowadź Stare Haslo" title="">
            </div>
        </div>
        <div class="form-group">
            <label for="passwd" class="col-xs-2 col-sm-2 col-md-2 control-label"> Nowe Hasło </label>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="password" required class="form-control inputPassword" id="passwd" name="passwd" placeholder="Wprowadź Nowe Haslo" title="">
            </div>
            <span class="help-block" id="passwd-error-message">

            </span>
        </div>
        <div class="form-group">
            <label for="passwd-repat" class="col-xs-2 col-sm-2 col-md-2 control-label"> Potwierdź Nowe Hasło </label>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="password" required class="form-control inputPassword" id="passwd-repeat" placeholder="Powtórz Nowe Haslo" title="">
            </div>
            <span class="help-block" id="passwd-repat-error-message">

            </span>
        </div>
        <div class="form-group">
            <div class="row">
                <span class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-3 col-sm-3 col-md-3">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submitButtonPassword" value="submit">Zmień  Hasło</button>
                </span>
            </div>

        </div>
    </fieldset>
</form>
<hr>
<form class="form-horizontal" role="form" id="firstname_form" method="post" action="php/HandlingUserEdit.php">
    <fieldset>
        <br />
        <div class="form-group">
            <label for="firstname" class="col-xs-2 col-sm-2 col-md-2 control-label">Nowe Imię</label>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="text" class="form-control" id="firstname" placeholder="Wprowadź Imię" name="name" value="<?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; } else { echo '';  }?>">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <span class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-3 col-sm-3 col-md-3">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submitButtonName" value="submit">Zmień  Imię</button>
                </span>
            </div>
        </div>
    </fieldset>
</form>
<hr>
<form class="form-horizontal" role="form" id="lastname_form" method="post" action="php/HandlingUserEdit.php">
    <fieldset>
        <br />
        <div class="form-group">
            <label for="lastname" class="col-xs-2 col-sm-2 col-md-2 control-label">Nowe Nazwisko</label>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="text" class="form-control" id="lastname" placeholder="Wprowadź Nazwisko" name="surname" value="<?php if(isset($_SESSION['surname'])){ echo $_SESSION['surname']; } else { echo '';  }?>">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <span class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-xs-3 col-sm-3 col-md-3">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submitButtonSurname" value="submit">Zmień  Nazwisko</button>
                </span>
            </div>
        </div>
    </fieldset>
</form>
<hr>
<form class="form-horizontal" role="form" id="gender_form" method="post" action="php/HandlingUserEdit.php">
    <fieldset>
        <br />
        <div class="form-group">
            <label for="gender" class="col-xs-2 col-sm-2 col-md-2 control-label">Nowa Płeć </label>
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
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submitButtonGender" value="submit">Zmień  Płeć</button>
                </span>
            </div>
        </div>
    </fieldset>
</form>
<hr>
<form class="form-horizontal" role="form" id="clear_form" method="post" action="php/HandlingUserEdit.php">
    <fieldset>
        <br />
        <div class="form-group">
            <div class="row">
                <span class="col-xs-2 col-sm-2 col-md-2">
                    <a href="php/HandlingUserEdit.php">
                        <button type="button" class="btn btn-lg btn-primary btn-block" name="clearButton">Wyczyść Pola</button>
                    </a>
                </span>
            </div>
        </div>
    </fieldset>
</form>

<?php include ("html/End.php"); ?>