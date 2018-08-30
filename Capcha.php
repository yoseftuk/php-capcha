<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 30/08/2018
 * Time: 18:58
 */

// Create a blank image and add some text
$im = imagecreatetruecolor(200, 80);
$chars = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u,','v','w','x','y','z','1','2','3','4','5','6','7','8','9','0'];
$backgroundColor = imagecolorallocate($im, random_int(130,255), random_int(130,255), random_int(130,255));
ImageFilledRectangle($im,0,0,200,80,$backgroundColor);
$small_char_width = 25;
$big_char_width = 80;
$capcha = '';

for($i=0;$i<6;$i++) {
    $text_color = getTextColor($im);
    $char_img_small = imagecreatetruecolor($small_char_width,$small_char_width);
    $char_img_big = imagecreatetruecolor($big_char_width,$big_char_width);
    ImageFilledRectangle($char_img_small,0,0,$small_char_width,$small_char_width,$backgroundColor);
    ImageFilledRectangle($char_img_big,0,0,$big_char_width,$big_char_width,$backgroundColor);

    $char = $chars[random_int(0,count($chars)-1)];
    imagestring($char_img_small, 5, 0, 0, $char, $text_color);
    imagecopyresampled($char_img_big, $char_img_small, 0, 0, 0, 0, $big_char_width, $big_char_width, $small_char_width, $small_char_width);
    $capcha .= $char;

    try {
        $char_img_big = imagerotate($char_img_big, random_int(-10, 10), $backgroundColor);
        imagecopymerge($im, $char_img_big, $i * 30 + 10, random_int(5, 20), 0, 0, imagesx($char_img_big), imagesy($char_img_big), 100);
    }catch (Exception $e){
        imagecopymerge($im, $char_img_big, $i * 30 + 10, 10, 0, 0, $big_char_width, $big_char_width, 100);
    }

}
imagesetthickness($im, 2);
ImageLine($im, 10, getLineY(), 190, getLineY(), getTextColor($im));
ImageLine($im, 10, getLineY(), 190, getLineY(), getTextColor($im));

session_start();
$_SESSION['yt_capcha'] = $capcha;
// Set the content type header - in this case image/jpeg
header('Content-Type: image/jpeg');

// Output the image
imagejpeg($im);

// Free up memory
imagedestroy($im);

function getTextColor($im){

    $text_color = imagecolorallocate($im, 90, 120, 150);

    try{
        $text_color = imagecolorallocate($im, random_int(0,150), random_int(0,150), random_int(0,150));

    }catch(Exception $e){}

    return $text_color;
}

function getLineY(){

    $y = 20;

    try{
        $y = random_int(5,75);

    }catch(Exception $e){}

    return $y;
}