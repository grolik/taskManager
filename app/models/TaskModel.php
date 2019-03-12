<?

class Task
{
	private $tasksPerPage = 3;
	
	public $sortBy, $sortOrder, $isAdmin, $page;
	
	function __construct()
	{
		$this->isAdmin = $this->checkAdmin();
	}
	
	public function getTaskList(int $pageNum): array
	{
		$page = [];
		
		$page['tasks'] = $this->getTasks($pageNum);
		
		$page['pageNum'] = $pageNum;
		
		$page['pagesCount'] = $this->getPagesCount();
		
		$page['isAdmin'] = $this->checkAdmin();
		
		$page['alerts'] = $this->checkAlerts('alerts');
		
		$page['errors'] = $this->checkAlerts('errors');
		
		return $page;
	}
	
	
	private function getTasks(int $page): array
	{
		$tasks = [];
		
		$db = Db::getConnection();
		
		$offset = ($page - 1) * $this->tasksPerPage;
		
		$sortBy = $this->sortBy;
		
		$sortOrder = $this->sortOrder;
		
		$tasksPerPage = $this->tasksPerPage;
		
		$query = "
		  SELECT	id, name, email, text, done
		    FROM	tasks
		ORDER BY	{$sortBy} {$sortOrder}
		   LIMIT	{$tasksPerPage}
		  OFFSET	{$offset}";
        
        $result = $db->prepare($query);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $result->execute();
        
		$i = 0;
		
		while($row = $result->fetch()) {
			
			$tasks[$i]['id'] = $row['id'];
			
			$tasks[$i]['name'] = $row['name'];
			
			$tasks[$i]['email'] = $row['email'];
			
			$tasks[$i]['text'] = $row['text'];
			
			$tasks[$i]['done'] = $row['done'] == "1" ? "true" : "false";
			
			$i++;
		}
		
		return $tasks;
	}
	
	public function getTaskById(int $id): ?array
	{
		$task = [];
		
		$db = Db::getConnection();
		
		$query = "
		SELECT	id, name, email, text, done
		  FROM	tasks
		 WHERE	id = :id";
        
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
		
		$task['isAdmin'] = $this->checkAdmin();
			
		return $task;
	}
	
	
	public final function updateTask(int $id, string $name, string $email, string $text, int $done)
	{
		$task = [];
		
		$db = Db::getConnection();
		
		$query = "
		UPDATE	tasks
		   SET	name = :name, email = :email, text = :text, done = :done
		 WHERE	id = :id";
        
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
		
		$query = "
		INSERT
		  INTO	tasks (name, email, text)
		VALUES	(:name, :email, :text)";
        
        $result = $db->prepare($query);
        
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        
        $result->execute();
		
		return;
	}
	
	
	private function getPagesCount(): int
	{
		$db = Db::getConnection();
		
		$query = '
		SELECT COUNT(id) FROM tasks';
		
		$result = $db->prepare($query);
		
		$result->execute();
		
		return ceil($result->fetchColumn() / $this->tasksPerPage);
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
	
	
	private function checkAdmin(): bool
	{
		return isset($_SESSION['admin']) ? true : false;
	}
}
