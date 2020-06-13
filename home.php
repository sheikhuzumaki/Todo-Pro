<?php

  session_start();

  define('home', 'https://localhost/LogSessions/home.php');
  
  $conn = mysqli_connect('localhost', 'root', '', 'emptyblog');

  $info = $_SESSION['email'] ;

  $query1 = "SELECT * FROM practise WHERE email = '$info'";
  $result1 = mysqli_query($conn , $query1);
  $output = mysqli_fetch_assoc($result1);
  $First = $output['fname'];
  $IDE = $output['id'];
  $id = $IDE.$First ;

  $query =  "SELECT * FROM   $id " ;

  $result = mysqli_query($conn , $query);

  $todos = mysqli_fetch_all($result , MYSQLI_ASSOC);

  if ($_GET['Submit']) {
        $work = mysqli_real_escape_string($conn , $_GET['work']);
        if (empty($work)) {
              echo '<script type="text/javascript">alert("Enter Todo Plan")</script>';
        }else{
           $query =" INSERT INTO $id(work) VALUES ('$work') ";

        if (mysqli_query($conn , $query)) {

         header('Location: ' .home.'');
        }
         else
          echo mysqli_error();
        }
  }

  if (isset($_GET['delete'])) {
        //echo "delete detected";
        //$delete_id = mysqli_real_escape_string($conn ,$_GET['id']);
        $query = "DELETE FROM $id WHERE id = " .$_GET['delete'];

        if(mysqli_query($conn, $query)){
      header('Location: '.home.'');
          echo "string";
           } else {
      echo 'ERROR: '. mysqli_error($conn);
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

    <title>Home</title>
  </head>
  <body>
    
    <nav class="navbar bg-primary text-white">
      <div class="container">
        <h1>Welcome <?php echo $output['fname']; ?></h1>
        <form method="GET" action="login.php">
          <input type="submit" name="back" class="btn btn-success" value="Back to Log In">
        </form>
      </div>
    </nav>
    <br>
    <div class="container col-md-8">
  
            <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <div class="input-group">
                    <input type="text" name="work" class="form-control">
                    <input  class="btn btn-primary" type="submit" name="Submit">
                </div>
                </form>
                <br> 
                
                <div class="input-group ">
                  <?php foreach($todos as $todo): ?>
                 <table class="table table-bordered table-striped">

                   <th><?php echo $todo['work']; ?>
                     <form method="GET" action="<?= $_SERVER['PHP_SELF']; ?>" >
                       <input type="hidden" name="delete" value="<?= $todo['id'] ?>">
                       <button class="btn btn-danger float-right">Delete</button>
                     </form>
                     <form method="GET" action="edit.php" >
                       <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                       <button class="btn btn-primary float-right">Edit</button>
                     </form>
                   </th>
                   <?php endforeach; ?>
                 </table>
                </div>        
               </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>