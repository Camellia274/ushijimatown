<?php
	//グローバル変数
	$userid;
	$username;

	//ログイン
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
				$GLOBALS['username'] = $name;
			}
			$stmt->close();
		}
		// DB接続を閉じる
		$mysqli->close();
	}

	login();

	session_start();
	$_SESSION["userid"] = $userid;
	$_SESSION["username"] = $username;

	header('location: ../html/phptest2.html');
	exit();
?>