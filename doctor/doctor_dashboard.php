<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--======== CSS ======== -->
    <link rel="stylesheet" href="/medi-connect-main-2/css/doctor/doctor_dashboard_style.css" />

    <!--===== Boxicons CSS (import icons)===== -->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />

    <title>Dashboard Sidebar Menu</title>

    <style>
        .enable-button {
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
        }

        .enable-button:hover {
            background-color: #28a745;
        }

        .disable-button {
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
        }

        .disable-button:hover {
            background-color: #ff3333;
        }
    </style>
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="/medi-connect-main-2/main-logo.png" alt="" />
                </span>

                <div class="text logo-text">
                    <span class="name">Mediconnect</span>
                    <span class="profession">Admin Dashboard</span>
                </div>
            </div>

            <i class="bx bx-chevron-right toggle"></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link active" data-tab="dashboard">
                        <a href="#">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>

                    <li class="nav-link" data-tab="appointment">
                        <a href="#">
                            <i class="bx bx-bar-chart-alt-2 icon"></i>
                            <span class="text nav-text">Appointment</span>
                        </a>
                    </li>

                    <li class="nav-link" data-tab="medical-records">
                        <a href="#">
                            <i class="bx bx-pie-chart-alt icon"></i>
                            <span class="text nav-text">???</span>
                        </a>
                    </li>

                    <li class="nav-link" data-tab="doctor-prescriptions">
                        <a href="#">
                            <i class="bx bx-heart icon"></i>
                            <span class="text nav-text">???</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="\medi-connect-main-2\doctor\logout.php">
                        <i class="bx bx-log-out icon"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>

    <section class="home">
        <div class="tab-content active" id="dashboard">
            <div class="text">
                <div class="doctor-profile">
                    <h2>Profile</h2>
                    <?php
            session_start();

            if (!isset($_SESSION['doctor_username'])) {
                header("Location: doctor.php"); // Redirect to login page if not logged in
                exit();
            }

            // Connect to the database
            include('C:\xampp\htdocs\medi-connect-main-2\db_connect.php');

            // Fetch doctor information
            $user = $_SESSION['doctor_username'];
            $sql = "SELECT * FROM doctors WHERE username = '$user'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<section id='profile'>";
                if (!empty($row['profile_picture'])) {
                    echo "<img class = 'pfp' src='/medi-connect-main-2/pfp/pfp.png'>";
                } else {
                    echo "<img class = 'pfp' src='/medi-connect-main-2/pfp/pfp.png'>";
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
            ?>
                </div>
            </div>
        </div>

        <div class="tab-content" id="appointment">
            <div class="text">
                <h2>Appointments</h2><br>
                <section id="doctor-list">
                   <?php
                   echo "<section id='appointments'>";

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

                   ?>
                </section>
            </div>
        </div>

        <div class="tab-content" id="medical-records">
            <div class="text">Medical Records Content</div>
        </div>

        <div class="tab-content" id="doctor-prescriptions">
            <div class="text">Doctor Prescriptions Content</div>
        </div>
    </section>

    <script src="/medi-connect-main-2/js/script.js"></script>
</body>
</html>
