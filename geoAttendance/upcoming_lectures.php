<html>

<head>
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
        
    </style>
</head>

<div class="section">
            <h2>Upcoming Lectures</h2>
            <?php
            // Define module information including start time
            $moduleInfo = [
                "MCI" => ["start_time" => "15:00:00", "end_time" => "16:00:00", "time" => "3:00 PM - 4:00 PM", "venue" => "AUD S"],
                "DBF" => ["start_time" => "07:30:00", "end_time" => "09:30:00",  "time" => "7:30 AM - 9:30 AM", "venue" => "FCI Lab 4"],
                "ICG" => ["start_time" => "10:30:00", "end_time" => "12:30:00",  "time" => "10:30 AM - 12:30 AM", "venue" => "FCI Lab 3"],
                "BMC" => ["start_time" => "23:00:00", "end_time" => "10:40:00",  "time" => "10:00 PM - 5:00 PM", "venue" => "AUD 1"],
                "DST" => ["start_time" => "8:30:00", "end_time" => "09:30:00",  "time" => "8:30 AM - 9:30 AM", "venue" => "AUD 1"],
                // Add module times and venues for other modules here
            ];

            // Get the current time
            $currentTime = strtotime(date('H:i:s'));

            // Find the next upcoming lecture
            $nextLecture = null;
            $nextLectureTime = PHP_INT_MAX;
            foreach($moduleInfo as $module => $info) {
                $startTime = strtotime($info['start_time']);
                if ($startTime > $currentTime && $startTime < $nextLectureTime) {
                    $nextLecture = $module;
                    $nextLectureTime = $startTime;
                }
            }
            $endTime = strtotime($moduleInfo[$nextLecture]['end_time']);
            
            if ($currentTime >= $nextLectureTime && $currentTime <= $endTime) {
                    $endHoursLeft = floor(($endTime - $currentTime) / 3600);
                    $endMinutesLeft = floor((($endTime - $currentTime) % 3600) / 60);
                    echo "<p>Current lecture ends at <strong>" . date('h:i A', $endTime) . "</strong></p>";
                    echo "<p>Time left until lecture ends: <strong>" . $endHoursLeft . " hours and " . $endMinutesLeft . " minutes</strong></p>";
                }

            // Display the next upcoming lecture and time left
            if ($nextLecture) {

                
                $timeLeftSeconds = $nextLectureTime - $currentTime;
                $hoursLeft = floor($timeLeftSeconds / 3600);
                $minutesLeft = floor(($timeLeftSeconds % 3600) / 60);
                echo "<p><strong>" . $nextLecture . "</strong> at <strong>" . $moduleInfo[$nextLecture]['time'] . "</strong> in <strong>" . $moduleInfo[$nextLecture]['venue'] . "</strong></p>";
                echo "<p>Time left until lesson starts: <strong>" . $hoursLeft . " hours and " . $minutesLeft . " minutes</strong></p>";
            } else {
                echo "<p>No upcoming lectures found.</p>";
            }
            ?>
        </div>
    </div>
</html>