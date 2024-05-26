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
        $book_quantity = '1';

        $total_price = number_format($book_price * $book_quantity);

        $select_book = $conn->query("SELECT * FROM cart WHERE book_id= '$book_id' AND user_id='$user_id' ") or die('query failed');

        if (mysqli_num_rows($select_book) > 0) {
            $message[] = 'This Book is alredy in your cart';
        } else {
            $conn->query("INSERT INTO cart (`user_id`,`book_id`,`name`, `price`, `image`,`quantity` ,`total`) VALUES('$user_id','$book_id','$book_name','$book_price','$book_image','$book_quantity', '$total_price')") or die('Add to cart Query failed');
            $message[] = 'Book Added To Cart Successfully';
            header('location:index.php');
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
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
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 img-banner" src="https://booksandbao.com/wp-content/uploads/2020/11/kitazawa-bookstore-feature-1000x563.jpg" alt="First slide">
            </div>

            <div class="carousel-item">
                <img class="d-block w-100 img-banner" src="https://a0.cdn.japantravel.com/photo/66517-222090/1440x960!/tokyo-infinity-books-tokyo-used-bookshop-222090.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 img-banner" src="https://a2.cdn.japantravel.com/photo/15405-92003/800!/osaka-standard-bookstore-92003.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section id="New">

        <div class="container px-5 mx-auto">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 " style="color: rgb(0, 167, 245);">
                Top book
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">

            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `book_info` ORDER BY date DESC LIMIT 8") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
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
                            <div class="price">Price: <?php echo number_format($fetch_book['price'], 0, ',', '.'); ?> VND</div>
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
                        <!-- <button name="add_to_cart" ><img src="./images/cart2.png" alt="Add to cart"></button> -->
                        <!-- <input type="submit" name="add_cart" value="cart"> -->
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <section id="Adventure">
        </div>

        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Adventure
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">

            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `book_info` where category='Adventure'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>

                    <div class="box" style="width: 255px;height: 355px;">
                        <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                            echo '-name=', $fetch_book['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;" class="books_images" src="added_books/<?php echo $fetch_book['image']; ?>" alt=""></a>
                        <div style="text-align:left ;">

                            <div style="font-weight: 500; font-size:18px; text-align: center; " class="name"> <?php echo $fetch_book['name']; ?></div>
                        </div>
                        <div class="price">Price: <?php echo number_format($fetch_book['price'], 0, ',', '.'); ?>VND</div>
                        <!-- <button name="add_cart"><img src="./images/cart2.png" alt=""></button> -->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                                    echo '-name=', $fetch_book['name']; ?>" class="update_btn">Read >></a>
                        </form>
                        <!-- <button name="add_to_cart" ><img src="./images/cart2.png" alt="Add to cart"></button> -->
                        <!-- <input type="submit" name="add_cart" value="cart"> -->
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <hr style="color: black; width:5px;">
    <section id="Magical">

        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Magical
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">

            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `book_info` where category='Magic'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>

                    <div class="box" style="width: 255px;height: 355px;">
                        <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                            echo '-name=', $fetch_book['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;" class="books_images" src="added_books/<?php echo $fetch_book['image']; ?>" alt=""></a>
                        <div style="text-align:left ;">

                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name"> <?php echo $fetch_book['name']; ?></div>
                        </div>
                        <div class="price">Price: <?php echo number_format($fetch_book['price'], 0, ',', '.'); ?>VND</div>
                        <!-- <button name="add_cart"><img src="./images/cart2.png" alt=""></button> -->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                                    echo '-name=', $fetch_book['name']; ?>" class="update_btn">Read >></a>
                        </form>
                        <!-- <button name="add_to_cart" ><img src="./images/cart2.png" alt="Add to cart"></button> -->
                        <!-- <input type="submit" name="add_cart" value="cart"> -->
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <section id="Knowledge">

        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Knowledge
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">

            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `book_info` Where category='knowledge'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>

                    <div class="box" style="width: 255px;height: 355px;">
                        <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                            echo '-name=', $fetch_book['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;" class="books_images" src="added_books/<?php echo $fetch_book['image']; ?>" alt=""></a>
                        <div style="text-align:left ;">

                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name"> <?php echo $fetch_book['name']; ?></div>
                        </div>
                        <div class="price">Price: <?php echo number_format($fetch_book['price'], 0, ',', '.'); ?>VND</div>
                        <!-- <button name="add_cart"><img src="./images/cart2.png" alt=""></button> -->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                                    echo '-name=', $fetch_book['name']; ?>" class="update_btn">Read >></a>
                        </form>
                        <!-- <button name="add_to_cart" ><img src="./images/cart2.png" alt="Add to cart"></button> -->
                        <!-- <input type="submit" name="add_cart" value="cart"> -->
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