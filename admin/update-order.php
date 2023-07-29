<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1> Update Order</h1>

        <br>
        <br>

        <?php
           
           // check whether the id is set or not
           if(isset($_GET['id']))
           {
                // get the ID and other details
                $id = $_GET['id'];

                // create sql query to get all other details
                $sql = "SELECT * FROM tbl_order WHERE id=$id";

                // execute query
                $res = mysqli_query($conn , $sql);

                //count rows to check whether id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // get all data

                         $row = mysqli_fetch_assoc($res);
                         $id = $row['id'];
                         $food = $row['food'];
                         $price = $row['price'];
                         $qty = $row['qty'];          
                       //  $total =$row['total'];   
                         
                       //  $order_date = $row['order_date'];     
                         $status = $row['status'];    // Ordered , On Delivered , Cancelled
                         $customer_name = $row['customer_name'];          
                         $customer_contact = $row['customer_contact'];          
                         $customer_email = $row['customer_email'];      
                         $customer_address = $row['customer_address'];    



                }else
                {
                    // redirect to manage category msg
                    $_SESSION['no-categroy-found'] = "<div class='error'>Categroy not found.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
           }else
           {
              // redirect to manage category
              header('location:'.SITEURL.'admin/manage-order.php');
           }

        ?>
        
        <form action="" method="POST" >

        <table class="tbl-30">
             <tr>
                <td>Food Name :</td>
                <td><b><?php  echo $food; ?></b></td>
             </tr>

             <tr>
                <td>Price :</td>
                <td><b><?php  echo  $price; ?></b> </td>
             </tr>
             
             <tr>
                <td>Qty :</td>
                <td>
                   <input type="number" name="qty" value="<?php  echo $qty; ?>"> 
                </td>
             </tr>

             <tr>
                <td>Status :</td>
                <td>
                   <select name="status">
                      <option  <?php if($status=="Ordered"){echo "Selected";}?> value="Ordered">Ordered</option>
                      <option  <?php if($status=="On Delivery"){echo "On Delivery";}?> value="On Delivery">On Delivery</option>
                      <option  <?php if($status=="Delivery"){echo "Delivery";}?> value="Delivery">Delivery</option>
                      <option  <?php if($status=="Cancelled"){echo "Cancelled";}?> value="Cancelled">Cancelled</option>
                   </select>
                </td>
             </tr>

             <tr>
                <td>Customer Name:</td>
                <td>
                    <input type="text" name="customer_name"  value="<?php echo $customer_name; ?>" > 
                </td>
             </tr>

             <tr>
                <td>Customer Contact:</td>
                <td>
                    <input type="text" name="customer_contact"  value="<?php echo $customer_contact; ?>" > 
                </td>
             </tr>

             <tr>
                <td>Customer Email:</td>
                <td>
                    <input type="text" name="customer_email"  value="<?php echo $customer_email; ?>" > 
                </td>
             </tr>

             <tr>
                <td>Customer Address:</td>
                <td>
                    <textarea type="text" name="customer_address" cols="30" rows="5"> <?php echo $customer_address; ?> </textarea> 
                </td>
             </tr>

             <tr>
                <td colspan="2">
                    </br>
                    <input type="hidden" name="id" value="<?php echo $id ;?>">
                    <input type="hidden" name="price" value="<?php echo $price ;?>">

                    <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    <br></br>

                </td>
             </tr>

         <table>
        
        </form>

        
            <?php
                // check whether the submit button is clciked or not
                if(isset($_POST['submit']))
                {
                    // get all the values from form to update
                    $id = $_POST['id'];
                     // name field parameter and post field parameter should be same
                    //$food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];          
                    $total =$price * $qty;   
                    
                    $status = $_POST['status'] ;   // Ordered , On Delivered , Cancelled
                    $customer_name = $_POST['customer_name'];          
                    $customer_contact = $_POST['customer_contact'];          
                    $customer_email = $_POST['customer_email'];      
                    $customer_address = $_POST['customer_address'];          
        
                    // creare a SQL query to update admin
                    $sql2 = "UPDATE tbl_order SET 
                        
                        qty=$qty ,
                        total=$total ,
                        status='$status' , 
                        customer_name='$customer_name' ,
                        customer_contact='$customer_contact' ,
                        customer_email='$customer_email' ,
                        customer_address='$customer_address' 
                        
                         WHERE id='$id'  ";

                    // execute  the query
                    $res2 = mysqli_query($conn , $sql2);

                    // check whether the query executed successfully or not
                    if($res2==true)
                    {
                            // query executed and admin updated
                            $_SESSION['update'] = "<div class='success'> Order Updated Successfully. </div>";
                            
                            // redirect to manage admin page
                            header('location:'.SITEURL.'admin/manage-order.php');
                    }
                    else
                    {
                        // failed to update admin 

                        // query executed and admin updated
                        $_SESSION['update'] = "<div class='error'> Failed to update Order. </div>";
                            
                        // redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-order.php');

                    }

                }
            ?>


    </div>    
</div>

<?php include('partials/footer.php')?>
