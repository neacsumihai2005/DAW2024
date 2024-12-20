<?php
require_once "app/models/users.php";

class UserController {
    public static function index() {
        if (!isset($_SESSION['user'])) {
            header('Location: /DAW2024');
            exit();
        }

        // Verificăm rolul utilizatorului
        $userRole = $_SESSION['user']['role_id'];

        // Permitem doar admin-ilor și owner-ilor să vadă lista
        if ($userRole != 2 && $userRole != 3) {
            echo "Acces interzis. Doar admin-ii și owner-ii pot vedea lista utilizatorilor.";
            exit();
        }

        $users = User::getAllUsers();
        require_once "app/views/users/index.php";
    }

    // Metoda care se ocupă de ștergerea unui utilizator
    public static function deleteMine() {
        $userRole = $_SESSION['user']['role_id'];

        if ($userRole == 3) {
            echo "Contul de Owner nu poate fi sters!";
            return;
        }

        // Începem sesiunea
        session_start();

        // Verificăm dacă utilizatorul este autentificat
        if (!isset($_SESSION['user'])) {
            // Dacă nu este autentificat, redirecționăm la pagina de login
            header('Location: /DAW2024/login');
            exit();
        }

        // Preluăm ID-ul utilizatorului din sesiune
        $userId = $_SESSION['user']['id'];

        // Conectare la baza de date (modifică cu conexiunea ta PDO)
        global $pdo;
        
        // Ștergem înregistrările din tabela `workouts` asociate cu utilizatorul
        $query = "DELETE FROM workouts WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $userIdToDelete);
        $stmt->execute();

        // Pregătim interogarea pentru a șterge utilizatorul din baza de date
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($query);
        
        // Legăm parametrul ID-ului
        $stmt->bindParam(':id', $userId);

        

        
        // Executăm interogarea
        if ($stmt->execute()) {
            // Ștergerea a avut loc cu succes
            // Distrugem sesiunea și redirecționăm utilizatorul la pagina principală
            session_unset();
            session_destroy();
            header('Location: /DAW2024'); // Redirecționăm la pagina principală sau la login
            exit();
        } else {
            // Dacă nu s-a reușit ștergerea, arătăm un mesaj de eroare
            $error_message = "Eroare la ștergerea contului.";
            require_once 'app/views/home/index.php';  // Afișăm pagina de login cu mesajul de eroare
        }
    }

    public static function deleteSomeones() {
        // Verificăm dacă un ID de utilizator a fost trimis din formular
        if (isset($_POST['user_id'])) {
            $userIdToDelete = $_POST['user_id'];
    
            // Verificăm dacă utilizatorul curent este autentificat
            if (!isset($_SESSION['user'])) {
                // Dacă nu este autentificat, redirecționăm la login
                header('Location: /DAW2024');
                exit();
            }
    
            // Preluăm rolul utilizatorului curent din sesiune
            $userRole = $_SESSION['user']['role_id'];
    
            // Dacă rolul utilizatorului curent nu este Admin, dar încearcă să șteargă un cont, redirecționăm
            if ($userRole == 1) {
                echo "Nu ai permisiunea de a șterge conturi.";
                return;
            }

            if($_SESSION['user']['id'] == $_POST['user_id']){
                echo "Nu iti sterge propriul cont din acest meniu. Te rog foloseste butonul din dashboard.";
                return;
            }
    
            // Verificăm dacă utilizatorul de șters este un "Owner"
            global $pdo;
            $query = "SELECT role_id FROM users WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $userIdToDelete);
            $stmt->execute();
    
            $userToDelete = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($userToDelete && $userToDelete['role_id'] == 3) {
                echo "Contul de Owner nu poate fi sters!";
                return;
            }
            
            // Ștergem înregistrările din tabela `workouts` asociate cu utilizatorul
            $query = "DELETE FROM workouts WHERE user_id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $userIdToDelete);
            $stmt->execute();


            // Dacă nu este un Owner, procedăm cu ștergerea utilizatorului
            $query = "DELETE FROM users WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $userIdToDelete);
    
            // Executăm ștergerea
            if ($stmt->execute()) {
                echo "Contul a fost șters cu succes!";
            } else {
                echo "Eroare la ștergerea contului!";
            }

            header("Location: /DAW2024/users/index");
            exit();
        } else {
            echo "Nu a fost furnizat un ID valid pentru utilizator!";
        }
    }
    

    public static function promote() {
        // Verifică dacă utilizatorul este logat și are rolul de admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] == 1) {
            // Dacă nu ești admin, redirecționează sau afișează un mesaj de eroare
            header("Location: /DAW2024");
            exit();
        }

        // Verifică dacă ID-ul utilizatorului este valid
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];

            // Folosește PDO pentru a actualiza `role_id` la 2 (admin)
            global $pdo;
            $query = "UPDATE users SET role_id = 2 WHERE id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            // Redirecționează înapoi la pagina cu lista de utilizatori
            header("Location: /DAW2024/users/index");
            exit();
        }
    }
    
    // Funcția de demote
    public static function demote() {
        // Verifică dacă utilizatorul este autentificat și are permisiunea să facă modificări
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] == 1) {
            header("Location: /DAW2024");
            exit;
        }

        // Verifică dacă id-ul utilizatorului a fost trimis
        if (isset($_POST['user_id'])) {

            if($_SESSION['user']['id'] == $_POST['user_id']){
                echo "Nu iti poti da demote singur.";
                return;
            }

            $user_id = $_POST['user_id'];

            // Conectează-te la baza de date
            global $pdo;

            // Actualizează rolul utilizatorului la 'user' (role_id = 1)
            $query = "UPDATE users SET role_id = 1 WHERE id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect la pagina de utilizatori sau dashboard
            header("Location: /DAW2024/users/index");
            exit;
        }
    }

    public static function edit() {
        // Verifică dacă utilizatorul este logat și are rolul de admin sau owner
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] == 1) {
            header("Location: /DAW2024");
            exit();
        }

        if (isset($_POST['user_id']) && isset($_POST['new_value'])) {
            $user_id = $_POST['user_id'];
            $new_value = $_POST['new_value'];

            $field_to_update = '';
            if (isset($_POST['field_type'])) {
                $field_to_update = $_POST['field_type']; // Numele câmpului care trebuie actualizat
            }

            // Actualizează valoarea în funcție de câmpul selectat
            global $pdo;
            $query = "UPDATE users SET $field_to_update = :new_value WHERE id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':new_value', $new_value);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            // Redirecționează înapoi la lista de utilizatori
            header("Location: /DAW2024/users/index");
            exit();
        }
    }
}
?>