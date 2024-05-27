<?php 
    require_once 'config.php';
    session_start();
    if (isset($_GET['id']) && $_GET['id']) {
        $id = $_GET['id'];
        $delete = mysqli_query($conn, "DELETE FROM `users_info` WHERE Id = '$id'") or die('query failed');
        if($delete){
            $_SESSION['message'] = '<p class="text-success small">Delete User Success</p>';
        }else{
            $_SESSION['message'] = '<p class="text-danger small">Delete User Not Success</p>';
        }
        header('Location: users_detail.php');
        exit;
    }
?>