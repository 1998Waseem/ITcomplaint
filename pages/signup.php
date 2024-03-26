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
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <title>Planet Shopify - SignUp</title>
  </head>
  <body>

  
  <?php

require_once "config.php";
 
$Emailsignup = $Passwordsignup =  $lnamesignup = "";
$Emailsignup_err = $Passwordsignup_err = $fnamesignup_err = $lnamesignup_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["Emailsignup"]))){
        $Emailsignup_err = "Please enter a Email address.";
    } 
    // elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    //     $username_err = "Username can only contain letters, numbers, and underscores.";
    // } 
    else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE Emailsignup = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Emailsignup);
            
            // Set parameters
            $param_Emailsignup = trim($_POST["Emailsignup"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $Emailsignup_err = "This Email is already taken.";
                } else{
                    $Emailsignup = trim($_POST["Emailsignup"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["Passwordsignup"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["Passwordsignup"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $Passwordsignup = trim($_POST["Passwordsignup"]);
    }

    if(empty(trim($_POST["fnamesignup"]))){
      $fnamesignup_err = "Please enter a First Name.";     
  }
  elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["fnamesignup"]))){
    $fnamesignup_err = "First Name can only contain letters, numbers, and underscores.";
}  
  
  else{
      $fnamesignup = trim($_POST["fnamesignup"]);
  }
    
  if(empty(trim($_POST["lnamesignup"]))){
    $lnamesignup_err = "Please enter a Last Name.";     
} 
elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["lnamesignup"]))){
  $lnamesignup_err = "Last Name can only contain letters, numbers, and underscores.";
}
else{
    $lnamesignup = trim($_POST["lnamesignup"]);
}
    
    
    // Check input errors before inserting in database
if(empty($Emailsignup_err) && empty($Passwordsignup_err) && empty($fnamesignup_err) && empty($lnamesignup_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (Emailsignup, Passwordsignup, fnamesignup,lnamesignup) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssd", $param_Emailsignup, $param_Passwordsignup, $param_fnamesignup, $param_lnamesignup);
            
            // Set parameters
            $param_Emailsignup = $Emailsignup;
            $param_Passwordsignup = password_hash($Passwordsignup, PASSWORD_DEFAULT); // Creates a password hash
            $param_fnamesignup= $fnamesignup;
          $param_lnamesignup = $lnamesignup;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
               
            header("location: login.php");
            // echo "<h1>You have registered sucessfully</h1>";
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }
        
    }
    
    // Close connection
    mysqli_close($link);
}
?>

    <div class="container-fluid" style="margin-top:15%;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                
            <h1 style="text-align:center;">SignUP Your Account Here</h1>
            <form id="signupform" onsubmit="return validatesignupform()" method="post">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="signupemail"  placeholder="Enter Email" name="Emailsignup">
                                <div id="erroremail" style="color:red"></div>
                              </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="signuppassword" placeholder="Password" name="Passwordsignup">
                                <div id="errorpassword" style="color:red"></div>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" id="signupfname" placeholder="First Name" name="fnamesignup">
                                <div id="errorfname" style="color:red"></div>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label>Last Name</label>
                                <input type="text" class="form-control" id="signuplname" placeholder="Last Name" name="lnamesignup">
                                 <div id="errorlname" style="color:red"></div>
                              </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="check1" name="checkboxs">
                                <label class="form-check-label" for="exampleCheck1">Agree terms and Condition</label>
                                <!-- <div id="errorcheck" style="color:red"></div> -->
                              </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-secondary" style="width: 100%;">Sign Up</button>
                        </div>
                </form>
        
</div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <script>
function validatesignupform() {

  let form = document.getElementById('signupform');
      let email = document.getElementById('signupemail');
      let password = document.getElementById('signuppassword');
      let fname = document.getElementById('signupfname');
      let lname = document.getElementById('signuplname');
      let checkbox = document.getElementById('check1');
      let flag = 1;
        if(email.value == ""){
          document.getElementById("erroremail").innerHTML="Email is not entered";
          flag =0;
        }
        else{
          document.getElementById("erroremail").innerHTML="";
          flag =1;
        }

        if(password.value == ""){
          document.getElementById("errorpassword").innerHTML="Password is not entered";
          flag =0;
        }
        else if(password.value.length < 10){
          document.getElementById("errorpassword").innerHTML="Password should be 10 characters";
          flag =0;
        }
        
        else{
          document.getElementById("errorpassword").innerHTML="";
          flag =1;
        }

        if(fname.value == ""){
          document.getElementById("errorfname").innerHTML="First name is not entered";
          flag =0;
        }
        else{
          document.getElementById("errorfname").innerHTML="";
          flag =1;
        }

        if(lname.value == ""){
          document.getElementById("errorlname").innerHTML="Last name is not entered";
          flag =0;
        }
        else{
          document.getElementById("errorlname").innerHTML="";
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

<script>

    </body>
    </html>