<?php

class GenerateMeme extends Model {

    public static function getGenMeme($id, $imgUrl) {
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
}