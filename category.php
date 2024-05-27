<?php
include 'config.php';

error_reporting(0);
session_start();

$user_id = $_SESSION['user_id'];
$id = isset($_GET['id']) && $_GET['id'] ? intval($_GET['id']) : 0;
$page = isset($_GET['page']) && $_GET['page'] ? intval($_GET['page']) : 0;
$select = $conn->query("SELECT * FROM category WHERE id_category = ".$id);
$oneItem = $select->fetch_assoc();
$selectBook = $conn->query("SELECT * FROM book_info WHERE id_category = ".$oneItem['id_category']." ORDER BY bid desc LIMIT ".($page * 10).",10");
if (isset($_POST['add_to_cart'])) {
    if (!isset($user_id)) {
        $message[] = 'Please Login to get your books';
    } else {
        $book_name = $_POST['book_name'];
        $book_id = $_POST['book_id'];
        $book_image = $_POST['book_image'];
        $book_price = $_POST['book_price'];
        $book_quantity = '1';

        $total_price = $book_price * $book_quantity;

        $select_book = $conn->query("SELECT * FROM cart WHERE book_id= '$book_id' AND user_id='$user_id' ") or die('query failed');

        if (mysqli_num_rows($select_book) > 0) {
            $message[] = 'This Book is alredy in your cart';
        } else {
            $conn->query("INSERT INTO cart (`user_id`,`book_id`,`name`, `price`, `image`,`quantity` ,`total`) VALUES('$user_id','$book_id','$book_name','$book_price','$book_image','$book_quantity', '$total_price')") or die('Add to cart Query failed');
            $message[] = 'Book Added To Cart Successfully';
            header('location:cart.php');
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
    <link rel="stylesheet" href="css/hello.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>MuseBook-Listen</title>
    <style>
        .toast-message {
            color: white !important;
        }
        .toast-title {
            color: white !important;
        }

        img {
            border: none;
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
    <?php include 'index_header.php' ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    <section id="New">
        <div class="container px-5 mx-auto">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 " style="color: rgb(0, 167, 245);">
                <?=$oneItem['name']?>
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">
            <?php
                if (mysqli_num_rows($selectBook) > 0) {
                    while ($fetch_book = mysqli_fetch_assoc($selectBook)) {
            ?>
                    <div class="box card-book">
                        <div class="card-header-book">
                            <a href="book_details.php?details=<?php echo $fetch_book['bid'].'&name='.$fetch_book['name']; ?>"> 
                                <img class="books_images image-book" src="added_books/<?php echo $fetch_book['image']; ?>" alt="">
                            </a>
                        </div>
                        <div class="card-body-book">
                            <div style="text-align:left;">
                                <div class="name"> <?php echo $fetch_book['name']; ?></div>
                            </div>
                            <div class="price price-font">Price: <?php echo number_format($fetch_book['price'], 0, ',', '.'); ?> VND</div>
                            <!-- <button name="add_cart"><img src="./images/cart2.png" alt=""></button> -->
                            <form action="" method="POST">
                                <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                                <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bid'] ?>">
                                <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                                <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                                <div class="btn-function">
                                    <a href="book_details.php?details=<?php echo $fetch_book['bid'].'&name='.$fetch_book['name']; ?>" class="update_btn btn-detail">View Details</a>
                                    <button onclick="myFunction()" name="add_to_cart" class="btn-add-cart"><i class="fa-solid fa-cart-shopping"></i></button>
                                </div>
                            </form>
                        </div>

                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <?php include 'index_footer.php'; ?>

    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            // 👇️ hides element (still takes up space on page)
            box.style.display = 'none';
        }, 8000);
    </script>


</body>

</html>