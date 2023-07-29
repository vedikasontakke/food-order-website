<?php
  
  // include constants file 
  include('../config/constants.php');

  // check wheather the id and image_name value is set or not
  if(isset($_GET['id']) AND isset($_GET['image_name']))
  {
     // get the value and delete
     $id = $_GET['id'];
     $image_name = $_GET['image_name'];

    // echo "Image Name: " . $image_name;


     // remove the physical image file is availabe
     if($image_name != "")
     {
        // image is availabe. So remove it
        $path = "../images/category/".$image_name;

        // remove the image
        $remove = unlink($path);

        //if failed to remove image then add an error message and stop the process
        if($remove==false)
        {
            // set the session message
            $_SESSION['remove'] = "<div class='error'>Failed to remove category Image. </div>";

            // redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');

            // stop the process
            die();
        }

        // delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // excecute the query
        $res = mysqli_query($conn , $sql);

        // check whether data is delete from db or not
        if($res==true)
        {
            // set success data is delete from db or not
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";

            // redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }else
        {
             //set fail message and redirects
             $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";

             // redirect to manage category
             header('location:'.SITEURL.'admin/manage-category.php');
        }

     }
  }else
  {
     // redirect to manage categeory page 
     header('location:'.SITEURL.'admin/manage-category.php');
  }
?>