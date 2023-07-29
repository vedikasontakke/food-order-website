<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br></br>

        <?php
            
            // cateogry failled to add 

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            // when we failed to upload the image 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <br></br>

        <!-- Add Category form starts -->        <!-- this property allows us to upload a image -->
        <form action="" method="POST" enctype="multipart/form-data" >
         <table class="tbl-30">
             <tr>
                <td>Title :</td>
                <td>
                    <input type="text" name="title"  placeholder="Category Title" > 
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
            <td>Select Image:</td>
                <td>
                    <input type="file" name="image">                     
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
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
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
                        $ext = end(explode('.' , $image_name));    

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
                            header('location:'.SITEURL.'admin/add-category.php');

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
                $sql = "INSERT INTO tbl_category SET 
                        title='$title' ,
                        featured='$featured',
                        image_name='$image_name',
                        active='$active'
                ";

                // 3. Execute the qiery and save in database
                $res = mysqli_query($conn , $sql);

                // 4. check wheather query executed or not and data added or not
                if($res==true)
                {
                    // query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";

                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');

                }else{
                    // failed to add category
                    $_SESSION['add'] = "<div class='error'> Failed to add Category .</div>";

                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }

            }

        ?>


    </div>
</div>

<?php include('partials/footer.php')?>