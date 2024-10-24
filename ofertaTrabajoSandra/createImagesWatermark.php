<?php
/**
* 
* Creador de imagenes con marca de agua.
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

$watermark = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/images/watermark/marca.png');
$watermark = imagescale($watermark, 50);

// "activamos" el modo de fusión de la imagen
imagealphablending($watermark, false);
imagesavealpha($watermark, true);

$watermarkWidth = imagesx($watermark);
$watermarkHeight = imagesy($watermark);

imageFilter($watermark, IMG_FILTER_COLORIZE, 0, 0, 0, 60);

$image = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/images/candidates/thumbnails/'.$_GET['image']);
$imageWidth = imagesx($image);
$imageHeight = imagesy($image);

imagecopy($image, $watermark, $watermarkWidth, $watermarkHeight, 0, 0, $imageWidth, $imageHeight);

header('content-type: image/png');
imagepng($image);

imagedestroy($image);
imagedestroy($watermark);