<?php
	//セッションを開始する
	session_start();

	//ユーザ名とユーザIDのセッションを削除する
	if (isset($_SESSION['username']) && isset($_SESSION['userid'])){
		unset($_SESSION['username']);
		unset($_SESSION['userid']);
	}

	// セッション変数を全て解除する
	$_SESSION = array();

	// 最終的に、セッションを破壊する
	session_destroy();

	//画面遷移
	header('location: ../html/logout.html');
	exit();
?>