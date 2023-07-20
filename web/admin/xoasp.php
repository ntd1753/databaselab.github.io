<?php 
    include "../config/config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Danh sách sản phẩm:</h2>

        <?php
        // Xử lý xóa thông tin sản phẩm và size khi người dùng nhấn nút "Xóa"
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['delete_product_id'];

            // Xóa thông tin size của sản phẩm từ bảng Size_Product
            $sqlDeleteSizeProduct = "DELETE FROM Size_Product WHERE product_id = ?";
            $paramsDeleteSizeProduct = array($product_id);

            $stmtDeleteSizeProduct = sqlsrv_query($conn, $sqlDeleteSizeProduct, $paramsDeleteSizeProduct);
            if ($stmtDeleteSizeProduct === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            // Xóa thông tin sản phẩm từ bảng Products
            $sqlDeleteProduct = "DELETE FROM Products WHERE product_id = ?";
            $paramsDeleteProduct = array($product_id);

            $stmtDeleteProduct = sqlsrv_query($conn, $sqlDeleteProduct, $paramsDeleteProduct);
            if ($stmtDeleteProduct === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            echo "Xóa thông tin sản phẩm thành công";
        }

        // Hiển thị danh sách sản phẩm để người dùng có thể chọn sản phẩm cần xóa
        $sqlProducts = "SELECT * FROM Products";
        $stmtProducts = sqlsrv_query($conn, $sqlProducts);
        if ($stmtProducts === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        ?>

        <div class="product-list">
            <?php while ($product = sqlsrv_fetch_array($stmtProducts, SQLSRV_FETCH_ASSOC)) { ?>
                <div class="product">
                    <p><strong>Product ID:</strong> <?php echo $product['product_id']; ?></p>
                    <p><strong>Tên sản phẩm:</strong> <?php echo $product['name']; ?></p>
                    <p><strong>Giá:</strong> <?php echo $product['price']; ?></p>
                    <p><strong>Danh mục ID:</strong> <?php echo $product['category_id']; ?></p>
                    <p><strong>URL hình ảnh:</strong> <?php echo $product['image_url']; ?></p>
                    <form method="post">
                        <input type="hidden" name="delete_product_id" value="<?php echo $product['product_id']; ?>">
                        <input type="submit" value="Xóa">
                    </form>
                </div>
            <?php } ?>
        </div>

        <a href="listsp.php">Quay lại</a>
    </div>
</body>
</html>
<style>
    /* style.css */

body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.product {
  background-color: #ffffff;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
  padding: 20px;
  margin-bottom: 20px;
}

.product label,
.product input[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.product label {
  font-weight: bold;
}

.product input[type="submit"] {
  background-color: #e74c3c;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.product input[type="submit"]:hover {
  background-color: #c0392b;
}

a {
  display: block;
  text-align: center;
  margin-top: 20px;
  text-decoration: none;
  color: #3498db;
}

a:hover {
  color: #2980b9;
}
</style>