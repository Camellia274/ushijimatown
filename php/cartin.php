<?php
	session_start();

	$_SESSION['cart'] = array($_POST['goodsid'], $_POST['quantity']);

	header("location: ./cart.php");
	exit();
?>