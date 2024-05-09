<?php
session_start();
include("includes/header.php"); 
include("functions/create-poster.php");
$showForm = true;

if(isset($_POST['name'], $_POST['sponsor'])) {
    $event = $_POST['name'];


    if (!isset($_SESSION['url'])) {
        // Sets generated poster to a session variable so that if refreshed it wont change
        $src = genereate_poster($event);
        $_SESSION['url'] = $src; 
    } else {
        $src = $_SESSION['url'];
    }

    $showForm = false;
    echo 
    "
    <div class='container' id='qr-cnt'>
        <div id='qr-img' class='qr-return'>
            <img id='sponsor-img' src='" . $src . "' alt='" . $event . " sponsor image'>
        </div>

        <br>

        <p>Use your mobile camera or hold on the image to ensure the QR code is correct</p>

        <br>

        <p>If you are using a mobile device, hold the image and press, 'save to camera roll'</p>
        
        <div class='btns'>
            <button id='download' class='btn btn-primary'>Download</button>
            <a href='index.php' id='lnk-back' class='btn btn-primary'>Generate New image</a>
        <div>
    </div>    
    ";
}
?>
<?php if ($showForm == true) { ?>   
    
<div id="info-box"class="two_column">

    <div class="content">
        <p>The Purpose of this site is to generate fundraising posters to help you get more donations for your UWCB, Ultra MMA, Ultra Comedy, Ultra Ballroom or Ultra adventure event, Fill out the event you are participating in and the URL you will be using for your fundraising in the form on the right to get your poster.</p>
        <div class="sponsor-example">
            <img src="assets/templates/Generic FUNDRAISING CODE  - mma .png" alt="">
        </div>
    </div>


    <div class="content">
        <form id='qr-form' class="sponsor-form" action="" method="post" enctype="multipart/form-data">
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
                <!-- <div class="form-check"> -->
                    <!-- <label class="form-check-label" for="" name="name">Ultra Adventures</label> -->
                    <!-- <input class="form-check-input" name="name" type="radio" value="UADVENTURES"> -->
                <!-- </div> -->
            </div>

            <div class="form-group">
                <label for="" name="sponsor">Justgiving Link</label>
                <input id='jg-link' class="form-control" name="sponsor" type="url" placeholder="https://example.com" required>
            </div>
            <button id='sbm'type="submit" name="sbm" class="btn btn-primary" onclick="runQR()">Submit</button>
        </form>
    </div>
</div>
<?php 
session_start();
};
//  
?>
<script src="assets/js/main.js"></script>
