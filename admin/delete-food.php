<?php
  
  // include constants file 
  include('../config/constants.php');

  // check wheather the id and image_name value is set or not
  if(isset($_GET['id']) && isset($_GET['image_name']))
  {
     // get the value and delete
     $id = $_GET['id'];
     $image_name = $_GET['image_name'];

    // echo "Image Name: " . $image_name;

     // remove the physical image file is availabe
     if($image_name != "")
     {
        // image is availabe. So remove it
        $path = "../images/food/".$image_name;

        // remove the image
        $remove = unlink($path);

        //if failed to remove image then add an error message and stop the process
        if($remove==false)
        {
            // set the session message
            $_SESSION['remove'] = "<div class='error'>Failed to remove food Image. </div>";

            // redirect to manage category page
            header('location:'.SITEURL.'admin/manage-food.php');

            // stop the process
            die();
        }

        // delete data from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        // excecute the query
        $res = mysqli_query($conn , $sql);

        // check whether data is delete from db or not
        if($res==true)
        {
            // set success data is delete from db or not
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";

            // redirect to manage category
            header('location:'.SITEURL.'admin/manage-food.php');
        }else
        {
             //set fail message and redirects
             $_SESSION['delete'] = "<div class='error'>Failed to delete Food.</div>";

             // redirect to manage category
             header('location:'.SITEURL.'admin/manage-food.php');
        }
     }
  }else
  {
     // redirect to manage categeory page 
     $_SESSION['delete'] = "<div class='error'>Unauthorized Access.</div>";
     header('location:'.SITEURL.'admin/manage-food.php');
  }
?>