<?php
// think I might be a fucking genius
include("functions/qr-code.php");
include("functions/create-poster.php");
$file = "https://ultrawhitecollarboxing.co.uk/locations/";
generate_qr($file);

// check and remove https / http if its there

if (strpos($file, "https://") !== false) {
    $file = str_replace("https://", "", $file);
} elseif (strpos($file, "http://") !== false) {
    $file = str_replace("http://", "", $file);
}

// removes / and replaces with -
$file = str_replace("/", "-", $file);


$file = "qr-codes/" . $file . ".png";

// Sets poster to a url
$src = genereate_poster("UMMA", $file);

echo"<img src='". $src ."'></img>";

unlink($file);



// if (is_writable($file)) {
    // if (unlink($file)) {
        // echo "Image deleted successfully.";
    // } else {
        // echo "Failed to delete the image.";
    // }
// } else {
    // echo "The script does not have the necessary permissions to delete the image.";
// } 
?>