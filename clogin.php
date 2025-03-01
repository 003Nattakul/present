<?php
session_start();
// Fix: Added proper session validation
if(isset($_SESSION['u_id']) && !empty($_SESSION['u_id']) && isset($_SESSION['u_name']) && !empty($_SESSION['u_name'])){
    // User is logged in, continue
} else{
    // Redirect to login page with a message parameter
    header('Location: login1.php?error=session_expired');
    exit(); // Added exit to prevent further code execution
}
?>