<?php
//セッションスタート
session_start();

//グローバル変数
$message = null;

//パスワードと確認用パスワードが一致しなかった場合
if ($_POST['userpassword'] != $_POST['userpasswordcheck']){
	//グローバル変数にメッセージを格納
	$GLOBALS['message'] = "パスワードと確認用パスワードが一致しません";

	//セッションにメッセージを格納
	$_SESSION['message'] = $GLOBALS['message'];

	//新規登録画面へ戻る
	header('location: ../html/newmember.html');
	exit();
}

//パスワードと確認用パスワードが一致した場合
elseif ($_POST['userpassword'] == $_POST['userpasswordcheck']){
	//セッションに入力値を入れる
	$_SESSION['useremail'] = $_POST['useremail'];
	$_SESSION['userpassword'] = $_POST['userpassword'];
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['kana'] = $_POST['kana'];
	$_SESSION['postno'] = $_POST['postno'];
	$_SESSION['address'] = $_POST['address'];
	$_SESSION['telno'] = $_POST['telno'];

	//新規登録確認画面へ進む
	header('location: ../html/newmembercheck.html');
	exit();
}
?>