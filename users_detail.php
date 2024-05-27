<?php
include 'config.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/index_book.css">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title> User Data</title>
</head>

<body>
    <?php include './admin_header.php' ?>
    <div class="wrapper">
        <?php include './admin_sidebar.php' ?>
        <div class="container-admin">
            <h1 class="title mb-2">List User</h1>
            <?php
                $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
                if ($message) { 
                    echo $message;
                    $_SESSION['message'] = '';
                }
            ?>
            <a href="add_user.php" class="btn btn-primary ml-0 mb-20">Add User</a>
            <div class="row">
                <?php
                $select_user = mysqli_query($conn, "SELECT * FROM users_info") or die('query failed');
                if (mysqli_num_rows($select_user) > 0) {
                    while ($one = mysqli_fetch_assoc($select_user)) {
                ?>
                <div class="col-12 mb-20">
                    <div class="card-dashboard card-user-admin">
                        <div class="card-icon-admin rounded-circle">
                            <i class="fa-solid fa-user text-dark"></i>
                        </div>
                        <div class="card-body border-left-dark">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title text-dark">Fullname: <?=$one['name']?></h5>
                                <h6 class="card-title text-dark">Surname: <?=$one['surname']?></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title text-dark">Email: <?=$one['email']?></h5>
                                <h6 class="card-title text-dark">Role: <span style="color: <?=$one['user_type'] == 'Admin' ? 'red' : 'darkcyan'?>"><?=$one['user_type']?></span></h6>
                            </div>
                            <div class="buttons" style="display: flex;">
                                <a href="update_user.php?id=<?=$one['Id']?>" class="ml-0 btn btn-primary">Update User</a>
                                <a href="delete_user.php?id=<?=$one['Id']?>" onclick="return confirm('Do you want to delete this user');" class="btn btn-list-book">Delete User</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('#close-update_user').onclick = () => {
            document.querySelector('.edit-product-form').style.display = 'none';
            window.location.href = 'users_detail.php';
        }
    </script>

</body>

</html>