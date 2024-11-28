<?php
session_start();

// Lấy id sản phẩm từ tham số trong URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
$flower = null;

// Nếu id hợp lệ, lấy dữ liệu sản phẩm
if ($id !== null && isset($_SESSION['flowers'][$id])) {
    $flower = $_SESSION['flowers'][$id];
} else {
    $flower = null;
}

// Nếu form được submit, xóa sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $flower !== null) {
    // Xóa sản phẩm khỏi session
    unset($_SESSION['flowers'][$id]);
    header('Location: index.php'); // Chuyển hướng về trang danh sách sản phẩm
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xóa sản phẩm</title>
</head>
<body>
<h2>Xóa sản phẩm</h2>
<?php if ($flower) : ?>
    <form action="delete.php?id=<?= $id ?>" method="post" style="display:inline">
        <p><strong>Tên hoa:</strong> <?= htmlspecialchars($flower['name']) ?></p>
        <p><strong>Mô tả:</strong> <?= htmlspecialchars($flower['description']) ?></p>
        <p><strong>Hình ảnh:</strong> <img src="<?= htmlspecialchars($flower['image']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>" style="height: 100px;"></p>
        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
    </form>
<?php else : ?>
    <p>Sản phẩm không tồn tại</p>
<?php endif; ?>
</body>
</html>