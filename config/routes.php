<?php
$routes = [
    "DAW2024" => ["HomeController", "index"], 
    "DAW2024/home" => ["HomeController", "index"], 
    "DAW2024/login" => ["HomeController", "login"], 
    "DAW2024/logout" => ["HomeController", "logout"], 
    "DAW2024/register" => ["RegisterController", "index"], 
    "DAW2024/register/formular" => ["RegisterController", "formular"], 
    "DAW2024/exercises/index" => ["ExerciseController", "index"],
    "DAW2024/exercises/formular" => ["ExerciseController", "formular"],
    "DAW2024/exercises/store" => ["ExerciseController", "store"],
    "DAW2024/classes/index" => ["GroupClassController", "index"],
    "DAW2024/classes/today" => ["GroupClassController", "today"],
    "DAW2024/classes/formular" => ["GroupClassController", "formular"],
    "DAW2024/classes/save" => ["GroupClassController", "save"],
    "DAW2024/dashboard" => ["DashboardController", "index"], 
    "DAW2024/user/delete" => ["UserController", "deleteMine"],  
    "DAW2024/users/index" => ["UserController", "index"],
    "DAW2024/users/deleteSomeones" => ["UserController", "deleteSomeones"],  
    "DAW2024/users/promote" => ["UserController", "promote"],  
    "DAW2024/users/demote" => ["UserController", "demote"],  
    "DAW2024/users/edit" => ["UserController", "edit"],  
    "DAW2024/workouts/create" => ["WorkoutsController", "create"],
    "DAW2024/workouts/save" => ["WorkoutsController", "save"],
    "DAW2024/workouts/index" => ["WorkoutsController", "index"]
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