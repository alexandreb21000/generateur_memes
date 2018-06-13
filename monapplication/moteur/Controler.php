<?php
require_once 'vendor/autoload.php';

class Controller {
   protected $route;
   protected $view;

    public $loader; public $twig;

    public function affichecontroleur()
    {
        echo $this.$route;
        echo $this.$view;
    }

    public function __construct( $route )
    {
        $this->route = $route;
        $this->loader = new Twig_Loader_Filesystem('monapplication/view');
        $this->twig = new Twig_Environment($this->loader, array(
            'cache' => false,
        ));
   }
}
