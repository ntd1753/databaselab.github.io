<?php 
    include "../config/config.php";
?>
<?php

 
    if(isset($_GET['id'])){
        $rs = $conn->query("delete from product where product_id = ".$_GET['id']."");
        //echo "<script>alert('Xóa Thành Công!!.');</script>";
        sleep(1);
        header("location:listsp.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Sản Phẩm</title>
    <link rel="stylesheet" href="listsp.css">
</head>
<body>
    <div class="container">
        <div class="menu">
            <a href="them.php">Thêm Sản Phẩm</a>
            <a href="suasp.php">Sửa Thông Tin Sản Phẩm</a>
            <a href="xoasp.php">Xóa Thông Tin Sản Phẩm</a>
            <a href="list.php">Quay lại</a>
        </div>
        <div class="content">
            <?php 
            sqlsrv_configure("ClientCharset", "UTF-8"); 
            // Lấy thông tin từ bảng Products
            $sqlProducts = "SELECT * FROM Products";
            $stmtProducts = sqlsrv_query($conn, $sqlProducts);
            if ($stmtProducts === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        
            echo "<h2>Thông tin sản phẩm:</h2>";
            echo "<table>";
            echo "<tr><th>Product ID</th><th>Tên sản phẩm</th><th>Giá</th><th>Danh mục ID</th><th>URL hình ảnh</th></tr>";
            while ($row = sqlsrv_fetch_array($stmtProducts, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['product_id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
              
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['category_id'] . "</td>";
                echo "<td>" . $row['image_url'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        
            // Lấy thông tin từ bảng Size_Product
            $sqlSizeProduct = "SELECT * FROM Size_Product";
            $stmtSizeProduct = sqlsrv_query($conn, $sqlSizeProduct);
            if ($stmtSizeProduct === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        
            echo "<h2>Thông tin size sản phẩm:</h2>";
            echo "<table>";
            echo "<tr><th>Size ID</th><th>Product ID</th><th>Size</th><th>Số lượng trong kho</th></tr>";
            while ($row = sqlsrv_fetch_array($stmtSizeProduct, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['size_id'] . "</td>";
                echo "<td>" . $row['product_id'] . "</td>";
                echo "<td>" . $row['size'] . "</td>";
                echo "<td>" . $row['SoLuongTrongKho'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            sqlsrv_close($conn);
            ?>
        </div>
    </div>
</body>
<style>
    
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
  }
  
  .container {
    display: flex;
    justify-content: center;
    margin-top: 50px;
  }
  
  .menu {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 200px;
    margin-right: 20px;
  }
  
  .menu a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #000;
  }
  
  .menu a:hover {
    background-color: #f2f2f2;
  }
  
  .content {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 600px;
  }
  
  /* Định dạng tiêu đề bảng */
  h2 {
    text-align: center;
  }
  
  table {
    border-collapse: collapse;
    width: 100%;
  }
  
  table, th, td {
    border: 1px solid #ccc;
  }
  
  th, td {
    padding: 10px;
    text-align: left;
  }
  
  th {
    background-color: #f2f2f2;
  }
  
  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  
</style>
</html>