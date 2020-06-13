<?php

  session_start();

  define('home', 'https://localhost/LogSessions/home.php');

  $conn = mysqli_connect('localhost', 'root', '', 'emptyblog');
  if ($conn) {
    //echo "Connected";
  }else{
    die($conn) . mysqli_error($conn);
  }

  if ($_GET['Submit']) {
     $email = $_GET['email'];
     $pass = $_GET['pass'];
     $query = "SELECT * FROM practise WHERE email = '$email' && pass = '$pass'";
     $data =  mysqli_query($conn , $query);
     $log = mysqli_num_rows($data);
     if (empty($email) || empty($pass)) {
          echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
      }else{
          if ($log == 1) {
          if ($data) {
            $_SESSION['email'] = $email;
            $info = $_SESSION['email'] ;
             $query1 = "SELECT * FROM practise WHERE email = '$info'";
             $result1 = mysqli_query($conn , $query1);
            $output = mysqli_fetch_assoc($result1);
            $First = $output['fname'];
            $IDE = $output['id'];
            $id = $IDE.$First ;
             $sql = "CREATE TABLE  $id  (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            work VARCHAR(100) NOT NULL )";
          if(mysqli_query($conn, $sql)){
          echo "Table created successfully.";
          } else
          {
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }
          header('Location: '.home.'');
      }else{
        die($conn) . mysqli_error($conn);
        }
        }else{
          echo '<script type="text/javascript">alert("Email or Password Incorrect")</script>';
        }
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Log In</title>
  </head>
  <body>
    
    <nav class="navbar bg-primary text-white">
      <div class="container">
        <h1>Log In</h1>
        <form method="GET" action="regiater.php">
          <input type="submit" name="back" class="btn btn-success" value="Sign Up">
        </form>
      </div>
    </nav>
    <br>
    <div class="container">
      <form method="GET" action="">
        <div class="form-group">
          <label class="text-primary">Email</label>
          <input type="email" name="email" class="form-control-file">
        </div>
        <div class="form-group">
          <label class="text-primary">Password</label>
          <input type="password" name="pass" class="form-control-file">
        </div>
        <div class="form-group">
          <input type="submit" name="Submit" value="Log In" class="form-control-file btn btn-primary">
        </div>
      </form>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>

