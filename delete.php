<?php
include 'partials/_dbconnect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    // echo $id;
    // die;
    
    $sql = "DELETE FROM users WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
    // echo "Record deleted successfully";
    header('location:welcome.php');
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>