<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Food </h1>

        <br>
        <br>

        <?php
        // when we failed to upload the image 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data" >
         <table class="tbl-30">
             <tr>
                <td>Title :</td>
                <td>
                    <input type="text" name="title"  placeholder="Title of the food" > 
                </td>
             </tr>

             <tr>
                <td>Description :</td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Description of the food." > </textarea>
                </td>
             </tr>

             <tr>
                <td>Price :</td>
                <td>
                    <input type="number" name="price"> 
                </td>
             </tr>

             <tr>
                <td>Select Image:</td>
                    <td>
                      <input type="file" name="image">                     
                    </td>
              </tr>

              <tr>
                <td>Category :</td>
                <td>
                    <select name="category">

                       <?php
                          // create PHP code to dislpay categories from Database

                          // 1. Create SQL to get all active categories from database
                          $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";

                          // execute query
                          $res = mysqli_query($conn , $sql);

                          $count = mysqli_num_rows($res);

                          // if count is greater than 0 we have cetegories else we dont have categories

                          if($count > 0)
                          {
                             // we have categories
                             while($row=mysqli_fetch_assoc($res))
                             {
                                // get the details of cetegories
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
 
                                <?php
                             }

                          }else
                          {
                             // we dont have categories 
                             ?>

                             <option value="0">No cateogrory</option>

                             <?php

                          }

                       ?>

                        <option value="1">Food</option>
                        <option value="2">Snacks</option>
                        
                    </select> 
                </td>
             </tr>

             <tr>
                <td>Featured :</td>
                <td>
                    <input type="radio" name="featured"  value="Yes">Yes                     

                    <input type="radio" name="featured"  value="No">No 
                </td>
             </tr>          
    
             <tr>
             <td>Active :</td>
                <td>
                    <input type="radio" name="active"  value="Yes">Yes                     

                    <input type="radio" name="active"  value="No">No 
                </td>
             </tr>

             <tr>
                <td colspan="2">
                    </br>
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    <br></br>
                </td>
             </tr>

         <table>
     </form>


    
        <!-- Add Category form ends -->

        <?php
            
            // Check wheather the submit button is clicked or not 
            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];


                // for radio input , we need to whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    // get value from form
                    $featured = $_POST['featured'];
                }else{
                    // set the default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }else{
                    $active = "No";
                }

                /*********************** to check how image backend is working just run below commented lines ************************* 
                            
                              print_r($_FILES['image']);
                              die();

                **********************************************************************************************************************/
                // check wheather the image is selected or not and set the value accordingly
                if(isset($_FILES['image']['name']))   // if name value is image 
                {
                    // upload the image
                    // to uplaod a image we need image name source path and destination path

                    $image_name = $_FILES['image']['name'];

                    // upload image only if image is selected
                    if($image_name != "")
                    {
                        // Auto Rename our image

                        // get the extenstion of our image (jpg , png , gif , etc ) eg. "food1.jpg"
                        $image_name_parts = explode('.', $image_name);
                        $ext = end($image_name_parts);  
                        
                        // Rename the image
                        $image_name = "Food-Name-".rand(000,999).'.'.$ext;         // Food_Category_567.jpg

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/food/".$image_name;

                        // upload the image
                        $upload = move_uploaded_file($source_path , $destination_path);

                        // check whether the iamge is uploaded or not
                        // and if the image is not uploaded we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            // set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";

                            // redirect to category page
                            header('location:'.SITEURL.'admin/add-food.php');

                            // stop the process
                            die();          // it is required because if the process fails we dont need to be data will be uploaded to the db 
                        }
                }

                }else
                {
                    // dont uplaod the image and set the image_name value as blank
                    $image_name = "";;
                }

                // 2. create SQL Query to Insert Category into database
                $sql2 = "INSERT INTO tbl_food SET 
                        title='$title' ,
                        description = '$description' , 
                        price = $price , 
                        image_name='$image_name',
                        category_id = $category ,
                        featured = '$featured',
                        active='$active'
                ";

                // 3. Execute the qiery and save in database
                $res2 = mysqli_query($conn , $sql2);

                // 4. check wheather query executed or not and data added or not
                if($res2==true)
                {
                    // query executed and category added
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";

                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-food.php');

                }else{
                    // failed to add category
                    $_SESSION['add'] = "<div class='error'> Failed to add Food .</div>";

                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }

        ?>
 


    </div>
</div>     

<?php include('partials/footer.php');?>
