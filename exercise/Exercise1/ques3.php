<?php

$val = array( 255, 115, 145, 113, 100,200, 150,287, 250,287, 300, 200 ); 

$img = imagecreatetruecolor(1750, 750);

$white = imagecolorallocate( $img, 88, 78,45 );

imagepolygon($img, $val, 6, $white);

imagearc($img, 200, 200, 150, 150,  0, 360, $white);

$val = array(   200,150, 150,200, 200,250, 250,200 );

imagepolygon($img, $val, 4, $white);

header('Content-type: image/jpeg'); 

imagejpeg($img);
?>