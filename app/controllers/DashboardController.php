<?php

class DashboardController {
    public static function index() {
        // Afișează dashboard-ul utilizatorului autentificat
        require_once 'app/views/dashboard/index.php';
    }
}
?>