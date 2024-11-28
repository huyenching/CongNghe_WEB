<?php
session_start(); // Khởi tạo session

// Kiểm tra nếu session chứa sản phẩm
if (isset($_SESSION['flowers'])) {
    $flowers = $_SESSION['flowers']; // Lấy dữ liệu sản phẩm từ session
} else {
    $flowers = array(); // Nếu chưa có sản phẩm nào
}
?>
<?php
// Kiểm tra xem người dùng có phải là quản trị viên hay không
$isAdmin = isset($_GET['admin']) && $_GET['admin'] == 1;
?>
<?php include 'flower.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách các loài hoa</title>
    <link rel="stylesheet" href="./images/hoadayenthao.webp">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        img {
            height: 100px;
            width: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container">

    <?php if ($isAdmin): ?>
        <a href="add.php" class="btn btn-primary">Thêm Hoa Mới</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tên Hoa</th>
                <th>Mô tả</th>
                <th>Hình ảnh 1</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($flowers as $flower): ?>
                <tr>
                    <td><?php echo $flower['name']; ?></td>
                    <td><?php echo $flower['description']; ?></td>
                    <td><img src="<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>"></td>

                    </td>
                    <td>
                        <a href="update.php" class="btn btn-info btn-sm">Sửa</a>
                        <a href="delete.php" class="btn btn-warning btn-sm">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- Giao diện Khách: Hiển thị như bài viết mẫu -->
        <div class="row">
            <?php foreach ($flowers as $flower): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $flower['name']; ?></h5>
                            <p class="card-text"><?php echo $flower['description']; ?></p>
                            <img src="<?php echo $flower['image']; ?>" class="" alt="<?php echo $flower['name']; ?>">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>