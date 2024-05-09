<?php
require_once("vendor/autoload.php");
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

function qr_gen($text) {
    $writer = new PngWriter();

// Create QR code
$qrCode = QrCode::create($text);
    // ->setEncoding(new Encoding('UTF-8'))
    // ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow());
    // ->setSize(300)
    // ->setMargin(10)
    // ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
    // ->setForegroundColor(new Color(0, 0, 0))
    // ->setBackgroundColor(new Color(255, 255, 255));


/*    
// Create generic logo
$logo = Logo::create(__DIR__.'/assets/image.png')
    ->setResizeToWidth(50)
    ->setPunchoutBackground(true)
;
*/


/*
// Create generic label
$label = Label::create('Label')
    ->setTextColor(new Color(255, 0, 0));

*/
$result = $writer->write($qrCode);



// Generate a data URI to include image data inline (i.e. inside an <img> tag)
$dataUri = $result->getDataUri();
return $dataUri;
};

function generate_qr($text) {
    $writer = new PngWriter();
    $qrCode = QrCode::create($text);
    $result = $writer->write($qrCode);
    $dataUri = $result->getDataUri();
    return $dataUri;
}


?>