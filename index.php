<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>PHP & Ajax CRUD</h1>

        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
            <input type="text" id="name" placeholder="User Name">
            <input type="email" id="email" placeholder="Email ID">
           <input type="text" id="location" placeholder="Location">
           <input type="date" id="date" placeholder="Birth Date">
           <input type="number" id="phone" placeholder="Phone No.">
          <input type="submit" id="save-button" value="Save">
        </form>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
  <div id="error-message"></div>
  <div id="success-message"></div>
  <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <table cellpadding="10px" width="100%">
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // Load Table Records
    function loadData(){
      $.ajax({
        url : "ajax_load-data.php",
        type : "POST",
        success : function(data){
          $("#table-data").html(data);
        }
      });
    }
    loadData(); // Load Table Records on Page Load

    // Insert New Records
    $("#save-button").on("click",function(e){
      e.preventDefault();
      var name = $("#name").val();
      var email = $("#email").val();
      var location = $("#location").val();
      var date = $("#date").val();
      var phone = $("#phone").val();
      if(name == "" || email == "" || location == "" || date == "" || phone == ""){
        $("#error-message").html("All fields are required.").slideDown();
        $("#success-message").slideUp();
      }else{
        $.ajax({
          url: "ajax_insertData.php",
          type : "POST",
          data : {stname:name, stemail: email,stlocation:location,stdate:date,stphone:phone},
          success : function(data){
            if(data == 1){
              loadData();
              $("#addForm").trigger("reset");
              $("#success-message").html("Data Inserted Successfully.").slideDown();
              $("#error-message").slideUp();
            }else{
              $("#error-message").html("Can't Save Record.").slideDown();
              $("#success-message").slideUp();
            }
          }
        });
      }
    });

// delete Data from records
$(document).on('click','.delete-btn',function(){
  var deleteInfo = $(this).data("id");
  var deleteElement = this;
  confirm('sure to delete this record ?')

  $.ajax({
    url:'ajax_deleteData.php',
    type:'POST',
    data:{deleteId:deleteInfo},
    success: function(data){
      if (data ==1) {
        $(deleteElement).closest('tr').fadeOut();
      }
      else{
        $('#error-messege').html('can\'t delete data').slideDown()
        $('#success-messege').slideUp();
      }
      
    }
  })
})
    //Delete Records
    // $(document).on("click",".delete-btn", function(){
    //   if(confirm("Do you really want to delete this record ?")){
    //     var studentId = $(this).data("id");
    //     var element = this;

    //     $.ajax({
    //       url: "ajax-delete.php",
    //       type : "POST",
    //       data : {id : studentId},
    //       success : function(data){
    //           if(data == 1){
    //             $(element).closest("tr").fadeOut();
    //           }else{
    //             $("#error-message").html("Can't Delete Record.").slideDown();
    //             $("#success-message").slideUp();
    //           }
    //       }
    //     });
    //   }
    // });

    //Show Modal Box
    // $(document).on("click",".edit-btn", function(){
    //   $("#modal").show();
    //   var studentId = $(this).data("eid");

    //   $.ajax({
    //     url: "load-update-form.php",
    //     type: "POST",
    //     data: {id: studentId },
    //     success: function(data) {
    //       $("#modal-form table").html(data);
    //     }
    //   })
    // });

    //Hide Modal Box
    // $("#close-btn").on("click",function(){
    //   $("#modal").hide();
    // });

    //Save Update Form
      // $(document).on("click","#edit-submit", function(){
      //   var stuId = $("#edit-id").val();
      //   var fname = $("#edit-fname").val();
      //   var lname = $("#edit-lname").val();

      //   $.ajax({
      //     url: "ajax-update-form.php",
      //     type : "POST",
      //     data : {id: stuId, first_name: fname, last_name: lname},
      //     success: function(data) {
      //       if(data == 1){
      //         $("#modal").hide();
      //         loadTable();
      //       }
      //     }
      //   })
      // });

    // Live Search
    //  $("#search").on("keyup",function(){
    //    var search_term = $(this).val();

    //    $.ajax({
    //      url: "ajax-live-search.php",
    //      type: "POST",
    //      data : {search:search_term },
    //      success: function(data) {
    //        $("#table-data").html(data);
    //      }
    //    });
    //  });
  });
</script>
</body>
</html>
