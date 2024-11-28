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

<form method="POST" action="main.php?admin=1" enctype="multipart/form-data">
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