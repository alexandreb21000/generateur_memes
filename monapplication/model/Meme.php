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

    public static function saveMeme() {
        $db = Database::getInstance();
        $sql = 
       "INSERT INTO meme
        (ME_id, ME_image, ME_date)
        VALUES
        (:id, :imgurl, datetime(now()))
       ";
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue( ':id', $id, PDO::PARAM_INT);
        $stmt->bindValue( ':imgurl', $imgUrl, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getGenMeme() {
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