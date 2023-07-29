
<?php  include('partials-front/menu.php') ; ?>

        <?php
            // check wheather id is passed or not

            if(isset($_GET['food_id']))
            {
                    // category id is set and get the id
                    $food_id = $_GET['food_id'];

                    // get category title based on id
                    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

                    
                    // execute query
                    $res = mysqli_query($conn , $sql);

                    // get value from database
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        // we have data
                        // get data from db
                        $row = mysqli_fetch_assoc($res);

                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                    }else
                    {
                        // food not availabe 
                        header('location:'.SITEURL);
                    }
            }else
            {
                  // food not availabe 
                  header('location:'.SITEURL);
             }      
        ?>
   

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                    <?php
                            // check image is availabe or not
                            if($image_name=="")
                            {
                                // display msg
                                echo "<div class='error'>Image not avaialbe</div>";
                                }else
                                {
                                    // image avaialbe
                            ?>
                            
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                            <?php

                                    }

                    ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">


                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vedika Sontakke" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vedikasontakke.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        <?php    
            // Process the value from Form and Save it in database

            //Check whether the submit button is clicked or not

            if(isset($_POST['submit']))
            {
                //1.  get data from Form

                // name field parameter and post field parameter should be same
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];          
                $total =$price * $qty;   
                
                $order_date = date("Y-m-d h:i:sa");     
                $status = "Ordered";    // Ordered , On Delivered , Cancelled
                $customer_name = $_POST['full-name'];          
                $customer_contact = $_POST['contact'];          
                $customer_email = $_POST['email'];      
                $customer_address = $_POST['address'];          
    

                //2.  SQL Qurey to save the data into database

                /**
                 *  left side is col name = right side is variable name 
                *  full_name='$full_name'
                */
                $sql2 = "INSERT INTO tbl_order SET 

                food='$food' ,
                price=$price ,
                qty=$qty ,
                total=$total ,
                order_date= '$order_date' ,
                status='$status' , 
                customer_name='$customer_name' ,
                customer_contact='$customer_contact' ,
                customer_email='$customer_email' ,
                customer_address='$customer_address' 
                ";

                // 3. Execute query and save data into database 
                
                $res2 = mysqli_query($conn , $sql2) ;

                //4. check if (query is executed ) data is inserted or not and display appropriate msg 

                if($res2==TRUE)
                {

                    $_SESSION['order'] = "<div class='success  text-center' >Food Ordered Successfully</div>";

                    //Redirect to home page 
                    header("location:".SITEURL);
                }else{

                    // failed to order 
                    $_SESSION['order'] = "<div class='error  text-center' text-center>Failed to order food.</div>";


                     //Redirect to home page 
                     header("location:".SITEURL);
                }



            }

?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php  include('partials-front/footer.php') ; ?>
