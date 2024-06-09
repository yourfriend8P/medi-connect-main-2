<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard - Hospital Management System</title>
    <link rel="stylesheet" type="text/css" href="/medi-connect-main-2/css/doctor_dashboard_styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-container">
                <img src="/medi-connect-main-2/main-logo.png" alt="MediConnect Logo" class="logo">
                <div class="header-text">
                    <h1>MediConnect</h1>
                    <h2>Doctor Panel</h2>
                </div>
                <a href="logout.php" class="logout-button">Logout</a>
            </div>
        </header>
        <div class="main-content">
            <?php
            session_start();
            
            if (!isset($_SESSION['doctor_username'])) {
                header("Location: doctor.php"); // Redirect to login page if not logged in
                exit();
            }

            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hospital_management";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch doctor information
            $user = $_SESSION['doctor_username'];
            $sql = "SELECT * FROM doctors WHERE username = '$user'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<section id='profile'>";
                echo "<h2>Profile</h2>";
                if (!empty($row['profile_picture'])) {
                    echo "<img src='" . $row['profile_picture'] . "' alt='Profile Picture' class='profile-picture'>";
                } else {
                    echo "<img src='default_profile.png' alt='Default Profile Picture' class='profile-picture'>";
                }
                echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                echo "<p><strong>Gender:</strong> " . $row['gender'] . "</p>";
                echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
                echo "<p><strong>Specialty:</strong> " . $row['specialty'] . "</p>";
                echo "</section>";
            } else {
                echo "<section id='profile'>";
                echo "<h2>Profile</h2>";
                echo "<p>No doctor information found.</p>";
                echo "</section>";
            }

            // Fetch appointments
            echo "<section id='appointments'>";
            echo "<h2>Appointments</h2>";

            $appointmentSql = "SELECT a.id, a.date, a.day_of_week, a.problem, a.status, a.doctor_comment, a.report, p.username AS patient_username, p.first_name, p.last_name
                              FROM appointments a
                              JOIN patients p ON a.user_username = p.username
                              WHERE a.doctor_id = (SELECT id FROM doctors WHERE username = '$user')
                              ORDER BY a.date";
            $appointmentResult = $conn->query($appointmentSql);

            if ($appointmentResult->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Patient</th><th>Date</th><th>Day</th><th>Problem</th><th>Status</th><th>Action</th></tr>";
                while ($appointmentRow = $appointmentResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $appointmentRow['first_name'] . " " . $appointmentRow['last_name'] . "</td>";
                    echo "<td>" . $appointmentRow['date'] . "</td>";
                    echo "<td>" . $appointmentRow['day_of_week'] . "</td>";
                    echo "<td>" . $appointmentRow['problem'] . "</td>";
                    echo "<td>" . $appointmentRow['status'] . "</td>";
                    echo "<td>";
                    if ($appointmentRow['status'] == 'Pending') {
                        echo "<form action='verify_appointment.php' method='post' class='action-form'>";
                        echo "<input type='hidden' name='appointment_id' value='" . $appointmentRow['id'] . "'>";
                        echo "<button type='submit' name='action' value='accept' class='accept-button'>Accept</button>";
                        echo "<button type='submit' name='action' value='reject' class='reject-button'>Reject</button>";
                        echo "<input type='text' name='doctor_comment' placeholder='Leave a comment' class='comment-box' required>";
                        echo "</form>";
                    } else {
                        echo "<form action='add_report.php' method='post' class='action-form'>";
                        echo "<input type='hidden' name='appointment_id' value='" . $appointmentRow['id'] . "'>";
                        echo "<textarea name='report' placeholder='Add report' class='report-box' required></textarea>";
                        echo "<button type='submit' class='report-button'>Submit Report</button>";
                        echo "</form>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No appointments found.</p>";
            }

            echo "</section>";

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
