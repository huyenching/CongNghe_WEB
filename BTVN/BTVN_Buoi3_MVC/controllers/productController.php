<?php
// File: controllers/ProductController.php
require_once 'model/productModel.php';

class ProductController
{
    // Hiển thị tất cả sản phẩm
    public function index()
    {
        $products = Product::getAll();
        include 'views/index.php';
    }

    // Thêm sản phẩm mới
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra dữ liệu nhập vào
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';

            // Kiểm tra nếu dữ liệu hợp lệ
            if (empty($name) || empty($price) || !is_numeric(str_replace(' VND', '', $price))) {
                $_SESSION['error'] = "Tên sản phẩm và giá phải hợp lệ!";
                header('Location: index.php?action=add');
                exit();
            }

            // Thêm sản phẩm
            Product::add($name, $price . " VND");
            header('Location: index.php');
            exit();
        }
        include 'views/add.php';
    }

    // Sửa thông tin sản phẩm
    public function edit($id)
    {
        $products = Product::getAll();

        // Kiểm tra xem sản phẩm có tồn tại không
        if (!isset($products[$id])) {
            // Nếu không tồn tại sản phẩm, điều hướng về trang chủ hoặc thông báo lỗi
            header('Location: index.php');
            exit();
        }

        $product = $products[$id];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra dữ liệu nhập vào
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';

            // Kiểm tra nếu dữ liệu hợp lệ
            if (empty($name) || empty($price) || !is_numeric(str_replace(' VND', '', $price))) {
                $_SESSION['error'] = "Tên sản phẩm và giá phải hợp lệ!";
                header('Location: index.php?action=edit&id=' . $id);
                exit();
            }

            // Cập nhật sản phẩm
            Product::edit($id, $name, $price . " VND");
            header('Location: index.php');
            exit();
        }

        include 'views/edit.php';
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        $products = Product::getAll();

        // Kiểm tra xem sản phẩm có tồn tại không
        if (!isset($products[$id])) {
            header('Location: index.php');
            exit();
        }

        Product::delete($id);
        header('Location: index.php');
        exit();
    }
}