<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Hospital Management System</title>
    <link rel="stylesheet" type="text/css" href="/medi-connect-main-2/css/admin/admin_dashboard_styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-container">
                <img src="/medi-connect-main-2/main-logo.png" alt="MediConnect Logo" class="logo">
                <div class="header-text">
                    <p class = "mediconnect">MediConnect |<p>
                    <p class="subtitle">&nbsp Admin Panel</p>
                </div>
                <div class = "empty-cointainer"><!-- empty container --></div>
                <a href="logout.php" class="logout-button">Logout</a>
            </div>
        </header>
        <div class="main-content">
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
<!-- changes here changes here changes here changes here changes here changes here changes here-->
                    <label for="select">Department:</label>
                        <select id="select" name="specialty" placeholder="Specialty" class="input-box" required>
                            <option value="">Select department</option>
                            <?php
                            include('C:\xampp\htdocs\medi-connect-main-2\db_connect.php');
                            $depts=mysqli_query($conn,"SELECT * from dept");
                            while($d=mysqli_fetch_array($depts)){
                                ?>
                            <option value="<?php echo $d['depart'] ?>"><?php echo $d['depart']?></option>
                            <?php }
                            mysqli_close($conn);?>
                        
                   
                        </select>

                    <!-- <input type="text" name="specialty" placeholder="Specialty" class="input-box" required> -->
                    <label for="profile_picture" class="upload-label">Upload Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="input-box">
                    <button type="submit" class="add-button">Add Doctor</button>
                </form>
            </section>
            <section id="doctor-list">
                <h2>Doctor List</h2>
                <?php
                // Connect to the database
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
                        echo "</div>";
                        echo "<form action='remove_doctor.php' method='post' class='remove-form'>";
                        echo "<input type='hidden' name='doctor_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='remove-button'>Remove</button>";
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
</body>
</html>