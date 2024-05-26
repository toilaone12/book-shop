<?php
include 'config.php';
session_start();

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $select_users = $conn->query("SELECT * FROM users_info WHERE email = '$email' and password='$password'") or die('query failed');
    // var_dump("SELECT * FROM users_info WHERE email = '$email' and password='$password' "); die;
    if (mysqli_num_rows($select_users) == 1) {

        $row = mysqli_fetch_assoc($select_users);

        if ($row['user_type'] == 'Admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['Id'];
            header('location:admin_index.php');
        } elseif ($row['user_type'] == 'User') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['Id'];
            header('location:index.php');
        }
    } else {
        $message[] = 'Incorrect Email Id or Password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/register.css" />
    <title>Login Here</title>
    <style>
        .container form .link {
            text-decoration: none;
            color: #fff;
            margin: 0px 10px;
            font-size: 16px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <h3 style="color:white">login to <a href="index.php"><span>musebook & </span><span style="color:#f8b02d">Chill</span></a></h3>
            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '
                <div class="noti"><span>' . $message . '</span>
                </div>
                ';
                }
            }
            ?>
            <input type="email" name="email" placeholder="Enter Email Id" required class="text_field mt-20">
            <input type="password" name="password" placeholder="Enter password" required class="text_field">
            <input type="submit" value="Login" name="login" class="btn text_field mt-20 w-15">
            <p>Don't have an Account?</p>
            <div class="btn-link">
                <a class="link" href="Register.php">Sign Up</a><a class="link" href="index.php">Back To Homepage</a>
            </div>
        </form>
    </div>


    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            // 👇️ hides element (still takes up space on page)
            box.style.display = 'none';
        }, 8000);
    </script>
</body>

</html>