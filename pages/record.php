
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/media.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Delius+Swash+Caps&display=swap" rel="stylesheet">
<script src="js/signup.js"></script>
    <title>Planet Shopify - Home</title>
  </head>
  <body>

  <!--- Delete modal --->
  <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="delete.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<!--- Delete modal --->

  <!--statrt of Edit form moal  -->
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="loginform" onsubmit="return validateupdateform()" method="POST">
                <div class="form-group">
                      <input type="hidden" class="form-control" id="update_id" aria-describedby="emailHelp" name="updateid">
                    </div>    
                    <div class="form-group">
                      <label for="exampleInputPassword1">Enter Name</label>
                      <input type="text" class="form-control" id="updatename" placeholder="Enter First Name" name="name">
                      <span id="errorupdatename" style="color:red"></span>
                    </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Enter New Email address</label>
                      <input type="email" class="form-control" id="updatemail" aria-describedby="emailHelp" placeholder="Enter Email" name="email">
                      <span id="errorupdatemail" style="color:red"></span>  
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Location</label>
                      <input type="text" class="form-control" id="updatelocation" placeholder="Enter Location" name="location">
                      <span id="errorupdatelocation" style="color:red"></span>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea type="text" class="form-control" id="updatedesc" placeholder="Enter Description" name="Description"></textarea>
                      <span id="errorupdatedesc" style="color:red"></span>
                    </div>
                    
                    <a href="record.php" type="submit" class="btn btn-secondary" name="updatedata" style="width: 100%;">Update</a>
                  </form>

            </div>
        </div>
    </div>

<!--End of Edit form moal  -->
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-12">
                <center>
                    <h1>User's List</h1>
                </center>
                <?php
                     include_once 'config.php';
                     $result = mysqli_query($link,"SELECT * FROM complaints");
                ?>
                <?php
                     if (mysqli_num_rows($result) > 0) {
                ?>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Location</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
                    <tbody>
                      <tr>
                        <th scope="row"><?php echo $row["id"]; ?></th>
                        <th><?php echo $row["username"]; ?></th>
                        <td><?php echo $row["useremail"]; ?></td>
                        <td><?php echo $row["userlocation"]; ?></td>
                        <td><?php echo $row["userDescription"]; ?></td>
                        <td><?php echo $row["userStatus"]; ?></td>
                        <td>
                          <button type="button" class="btn btn-success btn-sm editbtn">Edit</button>
                        </td>
                        <td>
                        <button type="button" class="btn btn-danger btn-sm deletebtn">Delete</button>
                        </td>
                      </tr>
                    </tbody>
                    <?php
$i++;
}?>
                  </table>

                  <?php
}
else{
echo "No result found";
}
?>
            </div>
           
        </div>

</div>
      <script>
      
      function validateupdateform() {
            
            let updatename = document.getElementById('updatename');
            let updatemail = document.getElementById('updatemail');
            let updatelocation = document.getElementById('updatelocation');
            let updatedesc = document.getElementById('updatedesc');
            
            let flag = 1;
      
              if(updatename.value == ""){
                document.getElementById("errorupdatename").innerHTML="Name is not entered";
                flag =0;
              }
              else{
                document.getElementById("errorupdatename").innerHTML="";
                flag =1;
              }
      
              if(updatemail.value == ""){
                document.getElementById("errorupdatemail").innerHTML="Email is not entered";
                flag =0;
              }
              else{
                document.getElementById("errorupdatemail").innerHTML="";
                flag =1;
              }

              
              if(updatelocation.value == ""){
                document.getElementById("errorupdatelocation").innerHTML="Location is not entered";
                flag =0;
              }
              else{
                document.getElementById("errorupdatelocation").innerHTML="";
                flag =1;
              }

              if(updatedesc.value == ""){
                document.getElementById("errorupdatedesc").innerHTML="Description is not entered";
                flag =0;
              }
              else{
                document.getElementById("errorupdatedesc").innerHTML="";
                flag =1;
              }
      
              if(flag){
                return true;
              }else{
                return false;
              }
      
              return true;
            }
          </script>

          


          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>

    <script>
            $(document).ready(function () {

             $('.editbtn').on('click', function () {

               $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
            return $(this).text();
             }).get();

            console.log(data);

              //  $('#update_id').val(data[0]);
              //   $('#updatename').val(data[1]);
              //   $('#updatemail').val(data[2]);
              //   $('#updatelocation').val(data[3]);
              //   $('#updatedesc').val(data[4]);

              $('#updatename').val(data[4]);
                $('#updatemail').val(data[1]);
                $('#updatelocation').val(data[2]);
                $('#updatedesc').val(data[3]);
                // $('#updateStatus').val(data[4]);
});
});
          </script>
    </body>