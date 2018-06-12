<?php

class View {
   protected $_route;
   protected $data = array();

   public function __construct( $route ) {
      $this->_route = $route;
   }

   public function display() {
      $viewFile = ROOT . "/monapplication/view/" . $this->_route["controler"] . "/" . $this->_route["action"] . ".html.twig";

      if( file_exists( $viewFile ) )
         include($viewFile);
      else
         throw new DomainException("Vue introuvable - " . $viewFile);
   }

   public function __set($key, $value) {
      $this->data[$key] = $value;
   }
   
   public function __get($key) {
      return $this->data[$key];
   }


}

