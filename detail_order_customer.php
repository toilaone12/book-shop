<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
$id = isset($_GET['id']) && $_GET['id'] ? intval($_GET['id']) : 0;
if (!$id) {
    header('location:orders.php');
}
if(isset($_POST['cancel-order'])){
    // var_dump($_POST); die;
    $idOrder = $_POST['id_order'];
    $update = $conn->query("UPDATE `confirm_order` SET payment_status = 'cancel' WHERE order_id = $idOrder");
    if($update){
        $_SESSION['message'] = 'Cancel Success';
    }else{
        $_SESSION['message'] = 'Cancel Failed';
    }
    header("Location: ".$_SERVER['PHP_SELF'].'?id='.$id);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order</title>

    <!-- font awesome cdn link  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>
    <?php include 'index_header.php'; ?>
    <?php
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    if ($message) {
        echo "<script>$(document).ready(function() {
            toastr.warning('".$message."', 'Success');
        })</script>";
        $_SESSION['message'] = '';
    }
    ?>
    <?php
    $select_orders = mysqli_query($conn, "SELECT * FROM `confirm_order` WHERE order_id = " . $id) or die('query failed');
    $one = mysqli_fetch_assoc($select_orders);
    $select_orders_detail = mysqli_query($conn, "SELECT * FROM `orders` WHERE id_order = " . $id) or die('query failed');
    ?>
    <div class="container-order" style="height: calc(100vh - <?= $select_orders_detail->num_rows == 0 ? '460px' : '430px' ?>);">
        <?php
            if (mysqli_num_rows($select_orders_detail) > 0) {
        ?>
        <h1 class="title" style="text-align:center;margin:20px 0;font-size:39px;">My Detail Orders</h1>
        <div class="row">
            <div class="col-9">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            $total = 0;
                            while($oneOrder = mysqli_fetch_assoc($select_orders_detail)){
                                $i++;
                                $total += $oneOrder['total'];
                        ?>
                        <tr>
                            <th scope="row"><?=$i;?></th>
                            <td><?=$oneOrder['book']?></td>
                            <td class="price-font"><?=$oneOrder['quantity']?></td>
                            <td class="price-font"><?=number_format($oneOrder['subtotal'],0,',','.')?> VND</td>
                        </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td>Total:</td>
                            <td class="price-font" colspan="3"><?=number_format($total,0,',','.');?> VND</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
                if($one['payment_status'] != 'cancel'){
            ?>
            <div class="col-3">
                <div class="card rounded">
                    <h2 class="text-center mt-2">Handle</h2>
                    <div class="card-body d-flex justify-content-center">
                        <form action="" method="POST">
                            <input type="hidden" name="id_order" value="<?=$id?>">
                            <button type="submit" class="btn btn-primary" name="cancel-order" onclick="return confirm('Do you want cancel this order?')">Cancel Order</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
        <?php } ?>
    </div>
    <!-- <section class="placed-orders">


   <div class="box-container">

      <?php
        $select_book = mysqli_query($conn, "SELECT * FROM `confirm_order`WHERE user_id = '$user_id' ORDER BY order_date DESC") or die('query failed');
        if (mysqli_num_rows($select_book) > 0) {
            while ($fetch_book = mysqli_fetch_assoc($select_book)) {
        ?>
      <div class="box">
         <p> Order Date : <span><?php echo $fetch_book['order_date']; ?></span> </p>
         <p> Order Id : <span># <?php echo $fetch_book['order_id']; ?> </p>
         <p> Name : <span><?php echo $fetch_book['name']; ?></span> </p>
         <p> Mobile Number : <span><?php echo $fetch_book['number']; ?></span> </p>
         <p> Email Id : <span><?php echo $fetch_book['email']; ?></span> </p>
         <p> Address : <span><?php echo $fetch_book['address']; ?></span> </p>
         <p> Payment Method : <span><?php echo $fetch_book['payment_method']; ?></span> </p>
         <p> Your orders : <span><?php echo $fetch_book['total_books']; ?></span> </p>
         <p> Total price : <span> <?php echo $fetch_book['total_price']; ?> VND</span> </p>
         <p> Payment status : <span style="color:<?php if ($fetch_book['payment_status'] == 'pending') {
                                                        echo 'orange';
                                                    } else {
                                                        echo 'green';
                                                    } ?>;"><?php echo $fetch_book['payment_status']; ?></span> </p>
         <p><a href="invoice.php?order_id=<?php echo $fetch_book['order_id']; ?>" target="_blank">Print Recipt</a></p>
         </div>
         <form action="" method="POST">
         <input type="hidden" name="order_id" value="<?php echo $fetch_book['order_id']; ?>">
         </form>
      <?php
            }
        } else {
            echo '<p class="empty">You have not placed any order yet!!!!</p>';
        }
        ?>
   </div>

</section> -->








    <?php include 'index_footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>