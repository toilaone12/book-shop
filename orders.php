<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
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
   <link rel="stylesheet" href="./css/hello.css">
   <link rel="stylesheet" href="./css/custom.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
    .placed-orders .title{
  text-align: center;
  margin-bottom: 20px;
  text-transform: uppercase;
  color:black;
  font-size: 40px;
}
   .placed-orders .box-container{
  max-width: 1200px;
  margin:0 auto;
  display:flex;
  flex-wrap: wrap;
  align-items: center;
  gap:20px;
}

.placed-orders .box-container .empty{
  flex:1;
}

.placed-orders .box-container .box{
  flex:1 1 400px;
  border-radius: .5rem;
  padding:15px;
  border:2px solid brown;
  background-color: white;
  padding:10px 20px;
}

.placed-orders .box-container .box p{
  padding:10px 0 0 0;
  font-size: 20px;
  color:gray;
}

.placed-orders .box-container .box p span{
  color:black;
}
</style>

</head>
<body>
   
<?php include 'index_header.php'; ?>
<?php
   $select_orders = mysqli_query($conn, "SELECT * FROM `confirm_order`") or die('query failed');
?>
<div class="container-order">
   <?php
      if (mysqli_num_rows($select_orders) > 0) {
   ?>
   <h1 class="title" style="text-align:center;margin:20px 0;font-size:39px;">My orders</h1>
   <div class="row">
      <?php
         while ($one = mysqli_fetch_assoc($select_orders)) {
      ?>
            <div class="col-12 mb-20">
               <div class="card-dashboard card-customer-order">
                  <div class="card-icon-admin rounded-circle">
                     <i class="fa-solid fa-box text-dark"></i>
                  </div>
                  <div class="card-body border-left-dark">
                     <h5 class="card-title text-dark mr-10 price-font">Fullname: <?= $one['name'] ?></h5>
                     <h5 class="card-title text-dark price-font">Phone Number: <?= $one['number'] ?></h5>
                     <h6 class="card-title text-dark price-font">Address: <?= $one['address'] ?></h6>
                     <h6 class="card-title text-dark price-font">Total Price: <?= number_format($one['total_price'],0,',','.')?> VND</h6>
                     <h6 class="card-title text-dark price-font">Payment Type: <?= $one['payment_method']?></h6>
                     <h6 class="card-title text-dark price-font">Payment Status: <span class="price-font <?= $one['payment_status'] == 'completed' ? 'text-success' : 'text-warning' ?>"><?=ucfirst($one['payment_status'])?></span></h6>
                     <div class="buttons" style="display: flex;">
                        <a href="detail_order_customer.php?id=<?= $one['order_id'] ?>" class="ml-0 btn btn-primary">View Detail</a>
                     </div>
                  </div>
               </div>
            </div>
      <?php
         }
      ?>
      <?php
         }else{
      ?>
      <h1 style="text-align: center; font-size: 32px; margin:20px 0;font-size:39px;"><i class="fa-solid fa-box text-dark" style="margin-right: 10px;"></i>No record order</h1>
      <?php
         }
      ?>
   </div>
</div>


<?php include 'index_footer.php'; ?>

</body>
</html>