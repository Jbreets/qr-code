<?php 
session_start();
include("functions/qr-code.php");
include("includes/header.php"); 
include("functions/create-poster.php");
// declares whether the form should be displayed or not
$showForm = true;
if (isset($_POST['name'], $_POST['sponsor'])) {
    // sets the post variables
    $event = $_POST['name'];
    $link = $_POST['sponsor'];
    // sets session if the url isn't already set
    if (!isset($_SESSION['url'])) {
        //Generates QR code
        generate_qr($link);
        // validation for URL
        if (strpos($link, "https://") !== false) {
            $link = str_replace("https://", "", $link);
        } elseif (strpos($link, "http://") !== false) {
            $link = str_replace("http://", "", $link);
        }
        // removes / and replaces with -
        $link = str_replace("/", "-", $link);
        // sets URL path for image function
        $file = "qr-codes/" . $link . ".png";
        // creates image
        $src = genereate_poster($event, $file);
        // sets the session url variable to the img path
        $_SESSION['url'] = $src; 
    } else {
        $src = $_SESSION['url'];
    }

    //  removes file
    unlink($file);

    $showForm = false;
    echo 
    "
    <div class='container' id='qr-cnt'>
        <div id='qr-img' class='qr-return'>
            <img id='sponsor-img' src='" . $src . "' alt='" . $event . " sponsor image'>
        </div>

        <br>

        <br>

        <p>Hold down on and click 'save to photos' if using on mobile</p>

        <div class='btns'>
            <button id='download' class='btn btn-primary'>Download</button>
            <a href='https://poster.ultraevents.co/' id='lnk-back' class='btn btn-primary'>Generate New image</a>
        <div>
    </div>    
    ";
}

// https://www.justgiving.com/fundraising/nicole-taylor13

?>
<?php if ($showForm == true) { ?>

<div class="container">
    <p class="description">Select the event type you are particpating in and paste in your Justgiving Link to generate a poster that you can share to get more donations!</p>
    <form id='qr-form' class="sponsor-form" action="" method="post" enctype="multipart/form-data" >
        <div class="form-group">
            <input type="text" name='honeypot' placeholder='your email'>
        </div>
        <div class="form-group">
            <p>Event Type:</p>
            <div class="form-check">
                <label class="form-check-label" for="" name="name">Ultra White Collar Boxing</label>
                <input class="form-check-input" name="name" type="radio" value="UWCB" required>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="" name="name">Ultra MMA</label>
                <input class="form-check-input" name="name" type="radio" value="UMMA">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="" name="name">Ultra Comedy</label>
                <input class="form-check-input" name="name" type="radio" value="UCOMEDY">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="" name="name">Ultra Ballroom</label>
                <input class="form-check-input" name="name" type="radio" value="UBALLROOM">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="" name="name">Ultra Adventures</label>
                <input class="form-check-input" name="name" type="radio" value="UADVENTURES">
            </div>
        </div>
        
        <div class="form-group">
            <label for="" name="sponsor">Justgiving Link</label>
            <input id='jg-link' class="form-control" name="sponsor" type="url" placeholder="https://example.com" required>
        </div>
        <button id='sbm'type="submit" name="sbm" class="btn btn-primary">Submit</button>
    </form>
</div>
<div class="loading">
    <img src="assets/Spinner-1s-200px.gif" alt="">
</div>
<?php 
// erases session variables should they see the home page again
session_unset();
} 
?>
<script src="assets/js/main.js"></script>