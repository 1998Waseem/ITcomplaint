<?php
// $connection = mysqli_connect("localhost","root","");
// $db = mysqli_select_db($connection, 'planet');

include 'config.php';

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['id'];
        
        // $name = $_POST['username'];
        // $email = $_POST['useremail'];
        // $location =  $_POST['userlocation'];
        // $Description = $_POST['userDescription'];
        $Status=$_POST['userStatus'];

        // $query = "UPDATE complaints SET email='$email', fnamesignup='$fnamesignup', WHERE id='$id' ";
        $query = "UPDATE complaints SET userStatus='$Status' WHERE id='$id' ";
        
        $query_run = mysqli_query($link, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header('Location:tech_record.php');
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>