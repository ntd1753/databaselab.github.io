<?php 
    include "../config/config.php";
?>
<?php

// Xử lý sửa thông tin sản phẩm và size khi người dùng nhấn nút "Sửa"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xử lý thông tin sản phẩm
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category'];
    $image_url = $_POST['image_url'];

    $sqlUpdateProduct = "UPDATE Products SET name = ?, description = ?, price = ?, category_id = ?, image_url = ? WHERE product_id = ?";
    $paramsUpdateProduct = array($name, $description, $price, $category_id, $image_url, $product_id);

    $stmtUpdateProduct = sqlsrv_query($conn, $sqlUpdateProduct, $paramsUpdateProduct);
    if ($stmtUpdateProduct === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Xử lý thông tin size và số lượng trong kho
    if (isset($_POST['size_id'])) {
        $size_id = $_POST['size_id'];
        $size = $_POST['size'];
        $SoLuongTrongKho = $_POST['SoLuongTrongKho'];

        // Cập nhật thông tin size của sản phẩm trong bảng Size_Product
        $sqlUpdateSizeProduct = "UPDATE Size_Product SET size = ?, SoLuongTrongKho = ? WHERE size_id = ?";
        $paramsUpdateSizeProduct = array($size, $SoLuongTrongKho, $size_id);

        $stmtUpdateSizeProduct = sqlsrv_query($conn, $sqlUpdateSizeProduct, $paramsUpdateSizeProduct);
        if ($stmtUpdateSizeProduct === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    } else {
        // Thêm thông tin size mới vào bảng Size_Product
        $size = $_POST['size'];
        $SoLuongTrongKho = $_POST['SoLuongTrongKho'];

        $sqlInsertSizeProduct = "INSERT INTO Size_Product (product_id, size, SoLuongTrongKho) VALUES (?, ?, ?)";
        $paramsInsertSizeProduct = array($product_id, $size, $SoLuongTrongKho);

        $stmtInsertSizeProduct = sqlsrv_query($conn, $sqlInsertSizeProduct, $paramsInsertSizeProduct);
        if ($stmtInsertSizeProduct === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    echo "Cập nhật thông tin sản phẩm và size thành công";
}

// Hiển thị danh sách sản phẩm để người dùng có thể chọn sản phẩm cần sửa
$sqlProducts = "SELECT * FROM Products";
$stmtProducts = sqlsrv_query($conn, $sqlProducts);
if ($stmtProducts === false) {
    die(print_r(sqlsrv_errors(), true));
}

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

        <?php while ($product = sqlsrv_fetch_array($stmtProducts, SQLSRV_FETCH_ASSOC)) { ?>
            <div class="product">
                <p><strong>Product ID:</strong> <?php echo $product['product_id']; ?></p>
                <form method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <label for="name">Tên sản phẩm:</label>
                    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>

                    

                    <label for="price">Giá:</label>
                    <input type="number" name="price" value="<?php echo $product['price']; ?>" required>

                    <label for="category">Danh mục:</label>
                    <select name="category" required>
                        <option value="1" <?php if ($product['category_id'] == 1) echo 'selected'; ?>>Áo</option>
                        <option value="2" <?php if ($product['category_id'] == 2) echo 'selected'; ?>>Quần</option>
                    </select>

                    <label for="image_url">URL hình ảnh:</label>
                    <input type="text" name="image_url" value="<?php echo $product['image_url']; ?>" required>

                    <!-- Hiển thị thông tin size của sản phẩm -->
                    <?php
                        $sqlSizeProduct = "SELECT * FROM Size_Product WHERE product_id = ?";
                        $paramsSizeProduct = array($product['product_id']);
                        $stmtSizeProduct = sqlsrv_query($conn, $sqlSizeProduct, $paramsSizeProduct);
                        if ($stmtSizeProduct === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        while ($sizeProduct = sqlsrv_fetch_array($stmtSizeProduct, SQLSRV_FETCH_ASSOC)) {
                    ?>
                        <input type="hidden" name="size_id" value="<?php echo $sizeProduct['size_id']; ?>">
                        <label for="size">Kích cỡ:</label>
                        <select name="size" required>
                            <option value="S" <?php if ($sizeProduct['size'] == 'S') echo 'selected'; ?>>S</option>
                            <option value="M" <?php if ($sizeProduct['size'] == 'M') echo 'selected'; ?>>M</option>
                            <option value="L" <?php if ($sizeProduct['size'] == 'L') echo 'selected'; ?>>L</option>
                            <option value="XL" <?php if ($sizeProduct['size'] == 'XL') echo 'selected'; ?>>XL</option>
                            <option value="XXL" <?php if ($sizeProduct['size'] == 'XXL') echo 'selected'; ?>>XXL</option>
                        </select>
                        <label for="SoLuongTrongKho">Số lượng trong kho:</label>
                        <input type="number" name="SoLuongTrongKho" value="<?php echo $sizeProduct['SoLuongTrongKho']; ?>" required>
                    <?php
                        }
                    ?>
                    <!-- Hiển thị thông tin size của sản phẩm -->

                    <input type="submit" value="Sửa">
                </form>
            </div>
        <?php } ?>

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
.product select,
.product input[type="text"],
.product input[type="number"] {
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

.product select {
  margin-bottom: 20px;
}

.product input[type="submit"] {
  background-color: #007bff;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.product input[type="submit"]:hover {
  background-color: #0056b3;
}

a {
  display: block;
  text-align: center;
  margin-top: 20px;
  text-decoration: none;
  color: #007bff;
}

a:hover {
  color: #0056b3;
}
</style>