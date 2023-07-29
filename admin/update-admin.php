<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        
        <br></br>

        <?php

             // 1. get the ID of Selected Admin
             $id=$_GET['id'];

             // 2. Create SQL Query to get the Details
             $sql="SELECT * FROM tbl_admin WHERE id=$id";

             // 3. Execute the query
             $res=mysqli_query($conn,$sql);

             // check wheather the query is executed or not
             if($res==true)
             {
                //wheather the data is availabe or not
                $count = mysqli_num_rows($res);

                // check whether we have admin data or not 
                if($count==1)
                {
                    // Get the details

                    $row=mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }else
                {
                    // redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
             }

        ?>

<form action="" method="POST">
         <table class="tbl-30">
             <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" value="<?php echo $full_name?>"> </td>
             </tr>

             <tr>
                <td>Username:</td>
                <td><input type="text" name="username" value="<?php echo $username?>"> </td>
             </tr>

             <tr>
                <td colspan="2">
                    </br>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    <br></br>

                </td>
             </tr>

         <table>
     </form>
    </div>
</div>

<?php
  // check whether the submit button is clciked or not
   if(isset($_POST['submit']))
   {
       // get all the values from form to update
       $id = $_POST['id'];
       $full_name = $POST['full_name'];
       $username= $_POST['username'];

       // creare a SQL query to update admin
       $sql = "UPDATE tbl_admin SET full_name='$full_name' , username = '$username' WHERE id='$id'  ";

       // execute  the query
       $res = mysqli_query($conn , $sql);

       // check whether the query executed successfully or not
       if($res==true)
       {
            // query executed and admin updated
            $_SESSION['update'] = "<div class='success'> Admin Updated Successfully. </div>";
            
            // redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
       }
       else
       {
          // failed to update admin 

           // query executed and admin updated
           $_SESSION['update'] = "<div class='error'> Failed to update Admin. </div>";
            
           // redirect to manage admin page
           header('location:'.SITEURL.'admin/manage-admin.php');

       }

   }
?>

<?php include('partials/footer.php'); ?>
