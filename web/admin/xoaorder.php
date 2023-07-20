<?php 
    include "../config/config.php";
?>

<?php

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Kiểm tra xem đơn hàng có tồn tại hay không
    $sqlCheckOrder = "SELECT * FROM Orders WHERE order_id = ?";
    $paramsCheckOrder = array($order_id);
    $stmtCheckOrder = sqlsrv_query($conn, $sqlCheckOrder, $paramsCheckOrder);

    if (sqlsrv_has_rows($stmtCheckOrder)) {
        // Xóa thông tin từ bảng OrderItems dựa trên order_id
        $sqlOrderItems = "DELETE FROM OrderItems WHERE order_id = ?";
        $paramsOrderItems = array($order_id);
        $stmtOrderItems = sqlsrv_query($conn, $sqlOrderItems, $paramsOrderItems);

        if ($stmtOrderItems === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Xóa thông tin từ bảng Orders dựa trên order_id
        $sqlOrders = "DELETE FROM Orders WHERE order_id = ?";
        $paramsOrders = array($order_id);
        $stmtOrders = sqlsrv_query($conn, $sqlOrders, $paramsOrders);

        if ($stmtOrders === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        echo "Xóa đơn hàng thành công";
    } else {
        echo "Đơn hàng không tồn tại";
    }
}

sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Xóa Đơn Hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Xóa đơn hàng:</h2>
        <form method="GET">
            <label for="order_id">Nhập order_id để xóa đơn hàng:</label>
            <input type="text" name="order_id" id="order_id" required>
            <input type="submit" value="Xóa đơn hàng">
        </form>
    </div>
    <a href="listorder.php">Quay lại</a>
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

form input[type="text"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 20px;
}

form input[type="submit"] {
  background-color: #dc3545;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

form input[type="submit"]:hover {
  background-color: #c82333;
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