<?php
if (isset($_POST['submit'])) {
    $quantities = $_POST['quatity'];
    $sizes = $_POST['size'];
    echo $sizes;
    $data = array();

    // Kiểm tra xem các biến là mảng
    if (is_array($quantities) && is_array($sizes)) {
        $count = count($quantities);

        for ($i = 0; $i < $count; $i++) {
            $quantity = $quantities[$i];
            $size = $sizes[$i];
            $data = array('quantity' => $quantity, 'size' => $size);
        }
    }
    foreach ($data as $item) {
        $quantity = $item['quantity'];
        $size = $item['size'];
        echo "Quantity: " . $quantity . ", Size: " . $size . "<br>";
    }
}
?>