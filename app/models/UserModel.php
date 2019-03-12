<?

class User
{
	//herdcoded authData
	private $validLogin = 'admin';
	
	private $validPassword = '123';
	
	
	public function auth(string $login, string $password)
	{
		if ($login ===  $this->validLogin & $password === $this->validPassword) {
			
			$_SESSION['admin'] = 'true';
			
		} else $_SESSION['errors'][] = 'Wrong login or password';
		
		return;
	}
	
	
	public function logout()
	{
		unset($_SESSION['admin']);
		
		header("Location: /taskManager");
		
		return;
	}
}
