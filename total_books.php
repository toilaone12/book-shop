<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (isset($_GET['delete'])) {
   $id = $_GET['id'];
   mysqli_query($conn, "DELETE FROM `book_info` WHERE bid = '$id'") or die('query failed');
   header('location:total_books.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./css/register.css">
   <link rel="stylesheet" href="./css/admin.css">
   <link rel="stylesheet" href="./css/custom.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <title>List Books</title>
</head>

<body>
   <?php include './admin_header.php' ?>
   <div class="wrapper">
      <?php include './admin_sidebar.php' ?>
      <div class="container-admin">
         <?php
         if (isset($message)) {
            foreach ($message as $message) {
               echo '
              <div class="message"><span>' . $message . '</span><i onclick="this.parentElement.remove();">Close</i>
              </div>
              ';
            }
         }
         ?>
         <a class="update_btn" style="position: fixed ; z-index:100;" href="add_books.php">Add More Books</a>
      
         <section class="show-products">
            <div class="row">
               <?php
               $select_book = mysqli_query($conn, "SELECT * FROM `book_info` ORDER BY date DESC") or die('query failed');
               if (mysqli_num_rows($select_book) > 0) {
                  while ($fetch_book = mysqli_fetch_assoc($select_book)) {
               ?>
                  <div class="col-4 mb-20">
                     <div class="box card-book">
                        <div class="card-header-book">
                           <img class="books_images image-book" src="added_books/<?php echo $fetch_book['image']; ?>" alt="">
                        </div>
                        <div class="card-body-book">
                           <div class="name"> <?php echo $fetch_book['name']; ?></div>
                           <div class="price price-font">Price: <?php echo number_format($fetch_book['price'], 0, ',', '.'); ?> VND</div>
                           <div class="btn-hover-function">
                              <div class="btn-function">
                                 <a href="update_book.php?id=<?php echo $fetch_book['bid']; ?>" class="update_btn btn-detail">Update Book</a>
                                 <a href="total_books.php?id=<?php echo $fetch_book['bid'].'&delete=1'; ?>" onclick="return confirm('Do you want delete this book?')" class="update_btn btn-detail">Delete Book</a>
                              </div>
                           </div>
                        </div>
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
      </div>
   </div>

   <script src="./js/admin.js"></script>
</body>

</html>