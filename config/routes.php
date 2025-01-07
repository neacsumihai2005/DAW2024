<?php
$routes = [
    "DAW2024" => ["HomeController", "index"], 
    "DAW2024/home" => ["HomeController", "index"], 
    "DAW2024/login" => ["HomeController", "login"], 
    "DAW2024/logout" => ["HomeController", "logout"], 
    "DAW2024/register" => ["RegisterController", "index"], 
    "DAW2024/register/formular" => ["RegisterController", "formular"], 
    "DAW2024/confirm/{token}" => ["RegisterController", "confirm"],
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
    "DAW2024/workouts/index" => ["WorkoutsController", "index"],
    "DAW2024/news" => ["NewsController", "showFitnessNews"]
];
class Router {
    private $uri;
    private $params = [];

    public function __construct() {
        // Obține URI-ul curent
        $this->uri = trim($_SERVER["REQUEST_URI"], "/");
    }

    public function direct() {
        global $routes;

        // Căutăm o rută care să fie potrivită cu parametrii dinamici
        foreach ($routes as $route => $action) {
            // Creăm un pattern regulat pentru a extrage parametrii (ex. token)
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[\w-]+)', $route);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $this->uri, $matches)) {
                // Dacă găsim o potrivire, extragem parametrii din URI
                $this->params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Verifică că controllerul și metoda există și sunt valide
                [$controller, $method] = $action;

                // Includem fișierul controller-ului și apelăm metoda corespunzătoare
                require_once "app/controllers/{$controller}.php";

                // Executăm metoda controller-ului cu parametrii extrase
                return $controller::$method($this->params);
            }
        }

        // Dacă nu am găsit nicio rută, încărcăm pagina de eroare 404
        require_once 'app/views/404/404.php'; // Sau altă cale dacă pagina 404 se află într-o altă locație
        exit();
    }
}


?>