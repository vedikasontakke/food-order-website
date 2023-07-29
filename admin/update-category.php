<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1> Update Category</h1>

        <br>
        <br>

        <?php
           
           // check whether the id is set or not
           if(isset($_GET['id']))
           {
                // get the ID and other details
                $id = $_GET['id'];

                // create sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                // execute query
                $res = mysqli_query($conn , $sql);

                //count rows to check whether id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // get all data

                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured']; 
                    $active = $row['active']; 



                }else
                {
                    // redirect to manage category msg
                    $_SESSION['no-categroy-found'] = "<div class='error'>Categroy not found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
           }else
           {
              // redirect to manage category
              header('location:'.SITEURL.'admin/manage-category.php');
           }

        ?>

        <form action="" method="POST" enctype="multipart/form-data" >

        <table class="tbl-30">
             <tr>
                <td>Title :</td>
                <td>
                    <input type="text" name="title"  value="<?php echo $title; ?>" > 
                </td>
             </tr>

            

            <tr>
            <td>Current Image Image:</td>
                <td>
                   <?php
                       if($current_image != "")
                       {
                          // dislay img
                          ?>

                           <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">

                          <?php
                       }else
                       {
                          // display msg
                          echo "<div class='error'>Image not added.</div>";
                       }
                   ?>
                </td>
            </tr>
             
             <tr>
             <td>New Image :</td>
                <td>
                    <input type="file" name="image">                     
                </td>
             </tr>

             <tr>
                <td>Featured :</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked"; } ?> type="radio" name="featured"  value="Yes">Yes                     

                    <input <?php if($featured=="No"){echo "checked"; } ?> type="radio" name="featured"  value="No">No 
                </td>
             </tr>

             <tr>
                <td>Active :</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked"; } ?> type="radio" name="active"  value="Yes">Yes                     

                    <input <?php if($active=="No"){echo "checked"; } ?> type="radio" name="active"  value="No">No 
                </td>
             </tr>

             <tr>
                <td colspan="2">
                    </br>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    <br></br>

                </td>
             </tr>

         <table>
        
        </form>

        <?php
                                           
           if(isset($_POST['submit']))
           {
               // 1. Get all the values from our form
               $id = $_POST['id']; 
               $title = $_POST['title']; 
               $current_image = $_POST['current_image']; 
               $featured = $_POST['featured'];
               $active = $_POST['active'];

               //2. Updating new image if selected
               // check whether the image is selected or not
               if(isset($_FILES['image']['name']))
               {
                  // get img details
                  $image_name = $_FILES['image']['name'];

                  // check whether the iage is availab or not 
                  if($image_name != "")
                  {
                     // Image Availabe

                     //A.  upload te current image

                      // Auto Rename our image

                        // get the extenstion of our image (jpg , png , gif , etc ) eg. "food1.jpg"
                        $image_name_parts = explode('.', $image_name);
                        $ext = end($image_name_parts);     

                        // Rename the image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;         // Food_Category_567.jpg

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        // upload the image
                        $upload = move_uploaded_file($source_path , $destination_path);

                        // check whether the iamge is uploaded or not
                        // and if the image is not uploaded we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            // set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";

                            // redirect to category page
                            header('location:'.SITEURL.'admin/manage-category.php');

                            // stop the process
                            die();          // it is required because if the process fails we dont need to be data will be uploaded to the db 
                        }

                     // B. remove the current image if availbe 
                     if($current_image != "")
                     {
                        $remove_path = "../images/category/".$current_image;
                        $remove = unlink($remove_path);
    
                        // check whether image is removed or not
                        // If failed to remove then display message and stop process
                        if($remove == false)
                        {
                            // failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image </div>";
    
                            header('location:'.SITEURL.'admin/manage-category.php');

                            die(); // stop the process
                        }
                     }
                  

                  }else
                  {
                    $image_name = $current_image;
                  }

               }else
               {
                  $image_name = $current_image;
               }


               // 3. Update the database
               $sql2 = "UPDATE tbl_category SET 
                        title='$title' ,
                        image_name = '$image_name',
                        featured = '$featured' ,
                        active = '$active' 
                        WHERE id=$id
                ";

                // execute query
                $res2 = mysqli_query($conn , $sql2);

               // 4. Redirect to manage category with message

               // check whether query executed or not
               if($res2 == true)
               {
                  // category updated
                  $_SESSION['update'] = "<div class='success'>Updated Successfully.</div>";
                  header('location:'.SITEURL.'admin/manage-category.php');

               }else{
                  // failed to update category 
                  $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";

                  header('location:'.SITEURL.'admin/manage-category.php');

               }


           }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>
