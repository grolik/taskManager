<?php

include_once ROOT. 'models/UserModel.php';

class UserController
{
	public static function actionLogin()
	{
		if (isset($_POST['submit'])) {
			
			$login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
			
			if (!$login) $_SESSION['errors'][] = 'Login must be a string';
			
			$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
			
			if (!$password) $_SESSION['errors'][] = 'Password must be a string';
			
			$auth = new User();
			
			$auth->auth($login, $password);
		}
		
		return;
	}
	
	
	public static function actionLogout()
	{
		$auth = new User();
			
		$auth->logout();
		
		return;
	}
}
