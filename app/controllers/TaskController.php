<?php

include_once ROOT. '/models/TaskModel.php';

class TaskController
{
	public function actionIndex(int $pageNum = 1)
	{
		$tasks = new Task();
		
		$tasks->sortBy = isset($_SESSION['sortBy']) ? $_SESSION['sortBy'] : "id";
		
		$tasks->sortOrder = isset($_SESSION['sortOrder']) ? $_SESSION['sortOrder'] : "ASC";
		
		$page = $tasks->getTaskList($pageNum);
		
		require_once(ROOT . '/views/task/index.php');
		
		return;
	}
	
	
	public static function actionEdit(int $id)
	{
		if (!filter_var($id, FILTER_VALIDATE_INT)) $_SESSION['errors'][] = 'Task ID must be integer';
		
		$task = new Task();
		
		$page = $task->getTaskById($id);
		
		if (!$task->isAdmin) $_SESSION['errors'][] = 'Only admin can edit tasks';
		
		if (!$page) $_SESSION['errors'][] = 'Not valid task ID';
		
		if (!empty($_SESSION['errors'])) return;
		
		$page['isAdmin'] = true;
		
		require_once(ROOT . '/views/task/edit.php');
		
		return true;
	}
	
	
	public static function actionUpdate()
	{
		$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$text = $_POST['text'];
		$done = (isset($_POST['done'])) ? 1 : 0;
		
		$task = new Task();
		
		if (!$task->isAdmin) $_SESSION['errors'][] = 'Only admin can edit tasks';
		
		if (!filter_var($id, FILTER_VALIDATE_INT)) $_SESSION['errors'][] = 'Task ID must be integer';
		
		if (!filter_var($name, FILTER_SANITIZE_STRING)) $_SESSION['errors'][] = 'Name must be only string';
		
		if (!filter_var($email, FILTER_SANITIZE_STRING)) $_SESSION['errors'][] = 'Enter correct email';
		
		if (!filter_var($text, FILTER_SANITIZE_STRING)) $_SESSION['alerts'][] = 'Task cleared from specialchars';
		
		
		if (empty($_SESSION['errors'])) {
			
			$task->updateTask($id, $name, $email, $text, $done);
			
			$_SESSION['sortBy'] = "done";
			
			$_SESSION['sortOrder'] = "DESC";
			
			$_SESSION['alerts'][] = 'Task updated successfully';
			
		}
		
		header('Location: /taskManager');
		
		exit;
	}
	
	
	public function actionNew()
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$text = $_POST['text'];
		
		if (!filter_var($name, FILTER_SANITIZE_STRING)) $_SESSION['errors'][] = 'Name must be only string';
		
		if (!filter_var($email, FILTER_SANITIZE_STRING)) $_SESSION['errors'][] = 'Enter correct email';
		
		if (!filter_var($text, FILTER_SANITIZE_STRING)) $_SESSION['alerts'][] = 'Task cleared from specialchars';
		
		$task = new Task();
		
		if (empty($_SESSION['errors'])) {
			
			$task->newTask($name, $email, $text);
			
			$_SESSION['sortBy'] = "id";
			
			$_SESSION['sortOrder'] = "DESC";
			
			$_SESSION['alerts'][] = 'New task created';
			
		}
		
		header('Location: /taskManager');
		
		exit;
	}
	
	
	public static function actionSort(string $field, string $direction)
	{
		filter_var($field, FILTER_SANITIZE_STRING);
		
		filter_var($direction, FILTER_SANITIZE_STRING);
		
		$allowFields = ['id', 'name', 'email', 'done'];
		
		$allowDirection = ['asc', 'desc'];
		
		if (!in_array($field, $allowFields) or !in_array($direction, $allowDirection)) {
			
			$_SESSION['errors'][] = 'Wrong sort params';
		}
		
		if (empty($_SESSION['errors'])) {
			
			$_SESSION['sortBy'] = $field;
			
			$_SESSION['sortOrder'] = $direction;
			
		}
		
		header('Location: /taskManager');
		
		exit;
	}
}
