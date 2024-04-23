<?php 
include("nav.php");

if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Attendance</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->

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
            margin: 0 auto;
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
        

<?php


// Check if module and user coordinates are set
if(isset($_GET['module']) && isset($_GET['userLat']) && isset($_GET['userLon'])) {
    // Get module and user coordinates
    $module = $_GET['module'];
    $userLat = $_GET['userLat'];
    $userLon = $_GET['userLon'];

    // Define coordinates for each module
    $moduleCoordinates = [
        "MCI" => ["latitude" => -22.565613243599294, "longitude" =>17.07476833241302],
        "DBF" => ["latitude" => -22.565447293823517, "longitude" =>17.077045527817557],
        "ICG" => ["latitude" => -22.5654101408606, "longitude" =>17.076750484858188],
        "BMC" => ["latitude" => -22.565058425636845, "longitude" =>17.075146523871656],
        "DST" => ["latitude" => -22.565058425636845, "longitude" =>17.075146523871656]
        // Add coordinates for other modules here
    ];

    // Define lecture start and end times
    $lectureTimes = [
        "MCI" => ["start" => "09:00:00", "end" => "10:00:00"],
        "DBF" => ["start" => "11:00:00", "end" => "12:00:00"],
        "ICG" => ["start" => "13:00:00", "end" => "14:00:00"],
        "BMC" => ["start" => "15:00:00", "end" => "16:00:00"],
        "DST" => ["start" => "17:00:00", "end" => "18:00:00"]
        // Add lecture times for other modules here
    ];

    // Check if the module exists
    if(array_key_exists($module, $moduleCoordinates)) {
        // Get module coordinates
        $moduleLatitude = $moduleCoordinates[$module]['latitude'];
        $moduleLongitude = $moduleCoordinates[$module]['longitude'];

        // Calculate distance between user and module
        $distance = calculateDistance($userLat, $userLon, $moduleLatitude, $moduleLongitude);

        // Get current time
        $currentTime = date('H:i:s');

        // Check if user is within range (200 meters) and if lecture time is ongoing
        if ($distance <= 200 && $currentTime >= $lectureTimes[$module]['start'] && $currentTime <= $lectureTimes[$module]['end']) {
            echo "<h3 class='success'>Successfully Attended " . $module . "</h3>";
        } else {
            // Check if user came before or after the lecture time
            if ($currentTime < $lectureTimes[$module]['start']) {
                echo "<h3 class='fail'>Not Attended " . $module . ". Lecture has not yet started.</h3>";
            } elseif ($currentTime > $lectureTimes[$module]['end']) {
                echo "<h3 class='fail'>Not Attended " . $module . ". Lecture is already over.</h3>";
            } else {
                echo "<h3 class='fail'>Not Attended " . $module . ". You are out of range. By a distance of: <p class='distance'>" . round($distance, 0) .' metres</p> </h3>';
            }
        }

    } else {
        echo "Module not found.";
    }
} else {
    
}

// Function to calculate distance between two coordinates
function calculateDistance($userLat, $userLon, $moduleLat, $moduleLon) {
    // Haversine formula to calculate distance
    $earthRadius = 6371e3; // Earth radius in meters
    $latRad1 = deg2rad($userLat);
    $latRad2 = deg2rad($moduleLat);
    $lonRad1 = deg2rad($userLon);
    $lonRad2 = deg2rad($moduleLon);
    $deltaLat = $latRad2 - $latRad1;
    $deltaLon = $lonRad2 - $lonRad1;
    $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($latRad1) * cos($latRad2) * sin($deltaLon / 2) * sin($deltaLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earthRadius * $c;
    return $distance;
}
?>
 
 <!-- All Modules Section -->
        <div class="section">
            <h2>All Modules</h2>
            <div class="module-buttons">
                <button class="attend" onclick="checkAttendance('MCI')">MCI</button>
                <button class="attend" onclick="checkAttendance('ICG')">ICG</button>
                <button class="attend" onclick="checkAttendance('DBF')">DBF</button>
                <button class="attend" onclick="checkAttendance('DST')">DST</button>
                <button class="attend" onclick="checkAttendance('BMC')">BMC</button>
                
                <!-- Add more buttons for additional modules -->
            </div>
        </div>

        <!-- Upcoming Lectures Section -->

        <a href="split.php" class="back-button"><i class="fas fa-arrow-left"></i></a>

    <script>
        function checkAttendance(module) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const userLatitude = position.coords.latitude;
                    const userLongitude = position.coords.longitude;

                    // Send user's coordinates to PHP script
                    window.location.href = 'attend.php?module=' + module + '&userLat=' + userLatitude + '&userLon=' + userLongitude;
                });
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }
    </script>



</body>
</html>
