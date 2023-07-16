<?php
     session_start();
    include "../config/config.php";
    $size_name=array("S","M","L","XL","XXL","XXL");
    if(isset($_POST['submit'])){
        $product_name=$_POST['product_name'];
        $price=$_POST['price'];
        $img=$_POST['img'];
        $category_id=$_POST['category'];
        $product=array(
            'name'=>$product_name,
            'price'=>$price,
            'category_id'=>$category_id,
            'img_url'=>$img);
        
         $_SESSION['product']=$product;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
   
    <form action="test.php" method="post">
        <label for="">Size</label><br>
        <select name="size" class="size">
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option> 
            <option value="XXL">XXL</option>
        </select><br>
        <label for="quatity" class="label-quatity">Số Lượng</label><br>
        <input type="number" name="quatity" class="quatityip"><br>
        <button class="themsize">Thêm Size</button>
        <button type="submit" name="submit">Thêm sản phẩm</button>
    </form>

</body>
<script>
    const slt=document.querySelector(".size");
    let count='';
    const labelq=document.querySelector(".label-quatity");
     const input=document.querySelector("input");
    const btn=document.querySelector(".themsize");
    btn.addEventListener('mousedown', function(){
        btn.insertAdjacentHTML("beforeBegin","<br>");
        btn.insertAdjacentHTML("beforeBegin","<label>Size</label>");
        btn.insertAdjacentHTML("beforeBegin","<br>");
        let sltcp=slt.cloneNode(true);
        let size="size"+count;
        sltcp.setAttribute("name",size);
        btn.insertAdjacentElement("beforeBegin",sltcp);
        btn.insertAdjacentHTML("beforeBegin","<br>");
         let labelqcp=labelq.cloneNode(true);
         let quatity="quatity"+count;
         labelqcp.setAttribute("name",quatity);
         btn.insertAdjacentElement("beforeBegin",labelqcp);
         btn.insertAdjacentHTML("beforeBegin","<br>");
         let inputcp = input.cloneNode(true);
        inputcp.setAttribute("name", quatity);
        btn.parentNode.insertBefore(inputcp, btn);
        btn.insertAdjacentHTML("beforeBegin","<br>");
        // count++;
    })

</script>


</html>
