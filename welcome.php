<?php
session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit; 
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

    <title> Welcome </title>
  </head>
  <body>
          <style>
            .logo{
              width: 50px;
              height:50px;
            }
            #image{
              border-radius:50%;
            }
            /* table{
              align:center;
              border:1px;
              width:600px; 
              line-height:40px;
            } */
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
        
        <?php 

    require_once('partials/_dbconnect.php');
    

?>


          <div class="container">
            <div class="row mt-3">
              <!-- <button></button> -->
                <div class="col ">
                    <!-- <div class="card mt-5"> -->
                        <table class="table table-bordered text-center">
                            <tr class="bg-dark text-white">
                                <td> S.No. </td>
                                <td> Image </td>
                                <td> Email </td>
                                <td> UserName </td>
                                <td> Password </td>
                                <td> Date </td>
                                <td> Edit  </td>
                                <td> Delete </td>
                            </tr>

                            <?php 
                              $query = " select * from users ";
                              $result = mysqli_query($conn,$query);  
                              while($row=mysqli_fetch_assoc($result))
                              {
                                  $id = $row['id'];
                                  $Image = $row['image'];
                                  $Email = $row['email'];
                                  $UserName = $row['username'];
                                  $Password = $row['password'];
                                  $Date = $row['date'];
                      
                                                                                                     
                              echo '<tr>
                                  <td scope="row"> '.$id.'</td>
                                  <td><img id="image" src='.$Image.' height=100px width=100px ></td>
                                  <td> '.$Email.'</td>
                                  <td> '.$UserName.'</td>
                                  <td> '.$Password.'</td>
                                  <td> '.$Date.'</td>
                                  <td><a href="update.php?updateid='.$id.'" class="btn btn-pencil btn-primary">Edit</a></td>
                                  <td><a href="delete.php?deleteid='.$id.'" class="btn btn-danger">Delete</a></td>
                              </tr>';    
                    
                              }
                              ?> 
                                   

                        </table>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



  </body>
</html>
