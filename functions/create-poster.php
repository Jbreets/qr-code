<?php 
//ini_set('display_errors', 1);
// error_reporting(E_ALL);
// function to generate and auto map QR code onto poster
function genereate_poster($image, $file) {
    // 
    if ($image == "UWCB") {
        // $image = "/var/www/html/qr-code/assets/FW_ Poster Generator/CRUK QR THING  - UWCB -3.png";
        $image = "./assets/templates/GENERIC FUNDRAISING QR -  UWCB.png";
        $x = 1205;
        $y = 645;
    }elseif ($image == "UMMA") {
        // $image = "/var/www/html/qr-code/assets/templates/Generic FUNDRAISING CODE  - mma .png";
        $image = "./assets/templates/GENERIC FUNDRAISING QR - MMA .png";
        $x = 1190;
        $y = 695;
    }elseif ($image == "UBALLROOM") {
        // $image = "/var/www/html/qr-code/assets/FW_ Poster Generator/CRUK FUNDRAISING QR - Ballroom-2.png";
        $image = "./assets/templates/GENERIC FUNDRAISING QR  - BALLROOM.png";
        $x = 1243;
        $y = 700;
    }elseif ($image == "UCOMEDY") {
        // $image = "/var/www/html/qr-code/assets/FW_ Poster Generator/CRUK FUNDRAISING QR - COMEDY.png";
        $image = "./assets/templates/CRUK FUNDRAISING QR -  COMEDY.png";
        $x = 1260;
        $y = 720;
    }elseif ($image == "UADVENTURES") {
        // $image = "/var/www/html/qr-code/assets/FW_ Poster Generator/CRUK FUNDRAISING QR - COMEDY.png";
        $image = "./assets/templates/FUNDRAISING CRUK QR - adventures.png";
        $x = 1263;
        $y = 668;
    }
    

//load QR code position




// Load the JPEG image
$jpegImage = imagecreatefromPNG($image);

$backg_width = imagesx($jpegImage);
$backg_height = imagesy($jpegImage);
$white = imagecolorallocate($jpegImage, 255, 255, 255);
$black = imagecolorallocate($jpegImage, 0, 0, 0);

// White box around the QR code area
//imagerectangle($jpegImage, $backg_width *6.87/10, $backg_height*5.43/10, $backg_width *9.45/10, $backg_height*9.1/10, $white);

//var_dump($backg_width *6.87/10); // 1200.876
//var_dump($backg_height*5.43/10); // 673.32
//var_dump($backg_width *9.45/10); // 1651.86
//var_dump($backg_height*9.1/10);  // 1128.4




// Create a new PNG image with the same dimensions as the JPEG image
$pngImage = imagecreatetruecolor(imagesx($jpegImage), imagesy($jpegImage));

// Preserve transparency for the PNG image
imagealphablending($pngImage, false);
imagesavealpha($pngImage, true);

// Fill the PNG image with transparent background
$transparentColor = imagecolorallocatealpha($pngImage, 0, 0, 0, 127);
imagefill($pngImage, 0, 0, $transparentColor);

// Copy the pixels from the JPEG image to the PNG image
imagecopy($pngImage, $jpegImage, 0, 0, 0, 0, imagesx($jpegImage), imagesy($jpegImage));




// QR code add on

$qr_code = imagecreatefrompng("./" . $file);



// gets background width of QR code
$backg_width = imagesx($qr_code);
$backg_height = imagesy($qr_code);


// maps size of code and position onto image
// can preset numbers later on as to save time and not needing another if/else / switch statement

imagecopyresized($pngImage, $qr_code, $x, $y, 0, 0, 450, 450, $backg_width, $backg_height);


// Set the appropriate headers for PNG image
// header('Content-Type: image/png');

// together saves file
$filename = './assets/image.png';
imagepng($pngImage, $filename);

ob_start();
imagepng($pngImage);
$imageData = ob_get_clean();

// Encode the image data as a data URL
$dataUrl = 'data:image/png;base64,' . base64_encode($imageData);

//echo '<img src="' . $dataUrl . '" alt="Dynamic Image">';


// imagepng($pngImage);


// Free up memory by destroying the image resources
imagedestroy($jpegImage);
imagedestroy($pngImage);

return $dataUrl;

}