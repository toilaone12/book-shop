<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}


if (isset($_POST['update_order'])) {

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $date = date("d.m.Y");
   mysqli_query($conn, "UPDATE `confirm_order` SET payment_status = '$update_payment',date='$date' WHERE order_id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `confirm_order` WHERE order_id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="./css/register.css">
   <link rel="stylesheet" href="./css/admin.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>
   <div class="wrapper">
      <?php include './admin_sidebar.php' ?>
      <?php
      if (isset($message)) {
         foreach ($message as $message) {
            echo '
         <div class="message" id= "messages"><span>' . $message . '</span>
         </div>
         ';
         }
      }
      ?>
      <div class="container-admin">
         <h1 class="title mb-20">List User</h1>
         <?php
         $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
         if ($message) {
            echo $message;
            $_SESSION['message'] = '';
         }
         $select_orders = mysqli_query($conn, "SELECT * FROM `confirm_order`") or die('query failed');
         if (mysqli_num_rows($select_orders) > 0) {
         ?>
            <div class="row">
               <?php
               while ($one = mysqli_fetch_assoc($select_orders)) {
               ?>
                  <div class="col-12 mb-20">
                     <div class="card-dashboard card-user-admin">
                        <div class="card-icon-admin rounded-circle">
                           <i class="fa-solid fa-box text-dark"></i>
                        </div>
                        <div class="card-body border-left-dark">
                           <div class="d-flex align-items-center">
                              <h6 class="card-title text-dark mr-10 price-font">Fullname: <?= $one['name'] ?></h6>
                              <h6 class="card-title text-dark price-font">Phone Number: <?= $one['number'] ?></h6>
                           </div>
                           <h6 class="card-title text-dark price-font">Address: <?= $one['address'] ?></h6>
                           <div class="d-flex align-items-center">
                              <h6 class="card-title text-dark price-font mr-10">Total Price: <?= number_format($one['total_price'], 0, ',', '.') ?> VND</h6>
                              <h6 class="card-title text-dark price-font">Payment Type: <?= $one['payment_method'] ?></h6>
                           </div>
                           <h6 class="card-title text-dark price-font">Payment Status: <span class="price-font <?= $one['payment_status'] == 'completed' ? 'text-success' : 'text-warning' ?>"><?= ucfirst($one['payment_status']) ?></span></h6>
                           <div class="buttons" style="display: flex;">
                              <a href="detail_order.php?id=<?= $one['order_id'] ?>" class="ml-0 btn btn-primary">View Detail</a>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php
               }
               ?>
            <?php
         } else {
            ?>
               <div style="text-align: center; font-size: 32px;"><i class="fa-solid fa-box text-dark" style="margin-right: 10px;"></i>No record order</div>
            <?php
         }
            ?>
            </div>
            <!-- <section class="placed-orders">
      
            <h1 class="order-title">Order</h1>
      
            <div class="row">
               <?php
               $select_orders = mysqli_query($conn, "SELECT * FROM `confirm_order`") or die('query failed');
               if (mysqli_num_rows($select_orders) > 0) {
                  while ($fetch_book = mysqli_fetch_assoc($select_orders)) {
               ?>
                     <div class="col-4">
                        <div class="card" style="height: 100% !important;">
                           <div class="card-header">
                              <h4>ID Order #<?php echo $fetch_book['order_id']; ?></h4>
                           </div>
                           <div class="card-body">
                              <p style="font-size: 16px !important; font-weight: normal;"> Order Date : <span><?php echo $fetch_book['order_date']; ?></span> </p>
                              <p style="font-size: 16px !important; font-weight: normal;"> Name : <span><?php echo $fetch_book['name']; ?></span> </p>
                              <p style="font-size: 16px !important; font-weight: normal;"> Mobile Number : <span><?php echo $fetch_book['number']; ?></span> </p>
                              <p style="font-size: 16px !important; font-weight: normal;"> Email Id : <span><?php echo $fetch_book['email']; ?></span> </p>
                              <p style="font-size: 16px !important; font-weight: normal;"> Address : <span><?php echo $fetch_book['address']; ?></span> </p>
                              <p style="font-size: 16px !important; font-weight: normal;"> Payment Method : <span><?php echo $fetch_book['payment_method']; ?></span> </p>
                              <p style="font-size: 16px !important; font-weight: normal;"> Your orders : <span><?php echo $fetch_book['total_books']; ?></span> </p>
                              <p style="font-size: 16px !important; font-weight: normal;"> Total price : <span><?php echo number_format($fetch_book['total_price'], 0, ',', '.'); ?> VND</span> </p>
                              <form action="" method="post">
                                 <input type="hidden" name="order_id" value="<?php echo $fetch_book['order_id']; ?>">
                                 Payment Status :
                                 <select name="update_payment" class="form-select">
                                    <option value="" selected disabled><?php echo $fetch_book['payment_status']; ?></option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                 </select>
                                 <div class="d-block mt-3">
                                    <input type="submit" value="Update Order" name="update_order" class="btn btn-success rounded">
                                    <a class="btn btn-danger rounded" href="admin_orders.php?delete=<?php echo $fetch_book['order_id']; ?>" onclick="return confirm('delete this order?');">Cancel Order</a>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
               <?php
                  }
               } else {
                  echo '<p class="empty">Chưa có đơn hàng</p>';
               }
               ?>
            </div>
      
         </section> -->
      </div>
   </div>



   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
   <script>
      setTimeout(() => {
         const box = document.getElementById('messages');

         // 👇️ hides element (still takes up space on page)
         box.style.display = 'none';
      }, 8000);
   </script>

</body>

</html>