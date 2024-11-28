<?php
// Lấy dữ liệu từ URL (GET request)
$index = $_GET['index'] ?? '';
$name = $_GET['name'] ?? '';
$description = $_GET['description'] ?? '';
$image = $_GET['image'] ?? '';
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
<h1>Sửa</h1>
<form method="POST" action="main.php?admin=1" enctype="multipart/form-data">
<input type="hidden" id="editIndex" name="edit_index" value="<?= htmlspecialchars($index) ?>">
    <div class="form-group">
        <label for="name">Tên Hoa:</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea name="description" id="description" class="form-control"  required><?= htmlspecialchars($description) ?></textarea>
    </div>
    <div class="form-group">
        <label for="image">Hình ảnh :</label>
        <input type="file" name="image" id="image" class="form-control-file" >
    </div>
    <input type="text" name="old_image" value="<?= htmlspecialchars($image) ?>"> <!-- Lưu ảnh cũ để xử lý khi không thay đổi ảnh -->
    <button type="submit" name="add_flower" class="btn btn-primary">Thêm</button>
</form>




</body>

</html>
