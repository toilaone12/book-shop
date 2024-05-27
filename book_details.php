<?php
include 'config.php';
error_reporting(0);
session_start();

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {
    if (!isset($user_id)) {
        $message[] = 'Please Login to get your books';
    } else {
        $book_name = $_POST['book_name'];
        $book_id = $_POST['book_id'];
        $book_image = $_POST['book_image'];
        $book_price = $_POST['book_price'];
        $book_quantity = $_POST['quantity'];
        $total_price = $book_price * $book_quantity;
        $select_book = $conn->query("SELECT * FROM cart WHERE name= '$book_name' AND user_id='$user_id' ") or die('query failed');

        if (mysqli_num_rows($select_book) > 0) {
            $message[] = 'This Book is alredy in your cart';
        } else {
            $conn->query("INSERT INTO cart (`book_id`,`user_id`,`name`, `price`, `image`, `quantity` ,`total`) VALUES('$book_id','$user_id','$book_name','$book_price','$book_image','$book_quantity', '$total_price')") or die('Add to cart Query failed');
            $message[] = 'Book Added To Cart Successfully';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index_book.css">
    <link rel="stylesheet" href="./css/hello.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Selected Products</title>

    <style>
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
    if (isset($message) && $message) {
        foreach ($message as $mess) {
            // echo '<script>alert("'.$message.'")</script>';
            echo "<script>$(document).ready(function() {
                toastr.warning('".$mess."', 'Warning');
            })</script>";
        }
        unset($message);
    }
    ?>
    <div class="details">
        <?php
        if (isset($_GET['details'])) {
            $get_id = $_GET['details'];
            $get_book = mysqli_query($conn, "SELECT * FROM `book_info` WHERE bid = '$get_id'") or die('query failed');
            if (mysqli_num_rows($get_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($get_book)) {
        ?>
                    <div class="row_box">
                        <form style="display: flex ;" action="" method="POST">
                            <div class="col_box">
                                <img src="./added_books/<?php echo $fetch_book['image']; ?>" alt="<?php echo $fetch_book['name']; ?>">
                            </div>
                            <div class="col_box">
                                <h4>Author: <?php echo $fetch_book['author']; ?></h4>
                                <h1>Name: <?php echo $fetch_book['name']; ?></h1>
                                <h3>Book Details</h3>
                                <p><?php echo $fetch_book['description']; ?></p>
                                <h3>Audio</h3>
                                <div class="audio">
                                    <audio controls>
                                        <source src="./audio_books/<?= $fetch_book['audio'] ?>" type="audio/mpeg">
                                        Trình duyệt của bạn không hỗ trợ thẻ audio.
                                    </audio>
                                    <!-- <audio src="./audio_books/<?= $fetch_book['audio'] ?>"></audio> -->
                                </div>
                                <h3 class="price-font">Price: <?php echo number_format($fetch_book['price'], 0, ',', '.'); ?>VND</h3>
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity" value="1" min="1" max="10" id="quantity">
                                <div class="buttons">
                                    <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                                    <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bid'] ?>">
                                    <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                                    <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                                    <input type="submit" name="add_to_cart" value="Buy" class="btn-cart btn-hover">
                                    <!-- <input type="submit" name="add_to_cart" value="Add to cart" class="btn"> -->
                                    <button name="add_to_cart" class="btn-icon-cart btn-hover"><i class="fa-solid fa-cart-plus"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
        <?php
                }
            }
        } else {
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        }
        ?>
    </div>
    <script src="./js/admin.js"></script>
    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            // 👇️ hides element (still takes up space on page)
            box.style.display = 'none';
        }, 5000);
    </script>
</body>

</html>