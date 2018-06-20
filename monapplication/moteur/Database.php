<?php

class Database {
   static protected $_instance = null;
   protected $_db;

   static public function getInstance() {
      if( is_null(self::$_instance) )
         self::$_instance = new Database();
      return self::$_instance;
   }

   protected function __construct() {
      // A faire : fichier de config

define ("db_name","generateur_meme");
define ("server_name","localhost");
define ("user","root");
define ("password","");
    $this->_db = new PDO('mysql:host=' .constant("server_name").';dbname=' .constant("db_name") .';charset=utf8', constant('user'),constant('password')); 
   }

   public function __call($method, array $arg) {
      // Si on appelle une méthode qui n'existe pas, on 
      // delegue cet appel à l'objet PDO $this->_db
      return call_user_func_array(array($this->_db, $method), $arg);
   }
}



