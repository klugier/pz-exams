<?php
    
    include_once("User.php");
    include_once("DatabaseConnector.php");
    
    final class UserDatabase
    {
        /*
         * Metoda sprawdza czy użytkownik o zadanym e-mailu istnieje w bazie danych.
         */
        static public function checkEmail($basicUser)
        {
            $sql = "Select * from Users WHERE Email = '".$basicUser->getEmail()."'";
            // echo $sql;
    
            $result = DatabaseConnector::getConnection()->query($sql);
            if ($result->num_rows == 1)
                return true;
            return false;
        }
    
        /*
         * Metoda sprawdza czy przypisane hasło do klasy $user jest poprawne.
         */
        static public function checkPassword($basicUser)
        {
            $sql = "Select * from Users WHERE Email = '" . $basicUser->getEmail() . "' && Password = '" . $basicUser->getPassword() . "'";
            $result = DatabaseConnector::getConnection()->query($sql);
            if ($result->num_rows == 1)
            {
                $result = DatabaseConnector::getConnection()->query($sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $basicUser->setID($row['ID']);
                return true;
            }
            return false;		
        }
    
        static public function checkActivated($basicUser)
        {
            $sql = "Select * from Users WHERE Email = '" . $basicUser->getEmail() . "' && Activated = TRUE";
            $result = DatabaseConnector::getConnection()->query($sql);
            if ($result->num_rows == 1)
                return true;
            return false;
        }
    
        static public function addUser($user)
        { 
			date_default_timezone_set('Europe/Warsaw');
			
            $values = "('"	. $user->getEmail()    . "', '"
                            . sha1($user->getPassword()) . "', '"
                            . ($user->getActivated()        ? "TRUE" : "FALSE") . "', '"
                            . $user->getActivationCode() . "', "
                            . (is_null($user->getFirstName())    ? "NULL" : "'" . $user->getFirstName()    . "'")  . ", " 
                            . (is_null($user->getSurname()) ? "NULL" : "'" . $user->getSurname() . "'")  . ", 'private', 'examiner'," 
                            . (is_null($user->getGender())  ? "NULL" : "'" . $user->getGender()  . "'" ) . " , '"
                            . date("Y/m/d") . "')";  
    
            $sql =  "INSERT INTO Users (Email, Password, Activated, ActivationCode, FirstName , Surname, Visibility , Rights , Gender , RegistrationDate) " 
                 .	"VALUES $values";
    
            // echo($sql);
    
            return DatabaseConnector::getConnection()->query($sql) ? true : false;
        } 
    
        static public function getUser($id)
        {
            $sql = "SELECT * FROM Users WHERE ID = " . $id ;
            $result = DatabaseConnector::getConnection()->query($sql);
            if (!$result) {
                return null;
            }
            $row = $result->fetch_array(MYSQLI_ASSOC);
    
            $resultUser = new User(); 
            $resultUser->setID($row['ID']);
            $resultUser->setEmail($row['Email']);
            $resultUser->setActivated($row['Activated']);
            $resultUser->setPassword($row['Password']);
            $resultUser->setFirstName($row['FirstName']);
            $resultUser->setSurname($row['Surname']);
            $resultUser->setGender($row['Gender']);
    
            return $resultUser;
        }
    
        /*
         * Aktualizacja imienia usera
         */
         static public function updateUserFirstName($user, $firstName)
         { 
             $sql = "UPDATE Users SET 
             FirstName  = '" . $firstName . "' 
             WHERE ID = '" . $user->getID() . "'";
    
             return DatabaseConnector::getConnection()->query($sql) ? true : false;
         } 
    
         /*
         * Aktualizacja hasla usera
         */
         static public function updateUserPassword($user, $password)
         { 
             $sql = "UPDATE Users SET 
             Password  = '" . $password . "' 
             WHERE ID = '" . $user->getID() . "'";
    
             return DatabaseConnector::getConnection()->query($sql) ? true : false;
         } 
    
         /*
         * Aktualizacja nicku usera
         */
         static public function updateUserSurname($user, $surname)
         { 
             $sql = "UPDATE Users SET 
             Surname  = '" . $surname . "' 
             WHERE ID = '" . $user->getID() . "'";
    
             return DatabaseConnector::getConnection()->query($sql) ? true : false;
         } 
    
         /*
         * Aktualizacja plci usera
         */
         static public function updateUserGender($user, $gender)
         { 
             $sql = "UPDATE Users SET 
             Gender  = '" . $gender . "'
             WHERE ID = '" . $user->getID() . "'";
    
             return DatabaseConnector::getConnection()->query($sql) ? true : false;
         }
    
        static public function activate($email, $code)
        {
            $email = mysql_real_escape_string($email);
            $code = mysql_real_escape_string($code);
    
            $user = new User();
            $user->setEmail($email);
    
            $sql =  "SELECT ID From Users WHERE email = '$email' AND ActivationCode = '$code' AND Activated = 0";
    
            if (DatabaseConnector::getConnection()->query($sql)->num_rows == 1)
            {
                $sql =  "UPDATE Users SET Activated = 1 WHERE Email = '$email'";
    
                return DatabaseConnector::getConnection()->query($sql) ? true : false;
            }
            else
            {
                return false;
            }
        }
    
        // Nie pozwalamy na utworzenie obiektu - Jeżeli zrozumiałeś design to nigdy nie zmienisz tego konstruktora na publiczny ;)
        private function __construct() { }
    }
?>
