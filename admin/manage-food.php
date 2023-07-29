<?php include('partials/menu.php')?>


    <!-- Main Content Section Starts -->
     <div class="main-content">
     <div class="wrapper">
         <h1>Manage Food</h1>

         </br>

         <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

         <br>
         </br>

         <?php
        // when we failed to upload the image 
                        if(isset($_SESSION['add']))
                        {
                           echo $_SESSION['add'];
                           unset($_SESSION['add']);
                        }

                          // failed to remove food
                          if(isset($_SESSION['remove']))
                          {
                              echo $_SESSION['remove'];
                              unset($_SESSION['remove']);
                          }
            
                           // delete food successfully
                           if(isset($_SESSION['delete']))
                           {
                               echo $_SESSION['delete'];
                               unset($_SESSION['delete']);
                           }
            
                            // update food not found
                            if(isset($_SESSION['no-food-found']))
                            {
                                echo $_SESSION['no-food-found'];
                                unset($_SESSION['no-food-found']);
                            }
            
                            // update successfully
                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
            
                            //upload updated image successfully
                            if(isset($_SESSION['upload']))
                            {
                                  echo $_SESSION['upload'];
                                  unset($_SESSION['upload']);
                            }
            
                             //if failed to upload updated image
                             if(isset($_SESSION['failed-remove']))
                             {
                                   echo $_SESSION['failed-remove'];
                                   unset($_SESSION['failed-remove']);
                             }
             
                    

        ?>

        <table class="tbl-full">
            <tr>
               <th>Sr No.</th>
               <th>Title</th>
               <th>Price</th>
               <th>Image</th>
               <th>Featured</th>
               <th>Active</th>
               <th>Actions</th>


            </tr>

            <?php
                 $sql = "SELECT * FROM tbl_food";

                 // execute query
                 $res = mysqli_query($conn , $sql);

                 // count rows
                 $count = mysqli_num_rows($res);

                 $sn = 1;          // create serial number varialbe 

                 // check whether  we have data in database or not 
                 if($count>0)
                 {
                      // we have data in database 

                      // get the data and display 
                      while($row=mysqli_fetch_assoc($res))
                      {
                         $id = $row['id'];
                         $title = $row['title'];
                         $price = $row['price'];
                         $image_name = $row['image_name'];
                         $featured = $row['featured'];
                         $active = $row['active'];

                         ?>
                        

                        
                        <tr>
                            <td><?php echo $sn++ ;?> </td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>


                            <td>
                              <?php 
                                  // check wheather image name is availabe

                                  if($image_name!="")
                                  {
                                     // Display the image
                                     ?>
                                     <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                     <?php
                                  }else
                                  {
                                     // display the msg
                                     echo "<div class='error'> Image not Added </div>";
                                  }
                              ?>
                           </td>

                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary"> Update Food</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Delete Food</a>
                            </td>
                        </tr>


                         <?php
                         
                      }

                 }else
                 {
                    // we do not have data
                    // we will display the msg inside the table

                    echo "<tr> <td colspan='7' class='error' > Food Not Added Yet. </td> </tr>";
                 }
            ?>

        </table> 

    </div>
    </div>
    <!--  Main Content Section Ends -->

<?php include('partials/footer.php')?>



 