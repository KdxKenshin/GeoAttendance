<?php
session_start();
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_number = $_POST['student_number'];
    $pin = $_POST['pin'];
    
    // Query to select user based on student number and PIN
    $sql = "SELECT * FROM users WHERE student_number = 240001 AND pin = 1234";
    
    // Execute the query
    $result = $conn->query($sql);
    
    // Check if the query executed successfully
    if ($result) {
        // Check if there's a matching user
        if ($result->num_rows == 1) {
            // Fetch user data
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = 1;
            $_SESSION['user_type'] = "student";
            $_SESSION['username'] = "Adolf";
            $_SESSION['student_id'] = 24001;
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
    <title>Login Page</title>
    <style>


        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

    
        * {
            font-family: 'Quicksand', sans-serif;
            font-weight:  300; 
            margin:  0; 
        }
        html, body {
            height:  100vh; 
            width:  100vw;
            margin:  0 0; 
            display:  flex; 
            align-items:  flex-start; 
            justify-content:  flex-start; 
            background:  #f3f2f2; 
        }
        h4 {
            font-size:  24px; 
            font-weight:  600; 
            color:  #000; 
            opacity:  .85; 
        }
        label {
            font-size:  12.5px; 
            color:  #000;
            opacity:  .8;
            font-weight:  400; 
        }
        form {
            padding:  40px 30px; 
            background:  #fefefe; 
            display:  flex; 
            flex-direction:  column;
            align-items:  flex-start; 
            padding-bottom:  20px; 
            width:  300px; 
            h4 {
                margin-bottom:  20px;
                color:  rgba(#000, .5);
                span {
                    color:  rgba(#000, 1);
                    font-weight:  700; 
                }
            }
            p {
                line-height:  155%; 
                margin-bottom:  5px; 
                font-size:  14px; 
                color:  #000; 
                opacity:  .65;
                font-weight:  400; 
                max-width:  200px; 
                margin-bottom:  40px; 
            }
        }
        a.discrete {
            color:  rgba(#000, .4); 
            font-size:  14px; 
            border-bottom:  solid 1px rgba(#000, .0);
            padding-bottom:  4px;  
            margin-left:  auto; 
            font-weight:  300; 
            transition:  all .3s ease; 
            margin-top:  40px; 
            &:hover {
            border-bottom:  solid 1px rgba(#000, .2);
            }
        }
        button {
            
            -webkit-appearance:  none; 
            width:  auto;
            min-width:  100px;
            border-radius:  24px; 
            text-align:  center; 
            padding:  15px 40px;
            margin-top:  5px; 
            background-color:  blue; 
            color:  #fff; 
            font-size:  14px;
            margin-left:  auto; 
            font-weight:  500; 
            box-shadow:  0px 2px 6px -1px rgba(0,0,0,.13); 
            border:  none;
            transition:  all .3s ease; 
            outline: 0; 
            &:hover {
                transform:  translateY(-3px);
                box-shadow:  0 2px 6px -1px rgba(blue, .65);
                &:active {
                    transform:  scale(.99);
                }
            }
        }
        input {
            font-size:  16px; 
            padding:  20px 0px; 
            height:  56px; 
            border:  none; 
            border-bottom:  solid 1px rgba(0,0,0,.1); 
            background:  #fff; 
            width:  280px; 
            box-sizing:  border-box; 
            transition:  all .3s linear; 
            color:  #000; 
            font-weight:  400;
            -webkit-appearance:  none; 
            &:focus {
                border-bottom:  solid 1px blue; 
                outline: 0; 
                box-shadow:  0 2px 6px -8px rgba(blue, .45);
            }
        }
        .floating-label {
            position:  relative; 
            margin-bottom:  10px;
            width:  100%; 
            label {
                position:  absolute; 
                top: calc(50% - 7px);
                left:  0; 
                opacity:  0; 
                transition:  all .3s ease; 
                padding-left:  44px; 
            }
            input {
                width:  calc(100% - 44px); 
                margin-left:  auto;
                display:  flex; 
            }
            .icon {
                position:  absolute; 
                top:  0; 
                left:  0; 
                height:  56px; 
                width:  44px; 
                display:  flex; 
                svg {
                    height:  30px; 
                    width:  30px; 
                    margin:  auto;
                    opacity:  .15; 
                    transition:  all .3s ease; 
                    path {
                        transition:  all .3s ease; 
                    }
                }
            }
            input:not(:placeholder-shown) {
                padding:  28px 0px 12px 0px; 
            }
            input:not(:placeholder-shown) + label {
                transform:  translateY(-10px); 
                opacity:  .7; 
            }
            input:valid:not(:placeholder-shown) + label + .icon {
                svg {
                    opacity:  1; 
                    path {
                        fill:  blue; 
                    }      
                }
            }
            input:not(:valid):not(:focus) + label + .icon {
                animation-name: shake-shake;
                animation-duration: .3s;
            }
        }
        $displacement:  3px; 
        @keyframes shake-shake {
            0% { transform: translateX(-$displacement);}
            20% { transform: translateX($displacement); }
            40% { transform: translateX(-$displacement);}
            60% { transform: translateX($displacement);}  
            80% { transform: translateX(-$displacement);}
            100% { transform: translateX(0px);}
        }
        .session {
            display:  flex; 
            flex-direction:  column; 
            width:  auto; 
            height:  auto; 
            margin:  auto auto; 
            background:  #ffffff; 
            border-radius:  4px; 
            box-shadow:  0px 2px 6px -1px rgba(0,0,0,.12);
        }
        .left {
            width:  100%; 
            height:  200px; 
            min-height:  100%; 
            position:  relative; 
            background-image: url("https://images.pexels.com/photos/114979/pexels-photo-114979.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
            background-size:  cover;
            border-top-left-radius:  4px; 
            border-bottom-left-radius:  0; 
            svg {
                height:  40px; 
                width:  auto; 
                margin:  20px; 
            }
        }

        @media only screen and (min-width: 768px) {
            .session {
                flex-direction:  row;
            }
            .left {
                width:  220px; 
                height:  auto; 
                min-height:  100%; 
                border-bottom-left-radius:  4px; 
                border-bottom-right-radius:  0; 
            }
            form {
                width:  auto;
                padding:  40px;
            }
        }

    </style>
</head>
<body>
    
    <div class="session">
        <div class="left">
            <!-- Your SVG code here -->
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="log-in" autocomplete="off">
            <h4>Learner Login - Manage Dashboard</h4>
            <div class="floating-label">
                <input placeholder="Student Number" type="text" name="student_number" id="student_number" required>
                <label for="student_number">Student Number:</label>
                <!-- Your SVG code here -->
            </div>
            <div class="floating-label">
                <input placeholder="PIN" type="password" name="pin" id="pin" required>
                <label for="pin">PIN:</label>
                <!-- Your SVG code here -->
            </div>
            <button type="submit">Log in</button>
            <p>
        <a href="login-teacher.php" class="discrete">Login as Teacher</a>

        <?php
if (isset($error_message)) {
    echo "<script>alert('$error_message');</script>";
}
?>

    </p>
        </form>
        
    </div>

    

    
</body>
</html>
