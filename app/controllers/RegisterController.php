<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require_once 'vendor/autoload.php'; // Dacă folosești Composer pentru PHPMailer

class RegisterController {
    public static function formular() {
        // Încarcă view-ul pentru înregistrare
        require_once 'app/views/register/index.php';
    }

    public static function index() {
        // Încarcă fișierul .env
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2)); // Acesta va naviga două niveluri în sus
        $dotenv->load();
        

        // Verifică dacă formularul de înregistrare a fost trimis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Preia datele din formular
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number']; // Noul câmp pentru telefon
            $password = $_POST['password'];

            // Verifică reCAPTCHA
            $recaptcha_secret = $_ENV['RECAPTCHA_SECRET']; // Secret Key din .env
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

            // Generare token unic pentru confirmare email
            $token = bin2hex(random_bytes(32));

            // Inserare utilizator în baza de date
            global $pdo;
            try {
                $query = "INSERT INTO users (first_name, last_name, email, phone_number, password, role_id, token, is_verified) 
                          VALUES (:first_name, :last_name, :email, :phone_number, :password, 1, :token, 0)"; // 1 pentru rolul de client
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':first_name', $first_name);
                $stmt->bindParam(':last_name', $last_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':phone_number', $phone_number); // Stocăm și telefonul
                $stmt->bindParam(':password', $hashed_password); // Stocăm parola criptată
                $stmt->bindParam(':token', $token);
                $stmt->execute();

                // Trimitere email de confirmare
                self::sendConfirmationEmail($email, $first_name, $token);
            } catch (PDOException $e) {
                // Afișează eroare în caz de eșec la inserarea în baza de date
                echo "Eroare la înregistrare: " . $e->getMessage();
                return;
            }

            // Redirect după înregistrare
            echo "Înregistrarea a reușit! Verifică emailul pentru confirmare.";
            exit();
        }
    }

    private static function sendConfirmationEmail($email, $first_name, $token) {
        try {
            $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2)); // Acesta va naviga două niveluri în sus
            $dotenv->load();

            // Setările pentru SMTP
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST']; // Server SMTP din .env
            $mail->SMTPAuth = $_ENV['MAIL_SMTPAUTH'] == 'true';
            $mail->Username = $_ENV['MAIL_USERNAME']; // Emailul din .env
            $mail->Password = $_ENV['MAIL_PASSWORD']; // Parola din .env
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Setări email
            $mail->setFrom($_ENV['MAIL_USERNAME'], 'Fitness App');
            $mail->addAddress($email, $first_name); // Destinatarul

            // Link-ul de confirmare
            $confirmLink = "http://localhost/DAW2024/confirm/$token";

            // Conținut email
            $mail->isHTML(true);
            $mail->Subject = 'Confirmare cont - Fitness App';
            $mail->Body = "Salut $first_name,<br><br>
                Multumim pentru inregistrare! Te rugam sa confirmi contul tau accesand link-ul de mai jos:<br>
                <a href='$confirmLink'>Confirma contul</a><br><br>
                Daca nu ai solicitat acest cont, poti ignora acest mesaj.";

            $mail->send();
        } catch (Exception $e) {
            echo "Eroare la trimiterea emailului: {$mail->ErrorInfo}";
        }
    }

    public static function confirm($params) {
        // Conectare la baza de date
        global $pdo;
        
        // Extragem token-ul din parametrii primiți
        $token = $params['token'];
        
        // Adăugăm un mesaj de debug pentru a verifica token-ul primit
        echo "Token: $token<br>";

        // Verificăm dacă token-ul există în baza de date
        $query = "SELECT * FROM users WHERE token = :token AND is_verified = 0";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            // Token-ul este valid, activăm contul
            $updateQuery = "UPDATE users SET is_verified = 1, token = NULL WHERE id = :id";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->bindParam(':id', $user['id']);
            $updateStmt->execute();

            // Mesaj de succes + buton de redirect
            echo "Contul a fost confirmat cu succes!<br>";
        } else {
            // Token-ul nu este valid sau deja confirmat
            echo "Token invalid sau contul este deja confirmat.<br>";
        }
        // Redirecționează la homepage după 3 secunde
        header("Refresh: 3; url=http://localhost/DAW2024/");
    }
}
?>
