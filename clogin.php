<?php
session_start();
if(isset($_SESSION['u_id']) && !empty($_SESSION['u_name'])){
} else{
    header('Location:login1.php');
}
?>