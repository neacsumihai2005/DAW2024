<?php

class HomeController {
    public static function index() {
        // Verifică dacă formularul de login a fost trimis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];  // Numele utilizatorului este folosit ca email
            $password = $_POST['password'];

            // Folosește PDO-ul din config/pdo.php pentru a te conecta la baza de date
            global $pdo;

            // Căutăm utilizatorul în baza de date pe baza email-ului
            $query = "SELECT id, first_name, last_name, password FROM users WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $password === $user['password']) {
                // Autentificare reușită
                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name']
                ];
                header("Location: /SalaFitness/dashboard"); // Redirecționează către pagina principală
                exit();
            } else {
                // Autentificare eșuată
                $error_message = 'Datele de autentificare sunt incorecte.';
                require_once 'app/views/home/index.php';  // Reîncarcă pagina de login cu mesajul de eroare
                return;
            }
        }

        // Încarcă view-ul de login
        require_once 'app/views/home/index.php';
    }

}
?>