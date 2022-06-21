<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    #pagination a{
      border: 1px solid green;
      background-color: orange;
      color: while;
      font-weight: bold;
      padding: 5px 15px;
    }
    #pagination .active{
      background-color: white;
      color: orange;
    }
  </style>
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
           <input type="number" id="phone" class="phone-style" placeholder="Phone No.">
          <input type="submit" id="save-button" value="Save">
        </form>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
    <tr>
      <td style="text-align: center">
      </td>
    </tr>
  </table>
  
   
  <div id="error-message"></div>
  <div id="success-message"></div>

  <!-- Modal Box for Update Data  -->
  <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
 <table border="1" width="100%" cellspacing="0" cellpadding="10px">

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
  confirm('sure to delete this record ?')
  var deleteInfo = $(this).data("del_id");
  var deleteElement = this;
 
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
    
    //  show Modal in Update data  Box Here
$(document).on('click','.edit-btn',function(){
  $('#modal').show();
  var edite_id = $(this).data('ed_id');
$.ajax({
  type:"POST",
  url:"ajax-load-updateData.php",
  data:{editId:edite_id},
  success:function(data){
$("#modal-form table").html(data);
  }
})
})

  //  Close Modal in Update data  Box Here
$(document).on('click','#close-btn',function(){
    $('#modal').hide();
  })
// Update Data to save after input
$(document).on("click","#update-btn",function(){
  var edit_id = $('#hidden_edit_id').val();
  var uname  = $('#uname').val();
  var uemail = $('#uemail').val();
  var ulocation = $('#ulocation').val();
  var udate = $('#udate').val();
  var uphone = $('#uphone').val();

  $.ajax({
  type:"POST",
  url:"ajax-update-submit-data.php",
  data:{upd_id:edit_id,upd_name:uname,upd_email:uemail,upd_location:ulocation,upd_date:udate,upd_phone:uphone},
  success:function(data){
    if (data ==1) {
      $('#modal').hide();
      loadData();
    }
  }
})
});
    // Update data in showing Modal Box Here
    // Update data in showing Modal Box Here

    // Live Search in ajax crud
$("#search").on("keyup",function(){
  var search = $(this).val();
  $.ajax({
    type:"POST",
    url:"ajax-live-searchData.php",
    data:{searchData:search},
    success : function(data){
          $("#table-data").html(data);
        }
      });
   });

   // Page Pagination 
  function PageLoad(page_data) {
    
    $.ajax({
      type:"POST",
      url:'ajax-pagination-load.php',
      data:{page_no:page_data},
      success: function(data){
        $('#table-data').html(data);
      }
    })
  }
  PageLoad();
  $(document).on('click','#pagination a',function(ev){
  ev.preventDefault();
  var page_id = $(this).attr('id');
  PageLoad(page_id);
  
  });
  
});
</script>
</body>
</html>
