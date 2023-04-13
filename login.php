<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    header("location: welcome.php");
    exit; 
}

$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';

    $email = $_POST["email"];
    $password = $_POST["password"]; 

    $sql = "Select * from users where ( username='$email' OR email='$email' ) AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $login = true;
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        header("location: welcome.php");

    } 
    else{
        $showError = "Invalid Credentials";
    }
}
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>
    <style>
        .container{
            
            display:flex;
            flex-direction:column;
            align-items:center;
            border:2px solid gray;
            border-radius:10px;
            padding:5px;
            background:white;
        }
    </style>

    <div class="container my-4 col-md-3">
     <h1 class="text-center">Login to our website</h1>
     <form action="/loginsystem/login.php" method="post">
        <div class="form-group">
            <label for="username">Username/Email</label>
            <input type="text" class="form-control" id="email" name="email">
            
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <input type="checkbox" onclick="myFunction('password')">&nbsp;Show Password
        </div>
       
        <!-- <button type="submit" class="btn btn-primary" onclick="check_email_or_username('input')">Login</button> -->
        <button type="submit" class="btn btn-primary" >Login</button>
        
     </form>
    </div>

    <!-- Optional JavaScript -->
    <script>
       function myFunction($val) {
            var x = document.getElementById($val);
            if (x.type === $val) {
                x.type = "text";
            } else {
                x.type = $val;
            }
            }
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
