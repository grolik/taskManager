<?php

class Db
{
		public static function getConnection()
		{
			$paramsPath = ROOT . 'config/DB_params.php';
			$params = include($paramsPath);
			
			$dbn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8";
			$db = new PDO($dbn, $params['user'], $params['password']);
			
			return $db;
		}
}
