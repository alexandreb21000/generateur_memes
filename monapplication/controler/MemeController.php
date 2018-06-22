<?php

class MemeController extends Controller {
   
    public function display()
    {     
        $message['msg'] = ''; $message['urlImg'] = ''; $message['type'] = '';

        if(isset($_POST['submitForm'])){  
            $result = Meme::saveMeme();
            $message = $result;
        }

            $template = $this->twig->loadTemplate('/pages/display.html.twig');
            echo $template->render(array(
            'message' => $message['msg'],
            'urlImg'  => $message['urlImg'],
            'type'    => $message['type']
        ));
        }   
    }