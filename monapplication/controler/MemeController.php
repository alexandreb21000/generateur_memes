<?php

class MemeController extends Controller {
   
    public function display()
    {     
        $result = "";
        $message['msg'] = ''; $message['urlImg'] = ''; $message['type'] = '';

        if(isset($_POST['submitForm']) && $message['urlImg'] != ''){  

            $result = Meme::saveMeme($_POST);
        }

        /* if(isset($_POST['submitForm'])){

            if(!empty($message['msg']['urlImg']['type'])){
                $result = Meme::saveMeme($_POST);
                print_r($result);
            }
            else if(empty($message['urlImg']) || empty($message['msg']['type'])){
                $result .= $message['type'];
                $result .= $message['msg'];
                print_r($result);
            }
        } */

        

            $template = $this->twig->loadTemplate('/pages/display.html.twig');
            echo $template->render(array(
            'message' => $message['msg'],
            'urlImg'  => $message['urlImg'],
            'type'    => $message['type']
        ));
        }   
    }
