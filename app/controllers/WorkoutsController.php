<?php
class WorkoutsController {
    public static function save() {
        global $pdo;
        // Obține lista de exerciții din baza de date
        $stmt = $pdo->prepare("SELECT id, name FROM exercises");
        $stmt->execute();
        $exercises = $stmt->fetchAll();
        
        // Verifică dacă formularul a fost trimis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Preia datele din formular
            $userId = $_SESSION['user']['id']; // presupunem că utilizatorul este autentificat
            $exerciseId = $_POST['exercise_id'];
            $sets = $_POST['sets'];
            $reps = $_POST['reps'];
            $weight = $_POST['weight'] ?? NULL; // dacă nu este specificată greutatea, lasă NULL

            // Conectează-te la baza de date
            global $pdo;

            // Inserare în tabela workouts
            $query = "INSERT INTO workouts (user_id, exercise_id, sets, reps, weight) 
                      VALUES (:user_id, :exercise_id, :sets, :reps, :weight)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':exercise_id', $exerciseId);
            $stmt->bindParam(':sets', $sets);
            $stmt->bindParam(':reps', $reps);
            $stmt->bindParam(':weight', $weight);

            if ($stmt->execute()) {
                echo "Workout salvat cu succes!";
            } else {
                echo "A apărut o eroare la salvarea workout-ului.";
            }
            header('Location: /DAW2024/workouts/index');
        }
    }   
    public static function index() {
        // Obține lista de exerciții din baza de date
        
        global $pdo;
        
        $stmt = $pdo->prepare("SELECT id, name FROM exercises");
        $stmt->execute();
        $exercises = $stmt->fetchAll();

        $userId = $_SESSION['user']['id'];
        $userRole = $_SESSION['user']['role_id'];

        if($userRole == 1){
            // Obține toate workout-urile utilizatorului
            $query = "SELECT w.sets, w.reps, w.weight, e.name AS exercise_name, w.date 
                    FROM workouts w 
                    JOIN exercises e ON w.exercise_id = e.id
                    WHERE w.user_id = :user_id 
                    ORDER BY w.date DESC";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            
            $workouts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            require_once 'app/views/workouts/userIndex.php'; // Aici încarci un view care să afișeze datele
        }
        else {
            // Obține toate workout-urile tuturor utilizatorilor
            $query = "SELECT 
                w.sets, 
                w.reps, 
                w.weight, 
                e.name AS exercise_name, 
                w.date, 
                u.first_name, 
                u.last_name 
            FROM workouts w 
            JOIN exercises e ON w.exercise_id = e.id 
            JOIN users u ON w.user_id = u.id 
            ORDER BY w.date DESC";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            
            $workouts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            require_once 'app/views/workouts/adminIndex.php'; // Aici încarci un view care să afișeze datele
        }

        // Afișează workout-urile
    }
}
?>