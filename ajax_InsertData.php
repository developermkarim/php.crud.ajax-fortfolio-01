<?php
require_once 'Database.php';
$dbobj = new Database;
$dbcon_insert = $dbobj->database_function();
$name = ucfirst($_POST['stname']);
$email = strtolower($_POST['stemail']);
$location = ucfirst($_POST['stlocation']);
$date = $_POST['stdate'];
$phone = $_POST['stphone'];
// $dbcon_insert = new mysqli('localhost','root','','ajax_in_crud') or die('couldnt connect to database');
$stmt = "INSERT INTO students(Name,Email,Location,Birth_date,phone_number) VALUES('{$name}','{$email}','{$location}','{$date}',{$phone})";
if ($dbcon_insert->query($stmt)){
    echo 1;

}else{
    echo 0;
}
?>