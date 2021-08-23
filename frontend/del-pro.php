<?php
    include 'connect.php';
    $id= $_GET['id'];
    $sql = "DELETE FROM `product` WHERE `id`='".$id."'";

    if ($result = $con->query($sql)) {
        echo "<h1> Đã xoá thành công <a href='product.php'>Cick vào đây để trở về</a> <h1>";
    }else{
        echo "<h1> Đã xoá thất bại<a href='product.php'>Cick vào đây để trở về</a> <h1>";
    }
?>