<?php
class RegisterController {

    public static function index() {
        // Verifică dacă formularul de înregistrare a fost trimis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Preia datele din formular
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone_number']; // Noul câmp pentru telefon
            $password = $_POST['password'];

            // Verifică reCAPTCHA
            $recaptcha_secret = '6LeYeKEqAAAAAI7O2eA1Ncdwgv8rgn0xe4RqutFg'; // Secret Key-ul tău
            $recaptcha_response = $_POST['g-recaptcha-response'];
            $recaptcha_verify_url = 'https://www.google.com/recaptcha/api/siteverify';

            // Verificarea reCAPTCHA
            $response = file_get_contents($recaptcha_verify_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha_data = json_decode($response);

            // Dacă reCAPTCHA nu este validă, nu procesăm înregistrarea
            if (!$recaptcha_data->success) {
                echo "Verificarea reCAPTCHA a eșuat. Te rog să încerci din nou!";
                return;
            }

            // Criptare parolă (stocare sigură)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Inserare utilizator în baza de date
            global $pdo;
            try {
                $query = "INSERT INTO users (first_name, last_name, email, phone, password, role_id) 
                          VALUES (:first_name, :last_name, :email, :phone, :password, 1)";  // 1 pentru rolul de client
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':first_name', $first_name);
                $stmt->bindParam(':last_name', $last_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':phone', $phone); // Stocăm și telefonul
                $stmt->bindParam(':password', $hashed_password); // Stocăm parola criptată
                $stmt->execute();
            } catch (PDOException $e) {
                // Afișează eroare în caz de eșec la inserarea în baza de date
                echo "Eroare la înregistrare: " . $e->getMessage();
                return;
            }

            // Redirect după înregistrare
            header("Location: /DAW2024/home");
            exit();
        }

        // Încarcă view-ul pentru înregistrare
        require_once 'app/views/register/index.php';
    }
}
?>
