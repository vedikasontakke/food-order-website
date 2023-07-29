<?php include('partials/menu.php')?>

    <!-- Main Content Section Starts -->
     <div class="main-content">
     <div class="wrapper">
         <h1>Manage Admin</h1>

         </br>

         <?php
            // admin added successfully 
           if(isset($_SESSION['add']))
           {
              echo $_SESSION['add'];    // displaying session msg 
              unset($_SESSION['add']); // removing session msg
           }


           // admin deleted successfully
           if(isset($_SESSION['delete']))
           {
                echo $_SESSION['delete'];    // displaying session msg 
                unset($_SESSION['delete']); // removing session msg
           }


           //admin updated successfully
           if(isset($_SESSION['update']))
           {
                echo $_SESSION['update'];    // displaying session msg 
                unset($_SESSION['update']); // removing session msg
           }


           // user not found
           if(isset($_SESSION['user-not-found']))
           {
                 echo $_SESSION['user-not-found'];    // displaying session msg 
                 unset($_SESSION['user-not-found']); // removing session msg
           }

           // password not match
           if(isset($_SESSION['pwd-not-match']))
           {
                 echo $_SESSION['pwd-not-match'];    // displaying session msg 
                 unset($_SESSION['pwd-not-match']); // removing session msg
           }

            // password changed
            if(isset($_SESSION['change-pwd']))
            {
                  echo $_SESSION['change-pwd'];    // displaying session msg 
                  unset($_SESSION['change-pwd']); // removing session msg
            }
         ?>

         <br>
         </br>

         <a href="add-admin.php" class="btn-primary">Add Admin</a>

         <br>
         </br>

        <table class="tbl-full">
            <tr>
               <th>Sr No.</th>
               <th>Full Name</th>
               <th>Username</th>
               <th>Actions</th>
            </tr>

            <?php
                
                // query to get all admin
                $sql = "SELECT * FROM tbl_admin";

                // execute the query
                $res = mysqli_query($conn , $sql);

                $sn=1;  // create variable and assign id 

                // check whether the query is executed or not 
                if($res==TRUE)
                {
                  // count rows to check whether we have data in database or not
                  $count = mysqli_num_rows($res);  // function to get all rows in database 

                  //check the num of rows
                  if($count > 0)
                  {
                     // we have data in database
                     while($rows=mysqli_fetch_assoc($res))
                     {
                        // using while loop to get all data from database 
                        // and while loop willl run as long as we have data in databse 

                        // get individual data
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        // display the values in table

                       ?>

                       <!-- html code starts here -->

                        <tr>
                              <td><?php echo $sn++; ?></td>
                              <td><?php echo $full_name; ?></td>
                              <td><?php echo $username; ?></td>
                              <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary"> Change Password </a> 
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> Delete Admin</a>
                             </td>
                        </tr>

                       <!-- html code ends here -->

                       <?php
                     
                     }
                  }else
                  {
                     // we dont have data in database 
                  }


                }

            ?>

           

        </table> 

    </div>
    </div>
    <!--  Main Content Section Ends -->

<?php include('partials/footer.php')?>



 