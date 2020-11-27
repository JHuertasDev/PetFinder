<?php

include_once 'app/helpers/db.helper.php';

class CommentModel {
    
    private $dbHelper;
    private $db;

    function __construct() {
        $this->dbHelper = new DbHelper();
        $this->db = $this->dbHelper->connect();
    }

    function add($userId, $petId, $message, $rate) {
        $query = $this->db->prepare('   INSERT INTO comment (`user_id`, `pet_id`, `message`, `rate`) 
                                        VALUES (?,?,?,?)');
        $query->execute([$userId, $petId, $message, $rate]);
        // Obtengo y devuelvo el ID del comentario nuevo
        return $this->db->lastInsertId();
    }

    function getFromPet($idPet){
        $query = $this->db->prepare('SELECT com.id, com.message, com.rate, usr.name 
            FROM comment AS com   INNER JOIN `user` as `usr` ON
         `com`.`user_id` = `usr`.`id` WHERE pet_id = ?');
        $query->execute([$idPet]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    function get($id) {
        $query = $this->db->prepare('SELECT * FROM comment WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);;
    }

    function getAll() {
        $query = $this->db->prepare('SELECT * FROM comment');
        $query->execute();
        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    function remove($id) {  
        $query = $this->db->prepare('DELETE FROM comment WHERE id = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }
}