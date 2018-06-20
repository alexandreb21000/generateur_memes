<?php

class MemeController extends Controller {
   
    public function display()
    {     
        $result['msg'] = ''; $result['urlImg'] = ''; $result['type'] = '';

        if(isset($_POST['submitForm'])){
            $result = Meme::saveMeme($_POST);
        }
    
            $template = $this->twig->loadTemplate('/pages/display.html.twig');
            echo $template->render(array(
            'message' => $result['msg'],
            'urlImg'    => $result['urlImg'],
            'type'      => $result['type']
        ));
        }   

    }