<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Cate</title>
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
$id = isset($_GET['id']) && $_GET['id'] ? intval($_GET['id']) : intval($_POST['id']);
$queryOne = $conn->query("SELECT * FROM category WHERE id_category = $id");
$oneItem = $queryOne->fetch_assoc();
$listCategory = $conn->query("SELECT * FROM category WHERE id_parent = 0");
if(isset($_POST['update-category']) && $_POST['name_category']){
    // var_dump($id); die;
    $nameCategory = $conn->real_escape_string($_POST['name_category']);
    $idParent = $conn->real_escape_string($_POST['id_parent']);
    $update = $conn->query("UPDATE `category` SET name = '$nameCategory', id_parent = $idParent WHERE id_category = $id");
    if($update){
        $_SESSION['message'] = '<p class="text-success small">Update Category Success</p>';
    }else{
        $_SESSION['message'] = '<p class="text-danger small">Update Category Not Success</p>';
    }
    header('Location: ' . $_SERVER['PHP_SELF'] . '?id='.$id);
    exit;
}

?>

<body>
    <?php include 'admin_header.php'; ?>
    <div class="wrapper">
        <?php include './admin_sidebar.php' ?>

        <div class="container-admin">
            <h1 class="title mb-2">Add Category</h1>
            <?php
                $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
                if ($message) { 
                    echo $message;
                    $_SESSION['message'] = '';
                }
            ?>
            <a href="list_category.php" class="btn btn-primary mb-4">Back To List Category</a>
            <form action="" method="POST">
                <div class="row">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" require class="form-label">Name Category</label>
                            <input type="text" class="form-control" name="name_category" id="exampleInputEmail1" value="<?=$oneItem['name']?>" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="col-6">
                    <div class="mb-3">
                    <label for="exampleInputEmail1" require class="form-label">Parent Category</label>
                    <select class="form-select" aria-label="Default select example" name="id_parent">
                        <option <?=$oneItem['id_parent'] == 0 ? 'selected' : '' ?> value="0">No parent category</option>
                        <?php
                            if($listCategory->num_rows){
                                while($row = $listCategory->fetch_assoc()){
                        ?>
                        <option value="<?=$row['id_category']?>" <?=$oneItem['id_parent'] == $row['id_category'] ? 'selected' : '' ?>><?=$row['name']?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                    </div>
                </div>
                <button type="submit" name="update-category" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>