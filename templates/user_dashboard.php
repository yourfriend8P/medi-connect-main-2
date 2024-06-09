<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--======== CSS ======== -->
    <link rel="stylesheet" href="/medi-connect-main-2/css/user/dashboard_style.css" />

    <!--===== Boxicons CSS (import icons)===== -->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />

    <title>Dashboard Sidebar Menu</title>
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
                    <span class="profession">User Dashboard</span>
                </div>
            </div>

            <i class="bx bx-chevron-right toggle"></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <!-- <li class="search-box">
                    <i class="bx bx-search icon"></i>
                    <input type="text" placeholder="Search..." />
                </li> -->

                <ul class="menu-links">
                    <li class="nav-link active" data-tab="dashboard">
                        <a href="#">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Dashboard</span>
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
                            <span class="text nav-text">Book Appointment</span>
                        </a>
                    </li>

                    <li class="nav-link" data-tab="doctor-prescriptions">
                        <a href="#">
                            <i class="bx bx-heart icon"></i>
                            <span class="text nav-text">Doctor Prescriptions</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class="bx bx-log-out icon"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <!-- <li class="mode">
                    <div class="sun-moon">
                        <i class="bx bx-moon icon moon"></i>
                        <i class="bx bx-sun icon sun"></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li> -->
            </div>
        </div>
    </nav>

    <section class="home">
        <div class="tab-content active" id="dashboard">
            <div class="text">
           <div class = "user-profile">
            <?php
                session_start();

                if (!isset($_SESSION['username'])) {
                    header("Location: user.php"); // Redirect to login page if not logged in
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

                // Fetch user information
                $user = $_SESSION['username'];
                $sql = "SELECT * FROM patients WHERE username = '$user'";
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
                    echo "<p><strong>Full Name:</strong> " . $row['first_name'] . " " . $row['last_name'] . "</p>";
                    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                    echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
                    echo "<p><strong>Blood Type:</strong> " . $row['blood_type'] . "</p>";
                    echo "<p><strong>Medical Problems:</strong> " . $row['medical_problem'] . "</p>";
                    echo "</section>";
                } else {
                    echo "<section id='profile'>";
                    echo "<h2>Profile</h2>";
                    echo "<p>No user information found.</p>";
                    echo "</section>";
                }
                ?>
                </div>
                </div>
                </div>
        </div>

        <div class="tab-content" id="appointment">
            <div class="text">Your Appointment
            <div class="appointment-table">
                        <?php
                        // Fetch and display appointments
                            $appointmentSql = "SELECT a.id, a.date, a.day_of_week, a.problem, a.status, a.doctor_comment, a.report, d.name AS doctor_name, d.specialty
                                            FROM appointments a
                                            JOIN doctors d ON a.doctor_id = d.id
                                            WHERE a.user_username = '$user'
                                            ORDER BY a.date";
                            $appointmentResult = $conn->query($appointmentSql);

                            if ($appointmentResult->num_rows > 0) {
                                echo "<table>";
                                echo "<tr><th>Doctor</th><th>Specialty</th><th>Date</th><th>Day</th><th>Problem</th><th>Status</th><th>Doctor Comment</th><th>Report</th></tr>";
                                while ($appointmentRow = $appointmentResult->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $appointmentRow['doctor_name'] . "</td>";
                                    echo "<td>" . $appointmentRow['specialty'] . "</td>";
                                    echo "<td>" . $appointmentRow['date'] . "</td>";
                                    echo "<td>" . $appointmentRow['day_of_week'] . "</td>";
                                    echo "<td>" . $appointmentRow['problem'] . "</td>";
                                    if ($appointmentRow['status'] == 'Accepted') {
                                        echo "<td style='color: green;'>" . $appointmentRow['status'] . "</td>";
                                    } elseif ($appointmentRow['status'] == 'Rejected') {
                                        echo "<td style='color: red;'>" . $appointmentRow['status'] . "</td>";
                                    } else {
                                        echo "<td>" . $appointmentRow['status'] . "</td>";
                                    }
                                    echo "<td>" . $appointmentRow['doctor_comment'] . "</td>";
                                    echo "<td>" . $appointmentRow['report'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "<p>You have no appointments.</p>";
                            }
                            ?>
                
        </div>
        </div>

        <div class="tab-content" id="medical-records">
            <div class="text">Book Appointment</div>
            <div class="book-appointment-content">
                        <?php
                        echo "<section id='appointments'>";
                            echo "<h2>Appointments</h2>";

                            // Appointment booking form
                            echo "<h3>Book an Appointment</h3>";
                            echo "<form action='book_appointment.php' method='post'>";
                            echo "<label for='doctor'>Select Doctor:</label>";
                            echo "<select name='doctor_id' required>";
                            
                            // Fetch doctors
                            $doctorSql = "SELECT id, name, specialty FROM doctors";
                            $doctorResult = $conn->query($doctorSql);
                            
                            if ($doctorResult->num_rows > 0) {
                                while ($doctorRow = $doctorResult->fetch_assoc()) {
                                    echo "<option value='" . $doctorRow['id'] . "'>" . $doctorRow['name'] . " (" . $doctorRow['specialty'] . ")</option>";
                                }
                            } else {
                                echo "<option value=''>No doctors available</option>";
                            }
                            
                            echo "</select>";
                            echo "<label for='date'>Select Date:</label>";
                            echo "<input type='date' name='date' required>";
                            echo "<label for='day_of_week'>Day of the Week:</label>";
                            echo "<select name='day_of_week' required>";
                            echo "<option value='Monday'>Monday</option>";
                            echo "<option value='Tuesday'>Tuesday</option>";
                            echo "<option value='Wednesday'>Wednesday</option>";
                            echo "<option value='Thursday'>Thursday</option>";
                            echo "<option value='Friday'>Friday</option>";
                            echo "<option value='Saturday'>Saturday</option>";
                            echo "<option value='Sunday'>Sunday</option>";
                            echo "</select>";
                            echo "<label for='problem'>Describe your problem:</label>";
                            echo "<textarea name='problem' rows='4' required></textarea>";
                            echo "<p><strong>Note:</strong> Payment will be made during the appointment.</p>";
                            echo "<button type='submit'>Book Appointment</button>";
                            echo "</form>";
                        ?>
            </div>
        </div>

        <div class="tab-content" id="doctor-prescriptions">
            <div class="text">Doctor Prescriptions Content</div>
        </div>

    </section>

    <script src="/medi-connect-main-2/js/script.js"></script>
</body>
</html>
