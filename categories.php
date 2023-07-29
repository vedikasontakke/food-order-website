<?php  include('partials-front/menu.php') ; ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
               
               // create sql query to display categories from database
               $sql = "SELECT * FROM tbl_category WHERE active='YES'";

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
    <?php  include('partials-front/footer.php') ; ?>
