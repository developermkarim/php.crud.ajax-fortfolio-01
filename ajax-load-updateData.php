
<?php
require_once 'Database.php';
$edit_id = $_POST['editId'];
$database = new Database;
$dbquery = $database->database_function()->query("SELECT * FROM students WHERE id ={$edit_id}");
$output = '';
if ($dbquery->rowCount() > 0) {
  $output .= "<table border='1' width='100%' cellspacing='0' cellpadding='10px'>";
    while($rowRecords = $dbquery->fetch(PDO::FETCH_ASSOC)){

       $output .=
        "<form>
                <tr>
                 <td>
                 <label for='uname'>Name :</label>
                 <input type='text' id='uname' value='{$rowRecords["Name"]}'>
                 <label for='uemail'>Email ID :</label>
                  <input type='email' id='uemail' value='{$rowRecords["Email"]}'>
                  <label for='ulocation'>Location :</label>
                 <input type='text' id='ulocation' value='{$rowRecords["Location"]}'>
                 <label for='udate'>Birth Date :</label>
                 <input type='date' id='udate'  value='{$rowRecords["Birth_date"]}'>
                 <label for='uphone'>Phone No. :</label>
                 <input type='text' id='uphone'  value='{$rowRecords["phone_number"]}'>
                <input type='submit' id='update-btn' value='Update'>
                <input type=\"hidden\" name=\"edit\" id='hidden_edit_id' value='{$rowRecords["id"]}'>
                </td>
                </tr>
      </form>";
    }
    $output .="</table>";
    echo $output;
    $dbquery = null;
}else{
   echo "<h2>No data found</h2>";

}
?>
