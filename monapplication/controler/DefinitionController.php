<?php

class DefinitionController extends Controller {
   
    public function display()
    {
        $template = $this->twig->loadTemplate('/pages/definition.html.twig');
        echo $template->render(array());
    }
}