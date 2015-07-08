<?php
	//セッション開始
	session_start();

	//新規会員登録
	function memberinsert(){
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
		$sql = "INSERT INTO member(name, kana, address, postal_code, password, email_address, phone_number)
				VALUES(?,?,?,?,?,?,?)";
		if ($stmt = $mysqli->prepare($sql)) {
			// 条件値をSQLにバインドする
			$stmt->bind_param("sssssss", $_SESSION['name'], $_SESSION['kana'], $_SESSION['address'],
								$_SESSION['postno'], $_SESSION['userpassword'], $_SESSION['useremail'],
								$_SESSION['telno']);

			// 実行
			$stmt->execute();

			$stmt->close();
		}
		// DB接続を閉じる
		$mysqli->close();
	}

	//新規登録実行
	memberinsert();

	//ユーザ入力値のセッションを削除
	unset($_SESSION['useremail']);
	unset($_SESSION['userpassword']);
	unset($_SESSION['userpasswordcheck']);
	unset($_SESSION['name']);
	unset($_SESSION['kana']);
	unset($_SESSION['postno']);
	unset($_SESSION['address']);
	unset($_SESSION['telno']);

	//画面遷移
	header('location: ../html/newmemberend.html');
	exit();
?>