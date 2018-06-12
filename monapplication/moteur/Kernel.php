<?php

class Kernel {
   public static function autoload($class)
   {

// cette fonction autoload est essentielle, elle permet de d�finir les chemins vers les fichiers qui instancient les classes routeur models etc ... de sorte � pouvoir appeller les fonctions qu'elles ex�cutent...

      if(file_exists(ROOT."/monapplication/moteur/".$class.".php"))
        { require_once(ROOT."/monapplication/moteur/".$class.".php");}
        
      else if(file_exists(ROOT."/monapplication/controler/".$class.".php"))
         
            require_once(ROOT."/monapplication/controler/".$class.".php");
  
      else if(file_exists(ROOT."/monapplication/model/".$class.".php"))
         
            require_once(ROOT."/monapplication/model/".$class.".php");
   }


   public static function run()
   {
      // Autoload
      spl_autoload_register(array("Kernel", "autoload"));

      // Analyser la requete
      $query = isset($_GET["query"]) ? $_GET["query"] : "";
    
      $route = Router::analyze( $query );
      
      // Instancier le controleur et
      // executer l'action
      $class = $route["controler"]."Controller";
     
      if(class_exists($class)) {
         $controler = new $class ($route);
         $method = array($controler, $route["action"]);
         if( is_callable( $method ))
            call_user_func($method);   
      }
    
      // Gestion des erreurs
      // �a reste � faire : par exemple si l'url n'existe pas ou qu'elle a trop de param�tres etc ... 
     
   }
   
}
