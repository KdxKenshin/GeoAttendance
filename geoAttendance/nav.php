<?php 
session_start();
include("db_conn.php");

$id = $_SESSION['user_id'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 

  <style>
    /* Add your CSS styles here */
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

        body {
            
            font-family: 'Quicksand', sans-serif;
            margin: 0;
        }

    .navbar {
      background-color: #302f49; /* Primary color */
      color: #fff; /* Text color */
      padding: 10px 20px;
      display: flex; /* Allow for horizontal layout */
      justify-content: center; /* Center list items */
    }

    .navbar ul {
      list-style: none; /* Remove default bullet points */
      margin: 0; /* Remove default margin */
      padding: 0; /* Remove default padding */
    }

    .navbar li {
      display: inline-block; /* Make list items appear side-by-side */
      margin-right: 20px; /* Add spacing between list items */
    }

    .navbar a {
      text-decoration: none; /* Remove underline from links */
      color: inherit; /* Inherit text color from navbar */
    }

    .navbar a:hover {
      color: #45a049; /* Secondary color for hover effect */
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <ul>
      
      <?php 
        if($_SESSION['is_student']){
      ?>
      
      <li><a href="index.php">Home</a></li>
      <li><a href="attend.php">Attend</a></li>
      <li><a href="upcoming-lectures.php">Upcoming Lectures</a></li>

      
      <li><a href="logout.php">Logout</a></li>
      <h3 style="display: inline;">STUDENT VIEW</h3>
      <?php }elseif($_SESSION['is_teacher']){?>

      <li><a href="index.php">Home</a></li>
      <li><a href="update_visit.php">Attend</a></li>
      

      <li><a href="logout.php">Logout</a></li>
      <h3 style="display: inline;">Lecture VIEW</h3>

    <?php }else{?>
        <p>ERROR: User role not found.</p>
      <?php }?>

      
                  <!-- Security View -->
      
      


      <!-- <li><a href="login.php">Login</a></li> -->
    </ul>
  </nav>

  </body>
</html>
