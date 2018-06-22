<?php

class Router {
   public static function analyze( $query ) {
      $result = array(
         "controller" => "error",
         "action" => "error404",
         "params" => array()
      );

      if( $query === "" || $query === "/" ) {
         $result["controller"] = "index";
         $result["action"] = "display";
         $result["params"]["limit"] = 5;

      } else {
        $parts = explode("/", $query);
        if($parts[0] == "meme" && (count($parts) == 1 || $parts[1] == "")){
            $result["controller"] = "meme";
            $result["action"] = "display";  
            
        } elseif($parts[0] == "definition" && (count($parts) == 1 || $parts[1] == "")){
            $result["controller"] = "definition";
            $result["action"] = "display";

        } 
      }
      
      return $result;
   
    }
}