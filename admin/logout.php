<?php include('../config/constants.php'); ?>


<?php
 // 1. Destroy the Session
 session.destroy();   // unsets $_SESSSION['user']

 //2. Redirect to login page
 header('location:'.SITEURL.'admin/login.php');

 //3.
?>