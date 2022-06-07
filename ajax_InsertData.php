<?php
$name = $_POST['stname'];
$email = $_POST['stemail'];
$location = $_POST['stlocation'];
$date = $_POST['stdate'];
$phone = $_POST['stphone'];

$dbcon_insert = new mysqli('localhost','root','','ajax_in_crud') or die('couldnt connect to database');
$stmt = "INSERT INTO students(Name,Email,Location,Birth_date,phone_number) VALUES('{$name}','{$email}','{$location}','{$date}',{$phone})";
if ($dbcon_insert->query($stmt)){
    echo 1;

}else{
    echo 0;
}
?>