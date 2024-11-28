<?php

session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $image = $_FILES["image"];
    if(!isset($_SESSION["flowers"])){
        $_SESSION["flowers"] = array();
    }
    $targetDir = "images/";
    $targetFile = $targetDir . basename($image["name"]);

    // Kiểm tra và upload file
    if (move_uploaded_file($image["tmp_name"], $targetFile)) {
        // Lưu vào session
        $_SESSION["flowers"][] = array(
            'name' => $name,
            'description' => $description,
            'image' => $targetFile
        );
    } else {
        echo "Không thể upload hình ảnh!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
    <title>Thêm hoa</title>

</head>
<body>

<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Tên Hoa:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Hình ảnh :</label>
        <input type="file" name="image" id="image" class="form-control-file" required>
    </div>
    <button type="submit" name="add_flower" class="btn btn-primary">Thêm</button>
</form>




</body>

</html>
