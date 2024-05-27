<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($user_id)) {
    header('location:login.php');
}


if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id='$remove_id'") or die('query failed');
    $message[] = 'Removed Successfully';
    header('location:cart.php');
}
if (isset($_POST['update'])) {
    $update_cart_id = $_POST['cart_id'];
    $book_price = $_POST['book_price'];
    $update_quantity = $_POST['update_quantity'];
    $total_price = $book_price * $update_quantity;
    mysqli_query($conn, "UPDATE `cart` SET `quantity`='$update_quantity', `total`='$total_price' WHERE `id`='$update_cart_id'") or die('query failed');

    $message[] = '' . $user_name . ' cart updated successfully';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/hello.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Cart</title>
    <style>
        .cart-btn1,
        .cart-btn2 {

            display: inline-block;
            margin: auto;
            padding: 0.8rem 1.2rem;
            cursor: pointer;
            color: white;
            font-size: 15px;
            border-radius: .5rem;
            text-transform: capitalize;
        }

        .cart-btn1 {
            margin-left: 40%;
            background-color: #ffa41c;
            color: black;
        }

        .cart-btn2 {
            background-color: rgb(0, 167, 245);
            color: black;
        }

        .message {
            position: sticky;
            top: 0;
            margin: 0 auto;
            width: 61%;
            background-color: #fff;
            padding: 6px 9px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 100;
            gap: 0px;
            border: 2px solid rgb(68, 203, 236);
            border-top-right-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .message span {
            font-size: 22px;
            color: rgb(240, 18, 18);
            font-weight: 400;
        }

        .message i {
            cursor: pointer;
            color: rgb(3, 227, 235);
            font-size: 15px;
        }
    </style>
</head>

<body>
    <?php
    include 'index_header.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <?php
    $total = 0;
    $select_book = $conn->query("SELECT id, name, price, image, quantity, total  FROM cart Where user_id= $user_id");
    ?>
    <div class="cart_form" style="height: calc(100vh - <?= $select_book->num_rows == 0 ? '460px' : '430px'?>);">
        <?php
        if (isset($message)) {
            foreach ($message as $mess) {
                echo "<script>$(document).ready(function() {
                    toastr.warning('".$mess."', 'Warning');
                })</script>";
            }
        }
        if ($select_book->num_rows  > 0) {
        ?>
        <table style="width: 70%; align-items:center; margin:10px auto;">
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>price</th>
                <th>Quatity</th>
                <th>Total (VND)</th>
            </thead>
            <tbody>
                <?php
                    while ($row = $select_book->fetch_assoc()) {
                ?>
                        <tr>
                            <td><img style="height: 90px;" src="./added_books/<?php echo $row['image']; ?>" alt=""></td>
                            <td><?php echo $row['name']; ?></td>
                            <td class="price-font"><?php echo number_format($row['price'], 0, ',', '.'); ?> VND</td>
                            <td>
                                <form action="" method="POST">
                                    <input type="number" name="update_quantity" min="1" max="100" value="<?php echo $row['quantity']; ?>">
                                    <input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
                                    <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $row['price'] ?>">
                                    <button class="btn-cart-update cart-btn2" name="update"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <a class="btn-cart-delete cart-btn2" href="cart.php?remove=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash"></i></a>
                                </form>


                            </td>
                            <td class="price-font"><?php $sub_total = $row['price'] * $row['quantity']; echo number_format($sub_total, 0, ',', '.'); ?> VND</td>
                        </tr>

                <?php
                        $total += $sub_total;
                    }
                ?>
                <tr>
                    <th style="text-align:center;" colspan="3">Total</th>
                    <th colspan="2" class="price-font"><?php echo number_format($total, 0, ',', '.'); ?> VND</th>

                </tr>


            </tbody>
        </table>
        <div class="mt-20">
            <a href="checkout.php" class="btn cart-btn1 text-white mr-10"> &nbsp; Proceed to Checkout</a> 
            <a class="cart-btn2 text-white" href="index.php">Continue Shoping</a>
        </div>
    </div>
    <?php
        } else {
    ?>
    <div class="no-cart">There is no cart, please click <a href="index.php">here</a> go to shopping
    </div>
    <?php
        }
    ?>
    </div>
    <?php include 'index_footer.php'; ?>

    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            // 👇️ hides element (still takes up space on page)
            box.style.display = 'none';
        }, 5000);
    </script>

</body>

</html>