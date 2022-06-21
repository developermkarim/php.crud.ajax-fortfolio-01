<?php
require_once 'Database.php';
$dbobj = new Database;
$dbconnection = $dbobj->database_function();
$edit_id = $_POST['upd_id'];
$name = $_POST['upd_name'];
$email = $_POST['upd_email'];
$location = $_POST['upd_location'];
$phone = $_POST['upd_phone'];
$date = $_POST['upd_date'];

$updateQuery = $dbconnection->query("UPDATE students SET Name='{$name}', Email='{$email}',Location='{$location}', phone_number='{$phone}',Birth_date='{$date}' WHERE id='{$edit_id}'");

if ($updateQuery) {
    echo 1;
}else{
    echo 0;
}
?>