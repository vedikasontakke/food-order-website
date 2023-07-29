<?php

     // Include constants.php file here 
     include("../config/constants.php");

    // 1. get id of admin to be deleted 
    $id = $_GET['id'];

    // 2. create SQL Query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn , $sql);

    // check whether the query executed successfully or not 
    if($res==true)
    {
        // query executed successfully and admin deleted 

        // create session variable to display msg
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

        // redirect ot manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }else
    {
        // fail to delete admin 

          // create session variable to display msg
          $_SESSION['delete'] = "<div class='error'>Failed to delete Admin . Try Again Later .</div>";

          // redirect ot manage admin page
          header('location:'.SITEURL.'admin/manage-admin.php');
    }

   // 3. Redirect to manage Admin Page with msg (Sucess/Fail)
 
?>