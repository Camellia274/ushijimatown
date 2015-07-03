<?php
//セッションスタート
session_start();

//グローバル変数
$message = null;
$flag = true;

//メールアドレスが入力されていなかった場合
if ($_POST['useremail'] == null){
	$GLOBALS['flag'] = false;
}
//パスワードが入力されていなかった場合
elseif ($_POST['userpassword'] == null){
	$GLOBALS['flag'] = false;
}
//確認用パスワードが入力されていなかった場合
elseif ($_POST['userpasswordcheck'] == null){
	$GLOBALS['flag'] = false;
}
//氏名が入力されていなかった場合
elseif ($_POST['name'] == null){
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
		$GLOBALS['message'] = "すべての項目を入力してください";
		$_SESSION['newmembermessage'] = $GLOBALS['message'];

		//新規登録画面へ戻る
		header('location: ../html/newmember.html');
		exit();
		break;

	//すべての項目が入力されている場合
	case true:
		//セッションに入力値を入れる
		$_SESSION['useremail'] = $_POST['useremail'];
		$_SESSION['userpassword'] = $_POST['userpassword'];
		$_SESSION['userpasswordcheck'] = $_POST['userpasswordcheck'];
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['kana'] = $_POST['kana'];
		$_SESSION['postno'] = $_POST['postno'];
		$_SESSION['address'] = $_POST['address'];
		$_SESSION['telno'] = $_POST['telno'];

		//パスワードと確認用パスワード一致確認へ進む
		header('location: newmemberpasswordcheck.php');
		exit();
		break;
}
?>