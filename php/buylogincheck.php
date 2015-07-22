<?php
	//グローバル変数
	$userid = null;
	$useremail = null;
	$userpassword = null;
	$username = null;
	$errormessage = null;
	$point = null;

	//ログイン処理
	function login(){
		// mysqliクラスのオブジェクトを作成
		$mysqli = new mysqli('localhost', 'root', 'root', 'ushijimatown');
		if ($mysqli->connect_error) {
			echo $mysqli->connect_error;
			exit();
		}
		else {
			$mysqli->set_charset("utf8");
		}

		// ここにDB処理いろいろ書く
		$sql = "SELECT member_id, email_address, password, name, point FROM member WHERE email_address=? AND password=?";
		if ($stmt = $mysqli->prepare($sql)) {
			// 条件値をSQLにバインドする
			$stmt->bind_param("ss", $_POST['useremail'], $_POST['userpassword']);

			// 実行
			$stmt->execute();

			// 取得結果を変数にバインドする
			$stmt->bind_result($member_id, $email_address, $password, $name, $point);
			while ($stmt->fetch()) {
				$GLOBALS['point'] = $point;
				$GLOBALS['userid']  = $member_id;
				$GLOBALS['useremail'] = $email_address;
				$GLOBALS['userpassword'] = $password;
				$GLOBALS['username'] = $name;
			}
			$stmt->close();
		}
		// DB接続を閉じる
		$mysqli->close();
	}

	//セッション開始
	session_start();

	//メールアドレスとパスワードが入力されている場合
	if($_POST['useremail'] != null && $_POST['userpassword'] != null){
		//ログイン処理
		login();
		//メールアドレスとパスワードが一致する場合
		if ($_POST['useremail'] == $useremail && $_POST['userpassword'] == $userpassword) {
			//セッションにユーザIDとユーザパスワードを入れる
			$_SESSION['userid'] = $GLOBALS['userid'];
			$_SESSION['username'] = $GLOBALS['username'];
			$_SESSION['point'] = $GLOBALS['point'];
		}
		else {
			//グローバル変数にエラーメッセージを格納する
			$GLOBALS['errormessage'] = "メールアドレスまたは、パスワードが違います。";
		}
	}
	//メールアドレスとパスワードが入力されていない場合
	elseif ($_POST['useremail'] == null && $_POST['userpassword'] == null){
		//グローバル変数にエラーメッセージを格納する
		$GLOBALS['errormessage'] = "<font color=\"#da0b00\">※メールアドレスとパスワードが入力されていません。</font>";
	}
	//メールアドレスが入力されていない場合
	elseif ($_POST['useremail'] == null){
		//グローバル変数にエラーメッセージを格納する
		$GLOBALS['errormessage'] = "<font color=\"#da0b00\">※メールアドレスが入力されていません。</font>";
	}
	//パスワードが入力されていない場合
	elseif ($_POST['userpassword'] == null){
		//グローバル変数にエラーメッセージを格納する
		$GLOBALS['errormessage'] = "<font color=\"#da0b00\">※パスワードが入力されていません。</font>";
	}

	//セッションにエラーメッセージを格納する
	$_SESSION['errormessage'] = $GLOBALS['errormessage'];

	//画面遷移
	header('location: ./buystep1.php');
	exit();
?>