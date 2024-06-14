<?php
session_start();
session_unset();
session_destroy();
header("Location: /medi-connect-main-2/doctor/doctor.php");
exit();
?>
