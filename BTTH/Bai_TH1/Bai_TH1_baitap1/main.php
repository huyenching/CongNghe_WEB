<?php
include 'flower.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xử lý xóa hoa
    if (isset($_POST['delete_index'])) {
        $deleteIndex = $_POST['delete_index'];
        if (isset($_SESSION["flowers"][$deleteIndex])) {
            unset($_SESSION["flowers"][$deleteIndex]);  // Xóa hoa tại vị trí index
            $_SESSION["flowers"] = array_values($_SESSION["flowers"]);  // Đặt lại chỉ số mảng
        }
    }

    // Xử lý sửa hoa
    if (isset($_POST['edit_index'])) {
        $editIndex = $_POST['edit_index'];
        if (isset($_SESSION["flowers"][$editIndex])) {
            // Lấy dữ liệu từ form
            $name = $_POST["name"];
            $description = $_POST["description"];
            $image = $_FILES["image"];
            $targetDir = "image/";
            $targetFile = $targetDir . basename($image["name"]);

            // Nếu có hình ảnh mới, upload hình ảnh mới
            if ($image["name"]) {
                if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                    $_SESSION["flowers"][$editIndex] = array(
                        'name' => $name,
                        'description' => $description,
                        'image' => $targetFile
                    );
                } else {
                    echo "Không thể upload hình ảnh!";
                }
            } else {
                // Nếu không có hình ảnh mới, giữ nguyên hình ảnh cũ
                $_SESSION["flowers"][$editIndex] = array(
                    'name' => $name,
                    'description' => $description,
                    'image' => $_SESSION["flowers"][$editIndex]['image']  // Giữ nguyên hình ảnh cũ
                );
            }
        }
    }

    // Xử lý thêm hoa mới
    if (!isset($_POST['edit_index'])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $image = $_FILES["image"];
        if (!isset($_SESSION["flowers"])) {
            $_SESSION["flowers"] = array();
        }
        $targetDir = "image/";
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

    // Chuyển hướng về trang chính
    header('Location: main.php?admin=1');
    exit();
}
?>




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
                    <?php foreach ($_SESSION["flowers"] as $index => $flower): ?>
                        <tr data-index="<?= $index ?>">
                            <td><?php echo $flower['name']; ?></td>
                            <td><?php echo $flower['description']; ?></td>
                            <td><img src="<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>"></td>

                            <td>
                                <a href="update.php?index=<?= $index ?>&name=<?= urlencode($flower['name']) ?>&description=<?= urlencode($flower['description']) ?>&image=<?= urlencode($flower['image']) ?>" class="btn-edit">
                                    <button class="btn btn-primary">Sửa</button>
                                </a>


                                <form action="" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="delete_index" value="<?= $index ?>">
                                    <button type="submit" class="btn btn-danger btn-delete">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Giao diện Khách: Hiển thị như bài viết mẫu -->
            <div class="row">
                <?php foreach ($_SESSION["flowers"] as $flower): ?>
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