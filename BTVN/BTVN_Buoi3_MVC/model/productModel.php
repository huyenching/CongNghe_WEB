<?php
session_start();

class Product {
    // Lấy tất cả sản phẩm
    public static function getAll() {
        return isset($_SESSION['products']) ? $_SESSION['products'] : [];
    }

    // Thêm sản phẩm mới
    public static function add($name, $price) {
        // Lấy danh sách sản phẩm hiện tại
        $products = self::getAll();

        // Thêm sản phẩm mới vào danh sách
        $products[] = ['name' => $name, 'price' => $price];

        // Cập nhật lại session
        $_SESSION['products'] = $products;
    }

    // Sửa thông tin sản phẩm
    public static function edit($id, $name, $price) {
        // Lấy danh sách sản phẩm hiện tại
        $products = self::getAll();

        // Kiểm tra nếu sản phẩm tồn tại
        if (isset($products[$id])) {
            // Cập nhật thông tin sản phẩm
            $products[$id]['name'] = $name;
            $products[$id]['price'] = $price;

            // Cập nhật lại session
            $_SESSION['products'] = $products;
        }
    }

    // Xóa sản phẩm
    public static function delete($id) {
        // Lấy danh sách sản phẩm hiện tại
        $products = self::getAll();

        // Kiểm tra nếu sản phẩm tồn tại
        if (isset($products[$id])) {
            // Xóa sản phẩm
            unset($products[$id]);

            // Cập nhật lại danh sách sản phẩm trong session
            $_SESSION['products'] = array_values($products); // Cập nhật lại chỉ số mảng
        }
    }
}
?>