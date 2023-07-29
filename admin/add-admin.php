<?php  include('partials/menu.php');?>

<div class="main-content">
     <div class="wrapper">
         <h1>Add Admin</h1>

         <br></br>

         <?php

           // fail to add admin 
           if(isset($_SESSION['add']))  // checking whether the session is set of not 
           {
               echo $_SESSION['add'];  //  display the session msg if set
               unset($_SESSION['add']);  // remove session msg 

           }
         ?>

         <form action="" method="POST">
             <table class="tbl-30">
                 <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"> </td>
                 </tr>

                 <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your Username"> </td>
                 </tr>

                 <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your Password"> </td>
                 </tr>


                 <tr>
                    <td colspan="2">
                        </br>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        <br></br>

                    </td>
                 </tr>

             <table>
         </form>

     </div>
</div>

<?php  include('partials/footer.php');?>

<?php

    // Process the value from Form and Save it in database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //1.  get data from Form

        // name field parameter and post field parameter should be same
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];
         $password = md5($_POST['password']);           /* Password Encryption with MD5 */ 

         //2.  SQL Qurey to save the data into database

         /**
          *  left side is col name = right side is variable name 
          *  full_name='$full_name'
          */
         $sql = "INSERT INTO tbl_admin SET 

           full_name='$full_name' ,
           username='$username' ,
           password='$password' 
         ";

        // 3. Execute query and save data into database 
        
        // die is used to stop the process and mysqli_query is used to execute the query 
        $res = mysqli_query($conn , $sql) or die(mysqli_error());

        //4. check if (query is executed ) data is inserted or not and display appropriate msg 

        if($res==TRUE)
        {
            // data inserted

            $_SESSION['add'] = "Admin Added Successfully";

            //Redirect page to manage admin 
            header("location:".SITEURL.'admin/manage-admin.php');
        }else{

            // failed to inserted 
            $_SESSION['add'] = "Fail to Add Admin ";


             //Redirect page to manage admin 
             header("location:".SITEURL.'admin/add-admin.php');
        }



    }

?>