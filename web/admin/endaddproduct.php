<?php
session_start();
$product=$_SESSION['product'];
$product_query="INSERT INTO Products ( name,price, category_id, image_url)
VALUES ('$product['name']', ),
"
?>
<!DOCTYPE html>
<html lang="ens">
<head>
    <meta charset="UTF-8">
   
</head>
<body>
    <div>Bạn đã nhập sản phẩm thành công bạn có muốn nhập thêm size cho sản phẩm không?</div>
    <form action="" method="post"><button>có</button></form>
    <form action="" method="post"><button>không</button></form>
    
</body>
</html>