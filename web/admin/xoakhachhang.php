<?php 
    include "../config/config.php";
?>

<?php

// Xử lý xóa khách hàng khi nhấn nút "Xóa"
if (isset($_POST['delete_customer_id'])) {
    $customer_id = $_POST['delete_customer_id'];

    // Xóa thông tin khách hàng từ bảng Customers
    $sqlDeleteCustomer = "DELETE FROM OrderItems WHERE order_id IN (
        SELECT order_id FROM Orders WHERE customer_id = ?
    );
    DELETE FROM Orders WHERE customer_id = ?;
    DELETE FROM Customers WHERE customer_id = ?;
    ";
    $paramsDeleteCustomer = array($customer_id, $customer_id, $customer_id);

    $stmtDeleteCustomer = sqlsrv_query($conn, $sqlDeleteCustomer, $paramsDeleteCustomer);
    if ($stmtDeleteCustomer === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Xóa thông tin khách hàng thành công";
}

// Hiển thị danh sách khách hàng để người dùng có thể chọn khách hàng cần xóa
$sqlCustomers = "SELECT * FROM Customers";
$stmtCustomers = sqlsrv_query($conn, $sqlCustomers);
if ($stmtCustomers === false) {
    die(print_r(sqlsrv_errors(), true));
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Xóa Khách Hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Danh sách khách hàng:</h2>
        <?php while ($customer = sqlsrv_fetch_array($stmtCustomers, SQLSRV_FETCH_ASSOC)): ?>
            <div class="customer">
                <h3>Customer ID: <?php echo $customer['customer_id']; ?></h3>
                <p>Tên khách hàng: <?php echo $customer['customer_name']; ?></p>
                <p>Email: <?php echo $customer['email']; ?></p>
                <p>Địa chỉ: <?php echo $customer['address']; ?></p>
                <p>Số điện thoại: <?php echo $customer['phone']; ?></p>
                <form method="post">
                    <input type="hidden" name="delete_customer_id" value="<?php echo $customer['customer_id']; ?>">
                    <input type="submit" value="Xóa">
                </form>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="listorder.php">Quay lại</a>
</body>
</html>

<?php
sqlsrv_close($conn);
?>

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

.customer {
  background-color: #ffffff;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
  padding: 10px;
  margin-bottom: 10px;
}

.customer h3 {
  margin-top: 0;
}

.customer p {
  margin: 0;
}

.customer form {
  display: inline;
}

.customer form input[type="submit"] {
  background-color: #dc3545;
  color: #ffffff;
  border: none;
  padding: 5px 10px;
  border-radius: 3px;
  cursor: pointer;
}

.customer form input[type="submit"]:hover {
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