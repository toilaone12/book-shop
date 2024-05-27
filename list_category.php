<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Category</title>
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

$listCategory = $conn->query("SELECT * FROM category");

?>

<body>
    <?php include 'admin_header.php'; ?>
    <div class="wrapper">
        <?php include './admin_sidebar.php' ?>
        <div class="container-admin">
            <h1 class="title mb-2">List Category</h1>
            <?php
                $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
                if ($message) { 
                    echo $message;
                    $_SESSION['message'] = '';
                }
            ?>
            <a href="add_category.php" class="btn btn-primary mb-4">Add Category</a>
            <table class="table table-primary table-hover">
                <thead>
                    <tr>
                        <th scope="col">Number ID</th>
                        <th scope="col">Name Category</th>
                        <th scope="col">Name Parent</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($listCategory->num_rows){
                            $i = 0;
                            while($row = $listCategory->fetch_assoc()){
                                $i++;
                    ?>
                    <tr>
                        <th scope="row"><?=$i?></th>
                        <td><?=$row['name']?></td>
                        <td>
                            <?php
                                if($row['id_parent'] == 0){
                            ?>
                            No parent
                            <?php
                                }else{
                                    $listParent = $conn->query("SELECT * FROM category WHERE id_category = ".$row['id_parent']);
                                    $rowParent = $listParent->fetch_assoc();
                                    echo $rowParent['name'];
                                }
                            ?>
                        </td>
                        <td>
                            <a href="update_category.php?id=<?=$row['id_category']?>" class="btn btn-primary d-block w-25 mb-2 rounded"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="delete_category.php?id=<?=$row['id_category']?>" onclick="return confirm('Do you want delete this category?');" class="btn btn-danger d-block w-25 mb-2 rounded"><i class="fa-regular fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php 
                            }
                        }else{ 
                    ?>
                    <tr>
                        <td colspan="4" align="center">No records</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>