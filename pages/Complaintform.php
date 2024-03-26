<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Request Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h3 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<?php
require_once "config.php";

$name = $email = $location = $Description = "";
$name_err = $email_err = $location_err = $Description_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && !empty(trim($_POST["name"]))) {
        $name = trim($_POST["name"]);
    } else {
        $name_err = "Please enter a name.";
    }

    if (isset($_POST["email"])) {
        $email = trim($_POST["email"]);
        if (empty($email)) {
            $email_err = "Please enter an email address.";
        }
    } else {
        $email_err = "Email field is missing.";
    }
    
    if (isset($_POST["location"]) && !empty(trim($_POST["location"]))) {
        $location = trim($_POST["location"]);
    } else {
        $location_err = "Please enter a location.";
    }

    if (isset($_POST["Description"]) && !empty(trim($_POST["Description"]))) {
        $Description = trim($_POST["Description"]);
    } else {
        $Description_err = "Please enter a Description.";
    }

    if (empty($name_err) && empty($email_err) && empty($location_err) && empty($Description_err)) {
        $sql = "INSERT INTO complaints (username, useremail, userlocation, userDescription, userStatus) VALUES (?, ?, ?, ?, 'InComplete')";
         
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_location, $param_Description);
            
            $param_name = $name;
            $param_email = $email;
            $param_location = $location;
            $param_Description = $Description;
            
            if (mysqli_stmt_execute($stmt)) {
                header("location: record.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($link);
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    
    mysqli_close($link);
}
?>


<div class="center-container">
    <div class="col-md-6 col-lg-4 form-container">
        <h3>Register Your Complaint here</h3>
        <form id="it-request-form" action="record.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="form-group">
                <label for="Description">Description:</label>
                <textarea class="form-control" id="Description" name="Description" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function validateForm() {
        var name = document.getElementById('name').value.trim();
        var email = document.getElementById('email').value.trim();
        var location = document.getElementById('location').value.trim();
        var Description = document.getElementById('Description').value.trim();

        if (name === '' || email === '' || location === '' || Description === '') {
            alert('Please fill out all fields.');
            return false;
        }
        return true;
    }
</script>
</body>
</html>
