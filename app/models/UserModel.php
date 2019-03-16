<?

class User
{
    function __construct()
    {
        $this->isAdmin = isset($_SESSION['admin']);
    }
    
    public function auth(string $login, string $password): bool
    {
        return ($login === 'admin' & $password === '123');
    }
}
