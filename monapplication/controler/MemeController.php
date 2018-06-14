<?php

class MemeController extends Controller {
   
    public function display()
    {
        $message = array();
        $nb_erreur = 0;
        
        if(!empty($_FILES)){
            if(isset($_FILES['img']['error'])){
                switch($_FILES['img']['error']){
                    case 1:
                        $message['msg'] = "Votre fichier ne doit pas dépasser 10Mo";
                        $message['type'] = 'error';
                        $nb_erreur++;
                        break;
                    case 2:
                        $message['msg'] = "Erreur";
                        $message['type'] = 'error';
                        $nb_erreur++;
                        break;
                    case 3:
                        $message['msg'] = "Une erreur est survenue lors du téléchargement.";
                        $message['type'] = 'error';
                        $nb_erreur++;
                        break;
                    case 4:
                        $message['msg'] = "Aucun fichier n'a été séléctionné.";
                        $message['type'] = 'error';
                        $nb_erreur++;
                        break; 
                }
            }

            if($nb_erreur == 0){
                $img = $_FILES['img'];
                
                $ext = substr($img['name'], strrpos($img['name'], '.') + 1);
                /* $ext = strtolower(substr($img['name'], -3)); */
                $allow_ext = array("jpg", "JPG", "png", "PNG", "JPEG", "jpeg", "GIF", "gif");

                if(in_array($ext, $allow_ext)){
                    /* $file_name = 'image_'.time().'.'.$ext; */
                    
                    $file_name = 'image_'.substr(md5($img['name']), 0, 5).'_'.time().'.'.$ext;
                    move_uploaded_file($img['tmp_name'], "img/".$file_name);
                    $message['msg'] = "Votre image a bien été upload.";
                    $message['type'] = 'success';
                } else{
                    $message['msg'] = 'Extension de fichier non pris en compte.';
                    $message['type'] = 'error';
                }
            }
        }

      $template = $this->twig->loadTemplate('/pages/display.html.twig');
            echo $template->render(array(
                'message' => $message
            ));
        
    }
}
