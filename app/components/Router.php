<?php

class Router
{

    private $routes;
    
    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    
    private function getURL()
    {
        if (!empty ($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    
    public function start()
    {
        $uri = $this->getURL();
        foreach ($this->routes as $uriPattern => $path) {
            if(preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $uriParts = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($uriParts)).'Controller';
                $controllerFile = ROOT . 'controllers/' .$controllerName. '.php';
                $actionName = 'action'.ucfirst(array_shift($uriParts));
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                    $controllerObject = new $controllerName;
                    $result = call_user_func_array(array($controllerObject, $actionName), $uriParts);
                }
                if ($result != null) {
                    break;
                }
            }
        }
    }
}
