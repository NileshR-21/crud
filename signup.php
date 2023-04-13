<?php
include 'partials/_dbconnect.php';
$showAlert = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $filename= $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/".$filename;

    move_uploaded_file($tempname,$folder);
    
    if($filename==""){
        $folder="images/noprofil.jpg";
    }
    
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $exists=false;

    if (($password == $cpassword) && $exists==false) {
        $sql = "INSERT INTO `users`.`users` ( `image`,`email`,`username`, `password`, `date`,`created_at`) VALUES ('$folder','$email','$username', '$password', current_timestamp(),current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if ($result){
            $showAlert = true;
        }
    } else {
        $showError = "Passwords do not match";
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

    <title>SignUp</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
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
        #image{
            display:flex;
            /* flex-direction:row; */
        }
        #btn{
            text-align:center;
            width:100%;
        }
    </style>

    <div class="container my-4 col-md-4">
     <h1 class="text-center">Signup to our website</h1>
     <form action="/loginsystem/signup.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Upload Image</label>
            <div id="image"><input type="file" name="uploadfile"> <input type="submit"  value="Upload Image"class="btn btn-primary" name="submit"></div>             
        </div>
        <div class="form-group">
            <label for="username">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
            
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password"  required>
            <input type="checkbox" onclick="myFunction('password')">&nbsp;Show Password
        </div>
        <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" required>
            <input type="checkbox" onclick="myFunction('cpassword')">&nbsp;Show Password
            <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
        </div>
         
        <button id="btn" type="submit" class="btn btn-primary">SignUp</button>
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
