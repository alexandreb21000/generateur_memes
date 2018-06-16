<?php

class Meme extends Model {

    public static function getMeme() {
        $db = Database::getInstance();
        $sql = 
       "SELECT *
        FROM meme
        WHERE ME_date = MAX(ME_date)
        ORDER BY ME_date DESC
        LIMIT 5
       ";
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}