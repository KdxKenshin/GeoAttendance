<?php
include("db_conn.php");

// Fetch all attendance records
$query = "SELECT attendance.id, students.username AS student_name, attendance.module, attendance.attendance_time
          FROM attendance
          INNER JOIN students ON attendance.student_id = students.id
          ORDER BY attendance.attendance_time DESC"; // Change the sorting order as needed

$result = mysqli_query($conn, $query);

// Display all attendance records
echo "<h2>Attendance Records</h2>";
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Student Name</th><th>Module</th><th>Attendance Time</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['student_name']."</td>";
        echo "<td>".$row['module']."</td>";
        echo "<td>".$row['attendance_time']."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No attendance records found.";
}
?>

<html>
<head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

    body {
        font-family: 'Quicksand', sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('background-1.png');
        background-repeat: no-repeat;
        text-align: center;
    }

    form {
        max-width: 500px;
        margin: 0 auto;
        padding: 50px;
    }

    button {
        background-color: #302f49;
        padding: 10px;
        color: white;
        border-radius: 4px;
        border: none;
    }

    table {
        margin: 0 auto;
    }
</style>
</head>
<body>

<form action="" method="GET">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search">
    <button type="submit">Search</button>
</form>

</body>
</html>
