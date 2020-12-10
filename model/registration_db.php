<?php
    require('pdo.php');

    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $birthday = filter_input(INPUT_POST, 'birthday');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

function create_account($email, $firstName, $lastName, $birthday, $password)
{
    global $db;
    $query = 'INSERT INTO accounts
                    (email, fname, lname, birthday, password)
                  VALUES
                    (:email, :fname, :lname, :birthday, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':fname', $firstName);
    $statement->bindValue(':lname', $lastName);
    $statement->bindValue(':birthday', $birthday);
    $statement->bindValue(':password', $password);

    $statement->execute();
    $statement->closeCursor();

}

    if(strlen($password) < 8) {
        echo 'Password should be at least 8 characters';
    }
    if (empty($firstName)){
        echo 'First name is empty'; }
        echo "<br>";
    if (empty($lastName)){
        echo 'Last name is empty'; }
        echo "<br>";
    if (empty($birthday)){
        echo 'Birthday is empty'; }
        echo "<br>";
    if (empty($email)){
        echo 'Email is empty'; }
        echo "<br>";
    if (strpos($email, '@') == false ) {
        echo 'Email must contain an @ character';
        echo "<br>";
}
include('login.php');

?>
