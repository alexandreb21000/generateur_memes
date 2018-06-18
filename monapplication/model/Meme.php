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
        $objetPdo = new PDO('mysql:host=localhost;dbname=generateur_meme;','root','');
        $pdoStat = $objetPdo->prepare(
            "INSERT INTO meme
            (ME_image, ME_date)
            VALUES
            (:ME_image, datetime(now()))
            ");
        $pdoStat->bindValue( ':ME_image', $im, PDO::PARAM_STR);
        $id = $db->lastIsertId();
        $insterIsOk = $pdoStat->execute();
    }

}