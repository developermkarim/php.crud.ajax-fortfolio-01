<?php
require_once 'Database.php';
$dbobj = new Database;
$dbconnection = $dbobj->database_function();
 
if (!$dbconnection) {
    die("coulnd not connect the database");
};
      $limit_page = 3;
      $pageCount = "";
      if (isset($_POST['page_no'])) {
        $pageCount = $_POST['page_no'];
      }else{
        $pageCount = 1;
      };
      $starting_page = ($pageCount - 1)* $limit_page;

$selectQuery = "SELECT * FROM students limit {$starting_page},{$limit_page}";
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
      <td>{$rowRecords['Name']}</td>
      <td align='center'>{$rowRecords["Email"]}</td>
      <td align='center'>{$rowRecords['Location']}</td>
      <td align='center'>{$rowRecords['Birth_date']}</td>
      <td align='center'>{$rowRecords['phone_number']}</td>
      <td align='center'><button class='edit-btn' data-ed_id='{$rowRecords["id"]}'>Edit</button></td>
      <td align='center'><button Class='delete-btn' data-del_id='{$rowRecords["id"]}'>Delete</button></td>

      </tr>";
    }
      $output.= '</table>';
      $page_query = $dbobj->database_function()->query("select * from students");
      $page_records = $page_query->rowCount();
      $page_show = ceil($page_records/$limit_page);
      $output.=  '<div id="pagination" style="text-align:center;margin-top:20px">';
      for ($i=1; $i <= $page_show; $i++) {
        if ($i == $pageCount) {
         $addClass = "active";
        } else {
         $addClass = "";
        }
        
       $output.= "<a class=\"{$addClass}\" id=\"{$i}\" href=\"\">{$i}</a>";
      
      } 
       $output.='</div>';
    $dbconnection = null;
    echo $output;
  }else {
    echo "<h2>No data Found</h2>";
  }
  
?>

