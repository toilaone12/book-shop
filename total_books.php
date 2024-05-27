<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `book_info` WHERE bid = '$delete_id'") or die('query failed');
   header('location:total_books.php');
}


if (isset($_POST['update_product'])) {

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_title = $_POST['update_title'];
   $update_description = $_POST['update_description'];
   $update_price = $_POST['update_price'];
   $update_category = $_POST['update_category'];

   mysqli_query($conn, "UPDATE `book_info` SET name = '$update_name', title='$update_title', description ='$update_description', price = '$update_price', category='$update_category' WHERE bid = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = './added_books/' . $update_image;
   $update_old_image = $_POST['update_old_image'];

   if (!empty($update_image)) {
      if ($update_image_size > 2000000) {
         $message[] = 'image file size is too large';
      } else {
         mysqli_query($conn, "UPDATE `book_info` SET image = '$update_image' WHERE bid = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/' . $update_old_image);
      }
   }

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
      
         <section class="edit-product-form">
            <?php
            if (isset($_GET['update'])) {
               $update_id = $_GET['update'];
               $update_query = mysqli_query($conn, "SELECT * FROM `book_info` WHERE bid = '$update_id'") or die('query failed');
               if (mysqli_num_rows($update_query) > 0) {
                  while ($fetch_update = mysqli_fetch_assoc($update_query)) {
            ?>
                     <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['bid']; ?>">
                        <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                        <img src="./added_books/<?php echo $fetch_update['image']; ?>" alt="">
                        <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Enter Book Name">
                        <input type="text" name="update_title" value="<?php echo $fetch_update['title']; ?>" class="box" required placeholder="Enter Author Name">
                        <select name="update_category" value="<?php echo $fetch_update['category']; ?> required class=" text_field">
                           <option value="Adventure">Adventure</option>
                           <option value="Magic">Magic</option>
                           <option value="knowledge">knowledge</option>
                        </select>
                        <input type="text" name="update_description" value="<?php echo $fetch_update['description']; ?>" class="box" required placeholder="enter product description">
                        <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
                        <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                        <input type="submit" value="update" name="update_product" class="delete_btn">
                        <input type="reset" value="cancel" id="close-update" class="update_btn">
                     </form>
            <?php
                  }
               }
            } else {
               echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
            }
            ?>
      
         </section>
      
         <section class="show-products">
            <div class="row">
               <?php
               $select_book = mysqli_query($conn, "SELECT * FROM `book_info` ORDER BY date DESC") or die('query failed');
               if (mysqli_num_rows($select_book) > 0) {
                  while ($fetch_book = mysqli_fetch_assoc($select_book)) {
               ?>
                  <div class="col-3 mb-20">
                     <div class="box card-book">
                        <div class="card-header-book">
                           <img class="books_images image-book" src="added_books/<?php echo $fetch_book['image']; ?>" alt="">
                        </div>
                        <div class="card-body-book">
                           <div class="name"> <?php echo $fetch_book['name']; ?></div>
                           <div class="price price-font">Price: <?php echo number_format($fetch_book['price'], 0, ',', '.'); ?> VND</div>
                           <div class="btn-hover-function">
                              <div class="btn-function">
                                 <a href="book_details.php?details=<?php echo $fetch_book['bid'].'&name='.$fetch_book['name']; ?>" class="update_btn btn-detail">View Details</a>
                                 <button onclick="myFunction()" name="add_to_cart" class="btn-add-cart"><i class="fa-solid fa-cart-shopping"></i></button>
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