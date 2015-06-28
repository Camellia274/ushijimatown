<?php
	//グローバル変数
	$userid;
	$useremail;
	$userpassword;
	$username;
	$errormessage;

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
		$sql = "SELECT member_id, email_address, password, name FROM member WHERE email_address=? AND password=?";
		if ($stmt = $mysqli->prepare($sql)) {
			// 条件値をSQLにバインドする
			$stmt->bind_param("ss", $_POST['useremail'], $_POST['userpassword']);

			// 実行
			$stmt->execute();

			// 取得結果を変数にバインドする
			$stmt->bind_result($member_id, $email_address, $password, $name);
			while ($stmt->fetch()) {
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
		}
		else {
			//グローバル変数にエラーメッセージを格納する
			$GLOBALS['errormessage'] = "メールアドレスまたは、パスワードが違います。";
		}
	}
	//メールアドレスが入力されていない場合
	elseif ($_POST['useremail'] == null){
		//グローバル変数にエラーメッセージを格納する
		$GLOBALS['errormessage'] = "メールアドレスが入力されていません。";
	}
	//パスワードが入力されていない場合
	elseif ($_POST['userpassword'] == null){
		//グローバル変数にエラーメッセージを格納する
		$GLOBALS['errormessage'] = "パスワードが入力されていません。";
	}

	//セッションにエラーメッセージを格納する
	$_SESSION['errormessage'] = $GLOBALS['errormessage'];

	//画面遷移
	header('location: ../html/phptest.html');
	exit();
?>