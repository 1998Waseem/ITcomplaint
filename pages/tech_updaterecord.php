<?php
include 'config.php';

if(isset($_POST['updatedata'])) {   
    $id = $_POST['updateid'];
    $Status = $_POST['userStatus'];

    $query = "UPDATE complaints SET userStatus='$Status' WHERE id='$id'";
    
    $query_run = mysqli_query($link, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header('Location: tech_record.php');
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
