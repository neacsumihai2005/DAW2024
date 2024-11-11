<?php
require_once "app/models/groupclasses.php";

class GroupClassController{
    public static function index(){
        $groupclasses = GroupClass::getAllGroupClasses();
        require_once "app/views/groupclasses/index.php";
    }

    public static function today(){
        $todayGroupClasses = GroupClass::getTodayGroupClasses();
        require_once "app/views/groupclasses/today.php";
    }

}
?>