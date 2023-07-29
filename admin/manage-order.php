<?php include('partials/menu.php')?>


    <!-- Main Content Section Starts -->
     <div class="main-content">
     <div class="wrapper">
         <h1>Manage Order</h1>

         </br>
         <br>
         </br>

         <?php
         //admin updated successfully
           if(isset($_SESSION['update']))
           {
                echo $_SESSION['update'];    // displaying session msg 
                unset($_SESSION['update']); // removing session msg
           }
        ?>

        <table class="tbl-full">
            <tr>
               <th>Sr No.</th>
               <th>Food</th>
               <th>Price</th>
               <th>Qty</th>
               <th>Total</th>
               <th>Order Date</th>
               <th>Status</th>
               <th>Customer Name</th>
               <th> Contact</th>
               <th> Email</th>
               <th> Address</th>
               <th> Actions</th>
            </tr>

            <?php
                 $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

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
                         $food = $row['food'];
                         $price = $row['price'];
                         $qty = $row['qty'];          
                         $total =$row['total'];   
                         
                         $order_date = $row['order_date'];     
                         $status = $row['status'];    // Ordered , On Delivered , Cancelled
                         $customer_name = $row['customer_name'];          
                         $customer_contact = $row['customer_contact'];          
                         $customer_email = $row['customer_email'];      
                         $customer_address = $row['customer_address'];    

                         ?>
                        
                        <tr>
                            <td><?php echo $sn++;?> </td>
                            <td><?php echo $food;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $total;?></td>
                            <td><?php echo $order_date;?></td>

                            <td>
                                <?php
                                  if($status == "Ordered")
                                  {
                                     echo "<label style='color:blue;'>$status</label>";
                                  }elseif($status == "On Delivery")
                                  {
                                     echo "<label style='color:orange;'>$status</label>";
                                  }
                                  elseif($status == "Delivered")
                                  {
                                     echo "<label style='color:green;'>$status</label>";
                                  }else{
                                    echo "<label style='color:red;'>$status</label>";

                                  }
                                ?>
                            </td>   

                            <td><?php echo $customer_name;?></td>
                            <td><?php echo $customer_contact;?></td>
                            <td><?php echo $customer_email;?></td>
                            <td><?php echo $customer_address;?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary"> Update Food</a>
                            </td>
                        </tr>

                         <?php
                         
                      }

                 }else
                 {
                    // we do not have data
                    // we will display the msg inside the table

                    echo "<tr> <td colspan='12' class='error' > Orders not availabe. </td> </tr>";
                 }
            ?>

        </table> 

    </div>
    </div>
    <!--  Main Content Section Ends -->

<?php include('partials/footer.php')?>



 