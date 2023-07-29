<?php
  
  // Authorization - Access Control
  // check whether the user is logged in or not

  if(!isset($_SESSION['user']))   // if user session is not 
  {
     // user is not logged in
     // redirect to login page with message
     
     $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";

     //redirect ot login page
     header('location:'.SITEURL.'admin/login.php');
  }

?>