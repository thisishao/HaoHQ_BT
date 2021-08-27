<?php session_start();
	include 'connect.php';

	// echo $id;
	$Product = [];
	
	if (isset($_POST['getIdproduct'])) {
		$id = $_POST['getIdproduct']; 
		$sql = "SELECT * FROM `product` WHERE `id` = ".$id."";
		$result = $con->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result -> fetch_assoc()) {
				$Product["title"] = $row['title'];
				$Product["price"] = $row['price'];
				$Product["image"] = $row['image'];
				$Product["qty"] = 1;
			}
		}

		if (isset($_SESSION['cart'][$id])) {
			$qty = $_SESSION['cart'][$id]["qty"];
			$qty = $qty + 1;
			$Product["qty"] = $qty;
		}
		$_SESSION['cart'][$id] = $Product;
		print_r($_SESSION['cart']);

		// echo $_SESSION['cart'][$id]['qty'];

	}

	if (isset($_POST['getIDUp'])) {
		$id = $_POST['getIDUp'];

		$qty = $_SESSION['cart'][$id]["qty"];
		$qty = $qty + 1;
		$Product["qty"] = $qty;

		$_SESSION['cart'][$id]['qty'] = $Product["qty"];
		print_r($_SESSION['cart']);
	}

	if (isset($_POST['getIdDow'])) {
		$id = $_POST['getIdDow'];

		$qty = $_SESSION['cart'][$id]["qty"];
		$qty = $qty - 1;
		$Product["qty"] = $qty;

		$_SESSION['cart'][$id]['qty'] = $Product["qty"];
		print_r($_SESSION['cart']);
	}

	// if (isset($_POST['getIdDel'])) {
	// 	$id = $_POST['getIdDel'];
	// 	unset($_SESSION['cart'][$id]);
	// }

	// session_destroy();
?>