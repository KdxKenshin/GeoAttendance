<?php
session_start();
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_number = $_POST['student_number'];
    $pin = $_POST['pin'];
    
    // Query to select user based on student number and PIN
    $sql = "SELECT * FROM students WHERE student_number = '$student_number' AND pin = '$pin'";
    
    // Execute the query
    $result = $conn->query($sql);
    
    // Check if the query executed successfully
    if ($result) {
        // Check if there's a matching user
        if ($result->num_rows == 1) {
            // Fetch user data
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['id'];
            
            $_SESSION['student_number'] = $row['student_number'];

            $_SESSION['is_student'] = 1;
            $_SESSION['is_teacher'] = 0;

            $_SESSION['name'] = $row['username'];


            header("Location: split.php");
            exit(); // Add exit() to stop further execution
        } else {
            $error_message = "Invalid student number or PIN.";
        }
    } else {
        // Error handling for failed query
        $error_message = "Query execution failed: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 300px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #302f49;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: #ff0000;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="student_number">Student Number:</label>
            <input type="text" id="student_number" name="student_number" required><br>
            <label for="pin">PIN:</label>
            <input type="password" id="pin" name="pin" required><br><br>
            <button type="submit">Login</button>
        </form>
        <br>
        <a href="login-teacher.php">Lecture login</a>
        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>
    </div>
</body>
</html>
