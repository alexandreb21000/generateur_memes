<?php

class Router {
   public static function analyze( $query ) {
      $result = array(
         "controler" => "Error",
         "action" => "error404",
         "params" => array()
      );

      if( $query === "" || $query === "/" ) {
         $result["controler"] = "index";
         $result["action"] = "display";
         $result["params"]["limit"] = 3;

      } else {
         $parts = explode("/", $query);
         if($parts[0] == "film" && count($parts) == 2) {
            $result["controler"] = "Film";
            $result["action"] = "display";
            $result["params"]["id"] = $parts[1];            
         }
      }
      return $result;
   }

}
