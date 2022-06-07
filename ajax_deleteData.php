<?php
require_once 'Database.php';
$dbobj = new Database;
$dbconnection = $dbobj->database_function();
if (!$dbconnection) {
    die("coulnd not connect the database");
}

$deleteid = $_POST['deleteId'];

$sql = "DELETE FROM students WHERE id='$deleteid'";
$dbquery = $dbconnection->query($sql);
if ($dbquery) {
   echo 1;
}else {
    echo 0;
}
?>