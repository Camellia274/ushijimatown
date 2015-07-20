<?php
	session_start();

	unset($_SESSION['cartgoodsid']);
	unset($_SESSION['cartquantity']);

	header("location: ./cart.php");
	exit();
?>