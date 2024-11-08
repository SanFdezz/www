<?php
/**
* 
* Creador de imagenes con marca de agua.
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

$watermark = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/images/watermark/marca.png');
$watermark = imagescale($watermark, 70);

// "activamos" el modo de fusión de la imagen
imagealphablending($watermark, false);
imagesavealpha($watermark, true);

$watermarkWidth = imagesx($watermark);
$watermarkHeight = imagesy($watermark);

imageFilter($watermark, IMG_FILTER_COLORIZE, 0, 0, 0, 60);

$image = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/images/candidates/thumbnails/'.$_GET['image']);
$imageWidth = imagesx($image);
$imageHeight = imagesy($image);

$xPosition = ($imageWidth/2)-($watermarkWidth/2);
$yPosition = ($imageHeight/2)-($watermarkHeight/2);

imagecopy($image, $watermark, $xPosition, $yPosition, 0, 0, $watermarkWidth, $watermarkHeight);

header('content-type: image/png');
imagepng($image);

imagedestroy($image);
imagedestroy($watermark);