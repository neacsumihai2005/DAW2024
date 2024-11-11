<?php

class Exercise {
    public static function getAllExercises(){
        global $pdo;
        $sql = "SELECT *
                FROM exercises";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>