<?php
$hostname = 'sql1.njit.edu';
$username = 'jc2284';
$password = 'Reyez2020A1$';
$dsn = "mysql:host=$hostname;dbname=$username";
try {
    $db = new PDO($dsn, $username, $password);
    echo "Connected successfully<br>";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
