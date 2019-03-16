<?php

include_once ROOT. '/models/TaskModel.php';
include_once ROOT. '/models/UserModel.php';

class TaskController
{
    private const TASK_PER_PAGE = 3;
    
    public function actionIndex(int $pageNum = 1)
    {
        $sortBy = isset($_SESSION['sortBy']) ? $_SESSION['sortBy'] : "id";
        $sortOrder = isset($_SESSION['sortOrder']) ? $_SESSION['sortOrder'] : "ASC";
        $tasks = new Task();
        $listTasks = $tasks->getTasksList($pageNum, self::TASK_PER_PAGE, $sortBy, $sortOrder);
        foreach ($listTasks as $taskItem) {
            $list[] = $tasks->getTaskById($taskItem);
        }
        $pagesCount = $tasks->getPagesCount(self::TASK_PER_PAGE);
        $isAdmin = (new User)->isAdmin;
        $errors = $this->checkAlerts('errors');
        $alerts = $this->checkAlerts('alerts');
        require_once(ROOT . '/views/task/index.php');
        return true;
    }
    
    public static function actionEdit(int $id)
    {
        $isAdmin = (new User)->isAdmin;
        if (!$isAdmin) $_SESSION['errors'][] = 'Only admin can edit tasks';
        if (!filter_var($id, FILTER_VALIDATE_INT)) $_SESSION['errors'][] = 'Task ID must be integer';
        if (empty($_SESSION['errors'])) {
            $task = (new Task)->getTaskById($id);
            if (!$task) $_SESSION['errors'][] = 'Not valid task ID';
        }
        if (!empty($_SESSION['errors'])) {
            header('Location: /taskManager');
            exit;
        }
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
        if (!filter_var($id, FILTER_VALIDATE_INT)) $_SESSION['errors'][] = 'Task ID must be integer';
        if (!filter_var($name, FILTER_SANITIZE_STRING)) $_SESSION['errors'][] = 'Name must be only string';
        if (!filter_var($email, FILTER_SANITIZE_STRING)) $_SESSION['errors'][] = 'Enter correct email';
        if (!filter_var($text, FILTER_SANITIZE_STRING)) $_SESSION['alerts'][] = 'Task cleared from specialchars';
        if (!(new User)->isAdmin) $_SESSION['errors'][] = 'Only admin can edit tasks';
        if (empty($_SESSION['errors'])) {
            $task = new Task();
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
        if (empty($_SESSION['errors'])) {
            $task = new Task();
            $task->newTask($name, $email, $text);
            $_SESSION['sortBy'] = "id";
            $_SESSION['sortOrder'] = "DESC";
            $_SESSION['alerts'][] = 'New task created';
        }
        header('Location: /taskManager');
        exit;
    }
    
    public function actionSort(string $field, string $direction)
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
    
    private function checkAlerts(string $type): ?array
    {
        if (!empty($_SESSION[$type])) {
            $alerts = $_SESSION[$type];
            unset($_SESSION[$type]);
            return $alerts;
        }
        return null;
    }
}
