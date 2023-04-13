<?php
$showAlert = false;
include 'partials/_dbconnect.php';
$id=$_GET['updateid'];
// echo $id;
// die;
$query = "SELECT * FROM users WHERE id=$id";
$result = mysqli_query($conn,$query);  
$row=mysqli_fetch_assoc($result);
$id = $row['id'];
$Image = $row['image'];
$Email = $row['email'];
$UserName = $row['username'];
$Password = $row['password'];
// $Date = $row['date'];
                              
                      

date_default_timezone_set("Asia/Kolkata");
$now = strtotime("now");
$date = date("Y/m/d H:i:s", $now);

// if(isset($_POST['submit']))
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $filename= $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/".$filename;
    move_uploaded_file($tempname,$folder);
    if($filename==""){
        $folder=$Image;
    }
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $folder = mysqli_real_escape_string($conn,$folder);


    $sql = "UPDATE users SET image='$folder',email='$email', username='$username',password='$password',updated_at='$date' WHERE id=$id";
    // echo "UPDATE users SET id=$id, email=$email, username=$username,password=$password, date=$date WHERE id=$id";
    // die;
    $result = mysqli_query($conn, $sql);
    if ($result){
        $showAlert = true;
        // echo "Record updated successfully";
    //    header("location : welcome.php");
    }
    else{
        echo "Error updating record: " . mysqli_error($conn);
    }
}
if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Details Are Successfully Updated
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Update</title>
  </head>
  <body>
  <style>
            .logo{
              width: 50px;
              height:50px;
            }
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <img class="logo" src="upwork logo.png" alt="">&nbsp;&nbsp;
            <a class="navbar-brand" href="/loginsystem">TECHSIMBA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/loginsystem/welcome.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                <a class="nav-link"  href="/loginsystem/logout.php">Logout</a>
                </li>
                
                </ul>
            </div>
            </nav>
    <div class="container my-4 col-md-4">
     <h1 class="text-center">Update User Information</h1>
     <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Upload Image</label>
            <div id="image">
                <input type="file" name="uploadfile" > 
                <!-- <input type="submit"  value="Upload Image"class="btn btn-primary" name="uploaddone"> -->
            </div>             
        </div>
        <div class="form-group">
            <label for="username">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $Email; ?>" >
            
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $UserName; ?>" >
            
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="<?php echo $Password; ?>" >
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
     </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
