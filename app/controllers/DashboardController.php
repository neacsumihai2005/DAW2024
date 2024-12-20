<?php

class DashboardController {
    public static function index() {
        // Începe sesiunea pentru a verifica autentificarea

        if (isset($_SESSION['user'])) {
            // Dacă da, afișăm informațiile utilizatorului
            $fullName = $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
            $roleId = $_SESSION['user']['role_id'];

            // Verifică rolul utilizatorului și afișează mesajul corespunzător
            if ($roleId == 1) {
                echo "User: " . $fullName;
            } elseif ($roleId == 2) {
                echo "Admin: " . $fullName;
            } elseif ($roleId == 3) {
                echo "Owner: " . $fullName;
            } else {
                echo "Rol necunoscut";
            }
            
            // Dacă utilizatorul este autentificat, afișează dashboard-ul
            if($roleId == 1){
                require_once 'app/views/dashboard/userIndex.php';
            }
            else {
                require_once 'app/views/dashboard/adminIndex.php';
            }
        } else {
            // Dacă nu există o sesiune activă, afișăm un mesaj corespunzător
            header("Location: /DAW2024/home");
            exit();
        }
    }
}
?>
