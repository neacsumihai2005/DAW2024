<?php
require_once "app/models/groupclasses.php";

class GroupClassController{
    public static function index(){
        if (!isset($_SESSION['user'])) {
            header('Location: /DAW2024');
            exit();
        }

        $groupclasses = GroupClass::getAllGroupClasses();
        require_once "app/views/groupclasses/index.php";
    }

    public static function today(){
        if (!isset($_SESSION['user'])) {
            header('Location: /DAW2024');
            exit();
        }
        
        $todayGroupClasses = GroupClass::getTodayGroupClasses();
        require_once "app/views/groupclasses/today.php";
    }
    
    public static function formular(){
        if (!isset($_SESSION['user'])) {
            header('Location: /DAW2024');
            exit();
        }

        global $pdo;

        // Preia utilizatorii care vor putea fi instructori
        $query = "SELECT id, first_name, last_name FROM users"; // Se presupune că ai un câmp `first_name` și `last_name` pentru utilizatori
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Salvează utilizatorii într-un array
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once "app/views/groupclasses/formular.php";
    }

    public static function save() {
        if (!isset($_SESSION['user'])) {
            header('Location: /DAW2024');
            exit();
        }
        global $pdo;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Preia datele din formular
            $name = $_POST['name'];
            $description = $_POST['description'];
            $instructor_id = $_POST['instructor_id'];
            $schedule = $_POST['schedule'];
            $capacity = $_POST['capacity'];
    
            // Inserare în baza de date
            $query = "INSERT INTO group_classes (name, description, instructor_id, schedule, capacity)
                      VALUES (:name, :description, :instructor_id, :schedule, :capacity)";
            $stmt = $pdo->prepare($query);
    
            // Leagă parametrii
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':instructor_id', $instructor_id);
            $stmt->bindParam(':schedule', $schedule);
            $stmt->bindParam(':capacity', $capacity);
    
            // Execută interogarea
            $stmt->execute();
    
            // Redirect către o altă pagină sau afișează un mesaj de succes
            header("Location: /DAW2024/classes/index");
            exit();
        }
    }
}
?>