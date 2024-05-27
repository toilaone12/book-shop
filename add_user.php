<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Cate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">
</head>
<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if(isset($_POST['add-user'])){
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $surname = $conn->real_escape_string($_POST['surname']);
    $email = $conn->real_escape_string($_POST['email']);
    $surname = $conn->real_escape_string($_POST['surname']);
    $password = $conn->real_escape_string($_POST['password']);
    $repassword = $conn->real_escape_string($_POST['re_password']);
    $role = $conn->real_escape_string($_POST['role']);
    if($password == $repassword){
        $insert = $conn->query("INSERT INTO `users_info` VALUES ('','$fullname','$surname','$email','$password','$role')");
        if($insert){
            $_SESSION['message'] = '<p class="text-success small">Insert User Success</p>';
        }else{
            $_SESSION['message'] = '<p class="text-danger small">Insert User Not Success</p>';
        }
    }else{
        $_SESSION['message'] = '<p class="text-danger small">Password Do Not Match</p>';
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

?>

<body>
    <?php include 'admin_header.php'; ?>
    <div class="wrapper">
        <?php include './admin_sidebar.php' ?>

        <div class="container-admin">
            <h1 class="title mb-2">Add User</h1>
            <?php
                $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
                if ($message) { 
                    echo $message;
                    $_SESSION['message'] = '';
                }
            ?>
            <a href="users_detail.php" class="btn btn-primary mb-4">Back To List User</a>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" require class="form-label">Fullname</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Enter Fullname" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="Surname" require class="form-label">Surname</label>
                            <input type="text" class="form-control" name="surname" placeholder="Enter Surname" id="Surname" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="Email" require class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" id="Email" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" require class="form-label">Role</label>
                            <select class="form-select" aria-label="Default select example" name="role">
                                <option selected value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="Password" require class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" id="Password" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ConfirmPassword" require class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="re_password" placeholder="Enter Confirm Password" id="ConfirmPassword" aria-describedby="emailHelp">
                        </div>
                    </div>
                </div>
                <button type="submit" name="add-user" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>