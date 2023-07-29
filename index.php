<?php  include('partials-front/menu.php') ; ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

                <?php

                    if(isset($_SESSION['order']))  // checking whether the session is set of not 
                    {
                        echo $_SESSION['order'];  //  display the session msg if set
                        unset($_SESSION['order']);  // remove session msg 

                    }
               ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
               
               // create sql query to display categories from database
               $sql = "SELECT * FROM tbl_category WHERE active='YES' AND featured='YES' LIMIT 3";

               // execute query
               $res = mysqli_query($conn , $sql);

               // count rows to check whether categories is availabe orn ot
               $count = mysqli_num_rows($res);

               // categories avilabe
               if($count > 0)
               {
                  while($row=mysqli_fetch_assoc($res))
                  {
                     // get values like id , title , image_name
                     $id = $row['id'];
                     $title = $row['title'];
                     $image_name = $row['image_name'];
                     ?>

                     <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
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
                                 
                                 <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                <?php
                               }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                     </a>

                

                     <?php
                  }
               }else
               {
                   // categories not availabe
                   echo "<div class='error'>Categories not added.</div>";
               }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
               
               // create sql query to display food from database
               $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

               // execute query
               $res2 = mysqli_query($conn , $sql2);

               // count rows to check whether food is availabe orn ot
               $count2 = mysqli_num_rows($res2);

               // categories avilabe
               if($count2 > 0)
               {
                  while($row=mysqli_fetch_assoc($res2))
                  {
                     // get values like id , title , image_name
                     $id = $row['id'];
                     $title = $row['title'];
                     $price = $row['price'];
                     $description = $row['description'];
                     $image_name = $row['image_name'];
                     ?>

                        <div class="food-menu-box">
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
                                 <h4><?php echo $title; ?></h4>
                                 <p class="food-price"><?php echo $price; ?></p>
                                 <p class="food-detail">
                                      <?php echo $description; ?>
                                 </p>
                           
                                 <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id ; ?>" class="btn btn-primary">Order Now</a>
                           </div>
                        </div>

                     <?php
                  }
               }else
               {
                   // categories not availabe
                   echo "<div class='error'>Food not available.</div>";
               }
            ?>

         

            <div class="clearfix"></div>
            
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php  include('partials-front/footer.php') ; ?>
