<?php

class IndexController extends Controller {
   
    public function display()
    {
        $limit = $this->route["params"]["limit"];
        $lastMeme = Meme::getGenMeme($limit);
      
        $template = $this->twig->loadTemplate('/index/display.html.twig');
        echo $template->render(array(
            'lastMeme'  => $lastMeme
        ));
    }
}
