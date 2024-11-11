<?php

class GroupClass{
    public static function getAllGroupClasses(){
        global $pdo;
        $sql = "SELECT gc.name, gc.description, gc.schedule, u.first_name AS instructor_name
                FROM group_classes gc 
                JOIN users u ON gc.instructor_id = u.id";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTodayGroupClasses(){
        global $pdo;

        $sql = "SELECT gc.name, gc.description, gc.schedule, u.first_name AS instructor_name
                FROM group_classes gc 
                JOIN users u ON gc.instructor_id = u.id
                WHERE DATE(gc.schedule) = CURDATE()  
                AND gc.schedule > NOW()";
        #$sql = "SELECT *
        #        FROM group_classes gc";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        #var_dump($stmt); // Aici vei vedea structura și datele rezultate din interogare
        #return $stmt;
    }

}

?>