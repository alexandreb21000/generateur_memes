<?php

class Meme extends Model {



    public static function getMeme() {
        $db = Database::getInstance();
        $sql = "SELECT * FROM meme 
        ORDER BY ME_id DESC
        LIMIT 5";
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}