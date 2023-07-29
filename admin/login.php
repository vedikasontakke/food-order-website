<?php include('../config/constants.php'); ?>

<html>
  <head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/style2.css">
  </head>

  <body>
      <div class="login">
         <h1 class="text-center">Login</h1>

         <br><br>

         <?php
             
             // login unsuccessful msg 
             if(isset($_SESSION['login']))
             {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
             }

               // login unsuccessful msg 
               if(isset($_SESSION['no-login-message']))
               {
                  echo $_SESSION['no-login-message'];
                  unset($_SESSION['no-login-message']);
               }

         ?>

          <br><br>

         <!-- Login From starts here -->

         <form action="" method="POST" class="login-form">

          Username: <br>
          <input type="text" name="username" placeholder="enter username"><br></br>

          Password : <br>
          <input type="password" name="password" placeholder="enter Password"><br></br>

          <input type="submit" name="submit" value="Login" class="btn-primary">
          <br></br>

         </form>

         <!-- Login From ends here -->


         <p  class="text-center">Created By - <a href="www.google.com">Vedika Sontakke</a></p>
         
      </div>
  </body> 

</html>

<?php

   // chekc whether the submit button is clicked or not
   if(isset($_POST['submit']))
   {
        // process for login
       // 1. get the data from login form

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // 2. check SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Execute the query
        $res = mysqli_query($conn , $sql);

        // 4. count rows to check whether user exists or not 
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
           // user availabe and login successfully and redirect to the home page / dashboard
           $_SESSION['login'] = "<div class='success text-center'> Login Successful. </div>";

           // to check whether the user is logged in or not and logout will unset it 
           $_SESSION['user'] = $username;

           header('location:'.SITEURL.'admin/');
        }else{

           // user not availabe and login failed and redirect to the home page / dashboard
           $_SESSION['login'] = "<div class='error text-center'> Username and Password did'nt match. </div>";

           header('location:'.SITEURL.'admin/login.php');

        }


   }

?>