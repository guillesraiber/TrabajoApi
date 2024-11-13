<?php

class LibroModel {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;"."dbname=libreria; charset=utf8","root","");
    }

    public function getLista() {
        $query = $this->db->prepare("SELECT * FROM libros");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function insertarLibro($id, $titulo, $autor, $genero, $editorial, $precio) {
        $query = $this->db->prepare("INSERT INTO libros (ID_Libro,Titulo, Autor, Genero, Editorial, Precio) VALUES(?,?,?,?,?,?)");
        $query->execute([$id, $titulo, $autor, $genero, $editorial, $precio]);
    }

    public function getLibro($id) {
        $query = $this->db->prepare("SELECT * FROM libros WHERE ID_Libro = ?");
        $query->execute([$id]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function ascendente() {
        $query = $this->db->prepare("SELECT * FROM libros ORDER BY Precio ASC");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function descendente() {
        $query = $this->db->prepare("SELECT * FROM libros ORDER BY Precio DESC");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function eliminar($id) {
        $query = $this->db->prepare("DELETE FROM libros WHERE ID_Libro = ?");
        $query->execute([$id]);
    }

    public function actualizar($titulo, $autor, $genero, $editorial, $precio, $id) {
        $query = $this->db->prepare("UPDATE libros SET Titulo=?, Autor=?, Genero=?, Editorial=?, Precio=? WHERE ID_Libro = ?");
        $query->execute([$titulo, $autor, $genero, $editorial, $precio, $id]);
    }

    public function filtrado() {
        $query = $this->db->prepare("SELECT precio FROM libros");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}