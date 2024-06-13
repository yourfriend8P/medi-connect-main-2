<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--======== CSS ======== -->
    <link rel="stylesheet" href="/medi-connect-main-2/css/admin/admin_dashboard_styles.css" />

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
                            <span class="text nav-text">Doctor's List</span>
                        </a>
                    </li>

                    <li class="nav-link" data-tab="appointment">
                        <a href="#">
                            <i class="bx bx-bar-chart-alt-2 icon"></i>
                            <span class="text nav-text">Add Doctor</span>
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
                    <a href="\medi-connect-main-2\admin\logout.php">
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
                <section id="add-doctor">
                    <h2>Add Doctor</h2>
                    <form action="add_doctor.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="username" placeholder="Username" class="input-box" required>
                        <input type="password" name="password" placeholder="Password" class="input-box" required>
                        <input type="text" name="name" placeholder="Name" class="input-box" required>
                        <select name="gender" class="input-box" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        <input type="email" name="email" placeholder="Email" class="input-box" required>
                        <input type="text" name="phone" placeholder="Phone" class="input-box" required>
                        <label for="select">Department:</label>
                        <select id="select" name="specialty" placeholder="Specialty" class="input-box" required>
                            <option value="">Select department</option>
                            <?php
                            include('C:\xampp\htdocs\medi-connect-main-2\db_connect.php');
                            $depts = mysqli_query($conn, "SELECT * FROM dept");
                            while ($d = mysqli_fetch_array($depts)) {
                                echo "<option value='" . $d['depart'] . "'>" . $d['depart'] . "</option>";
                            }
                            mysqli_close($conn);
                            ?>
                        </select>
                        <label for="profile_picture" class="upload-label">Upload Profile Picture</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="input-box">
                        <button type="submit" class="add-button">Add Doctor</button>
                    </form>
                </section>
            </div>
        </div>

        <div class="tab-content" id="appointment">
            <div class="text">
                <h2>Doctor List</h2>
                <section id="doctor-list">
                    <?php
                    include('C:\xampp\htdocs\medi-connect-main-2\db_connect.php');

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch doctor information
                    $sql = "SELECT * FROM doctors ORDER BY specialty, name";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $currentSpecialty = "";
                        while ($row = $result->fetch_assoc()) {
                            if ($row['specialty'] !== $currentSpecialty) {
                                if ($currentSpecialty !== "") {
                                    echo "</div>";
                                }
                                $currentSpecialty = $row['specialty'];
                                echo "<h3>" . $currentSpecialty . "</h3>";
                                echo "<div class='doctor-list'>";
                            }
                            echo "<div class='doctor-card'>";
                            if (!empty($row['profile_picture'])) {
                                echo "<img src='" . $row['profile_picture'] . "' alt='Profile Picture' class='doctor-picture'>";
                            } else {
                                echo "<img src='default_profile.png' alt='Default Profile Picture' class='doctor-picture'>";
                            }
                            echo "<div class='doctor-info'>";
                            echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                            echo "<p><strong>Specialty:</strong> " . $row['specialty'] . "</p>";
                            echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
                            echo "<p><strong>Status:</strong> " . ($row['status'] ? "Active" : "Disabled") . "</p>";
                            echo "</div>";
                            $action = $row['status'] ? "Disable" : "Enable";
                            $button_class = $row['status'] ? "disable-button" : "enable-button";
                            echo "<form action='doctor_status.php' method='post' class='remove-form'>";
                            echo "<input type='hidden' name='doctor_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' class='$button_class'>" . $action . "</button>";
                            echo "</form>";
                            echo "</div>";
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No doctors found.</p>";
                    }

                    $conn->close();
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

    <script src="script.js"></script>
</body>
</html>
