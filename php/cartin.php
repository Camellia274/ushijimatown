<?php
	session_start();

	if (!isset($_SESSION['cartgoodsid']) && !isset($_SESSION['cartquantity'])) {
		$gid = array($_POST['goodsid']);
		$q = array($_POST['quantity']);

		$_SESSION['cartgoodsid'] = $gid;
		$_SESSION['cartquantity'] = $q;

		header("location: ./cart.php");
		exit();
	}

	elseif (isset($_SESSION['cartgoodsid']) && isset($_SESSION['cartquantity'])) {
		$gid = $_SESSION['cartgoodsid'];
		$q = $_SESSION['cartquantity'];

		array_push($gid, $_POST['goodsid']);
		array_push($q, $_POST['quantity']);

		$_SESSION['cartgoodsid'] = $gid;
		$_SESSION['cartquantity'] = $q;

		header("location: ./cart.php");
		exit();
	}
?>