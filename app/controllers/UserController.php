<?php
require_once "app/models/users.php";

class UserController {
    public static function index() {
        $users = User::getAllUsers();
        require_once "app/views/users/index.php";
    }

    public static function delete() {
        global $pdo;

        if (isset($_SESSION['user']['email'])) {
            $userEmail = $_SESSION['user']['email'];
            echo($userEmail);
            try {
                // Ștergem utilizatorul din baza de date folosind email-ul
                $stmt = $pdo->prepare("DELETE FROM users WHERE email = :email");
                $stmt->bindParam(':email', $userEmail);
                $stmt->execute();

                // Distrugem sesiunea după ștergerea contului
                session_unset();
                session_destroy();

                // Redirecționăm la pagina de login
                header("Location: /SalaFitness/home");
                exit();
            } catch (PDOException $e) {
                echo "A apărut o eroare la ștergerea utilizatorului: " . $e->getMessage();
            }
        } else {
            // Dacă utilizatorul nu este autentificat, redirecționăm la login
            header("Location: /SalaFitness/home");
            exit();
        }
    }
}
