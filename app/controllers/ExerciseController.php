<?php
require_once "app/models/exercises.php";

class ExerciseController{
    public static function index(){
        $exercises = Exercise::getAllExercises();
        require_once "app/views/exercises/index.php";
    }
}

?>