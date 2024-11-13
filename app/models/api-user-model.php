<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=libreria;charset=utf8', 'root','');
    }

    public function getUser($nombre) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE Nombre = ?');
        $query->execute([$nombre]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}