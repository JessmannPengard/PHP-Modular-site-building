<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Check for session to allow access
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../modules/user/user.login.php');
    exit();
}
?>