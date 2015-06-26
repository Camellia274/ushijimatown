<?php
	include 'common.php';

	class login extends common{
		$a = new login();

		$a->login($_POST['useremail'], $_POST['userpassword']);

		header('location: ../html/phptest.html');
		exit();
	}
?>