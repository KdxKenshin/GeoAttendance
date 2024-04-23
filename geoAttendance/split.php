<?php 

include("nav.php");
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

echo "Welcome " . $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Attendance</title>
    <style>
             @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

body {
    font-family: 'Quicksand', sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('background-1.png'); background-repeat: no-repeat; 
    text-align: center;
}

h1, h2 {
    color: #302f49;
    margin-bottom: 50px;
    text-align: center;
}
.success {
    color: white;
    background-color: #45a049;
    margin-bottom: 10px;
    border-radius: 8px;
    padding: 10px;
}
.fail {
    color: #f0f0f0;
    background-color: red;
    margin-bottom: 10px;
    border-radius: 8px;
    padding: 10px;
}
.distance {
    color: white;
    margin: 0 ;
}
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .module-buttons {
            margin-bottom: 20px;
        }
        .module-buttons button {
            width: 200px;
            margin: 5px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        .section {
            margin-bottom: 20px;
            text-align: left;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .section h2 {
            margin-top: 0;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #302f49;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover{
            background-color: #45a049;

        }
        .attend {
            align-items: center;
        }
        
        
        .back-button {
    position: fixed;
    bottom: 20px; /* Adjust the distance from the bottom as needed */
    left: 20px; /* Adjust the distance from the left as needed */
    background-color: #302f49; /* Button background color */
    color: #fff; /* Button text color */
    width: 50px; /* Adjust button size */
    height: 50px; /* Adjust button size */
    border-radius: 50%; /* Make it circular */
    text-decoration: none;
    z-index: 999; /* Ensure it's above other content */
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow for better visibility */
    transition: background-color 0.3s ease; /* Smooth transition on hover */
}

.back-button:hover {
    background-color: #45a049; /* Change color on hover */
}

    </style>
</head>
<body>
<div class="container">
        <h1>Module Attendance App</h1>
        
        <a href="attend.php"><button>Attend </button></a>
        <br>
        <br>
        <a href="upcoming_lectures.php"><button>Upcoming Lectures</button></a>

</div>

<a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i></a>

</body>
</html>
