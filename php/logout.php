<?php

	// セッション変数を全て解除する
	$_SESSION = array();

	// 最終的に、セッションを破壊する
	session_destroy();

	//画面遷移
	header('location: ../html/logout.html');
	exit();
?>