<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$Namelogin = $Passwordlogin = "";
$Namelogin_err = $Passwordlogin_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["namelogin"]))) {
        $Namelogin_err = "Please enter Name.";
    } else {
        $Namelogin = trim($_POST["namelogin"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["Passwordlogin"]))) {
        $Passwordlogin_err = "Please enter your password.";
    } else {
        $Passwordlogin = trim($_POST["Passwordlogin"]);
    }

    // Validate credentials
    if (empty($Namelogin_err) && empty($Passwordlogin_err)) {
        // Prepare a select statement
        $sql = "SELECT admin_id, admin_name, admin_password FROM technician WHERE admin_name = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Namelogin);

            // Set parameters
            $param_Namelogin = $Namelogin;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $Namelogin, $stored_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if ($Passwordlogin == $stored_password) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["namelogin"] = $Namelogin;

                            // Redirect user to welcome page
                            header("location: tech_record.php");
                            exit;
                        } else {
                            // Password is not valid
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Username doesn't exist
                    $login_err = "Invalid username or password.";
                }
            } else {
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

    <title>Planet Shopify - Login</title>
</head>
<body>

<div class="container-fluid" style="margin-top:15%;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            
        <h1 style="text-align:center;">Admin Login</h1>

        <?php 
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }        
    ?>
            <form id="loginform" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="loginname" aria-describedby="emailHelp" placeholder="Enter Name" name="namelogin">
                  <span id="errorloginname" style="color:red"><?php echo $Namelogin_err; ?></span>  
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="loginpassword" placeholder="Enter Password" name="Passwordlogin">
                  <span id="errorloginpassword" style="color:red"><?php echo $Passwordlogin_err; ?></span>
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-secondary" style="width: 100%;">Login</button>
                <a href="#" class="tooltip-test" >forgot password?</a>
              </form>
    
        </div>
        <div class="col-md-2"></div>
    </div>
</div>


</body>
</html>
