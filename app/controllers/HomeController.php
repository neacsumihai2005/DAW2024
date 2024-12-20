<?php

class HomeController {
    public static function index() {
        // Încarcă view-ul pentru pagina de login
        
        // Distruge toate datele din sesiune
        session_unset();

        // Distruge sesiunea curentă
        session_destroy();

        require_once 'app/views/home/index.php';
    }

    public static function login() {
        // Verifică dacă cererea este de tip POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Preia datele trimise din formular
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            // Conectare la baza de date
            global $pdo;

            // Caută utilizatorul după email
            $query = "SELECT id, first_name, last_name, password, email, role_id FROM users WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);


            // Verifică dacă utilizatorul există și parola este corectă
            if ($user && $password === $user['password']) { // Înlocuiește verificarea cu password_verify pentru hash
                // Autentificare reușită
                session_start();
                $_SESSION['user'] = [
                    'email' => $user['email'],
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'role_id' => $user['role_id']  // Adaugă role_id aici
                ];
                header("Location: /DAW2024/dashboard");
                exit();
            } else {
                // Autentificare eșuată
                $error_message = "Email sau parolă incorectă.";
                require_once 'app/views/home/index.php'; // Reîncarcă view-ul cu mesajul de eroare
                return;
            }
        } else {
            // Dacă metoda nu este POST, redirecționează la pagina de login
            header("Location: /DAW2024");
            exit();
        }
    }

    public static function logout() {
        // Începem sesiunea
        session_start();

        // Ștergem toate datele din sesiune
        session_unset();

        // Distrugem sesiunea
        session_destroy();

        header('Location: /DAW2024');
        exit();
    }
}
?>
