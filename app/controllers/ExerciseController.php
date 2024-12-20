<?php
require_once "app/models/exercises.php";

class ExerciseController{
    public static function index(){
        if (!isset($_SESSION['user'])) {
            header('Location: /DAW2024');
            exit();
        }

        $exercises = Exercise::getAllExercises();
        require_once "app/views/exercises/index.php";
    }

    public static function formular(){
        if (!isset($_SESSION['user'])) {
            header('Location: /DAW2024');
            exit();
        }
        $userRole = $_SESSION['user']['role_id'];

        // Permitem doar admin-ilor și owner-ilor să vadă lista
        if ($userRole == 1) {
            echo "Acces interzis. Doar admin-ii și owner-ii pot adauga exercitii noi.";
            exit();
        }

        require_once "app/views/exercises/formular.php";
    }

    public static function store() {
        // Verificăm dacă formularul a fost trimis prin POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Preluăm datele din formular
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $youtube_video_id = $_POST['youtube_video_id'];

            // Conectare la baza de date (poți folosi PDO sau altă metodă de conectare)
            global $pdo;

            // Pregătim interogarea SQL pentru a insera datele în baza de date
            $query = "INSERT INTO exercises (name, description, category, youtube_video_id) 
                      VALUES (:name, :description, :category, :youtube_video_id)";
            $stmt = $pdo->prepare($query);

            // Leagă parametrii de interogare
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':youtube_video_id', $youtube_video_id);

            // Execută interogarea
            if ($stmt->execute()) {
                // Dacă inserarea a avut succes, redirecționăm utilizatorul
                header("Location: /DAW2024/exercises/index"); // Redirecționează către lista de exerciții
                exit();
            } else {
                // Dacă a apărut o eroare, afișăm un mesaj
                echo "Eroare la adăugarea exercițiului!";
            }
        } else {
            // În cazul în care nu s-a trimis formularul, afisăm un mesaj de eroare
            echo "Te rog să completezi formularul!";
        }
    }
}

?>