<?php
session_start();

// Kiểm tra nếu sản phẩm đã có trong session
if (!isset($_SESSION['flowers'])) {
    $_SESSION['flowers'] = [];
}

// Lấy id sản phẩm từ tham số trong URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Nếu id hợp lệ, lấy dữ liệu sản phẩm
$flower = null;
if ($id !== null && isset($_SESSION['flowers'][$id])) {
    $flower= $_SESSION['flowers'][$id];
}
else {
    @($flower = null);
}

// Nếu form được submit, cập nhật sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $flower !== null) {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    // Kiểm tra và upload lại hình ảnh nếu cần
    if ($image['error'] === 0) {
        $targetDir = "images/";
        $targetFile = $targetDir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $targetFile);
    } else {
        // Nếu không có hình ảnh mới, giữ nguyên hình ảnh cũ
        $targetFile = $flower['image'];
    }

    // Cập nhật thông tin sản phẩm trong session
    $_SESSION['flowers'][$id] = array(
        'name' => $name,
        'description' => $description,
        'image' => $targetFile
    );

    // Chuyển hướng về trang danh sách sản phẩm
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UPdate flowers</title>
</head>
<body>
<h2> Update flowers</h2>
<?php if ($flower) : ?>
    <form action="update.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
        <label for="name">Tên hoa:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($flower['name']) ?>" required>

        <label for="description">Mô tả:</label>
        <input type="text" name="description" value="<?= htmlspecialchars($flower['description']) ?>" required>

        <label for="image">Hình ảnh:</label>
        <input type="file" name="image" />

        <p><img src="<?= htmlspecialchars($flower['image']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>" style="height: 100px;"></p>

        <button type="submit">Cập nhật</button>
    </form>
<?php else : ?>
    <p>Sản phẩm không tồn tại</p>
<?php endif; ?>
</body>
</html>
