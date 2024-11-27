<?php
class RegisterController{
    public static function index() {
            // Verifică dacă formularul de înregistrare a fost trimis
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Criptare parolă (opțional, dacă nu vrei criptare, folosește o metodă simplă)
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                global $pdo;

                // Inserare utilizator în baza de date
                $query = "INSERT INTO users (first_name, last_name, email, password, role_id) 
                        VALUES (:first_name, :last_name, :email, :password, 1)";  // 1 pentru rolul de client
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':first_name', $first_name);
                $stmt->bindParam(':last_name', $last_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                // Redirect după înregistrare
                header("Location: /SalaFitness/home");
                exit();
            }

            // Încarcă view-ul pentru înregistrare
            require_once 'app/views/register/index.php';
        }
}
?>