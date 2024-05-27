<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_POST['add_books'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $author = mysqli_real_escape_string($conn, $_POST['author']);
   $category = mysqli_real_escape_string($conn, $_POST['Category']);
   $price = $_POST['price'];
   $desc = mysqli_real_escape_string($conn, ($_POST['bdesc']));
   $img = $_FILES["image"]["name"];
   $img_temp_name = $_FILES["image"]["tmp_name"];
   $img_file = "./added_books/" . $img;
   $audio = $_FILES["audio"]["name"];
   $temp_audio = $_FILES['audio']['tmp_name'];
   $filenames = './audio_books/' . $audio;
   $date = date('Y-m-d H:i:s');

   if (empty($name)) {
      $message[] = 'Please Enter book name';
   } elseif (empty($author)) {
      $message[] = 'Please Enter author';
   } elseif (empty($price)) {
      $message[] = 'Please Enter book price';
   } elseif (empty($category)) {
      $message[] = 'Please Choose a category';
   } elseif (empty($desc)) {
      $message[] = 'Please Enter book descriptions';
   } elseif (empty($img)) {
      $message[] = 'Please Choose Image';
   } else {
      $add_book = mysqli_query($conn, "INSERT INTO book_info VALUES('','$name','$author','$price','$category','$desc','$img', '$audio', '$date')") or die('Query failed');

      if ($add_book) {
         move_uploaded_file($temp_audio, $filenames);
         move_uploaded_file($img_temp_name, $img_file);
         $message[] = 'New Book Added Successfully';
      } else {
         $message = 'Book Not Added Successfully';
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
   <link rel="stylesheet" href="./css/admin.css">
   <link rel="stylesheet" href="./css/register.css">
   <link rel="stylesheet" href="./css/custom.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <title>Add Books</title>
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
              <div class="message" id="messages"><span>' . $message . '</span>
              </div>
              ';
            }
         }
         ?>
      
         <a class="update_btn" style="position: fixed ; z-index:100;" href="total_books.php">See All Books</a>
         <div class="container-book">
            <form action="" method="POST" enctype="multipart/form-data">
               <h3>Add Books To <a href="index.php"><span>MuseBook & </span><span>Chill</span></a></h3>
               <div class="row" style="margin-top: 50px;">
                  <div class="col-6">
                     <div class="form-group">
                        <label for="">Book Name</label>
                        <input type="text" name="name" placeholder="Enter Book Name" class="form-control-book">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="">Author Name</label>
                        <input type="text" name="author" placeholder="Enter Author Name" class="form-control-book">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" min="0" name="price" placeholder="Enter Price" class="form-control-book">
                     </div>
                  </div>
                  <div class="col-3">
                     <div class="form-group">
                        <label for="">Category</label>
                        <select name="Category" id="" required class="form-control-book">
                           <?php
                              $listParent = $conn->query("SELECT * FROM category WHERE id_parent = 0");
                              while($oneParent = $listParent->fetch_assoc()){
                           ?>
                           <option value="<?=$oneParent['id_category']?>"><?=$oneParent['name']?></option>
                           <?php
                              $listChild = $conn->query("SELECT * FROM category WHERE id_parent = ".$oneParent['id_category']);
                              while($oneChild = $listChild->fetch_assoc()){
                           ?>
                           <option value="<?=$oneChild['id_category']?>">|---<?=$oneChild['name']?></option>
                           <?php
                              }
                           ?>
                           <?php
                              }
                           ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="bdesc" placeholder="Enter book description" id="" class="form-control-book" cols="18" rows="5"></textarea>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                              <label for="" class="form-label">Image</label>
                              <div class="custom-file">
                                 <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="custom-file-input">
                                 <label for="" class="custom-file-label">Chose file</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group">
                              <label for="" class="form-label">Audio</label>
                              <div class="custom-file">
                              <label for="">Audio</label>
                                 <input type="file" name="audio" accept="audio/mp3" class="custom-file-input" style="top: -18px;">
                                 <label for="" class="custom-file-label">Chose file</label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <input type="submit" value="Submit" name="add_books" class="btn btn-primary">
            </form>
         </div>
      </div>
   </div>

   <script src="./js/admin.js"></script>
   <script>
      setTimeout(() => {
         const box = document.getElementById('messages');

         // 👇️ hides element (still takes up space on page)
         box.style.display = 'none';
      }, 8000);
   </script>
</body>

</html>