<?php

class IndexController extends Controller {
   
    public function display()
    {
        $limit = $this->route["params"]["limit"];
        $lastMeme = Meme::getMeme($limit);
      
        $template = $this->twig->loadTemplate('/index/display.html.twig');
        echo $template->render(array(
            'lastMeme'  => $lastMeme
        ));
    }
}
