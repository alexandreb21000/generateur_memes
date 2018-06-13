<?php

class IndexController extends Controller {
   
    public function display()
    {
        $limit = $this->route["params"]["limit"];
        $randomFilms = Film::getListRandom($limit);
      
        $template = $this->twig->loadTemplate('/index/display.html.twig');
        echo $template->render(array(
            'randomFilms'  => $randomFilms
        ));
    }
}
