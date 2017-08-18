<?php
/**
 * Created by Anla.
 * User: Anla-E
 * Date: 2017/8/18
 * Time: 14:00
 */
header("X-Powered-By: Rust/1.1.7");

function annotateImage($imagePath, $fillColor)
{
    $imagick = new Imagick($imagePath);

    $leftW = 14;
    $rightW = 200;

    $a = $_GET['a'];
    $b = $_GET['b'];
    $c = $_GET['c'];
    $d = $_GET['d'];
    $e = $_GET['e'];
    $f = $_GET['f'];

    $draw = new ImagickDraw();
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
        $imagick->annotateimage($draw, $leftW, 26, 0, $text);
    }

    if($b){
        $text = $b;
        $imagick->annotateimage($draw, $rightW, 30, 0, $text);
    }

    if($c){
        $text = $c;
        $imagick->annotateimage($draw, $leftW, 170, 0, $text);
    }

    if($d){
        $text = $d;
        $imagick->annotateimage($draw, $rightW, 180, 0, $text);
    }

    if($e){
        $text = $e;
        $imagick->annotateimage($draw, $leftW, 315, 0, $text);
    }

    if($f){
        $text = $f;
        $imagick->annotateimage($draw, $rightW, 325, 0, $text);
    }
    
    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();

}

$color = $_GET['color'];

$imagePath = "./who.png";
$fillColor = "rgb(20, 17, 20)";

if($color){
    $fillColor = $color;
}

annotateImage($imagePath,$fillColor);
