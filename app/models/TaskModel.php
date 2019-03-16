<?

class Task
{
    public $task;
    public $listTasks;
    
    public function getTasksList(int $page, int $tasksPerPage, string $sortBy, string $sortOrder): array
    {
        $tasks = [];
        $db = Db::getConnection();
        $offset = ($page - 1) * $tasksPerPage;
        $query = "SELECT id FROM tasks ORDER BY $sortBy $sortOrder LIMIT $tasksPerPage OFFSET $offset";
        $result = $db->prepare($query);
        $result->execute();
        while($row = $result->fetch()) {
            $listTasks[] = $row['id'];
        }
        return $listTasks;
    }
    
    public function getTaskById(int $id): ?array
    {
        $task = [];
        $db = Db::getConnection();
        $query = 'SELECT id, name, email, text, done FROM tasks WHERE id = :id';
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();
        if (empty($row)) return null;
        $task['id'] = $row['id'];
        $task['name'] = $row['name'];
        $task['email'] = $row['email'];
        $task['text'] = $row['text'];
        $task['done'] = $row['done'] == "1" ? "true" : "false";
        return $task;
    }
    
    public function updateTask(int $id, string $name, string $email, string $text, int $done)
    {
        $db = Db::getConnection();
        $query = 'UPDATE tasks SET name = :name, email = :email, text = :text, done = :done WHERE id = :id';
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':done', $done, PDO::PARAM_INT);
        $result->execute();
        return;
    }
    
    public function newTask(string $name, string $email, string $text)
    {
        $db = Db::getConnection();
        $query = 'INSERT INTO tasks (name, email, text) VALUES (:name, :email, :text)';
        $result = $db->prepare($query);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->execute();
        return;
    }
    
    public function getPagesCount(int $tasksPerPage): int
    {
        $db = Db::getConnection();
        $query = 'SELECT COUNT(id) FROM tasks';
        $result = $db->prepare($query);
        $result->execute();
        return ceil($result->fetchColumn() / $tasksPerPage);
    }
}
