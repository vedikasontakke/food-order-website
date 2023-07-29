<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">

        <h1>Change Password</h1>

        <br></br>

        <?php
           if(isset($_GET['id']))
           {
                $id=$_GET['id'];
           }
        ?>

        <form action="" method="POST">
         <table class="tbl-30">
             <tr>
                <td>Current Password :</td>
                <td><input type="password" name="current_password"  placeholder="Current Password" value=""> </td>
             </tr>

             <tr>
                <td>New Password :</td>
                <td><input type="password" name="new_password" placeholder="New Passoword" value=""> </td>
             </tr>

             
             <tr>
                <td>Confirm Password :</td>
                <td><input type="password" name="confirm_password" placeholder="Confirm Passoword" value=""> </td>
             </tr>

             <tr>
                <td colspan="2">
                    </br>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    <br></br>

                </td>
             </tr>

         <table>
     </form>

    </div>
</div>

<?php
   
   if(isset($_POST['submit']))
   {
      // 1. get data from form
      $id=$_POST['id'];
      $current_password = md5($_POST['current_password']);
      $new_password = md5($_POST['new_password']);
      $confirm_password = md5($_POST['confirm_password']);

      // 2. check whether the user with current ID  and current Password exits or not
      $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password' ";
      
      // execute the query
      $res = mysqli_query($conn , $sql);

      if($res==true)
      {
         // chekc whether data is available or not
         $count = mysqli_num_rows($res);

         if($count==1)
         {
            // user exists and password can be changed

            // check wheather the new password and confirm password match or not
            if($new_password == $confirm_password)
            {
               // update the password
               $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id ";

               // execute query
               $res2 = mysqli_query($conn , $sql2);

               if($res2==true)
               {
                  // display success msg


                  $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully </div>";

                  // redirect the user 

                  header('location:'.SITEURL.'admin/manage-admin.php');

               }
               else
               {
                   // display error msg
                   $_SESSION['change-pwd'] = "<div class='error'>Failed to change Password</div>";

                   // redirect the user 
 
                   header('location:'.SITEURL.'admin/manage-admin.php');
               }
            }else
            {
                   // redirect to manage admin page with error msg

                  $_SESSION['pwd-not-match'] = "<div class='error'>Password did'nt match </div>";

                  // redirect the user 

                  header('location:'.SITEURL.'admin/manage-admin.php');

            }

         }else
         {
            // user does not exist message and redirect
            $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";

            // redirect the user 

            header('location:'.SITEURL.'admin/manage-admin.php');

         }
      }

      // 3. check whether the new password and confirm password match or not

      // 4. change password if all above is true
   }

?>

<?php include('partials/footer.php'); ?>
