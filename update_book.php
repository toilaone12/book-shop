<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};
$id = isset($_GET['id']) && $_GET['id'] ? intval($_GET['id']) : intval($_POST['id']);
$select = $conn->query("SELECT * FROM `book_info` WHERE bid = " . $id);
$one = $select->fetch_assoc();
if (isset($_POST['update-book'])) {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $id_category = $_POST['id_category'];
    $update = mysqli_query($conn, "UPDATE `book_info` SET name = '$name', author='$author', description ='$description', price = '$price', id_category=$id_category WHERE bid = '$id'") or die('query failed');

    $old_image = $_POST['old_image'];
    $old_audio = $_POST['old_audio'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $audio_size = $_FILES['audio']['size'];
    $update_folder = './added_books/' . $image;
    $audio = $_FILES["audio"]["name"];
    $audio_tmp_name = $_FILES['audio']['tmp_name'];
    $filenames = './audio_books/' . $audio;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $message[] = 'Image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `book_info` SET image = '$image' WHERE bid = '$id'") or die('update image failed');
            move_uploaded_file($image_tmp_name, $update_folder);
            unlink('added_books/' . $old_image);
        }
    }

    if (!empty($audio)) {
        if ($audio_size > 2000000) {
            $message[] = 'Audio file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `book_info` SET audio = '$audio' WHERE bid = '$id'") or die('update audio failed');
            move_uploaded_file($audio_tmp_name, $update_folder);
            unlink('added_audio/' . $old_audio);
        }
    }
    if ($update) {
        $_SESSION['message'] = '<p class="text-success small">Update Book Success</p>';
    } else {
        $_SESSION['message'] = '<p class="text-danger small">Update Book Not Success</p>';
    }
    header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $id);
    exit;
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
    <title>Update Books</title>
</head>

<body>
    <?php include './admin_header.php' ?>
    <div class="wrapper">
        <?php include './admin_sidebar.php' ?>
        <div class="container-admin">
            <a class="update_btn" style="position: fixed ; z-index:100;" href="total_books.php">See All Books</a>
            <div class="container-book">
                <form action="" method="POST" enctype="multipart/form-data">
                    <h3>Add Books To <a href="index.php"><span>MuseBook & </span><span>Chill</span></a></h3>
                    <?php
                        $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
                        if ($message) { 
                            echo $message;
                            $_SESSION['message'] = '';
                        }
                    ?>
                    <div class="row" style="margin-top: 50px;">
                        <input type="hidden" name="old_image" value="<?= $one['image'] ?>">
                        <input type="hidden" name="old_audio" value="<?= $one['image'] ?>">
                        <input type="hidden" name="id" value="<?= $one['bid'] ?>">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Book Name</label>
                                <input type="text" name="name" placeholder="Enter Book Name" value="<?= $one['name'] ?>" class="form-control-book">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Author Name</label>
                                <input type="text" name="author" placeholder="Enter Author Name" value="<?= $one['author'] ?>" class="form-control-book">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" min="0" name="price" placeholder="Enter Price" value="<?= $one['price'] ?>" class="form-control-book">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="id_category" id="" required class="form-control-book">
                                    <?php
                                    $listParent = $conn->query("SELECT * FROM category WHERE id_parent = 0");
                                    while ($oneParent = $listParent->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $oneParent['id_category']?>" <?=$oneParent['id_category'] == $one['id_category'] ? 'selected' : ''?>><?= $oneParent['name'] ?></option>
                                        <?php
                                        $listChild = $conn->query("SELECT * FROM category WHERE id_parent = " . $oneParent['id_category']);
                                        while ($oneChild = $listChild->fetch_assoc()) {
                                        ?>
                                            <option value="<?= $oneChild['id_category'] ?>" <?=$oneParent['id_category'] == $one['id_category'] ? 'selected' : ''?>>|---<?= $oneChild['name'] ?></option>
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
                                <textarea name="description" placeholder="Enter book description" id="" class="form-control-book" cols="18" rows="5"><?= $one['description'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Image (File Original: <?= $one['image'] ?>)</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="custom-file-input">
                                            <label for="" class="custom-file-label">Chose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Audio (File Original: <?= $one['audio'] ?>)</label>
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
                    <input type="submit" value="Submit" name="update-book" class="btn btn-primary">
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