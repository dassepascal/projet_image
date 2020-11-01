<?php

echo '<h4>flux-image </h4>';
/*$img = imagecreatefromjpeg('images/vague1.jpg');

header('Content-Type: image/jpeg');
imagejpeg($img);

$img = imagecreatetruecolor(200, 200);
var_dump($img);*/
// nouvelle image 100*30
$im = imagecreate(100, 30);

//fond blanc et texte bleu
$bg = imagecolorallocate($im, 255, 255, 255);
$textcolor = imagecolorallocate($im, 0, 0, 255);

//ajout de la phrase en haut à gauche
imagestring($im, 5, 0, 0, 'hello world!', $textcolor);
var_dump(imagestring($im, 5, 0, 0, 'hello world!', $textcolor));

// affichage de l'image

header('Content-Type:image/png');
var_dump(header('Content-Type:image/png'));
exit();
imagepng($im);
var_dump(imagepng($im));
imagedestroy($im);
