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

  $new = $_GET['id'];
    

      
      if(isset($_GET['Submit'])) {
        $work = $_GET['prev'];
        //$query = "UPDATE   $id  set 'work' = $work WHERE id = " . $_GET['id'] ;   
        $query = 'UPDATE ' . $id . '  set work = "' . $work . '" WHERE id = ' . $_GET["IDE"]; 
        if (mysqli_query($conn , $query)) {
         // echo "string";
         header('Location: ' .home.'');
          }
         else{
          echo mysqli_error($conn);
          }
      }

  $query = "SELECT * FROM $id WHERE id =  " . $new;
  $result = mysqli_query($conn , $query);
  $todos = mysqli_fetch_assoc($result);
  echo $todos['id'];

?>

<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Edit</title>
  </head>
  <body>
    
    <nav class="navbar bg-primary text-white">
      <div class="container">
        <h1>Edit</h1>
      <form method="GET" action="home.php">
        <input type="submit" name="Back" class="btn btn-success" value="Back">
      </form>
      </div>
    </nav>
    <br>
      <div class="container col-md-8">
        <form class="input-group" method="GET" action="">
         <input type="hidden" name="IDE" value="<?= $_GET['id'] ?>">
          <textarea class="input-group" name="prev"><?php echo $todos['work']; ?></textarea>
           <input  class="btn btn-success" type="submit" name="Submit">
        </form>
      </div>
  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>