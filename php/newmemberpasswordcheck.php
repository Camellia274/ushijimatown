<?php
//セッションスタート
session_start();

//グローバル変数
$message = null;

//パスワードと確認用パスワードが一致しなかった場合
if ($_SESSION['userpassword'] != $_SESSION['userpasswordcheck']){
	//グローバル変数にメッセージを格納
	$GLOBALS['message'] = "パスワードと確認用パスワードが一致しません";

	//セッションにメッセージを格納
	$_SESSION['newmembermessage'] = $GLOBALS['message'];

	//新規登録画面へ戻る
	header('location: ../html/newmember.html');
	exit();
}

//パスワードと確認用パスワードが一致した場合
elseif ($_SESSION['userpassword'] == $_SESSION['userpasswordcheck']){
	//新規登録確認画面へ進む
	header('location: ../html/newmembercheck.html');
	exit();
}
?>