<?php 

   include('../config/constants.php');
   include('login-check.php');     // Authorization - Access Control   check whether the user is logged in or not
?>

<html>
  <head>
     <title> Food Order Website - Home Page</title>

     <link rel="stylesheet" href="../css/style2.css">
  </head>

  <body>
    <!-- Menu Section Starts -->
    <div class="menu text-center">
        <div class="wrapper">
        <ul>
           <li><a href="index.php">Home</a></li>
           <li><a href="manage-admin.php">Admin</a></li>
           <li><a href="manage-category.php">Category</a></li>
           <li><a href="manage-food.php">Food</a></li>
           <li><a href="manage-order.php">Order</a></li>
           <li><a href="login.php">Logout</a></li>

        <ul>  
        </div>
    </div>
    <!-- Menu Section Ends -->