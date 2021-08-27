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

        $size = 1048576;
        $fileName = basename($_FILES["image"]["name"]);
        if (isset($_FILES['image'])) {
            $arrayImg = $_FILES['image']['name'];
            $checka = array('jpg', 'png', 'jpeg','gif');
            $chek2 = explode('.', $arrayImg);
            $chek22 = strtolower(end($chek2));
            $demo2 = in_array($chek22, $checka);

            if ($demo2 === TRUE) {
                if ($_FILES['image']['size'] >= $size) {
                    $error_img = "Vui lòng upload file dưới 1MB";
                    $check = 0;
                }elseif($_FILES['image']['error'] > 0){
                    $error_img = "File Upload Bị Lỗi";
                    $check = 0;
                }else{
                    move_uploaded_file($_FILES['image']['tmp_name'],'./avatar/'.$_FILES['image']['name']);
                }   
            }else{
                $error_img = "Vui lòng chọn hình ảnh để upload";
                $check = 0;
            }
        }

        if ($check == 1) {
            $id = $_SESSION['id'];
            if (isset($_GET['id'])) {
                
                $sql = "UPDATE `product` SET `user_id`='".$id."',`title`='".$_POST['title']."',`price`='".$_POST['price']."',`image`='".$fileName."' WHERE `id` = ".$_GET['id']."";
                if ($result = $con->query($sql)) {
                    $dk = "<span style='color:red;'>Chỉnh sửa thông tin thành công Click vào <a href='product.php'>đây</a> để về trang chủ</span>";
                }else{
                    $dk = "<h1>Có lỗi xảy ra</h1>";
                }

            }else{
                $sql = "INSERT INTO `product`(`user_id`, `title`, `price`, `image`) VALUES ('".$id."','".$_POST['title']."','".$_POST['price']."','".$fileName."')";

                if ($result = $con->query($sql)) {
                    header("location: product.php");
                }else{
                    echo "huhu";
                    $dk = "Thêm sản phẩm thất bại Vui lòng <a href='product.php'>Click</a> vào đây để trở về trang sản phẩm!!";
                }
            }
        }


    }


?>