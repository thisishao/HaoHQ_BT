<?php session_start();
    include 'connect.php';
    $error_title = $error_price = $error_img = $dk = "";
    $check = 1;

    if (isset($_POST['sub-pro'])) {
    	
        if (empty($_POST['title'])) {
            $error_title = "Vui lòng nhập Title !!!";
            $check = 0;
        }else{
            if (!preg_match("/^[a-zA-Z ]*$/",$_POST["title"])) {
              $error_title = "<span style='color:red;'>Lỗi: Title chỉ chấp nhận chữ</span>";
              $check = 0;
            }
        }

        if (empty($_POST['price'])) {
            $error_price = "<span style='color:red;'>Lỗi: Price bắt buộc phải nhập.</span>";
            $check = 0;
        }else{
            if (!preg_match("/^[0-9]{3,5}$/",$_POST["price"])) {
                $error_price = "<span style='color:red;'>Lỗi: Price chỉ chấp nhận số từ 3 dến 5 chữ số</span>";
                $check = 0;
            }

        }

        if (empty($_POST['image'])) {
            $error_img = "Vui lòng nhập Image !!!";
            $check = 0;
        }else{
            if (!preg_match("/^[a-zA-Z ]*$/",$_POST["image"])) {
              $error_img = "<span style='color:red;'>Lỗi: Image chỉ chấp nhận chữ</span>";
              $check = 0;
            }
        }


        if ($check == 1) {
            if (isset($_GET['id'])) {
                
                $sql = "UPDATE `product` SET `title`='".$_POST['title']."',`price`='".$_POST['price']."',`image`='".$_POST['image']."' WHERE `id` = ".$_GET['id']."";
                if ($result = $con->query($sql)) {
                    $dk = "<span style='color:red;'>Chỉnh sửa thông tin thành công Click vào <a href='product.php'>đây</a> để về trang chủ</span>";
                }else{
                    $dk = "<h1>Có lỗi xảy ra</h1>";
                }

            }else{
                $sql = "INSERT INTO `product`(`title`, `price`, `image`) VALUES ('".$_POST['title']."','".$_POST['price']."','".$_POST['image']."')";

                if ($result = $con->query($sql)) {
 
                    header("location: product.php");
                }else{
                    $dk = "Thêm sản phẩm thất bại Vui lòng <a href='product.php'>Click</a> vào đây để trở về trang sản phẩm!!";
                }
            }
        }


    }


?>