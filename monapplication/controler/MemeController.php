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
                $allow_ext = array("jpg", "JPG", "png", "PNG", "JPEG", "jpeg", "GIF", "gif");

                if(in_array($ext, $allow_ext)){
                    //définit l'image en cours
                    $file_name = 'image_'.substr(md5($img['name']), 0, 5).'_'.time().'.'.$ext;

                    //Récupère le chemin temporaire + la direction où on veux l'envoyer.
                    $tmp_name = $_FILES["img"]["tmp_name"];
                    $directory = "img/".$file_name;

                    

                        $array_jpg = array('jpg', 'JPG', 'jpeg', 'JPEG');
                        $array_gif = array('gif', 'GIF');
                        $array_png = array('png', 'PNG');

                    //Vérification de l'extension pour crée une image de cet même extension
                        if(in_array($ext, $array_jpg)){
                            $im = imagecreatefromjpeg($tmp_name);
                        } elseif(in_array($ext, $array_gif)){
                            $im = imagecreatefromgif($tmp_name);
                        } elseif(in_array($ext, $array_png)){
                            $im = imagecreatefrompng($tmp_name);
                        } else {
                            $message['msg'] = "Impossible de crée votre meme, veuillez changer le type de fichier";
                            $message['type'] = "error";
                        }
                    
                    //Variable pour le texte.
                        //Récupère la largeur et hauteur de l'image en cours
                        $image_width = imagesx($im);
                        $image_height = imagesy($im);

                        //Récupère les valeurs des blocs où on écrit
                        $text_top = strtoupper($_POST['texttop']);
                        $text_bot = strtoupper($_POST['textbottom']);

                        //Rotation du texte
                        $rotation = 0;

                        //Margin
                        $top_margin = 60;

                        //Font family + font size
                        $font_size = 30;
                        $font = 'font/impact.ttf';

                        //Couleur
                        $grey = imagecolorallocate($im, 128, 128, 128);
                        $red = imagecolorallocate($im, 255, 0, 0);
                        $white = imagecolorallocate($im, 255, 255, 255);
                        $black = imagecolorallocate($im, 0, 0, 0);

                        //Crée un rectangle qui entourera le texte.
                        $text_bound_top = imageftbbox($font_size, $rotation, $font, $text_top);
                        $text_bound_bot = imageftbbox($font_size, $rotation, $font, $text_bot);

                    //Récupère les coordonnées des 4 coins du rectangle en X et Y
                        //top
                        $lower_left_x_top =  $text_bound_top[0]; 
                        $lower_left_y_top =  $text_bound_top[1];
                        $lower_right_x_top = $text_bound_top[2];
                        $lower_right_y_top = $text_bound_top[3];
                        $upper_right_x_top = $text_bound_top[4];
                        $upper_right_y_top = $text_bound_top[5];
                        $upper_left_x_top =  $text_bound_top[6];
                        $upper_left_y_top =  $text_bound_top[7];

                        //bot
                        $lower_left_x_bot =  $text_bound_bot[0]; 
                        $lower_left_y_bot =  $text_bound_bot[1];
                        $lower_right_x_bot = $text_bound_bot[2];
                        $lower_right_y_bot = $text_bound_bot[3];
                        $upper_right_x_bot = $text_bound_bot[4];
                        $upper_right_y_bot = $text_bound_bot[5];
                        $upper_left_x_bot =  $text_bound_bot[6];
                        $upper_left_y_bot =  $text_bound_bot[7];

                    //Création du texte
                        //Récupère la largeur du texte et sa hauteur
                            //top
                            $text_width_top =  $lower_right_x_top - $lower_left_x_top;
                            $text_height_top = $lower_left_y_top - $upper_left_y_top; 

                            //bot
                            $text_width_bot =  $lower_right_x_bot - $lower_left_x_bot;
                            $text_height_bot = $lower_left_y_bot - $upper_left_y_bot; 

                        //Récupère la position ou le texte sera centré.
                        $start_x_offset_top = ($image_width - $text_width_top) / 2; //Centre Horizontalement le texte.
                        $start_y_offset_top = ($image_height - $text_height_top) / 2; //Centre verticalement le texte.

                        $start_x_offset_bot = ($image_width - $text_width_bot) / 2; //Centre Horizontalement le texte.
                        $start_y_offset_bot = ($image_height - $text_height_bot) / 2; //Centre verticalement le texte.
                        $start_end_offset = $image_height - 20; //Place le texte en bas - 20px de la hauteur de l'image.
                    
                    //Param text top
                        //Contour
                        imagettftext($im, $font_size, $rotation, $start_x_offset_top - 1.5, $top_margin - 1.5, $black, $font, $text_top);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_top - 1.5, $top_margin + 2, $black, $font, $text_top);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_top + 1.5, $top_margin - 2, $black, $font, $text_top);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_top + 1.5, $top_margin + 1.5, $black, $font, $text_top);
                        //Text
                        imagettftext($im, $font_size, $rotation, $start_x_offset_top, $top_margin, $white, $font, $text_top);

                    //Param text bot
                        //Contour
                        imagettftext($im, $font_size, $rotation, $start_x_offset_bot - 1.5, $start_end_offset - 1.5, $black, $font, $text_bot);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_bot - 1.5, $start_end_offset + 2, $black, $font, $text_bot);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_bot + 1.5, $start_end_offset - 2, $black, $font, $text_bot);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_bot + 1.5, $start_end_offset + 1.5, $black, $font, $text_bot);
                        //Text
                        imagettftext($im, $font_size, $rotation, $start_x_offset_bot, $start_end_offset, $white, $font, $text_bot);
                        
                    //Envoi l'image à la destination souhaitée et libère la mémoire une fois envoyé.
                        if(isset($_POST['submitForm'])){
                            if(in_array($ext, $array_jpg)){ 
                                imagejpeg($im,$directory);
                    
                            } elseif(in_array($ext, $array_gif)){
                                imagegif($im,$directory);
                                
                            } elseif(in_array($ext, $array_png)){
                                imagepng($im,$directory);
                                

                            } else { 
                                $message['msg'] = "Impossible de crée votre meme, veuillez changer le type de fichier";
                                $message['type'] = "error";
                            }  
                        }

                        imagedestroy($im);
                       
                    // Si upload message de succès.
                        $message['msg'] = "Votre image a bien été upload.";
                        $message['type'] = 'success';
                    }
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