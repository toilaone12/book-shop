<?php include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
}

if (isset($_POST['order'])) {
  $name = mysqli_real_escape_string($conn, $_POST['firstname']);
  $number = $_POST['number'];
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $method = mysqli_real_escape_string($conn, $_POST['method']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $placed_on = date('d-m-Y');
  $cart_total = 0;
  $cart_products[] = '';
  if (empty($name)) {
    $_SESSION['message'] = 'Please Enter Your Name';
  } elseif (empty($email)) {
    $_SESSION['message'] = 'Please Enter Email Id';
  } elseif (empty($number)) {
    $_SESSION['message'] = 'Please Enter Mobile Number';
  } elseif (empty($address)) {
    $_SESSION['message'] = 'Please Enter Address';
  } else {
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
      while ($cart_item = mysqli_fetch_assoc($cart_query)) {
        $cart_products[] = $cart_item['name'] . ' #' . $cart_item['book_id'] . ',(' . $cart_item['quantity'] . ') ';
        $quantity = $cart_item['quantity'];
        $unit_price = $cart_item['price'];
        $cart_books = $cart_item['name'];
        $sub_total = ($cart_item['price'] * $cart_item['quantity']);
        $cart_total += $sub_total;
      }
    }


    $total_books = implode(' ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `confirm_order` WHERE name = '$name' AND number = '$number' AND email = '$email' AND payment_method = '$method' AND address = '$address' AND total_books = '$total_books' AND total_price = '$cart_total'") or die('query failed');


    if (mysqli_num_rows($order_query) > 0) {
      $_SESSION['message'] = 'order already placed!';
    } else {
      $insert = mysqli_query($conn, "INSERT INTO `confirm_order`(user_id, name, number, email, payment_method,address,total_books, total_price, order_date) VALUES('$user_id','$name', '$number', '$email','$method', '$address', '$total_books', '$cart_total', '$placed_on')") or die('query failed');
      $conn_oid = $conn->insert_id;
      $_SESSION['id'] = $conn_oid;
      $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
          $cart_products[] = $cart_item['name'] . ' #' . $cart_item['book_id'] . ',(' . $cart_item['quantity'] . ') ';
          $quantity = $cart_item['quantity'];
          $unit_price = $cart_item['price'];
          $cart_books = $cart_item['name'];
          $sub_total = ($cart_item['price'] * $cart_item['quantity']);
          $cart_total += $sub_total;
          mysqli_query($conn, "INSERT INTO `orders` VALUES('','$conn_oid','$user_id','$cart_books','$quantity','$unit_price','$sub_total')") or die('insert failed');
        }
      }
      $_SESSION['message'] = 'Order placed successfully!';
      mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    }
    header('Location: '.$_SERVER['PHP_SELF']);
    exit;
  }
}

?>



<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="./css/hello.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <?php include 'index_header.php'; ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <?php
  $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
  if ($message) {
      echo "<script>$(document).ready(function() {
          toastr.success('".$message."', 'Success');
      })</script>";
      $_SESSION['message'] = '';
  }
  ?>

  <h1 style="text-align: center; margin-top: 15px;  color:rgb(9, 152, 248);">Place Your Order Here</h1>
  <p style="text-align: center; ">Just One Step away from getting your books</p>
  <div class="row">
    <div class="col-12">
      <div class="container">
        <form action="" method="POST">
          <div class="row">
            <div class="col-7">
              <h3>Billing Address</h3>
              <div class="form-group mb-3">
                <label for="fname" class="small">Full Name</label>
                <input type="text" id="fname" name="firstname" class="form-control price-font" required placeholder="Pawan Mishra">
              </div>
              <div class="form-group mb-3">
                <label for="email" class="small">Email</label>
                <input type="email" id="email" name="email" class="form-control price-font" required placeholder="example@gmail.com">
              </div>
              <div class="form-group mb-3">
                <label for="phone" class="small">Number</label>
                <input type="phone" id="phone" class="form-control price-font" name="number" required placeholder="+84399311233">
              </div>
              <div class="form-group mb-3">
                <label for="adr" class="small">Address</label>
                <input type="text" id="adr" class="form-control price-font" name="address" required placeholder="30 Hoang Hoa Tham, Ba Dinh, Ha Noi">
              </div>
              <label>
                <input type="checkbox" name="sameadr" required> Shipping address same as billing
              </label>
              <button type="submit" name="order" class="btn btn-primary d-block w-25 mt-3 rounded">
                Order
              </button>
            </div>
            <div class="col-5">
              <div class="col-25">
                <div class="container">
                  <h4>Books In Cart</h4>
                  <?php
                  $grand_total = 0;
                  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = $user_id") or die('query failed');
                  if (mysqli_num_rows($select_cart) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                      $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                      $grand_total += $total_price;
                  ?>
                      <p>
                        <a href="book_details.php?details=<?php echo $fetch_cart['book_id']; ?>"><?php echo $fetch_cart['name']; ?>
                      </a>
                      <span class="price price-font">(<?php echo number_format($fetch_cart['price'], 0, ',', '.') . ' VND' . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
                  <?php
                    }
                  } else {
                    echo '<p class="empty">Your cart is empty, please purchase</p>';
                  }
                  ?>
                  <hr>
                  <p>Grand total : <span class="price" style="color:black"><b class="price-font"><?php echo number_format($grand_total, 0, ',', '.'); ?> VND</b></span></p>
                </div>
              </div>
              <div style="margin: 20px;">
                <h3>Payment </h3>
                <label for="fname">Accepted Payment Gateways</label>
                <div>
                  <i class="fa-brands fa-cc-visa" style="color:navy;font-size: 30px;margin-right:5px;"></i>
                  <i class="fa-brands fa-cc-amazon-pay" style="font-size: 30px;margin-right:5px;"></i>
                  <i class="fa-brands fa-google-pay" style="color:red;font-size: 30px;margin-right:5px;"></i>
                  <i class="fa-brands fa-cc-paypal" style="color:#3b7bbf;font-size: 30px;margin-right:5px;"></i>
                </div>
                <div class="form-group">
                  <label for="method">Choose Payment Method :</label>
                  <select name="method" id="method" class="form-control">
                    <option value="Cash on delivery">Cash on delivery</option>
                    <option value="Debit card">Debit card</option>
                    <option value="Amazon Pay">Amazon Pay</option>
                    <option value="Paypal">Paypal</option>
                    <option value="Google Pay">Google Pay</option>
                  </select>
                </div>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
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