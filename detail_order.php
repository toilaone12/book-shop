<?php

include 'config.php';
session_start();

$id = isset($_GET['id']) && $_GET['id'] ? intval($_GET['id']) : 0;
if (!$id) {
    header('location:orders.php');
}
if(isset($_GET['status']) && $_GET['status']){
    $idOrder = $_GET['id'];
    $status = $_GET['status'];
    $update = $conn->query("UPDATE `confirm_order` SET payment_status = '$status' WHERE order_id = $idOrder");
    if($update){
        $_SESSION['message'] = ucfirst($status).' Success';
    }else{
        $_SESSION['message'] = ucfirst($status).' Failed';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js" integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="wrapper">
        <?php include './admin_sidebar.php' ?>
        <?php
        $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
        if ($message) {
            echo "<script>$(document).ready(function() {
                toastr.success('".$message."','Success');
            })</script>";
            $_SESSION['message'] = '';
        }
        ?>
        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `confirm_order` WHERE order_id = " . $id) or die('query failed');
        $one = mysqli_fetch_assoc($select_orders);
        $select_orders_detail = mysqli_query($conn, "SELECT * FROM `orders` WHERE id_order = " . $id) or die('query failed');
        ?>
        <div class="container-admin">
            <?php
                if (mysqli_num_rows($select_orders_detail) > 0) {
            ?>
            <h1 class="title" style="text-align:center;margin:20px 0;font-size:39px;">My Detail Orders</h1>
            <div class="row">
                <div class="col-9">
                    <table class="table table-striped table-bordered form-pdf">
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
                <div class="col-3">
                    <div class="card rounded" style="height: 100% !important;">
                        <h4 class="text-center mt-2">Handle</h4>
                        <div class="mx-3 mt-3">
                            <?php
                                if($one['payment_status'] != 'cancel'){
                            ?>
                            <a href="detail_order.php?id=<?=$id?>&status=pending" class="<?=$one['payment_status'] == 'pending' ? 'disabled' : ''?> btn d-block btn-warning mb-2">Pending</a>
                            <a href="detail_order.php?id=<?=$id?>&status=complete" class="<?=$one['payment_status'] == 'complete' ? 'disabled' : ''?> btn d-block btn-primary mb-2">Complete</a>
                            <?php
                                }
                            ?>
                            <a class="btn d-block btn-success print-invoice">Print Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

</body>
<script>
    $(document).ready(function(){
        $('.print-invoice').on('click', function(){
            $('.form-pdf').print();
        })
    })
</script>
</html>