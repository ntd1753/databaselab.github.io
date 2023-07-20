<?php 
    include "../config/config.php";
?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
  
    $price = $_POST['price'];
    $category_id = $_POST['category'];
    $image_url = $_POST['image_url'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];

    // Thêm thông tin sản phẩm vào bảng Products
    $sqlAddProduct = "INSERT INTO Products (name, price, category_id, image_url) VALUES (?, ?, ?, ?)";
    $paramsAddProduct = array($name, $price, $category_id, $image_url);

    $stmtAddProduct = sqlsrv_query($conn, $sqlAddProduct, $paramsAddProduct);
    if ($stmtAddProduct === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Lấy product_id của sản phẩm vừa thêm
    $sqlGetProductID = "SELECT @@IDENTITY AS product_id";
    $stmtGetProductID = sqlsrv_query($conn, $sqlGetProductID);
    if ($stmtGetProductID === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $product_id = sqlsrv_fetch_array($stmtGetProductID, SQLSRV_FETCH_ASSOC)['product_id'];

    // Thêm thông tin size của sản phẩm vào bảng Size_Product
    $sqlAddSizeProduct = "INSERT INTO Size_Product (product_id, size, SoLuongTrongKho) VALUES (?, ?, ?)";
    $paramsAddSizeProduct = array($product_id, $size, $quantity);

    $stmtAddSizeProduct = sqlsrv_query($conn, $sqlAddSizeProduct, $paramsAddSizeProduct);
    if ($stmtAddSizeProduct === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Thêm sản phẩm thành công";
}

sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Thêm sản phẩm:</h2>
        <form method="POST">
            <label for="name">Tên sản phẩm:</label><br>
            <input type="text" name="name" id="name" required><br>

            <label for="price">Giá:</label><br>
            <input type="number" name="price" id="price" required><br>

            <label for="category">Danh mục:</label><br>
            <select name="category" id="category" required>
                <option value="1">Áo</option>
                <option value="2">Quần</option>
            </select><br>

            <label for="image_url">URL hình ảnh:</label><br>
            <input type="text" name="image_url" id="image_url" required><br>

            <label for="size">Kích cỡ:</label><br>
            <select name="size" id="size" required>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select><br>

            <label for="quantity">Số lượng:</label><br>
            <input type="number" name="quantity" id="quantity" required><br>

            <input type="submit" value="Thêm sản phẩm">
        </form>
    </div>
    <a href="listsp.php">Quay lại</a>
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

form {
  background-color: #ffffff;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
  padding: 20px;
  margin-bottom: 20px;
}

form label {
  display: block;
  margin-bottom: 10px;
}

form input[type="text"],
form input[type="number"],
form select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 20px;
}

form input[type="submit"] {
  background-color: #007bff;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

form input[type="submit"]:hover {
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
