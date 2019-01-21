<?php
const GENERATED_DIRECTORY = '/public/generatedMemes/';
require __DIR__.'/../vendor/autoload.php';

use GDText\Box;
use GDText\Color;

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

    public function generateMeme($upperText, $lowText)
    {
        $uploadedImage = $this->createImage($this->image);
        $box = new Box($uploadedImage);
        $box->setFontFace("/home/kasia/Pulpit/pai-meme-maker/public/assets/fonts/impact.ttf");
        $box->setFontSize(40);
        $box->setBox(0, 20, $this->imageWidth, $this->imageHeight);
        $box->setFontColor(new Color(255, 255, 255));
        $box->setStrokeColor(new Color(0, 0, 0));
        $box->setStrokeSize(3);
        $box->setTextAlign('center', 'top');
        $box->setLineHeight(1.5);
        $box->draw(strtoupper($upperText));

        $box = new Box($uploadedImage);
        $box->setFontFace("/home/kasia/Pulpit/pai-meme-maker/public/assets/fonts/impact.ttf");
        $box->setFontSize(40);
        $box->setBox(0, -20, $this->imageWidth, $this->imageHeight);
        $box->setFontColor(new Color(255, 255, 255));
        $box->setStrokeColor(new Color(0, 0, 0));
        $box->setStrokeSize(3);
        $box->setTextAlign('center', 'bottom');
        $box->setLineHeight(1.0);
        $box->draw(strtoupper($lowText));

        imagejpeg($uploadedImage, dirname(__DIR__).GENERATED_DIRECTORY.$_SESSION['username'].'/'.$_FILES['file']['name'], 100);

    }

}
?>