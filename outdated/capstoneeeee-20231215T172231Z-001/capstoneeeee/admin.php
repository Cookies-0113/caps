<?php
// Initialize variables with default values
$dayOfWeek = $startTime = $endTime = $subjectID = $facultyID = $roomID = $sectionID = "";

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capstone_db"; // Change to your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert timetable data into the Timetable table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dayOfWeek = $_POST["dayOfWeek"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    $subjectID = $_POST["subjectID"];
    $facultyID = $_POST["facultyID"];
    $roomID = $_POST["roomID"];
    $sectionID = $_POST["sectionID"];

    $sql = "INSERT INTO Timetable (DayID, StartTime, EndTime, SectionID, SubjectID, FacultyID, RoomID) 
        VALUES ((SELECT DayID FROM Days WHERE DayName = '$dayOfWeek'), '$startTime', '$endTime', '$sectionID',
                (SELECT SubjectID FROM Subjects WHERE SubjectName = '$subjectID'), 
                (SELECT FacultyID FROM Faculty WHERE FacultyName = '$facultyID'), 
                (SELECT RoomID FROM Rooms WHERE RoomNumber = '$roomID'))";

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch timetable data from the database
$sqlTimetable = "SELECT Timetable.TimetableID, Days.DayName, Timetable.StartTime, Timetable.EndTime, Sections.SectionName, 
                Subjects.SubjectName, Faculty.FacultyName, Rooms.RoomNumber 
                FROM Timetable
                JOIN Days ON Timetable.DayID = Days.DayID
                JOIN Sections ON Timetable.SectionID = Sections.SectionID
                JOIN Subjects ON Timetable.SubjectID = Subjects.SubjectID
                JOIN Faculty ON Timetable.FacultyID = Faculty.FacultyID
                JOIN Rooms ON Timetable.RoomID = Rooms.RoomID";

$resultTimetable = $conn->query($sqlTimetable);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="wrapper">
    <div class="menu-btn">
        <i class="fa-solid fa-bars"></i>
    </div>

    <div class="side-bar">
        <header>
            <div class="close-btn">
                <i class="bx bx-window-close"></i>
            </div>

            <a href="admin.html">
            <img src="img/cvsu.png" align="">
            <h1>Class Time Table</h1></a>
        </header>

        <div class="menu">
            <div class="item"><a class="sub-btn"><i class="bx bxs-building"></i>Classes
            <i class="bx bx-chevron-right"></i>
            </a>
            <div class="sub-menu">
                <a href="" class="sub-item">class 1</a>
                <a href="" class="sub-item">Class 2</a>
                <a href="" class="sub-item">Class 3</a>
            </div>
            </div>

            <div class="item"><a href="admin-faculty.html"><i class="bx bxs-user"></i>Faculty</a></div>
            <div class="item"><a href=""><i class="bx bxs-user"></i>Student</a></div>
            <div class="item"><a href="register.html"><i class="bx bx-user-plus"></i>Register</a></div>
            <div class="item"><a class="sub-btn"><i class="bx bxs-building"></i>Buildings
            <i class="bx bx-chevron-right"></i>
            </a>
            <div class="sub-menu">
                <a href="" class="sub-item">Building 1</a>
                <a href="" class="sub-item">Building 2</a>
                <a href="" class="sub-item">Building 3</a>
            </div>
            </div>
            <div class="item"><a href="index1.html"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></div>
        </div>
    </div>

    
    <div class="main_content">
        <div class="header">
            <ul>
           <li> <a href=""><h5>Admin</h5><img src="img/admin.svg"></a>
            <div class="logout">
              <ul class="dropdown">
                  <li> <a href="changepass.html">Change Password</a></li>
                  
                </ul>
               <ul>
                  <li class="new"> <a href="index.html">Logout</a></li>
                  
                </ul>
                  </div>
            </li>
        </ul>
        </div>  
        <div class="info">
          <div>
            <h1>Time Table</h1><br>

    <!-- Timetable data form -->
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">        

        <label for="dayOfWeek">Day:</label>
        <select name="dayOfWeek" required>
            <option value="MONDAY">MONDAY</option>
            <option value="TUESDAY">TUESDAY</option>
            <option value="WEDNESDAY">WEDNESDAY</option>
            <option value="THURSDAY">THURSDAY</option>
            <option value="FRIDAY">FRIDAY</option>
            <option value="SATURDAY">SATURDAY</option>
        </select>

        <label for="startTime">Start Time:</label>
        <input type="time" name="startTime" required>

        <label for="endTime">End Time:</label>
        <input type="time" name="endTime" required>

        <label for="subjectID">Subject:</label>
        <select name="subjectID" required>
            <option value="Capstone Project and Research">Capstone Project and Research</option>
            <option value="Social and Professional Issues">Social and Professional Issues</option>
            <option value="System Administration and Maintenance">System Administration and Maintenance</option>
            <option value="System Integration and Architecture">System Integration and Architecture</option>
            <option value="Integrated Programming and Technologies">Integrated Programming and Technologies</option>
        </select>

        <label for="facultyID">Faculty:</label>
        <select name="facultyID" required>
            <option value="Mr. Carlo Malabanan">Mr. Carlo Malabanan</option>
            <option value="Ms. Shaina Marie Modesto">Ms. Shaina Marie Modesto</option>
            <option value="Mr. John Vincent Dallego">Mr. John Vincent Dallego</option>
            <option value="Mr. Mark Anthony Cezar">Mr. Mark Anthony Cezar</option>
        </select>

        <label for="roomID">Room:</label>
        <select name="roomID" required>
            <option value="CL1">CL1</option>
            <option value="CL2">CL2</option>
            <option value="CL3">CL3</option>
            <option value="CL4">CL4</option>
        </select>

        <label for="sectionID">Section:</label>
        <select name="sectionID" required>
            <option value="1">BSIT 4A</option>
            <option value="2">BSIT 4B</option>
            <option value="3">BSIT 4C</option>
            <option value="4">BSIT 4D</option>
        </select>

        <input type="submit" value="Add to Timetable">
    </form>

     <!-- Display timetable data -->
    <?php
    if ($resultTimetable->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Day</th><th>Start Time</th><th>End Time</th><th>Section</th><th>Subject</th><th>Faculty</th><th>Room</th></tr>";
        while ($row = $resultTimetable->fetch_assoc()) {
            echo "<tr><td>" . $row["DayName"] . "</td><td>" . $row["StartTime"] . "</td><td>" . $row["EndTime"] . "</td><td>" . $row["SectionName"] . "</td><td>" . $row["SubjectName"] . "</td><td>" . $row["FacultyName"] . "</td><td>" . $row["RoomNumber"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No timetable data available.";
    }
    ?>

          </div>
      </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            //for closing menu
            $('.menu-btn').click(function(){
                $('.side-bar').addClass('active');
                $('.menu-btn').css("visibility","hidden");
            }); 
            //for opening menu
            $('.close-btn').click(function(){
                $('.side-bar').removeClass('active');
                $('.menu-btn').css("visibility","visible");
            }); 

            //for other menu
            $('.sub-btn').click(function(){
                $(this).next('.sub-menu').slideToggle();
                $(this).find('.bx-chevron-right').toggleClass('rotate');
            });


        })
    </script>

</body>
</html>

