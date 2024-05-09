<?php 

require './vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

// function that creates and saves the qr code image
function generate_qr($text) {
    $writer = new PngWriter();
    $qrCode = QrCode::create($text);
    $result = $writer->write($qrCode);
    $dataUri = $result->getDataUri();
    
    $imageData = base64_decode(explode(',', $dataUri)[1]);
    
    // check and remove https / http if its there

    if (strpos($text, "https://") !== false) {
        $text = str_replace("https://", "", $text);
    } elseif (strpos($text, "http://") !== false) {
        $text = str_replace("http://", "", $text);
    }

    // removes / and replaces with -
    $text = str_replace("/", "-", $text);
    
    $file_path = './qr-codes/' . $text . '.png';
    
    file_put_contents($file_path, $imageData);

    // $permisions = 0777;
    // chmod($file_path, $permisions);
}


function generate_qr_codes($text) {

        $qrCode = QrCode::create($text);

        $writer = new PngWriter();

        $result = $writer->write($qrCode);

        $filename = "../assets/qr-code.png";

        // uploads the Qr code to necessary file
        $upload_dir = "../assets";
        $upload_path = $upload_dir['basedir'];
        

        $file_path = $upload_path . '/qr_codes/' . $text . '.png';



        if (file_put_contents($filename, $result->getString()) === false) {

            throw new Exception('Failed to write file: ' . $filename);
        }

        return $result;
      
}

// $link = "https://www.justgiving.com/fundraising/nicole-taylor13";
// generate_qr_codes(37846593);
?>