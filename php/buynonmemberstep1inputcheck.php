<?php
//セッションスタート
session_start();

//グローバル変数
$message = null;
$flag = true;

//氏名が入力されていなかった場合
if ($_POST['name'] == null){
	$GLOBALS['flag'] = false;
}
//フリガナが入力されていなかった場合
elseif ($_POST['kana'] == null){
	$GLOBALS['flag'] = false;
}
//郵便番号が入力されていなかった場合
elseif ($_POST['postno'] == null){
	$GLOBALS['flag'] = false;
}
//住所が入力されていなかった場合
elseif ($_POST['address'] == null){
	$GLOBALS['flag'] = false;
}
//電話番号が入力されていなかった場合
elseif ($_POST['telno'] == null){
	$GLOBALS['flag'] = false;
}

switch ($flag){
	//入力されていない項目がある場合
	case false:
		$GLOBALS['message'] = "<font color=\"#FF0000\">※すべての項目を入力してください</font>";
		$_SESSION['inputcheckmessage'] = $GLOBALS['message'];

		//配送先情報入力画面へ戻る
		header('location: ./buynonmemberstep1.php');
		exit();
		break;

	//すべての項目が入力されている場合
	case true:
		//セッションに入力値を入れる
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['kana'] = $_POST['kana'];
		$_SESSION['postno'] = $_POST['postno'];
		$_SESSION['address'] = $_POST['address'];
		$_SESSION['telno'] = $_POST['telno'];

		//配送方法画面へ進む
		header('location: ./buynonmemberstep2.php');
		exit();
		break;
}
?>