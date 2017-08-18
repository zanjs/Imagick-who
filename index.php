<?php
/**
 * Created by Anla.
 * User: Anla-E
 * Date: 2017/8/18
 * Time: 14:00
 */

function annotateImage($imagePath, $fillColor,$a)
{
    $imagick = new Imagick($imagePath);


    $b = $_GET['b'];
    $c = $_GET['c'];
    $d = $_GET['d'];
    $e = $_GET['e'];
    $f = $_GET['f'];

    $draw = new ImagickDraw();
//    $draw->setStrokeColor($strokeColor);
    $draw->setFillColor($fillColor);

    $draw->setStrokeWidth(1);
    $draw->setFontSize(22);

    if(!$a){
        echo "who is who";
        return;
    }

    if($a){
        $text = $a;
        $draw->setFont("./JXK.ttf");
        $imagick->annotateimage($draw, 14, 26, 0, $text);
    }

    if($b){
        $text = $b;
        $draw->setFont("./JXK.ttf");
        $imagick->annotateimage($draw, 200, 30, 0, $text);
    }

    if($c){
        $text = $c;
        $draw->setFont("./JXK.ttf");
        $imagick->annotateimage($draw, 14, 170, 0, $text);
    }

    if($d){
        $text = $d;
        $draw->setFont("./JXK.ttf");
        $imagick->annotateimage($draw, 200, 180, 0, $text);
    }

    if($e){
        $text = $e;
        $draw->setFont("./JXK.ttf");
        $imagick->annotateimage($draw, 14, 315, 0, $text);
    }

    if($f){
        $text = $f;
        $draw->setFont("./JXK.ttf");
        $imagick->annotateimage($draw, 200, 325, 0, $text);
    }


    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();

}

$a = $_GET['a'];

$color = $_GET['color'];

$imagePath = "./who.png";
$fillColor = "rgb(20, 17, 20)";

if($color){
    $fillColor = $color;
}


annotateImage($imagePath,$fillColor,$a);
//echo $a;