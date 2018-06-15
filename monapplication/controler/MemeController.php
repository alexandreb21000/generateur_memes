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

                        $tmp_name = $_FILES["img"]["tmp_name"];

                        /* $fichier_nom = basename($_FILES["img"]["name"]); */

                        $directory = "img/".$file_name;
                        $text = $_POST['texttop'];
                    
                        switch ($ext) {
                            case "jpg" :
                                $im = imagecreatefromjpeg($_FILES["img"]["tmp_name"]);
                                break;
                            case "JPG" :
                                $im = imagecreatefromjpeg($_FILES["img"]["tmp_name"]);
                                break;
                            case "jpeg" :
                                $im = imagecreatefromjpeg($_FILES["img"]["tmp_name"]);
                                break;
                            case "JPEG" :
                                $im = imagecreatefromjpeg($_FILES["img"]["tmp_name"]);
                                break;
                            case "gif" :
                                $im = imagecreatefromgif($_FILES["img"]["tmp_name"]);
                                break;
                            case "GIF" :
                                $im = imagecreatefromgif($_FILES["img"]["tmp_name"]);
                                break;
                            case "png" :
                                $im = imagecreatefrompng($_FILES["img"]["tmp_name"]);
                                break;
                            case "PNG" :
                                $im = imagecreatefrompng($_FILES["img"]["tmp_name"]);
                                break;
                    
                            default :
                                $message['msg'] = "Impossible de crée votre meme, veuillez changer le type de fichier";
                                $message['type'] = "error";
                                break;
                        }
                    
                        $font = 'font/arial.ttf';
                        $grey = imagecolorallocate($im, 128, 128, 128);
                        $red = imagecolorallocate($im, 255, 0, 0);
                        // Add some shadow to the text
                       
                        imagettftext($im, 50, 0, 120, 120, $red, $font, $text);
                        
                        /* imagepng(move_uploaded_file($img['tmp_name'], "img/".$file_name)); */
                        imagepng($im,$directory);
                        imagedestroy($im);
                    
                        

                        // Si upload
                        $message['msg'] = "Votre image a bien été upload.";
                        $message['type'] = 'success';
                    }
                        /* header("Content-type: image/png");

                        $im = imagecreatefrompng("img/".$file_name);

                        $black = imagecolorallocate($im, 0, 0, 0);
    
                        $margin_right = 10;
                        $margin_bottom = 10;
                        $rotation = 0;
    
                        $fontSize_border = 43;
                        $fontSize_text = 40;
                        $font = 'font/arial.ttf';
    
                        $text = "BONJOUUUUUUUUUUUUUUUUUUUUUUUUUUUUUR";
    
                        imagettftext($im, $fontSize_text, $rotation, $margin_right, $margin_bottom, $black, $font, $text);
                       
                        
                        imagepng($im); */
                        /* move_uploaded_file($img['tmp_name'], "img/".$file_name); */
                        /* imagedestroy($im); */

                        
                                
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
            $template = $this->twig->loadTemplate('/pages/display.html.twig');
            echo $template->render(array(
                'message' => $message,
                
            ));
        }   
    }