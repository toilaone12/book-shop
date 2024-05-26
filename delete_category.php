<?php
    include 'config.php';
    session_start();
    if(isset($_GET['id']) && $_GET['id']){
        $id = intval($_GET['id']);
        $delete = $conn->query("DELETE FROM category WHERE id_category = $id");
        if($delete){
            $_SESSION['message'] = '<p class="text-success small">Delete Category Success</p>';
        }else{
            $_SESSION['message'] = '<p class="text-danger small">Delete Category Not Success</p>';
        }
        header('Location: list_category.php');
        exit;
    }
?>