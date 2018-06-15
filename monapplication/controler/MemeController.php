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
                    //définit l'image en cours
                    $file_name = 'image_'.substr(md5($img['name']), 0, 5).'_'.time().'.'.$ext;
                    
                    //crée un meme
                    header('content-type: image/jpeg');

                    /* $source = "img/breaking_bad.jpg"; */
                    $im = imagecreatefromjpeg($file_name);
  
                    $black = imagecolorallocate($im, 0, 0, 0);
                    imagecolortransparent( $im, $black );
                    
                    $originX = 120;
                    $originY = 120;
                    $rotation = 0;

                    $fontSize_border = 43;
                    $fontSize_text = 40;
                    $font = 'font/arial.ttf';

                    $text = urldecode($_POST['texttop']);

                    imagestring($im, $fontSize_text, $rotation, $originX, $originY, $black, $font, $text);
                    
                    imagejpeg($im);

                    //upload
                    move_uploaded_file($img['tmp_name'], "img/".$file_name);

                    imagedestroy($im);

                    
                    
                    $message['msg'] = "Votre image a bien été upload.";
                    $message['type'] = 'success';

                    

                    /* $output = $_FILES['img']; */
                    
                    // Création de l'image
                    /* $sizes = getimagesize($output);
                    $w = $sizes[0];
                    $h = $sizes[1];
                    $im = imagecreate($w, $h);
                           
                    // Création de quelques couleurs
                    $white = imagecolorallocate($im, 255, 255, 255);
                    $grey = imagecolorallocate($im, 128, 128, 128);
                    $black = imagecolorallocate($im, 0, 0, 0);
                    
                    $originX = 120;
                    $originY = 120;
                    $rotation = 0;
                    $fontSize_border = 43;
                    $fontSize_text = 40;
                    
                    
                    // Le texte à dessiner
                    $text = "trop bien la vie";
                    // Remplacez le chemin par votre propre chemin de police
                    $font = 'font/arial.ttf';
                    
                    // Ajout d'ombres au texte
                    imagettftext($im, $fontSize_border, $rotation, $originX, $originY, $grey, $font, $text);
                    
                    // Ajout du texte
                    imagettftext($im, $fontSize_text, $rotation, $originX, $originY, $black, $font, $text);
                    
                    // Utiliser imagepng() donnera un texte plus claire,
                    // comparé à l'utilisation de la fonction imagejpeg()
                    imagejpeg($im, $ouput); */

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
