<?php
const GENERATED_DIRECTORY = '/public/generatedMemes/';

class MemeGenerator
{
    private $font = '../public/assets/fonts/impact.ttf';
    private $image;
    private $imageWidth;
    private $imageHeight;

    public function __construct($image, $imageWidth, $imageHeight)
    {
        $this->image = $image;
        $this->imageWidth = $imageWidth;
        $this->imageHeight = $imageHeight;
    }

    private function createImage($path)
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext == 'jpg' || $ext == 'jpeg')
            return imagecreatefromjpeg($path);
        else if ($ext == 'png')
            return imagecreatefrompng($path);
        else if ($ext == 'gif')
            return imagecreatefromgif($path);
    }

    private function imagettfstroketext(&$image, $size, $angle, $x, $y, &$textcolor, &$strokecolor, $fontfile, $text, $px) {
        for($c1 = ($x-abs($px)); $c1 <= ($x+abs($px)); $c1++)
            for($c2 = ($y-abs($px)); $c2 <= ($y+abs($px)); $c2++)
                $bg = imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);
        return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
    }

    public function addUpperText($upperText, $lowText) {
        $uploadedImage = $this->createImage($this->image);
        $color = imagecolorallocate($uploadedImage, 255, 255, 255);
        $strokeColor = imagecolorallocate($uploadedImage, 0, 0, 0);
        putenv('GDFONTPATH=' . realpath('.'));
        $font = "Impact";
        $this->imagettfstroketext($uploadedImage, 40, 0, 20, 50, $color, $strokeColor, "/home/kasia/Pulpit/pai-meme-maker/public/assets/fonts/impact.ttf", strtoupper($upperText), 3);
        $this->imagettfstroketext($uploadedImage, 40, 0, 20, $this->imageHeight - 20, $color, $strokeColor, "/home/kasia/Pulpit/pai-meme-maker/public/assets/fonts/impact.ttf", strtoupper($lowText), 3);
        imagejpeg($uploadedImage, dirname(__DIR__).GENERATED_DIRECTORY.$_SESSION['username'].'/'.$_FILES['file']['name'], 100);
        imagedestroy($uploadedImage);
    }



}
?>