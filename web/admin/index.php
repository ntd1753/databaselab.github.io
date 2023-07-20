<?php
    include "../config/config.php";
    if(isset($_POST["txtDN"])){
        if(($_POST["txtUser"] == "")|| ($_POST["txtPass"] == "")){
            echo "<script>alert('chưa nhập đầy đủ thông tin');</script>";
        }else{
            

            $stmt = sqlsrv_query( $conn,"SELECT * FROM Admin WHERE account = '".$_POST["txtUser"]."' and password = '".$_POST["txtPass"]."' ", 
            array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

            $row_count = sqlsrv_num_rows( $stmt );
            if($row_count >0){
                header("location:list.php"); 
            }
            else{
                echo "<script>alert('mật khẩu hoặc tài khoản chưa chính xác!');</script>";
            }
            
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng Nhập Admin</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <h1>Đăng nhập trang quản trị</h1>
        <form action="index.php" method="post">
            <label for="txtUser">Tên Đăng Nhập:</label>
            <input type="text" name="txtUser" id="txtUser" required>
            <label for="txtPass">Mật Khẩu:</label>
            <input type="password" name="txtPass" id="txtPass" required>
            <input type="submit" name="txtDN" value="Đăng Nhập">
        </form>
    </div>
</body>
</html>

<style>
    body {
        width: 100%;
    }
    .container {
        
        margin: 0 auto;
        margin-top: 218px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 400px;
    padding: 20px;
  }
  
  .container h1 {
    text-align: center;
  }
  
  .container form {
    display: flex;
    flex-direction: column;
  }
  
  .container form label {
    margin-bottom: 5px;
  }
  
  .container form input[type="text"],
  .container form input[type="password"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
  }
  
  .container form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .container form input[type="submit"]:hover {
    background-color: #45a049;
  }
</style>