<?php
$routes = [
    "SalaFitness/users/index" => ["UserController", "index"],
    "SalaFitness/exercises/index" => ["ExerciseController", "index"],
    "SalaFitness/classes/index" => ["GroupClassController", "index"],
    "SalaFitness/classes/today" => ["GroupClassController", "today"],
    "SalaFitness/home" => ["HomeController", "index"], 
    "SalaFitness/dashboard" => ["DashboardController", "index"], 
    "SalaFitness/register" => ["RegisterController", "index"], 
    "SalaFitness/dashboard/delete" => ["UserController", "delete"]  // Noua rută pentru ștergere
];

class Router {
    private $uri;

    public function __construct() {
        // Get the current URI
        $this->uri = trim($_SERVER["REQUEST_URI"], "/");
    }

    public function direct(){
        global $routes;

        if(array_key_exists($this->uri, $routes) ){  
            [$controller, $method] = $routes[$this->uri];

            require_once "app/controllers/{$controller}.php";

            return $controller::$method();
        }
    }
}


?>