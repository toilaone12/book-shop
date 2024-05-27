<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $id = $_GET['id'];
   mysqli_query($conn, "DELETE FROM `msg` WHERE id = '$id'") or die('Delete message failed');
   header('location:message_admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Message</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="./css/register.css">
   <link rel="stylesheet" href="./css/admin.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>
   <div class="wrapper">
      <?php include './admin_sidebar.php' ?>
      <?php
      if (isset($message)) {
         foreach ($message as $message) {
            echo '
         <div class="message" id= "messages"><span>' . $message . '</span>
         </div>
         ';
         }
      }
      ?>
      <div class="container-admin">
         <h1 class="title mb-20">List Message</h1>
         <?php
         $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
         if ($message) {
            echo $message;
            $_SESSION['message'] = '';
         }
         $listMessage = mysqli_query($conn, "SELECT * FROM `msg`") or die('Query message failed');
         if (mysqli_num_rows($listMessage) > 0) {
         ?>
            <div class="row">
               <?php
               while ($one = mysqli_fetch_assoc($listMessage)) {
               ?>
                  <div class="col-12 mb-20">
                     <div class="card-dashboard card-user-admin">
                        <div class="card-icon-admin rounded-circle">
                            <i class="fa-solid fa-comment text-dark"></i>
                        </div>
                        <div class="card-body border-left-dark">
                           <div class="d-flex align-items-center">
                              <h6 class="card-title text-dark mr-10 price-font">Fullname: <?= $one['name'] ?></h6>
                              <h6 class="card-title text-dark price-font">Email: <?= $one['email'] ?></h6>
                           </div>
                           <h6 class="card-title text-dark price-font">Phone Number: <?= $one['number'] ?></h6>
                           <div class="d-flex align-items-center">
                              <h6 class="card-title text-dark price-font mr-10">Replied: <?= $one['msg']?></h6>
                           </div>
                           <h6 class="card-title text-dark price-font">Day Replied: <?= date('d/m/y H:i',strtotime($one['date']))?></h6>
                           <div class="buttons" style="display: flex;">
                              <a href="message_admin.php?id=<?= $one['id'] ?>&delete=1" class="ml-0 btn btn-primary">Delete</a>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php
               }
               ?>
            <?php
         } else {
            ?>
               <div style="text-align: center; font-size: 32px;"><i class="fa-solid fa-comment text-dark" style="margin-right: 10px;"></i>No record message</div>
            <?php
         }
            ?>
            </div>
      </div>
   </div>



   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
   <script>
      setTimeout(() => {
         const box = document.getElementById('messages');

         // 👇️ hides element (still takes up space on page)
         box.style.display = 'none';
      }, 8000);
   </script>

</body>

</html>