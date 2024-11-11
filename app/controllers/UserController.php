<?php
require_once "app/models/users.php";

class UserController{
    public static function index(){
        $users = User::getAllUsers();
        require_once "app/views/users/index.php";
    }
}






?>