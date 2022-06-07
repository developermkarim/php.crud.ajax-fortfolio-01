<?php
require_once 'Database.php';
$dbobj = new Database;
$dbconnection = $dbobj->database_function();
// $dbconnection = new mysqli("localhost","root","","ajax_in_crud");
if (!$dbconnection) {
    die("coulnd not connect the database");
}

$selectQuery = "SELECT * FROM students";
$stmt = $dbconnection->query($selectQuery);
$output = "";
if ($stmt->rowCount() > 0) {
  $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
  <tr>
    <th width="60px">Id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Location</th>
    <th>Birth Date</th>
    <th>Phone Number</th>
    <th width="90px">Edit</th>
    <th width="90px">Delete</th>
  </tr>';
    while ($rowRecords = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $output .= "<tr>

      <td align='center'>{$rowRecords["id"]}</td>
      <td>{$rowRecords['Name']}     </td>
      <td align='center'>{$rowRecords["Email"]}</td>
      <td align='center'>{$rowRecords['Location']}</td>
      <td align='center'>{$rowRecords['Birth_date']}</td>
      <td align='center'>{$rowRecords['phone_number']}</td>
      <td align='center'><button class='edit-btn' data-eid='{$rowRecords["id"]}'>Edit</button></td>
      <td align='center'><button Class='delete-btn' data-id='{$rowRecords["id"]}'>Delete</button></td>

      </tr>";
    }
    $output.= '</table>';
    $dbconnection = null;
    echo $output;
  }else {
    echo "<h2>No data Found</h2>";
  }
  
?>

