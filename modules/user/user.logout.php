<?php
// Script for closing session

// Init session
session_start();
// Unset session
session_unset();
// Destroy session
session_destroy();

// Redirect to Login
header("Location: user.login.php");
