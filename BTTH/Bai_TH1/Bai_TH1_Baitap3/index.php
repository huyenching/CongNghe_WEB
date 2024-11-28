<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Danh sách sinh viên lớp 64KTPM4</h1>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Tên sinh viên</th>
            <th>Mã sinh viên</th>
            <th>Lớp</th>
            <th>ĐTBTL</th>
            <th>ĐTBTL QĐ</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Đường dẫn tới file CSV
        $filename = "64KTPM4.csv";

        // Mảng chứa dữ liệu sinh viên
        $sinhvien = [];

        // Mở file CSV
        if (($handle = fopen($filename, "r")) !== FALSE) {
            // Đọc dòng đầu tiên (tiêu đề)
            $headers = fgetcsv($handle, 1000, ",");
            $headers = array_map('trim', $headers); // Xóa khoảng trắng nếu có

            // Đọc từng dòng dữ liệu
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $sinhvien[] = array_combine($headers, $data);
            }

            fclose($handle);
        } else {
            echo "<tr><td colspan='5' class='text-danger text-center'>Không thể đọc file CSV.</td></tr>";
        }
        $stt=1;
        // Hiển thị từng sinh viên
        foreach ($sinhvien as $sv) {
            echo "<tr>";
            echo "<td>{$stt}</td>";
            echo "<td>{$sv['Tên sinh viên']}</td>";
            echo "<td>{$sv['Mã sinh viên']}</td>";
            echo "<td>{$sv['Lớp']}</td>";
            echo "<td>{$sv['ĐTBTL']}</td>";
            echo "<td>{$sv['ĐTBTL QĐ']}</td>";
            echo "</tr>";
            $stt++;
        }
        ?>
        </tbody>
    </table>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>