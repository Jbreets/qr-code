let button = document.getElementById('sbm');
let url = document.getElementById('jg-link');
let imgBox = document.getElementById('qr-img');
let loading = document.querySelector('.loading img');



window.onpageshow = function(event) {
  if (event.persisted) {
      window.location.reload() 
  }
};


// potentially remove this and instead add back into raw css
if (imgBox) {
  // imgBox.style.border = "solid 5px black";
  imgBox.style.boxShadow = "0px 0px 14px 7px black";
}




// Function that creates the QR code
function runQR() {
  // check if radios are checked
  let radioCheck = document.querySelector('input[name = "name"]:checked');
  let honeypot = document.querySelector('input[name = "honeypot"]');

  // Stops QR code from being generated if honepot area is filled
  if (honeypot.value !== "") {
    return false
  } else {

    if (url.value !== "" & radioCheck !== null ) {

      var test = document.getElementById("jg-link").value;
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
      document.getElementById("sbm").innerHTML = "Generating";
  
      }
  
      xhttp.open("GET", "functions/qr-code.php?q="+test);
      xhttp.send();

      console.log(url.value)
    }
      
  return false
  }

}//END OF FUNCTION




// Code that force submits form (FIREFOX ISSUE)
const qrForm = document.getElementById('qr-form');
if (qrForm) {

  document.getElementById('qr-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting immediately
  
    var delayInMilliseconds = 500; // Delay in milliseconds (e.g., 2000 milliseconds = 2 seconds)
  
    // Function to submit the form after the delay
    // WIll not submit if the honeypot area is filled
    let honeypot = document.querySelector('input[name = "honeypot"]');
    
    if (honeypot.value !== "") {
      console.log("area is filled")  
      return false
    } else {

      // runQR();
    
      function submitForm() {
        document.getElementById('qr-form').submit(); // Submit the form
       }
       // Set the delay using setTimeout
       setTimeout(submitForm, delayInMilliseconds);
     
       // Changes text of button 
       document.getElementById("sbm").innerHTML = "Generating...";
       // disables button once it is submitted 
       button.setAttribute("disabled", true);
       loading.style.display = "inherit";

       

     
       console.log("working");
    }
  }) 
};


// Code for the JS download button
const downloadButton = document.getElementById('download');

if (downloadButton) {
    downloadButton.addEventListener('click', () => {
      let imageSrc = document.getElementById('qr-cnt').getElementsByTagName('img')[0].src;


      // get brand name
      let alt = document.getElementsByTagName("img")
      alt = alt[1].alt
      alt = alt.split(/(\s+)/);
      console.log(alt)

      let brand = alt[0];

      switch (brand) {
        case "UWCB":
          brand = "Ultra-white-collar-boxing";
          break;
        case "UMMA":
          brand = "Ultra-MMA"
          break;
        case "UCOMEDY":
          brand = "Ultra-Comedy"
          break;
        case "UBALLROOM":
          brand = "Ultra-Ballroom"
          break;  
      }
      


      // download link to button
      const link = document.createElement('a');
      link.href = imageSrc;
      link.download = brand + '-fundraising-poster.png';

      link.click();
  })  
};




// version of qr code that creates whatever qr I want
/*
function runQR() {
  

    var test = document.getElementById("jg-link").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
    document.getElementById("sbm").innerHTML = "Generating";

    }

    xhttp.open("GET", "functions/qr-code.php?q="+test);
    xhttp.send();

}//END OF FUNCTION
*/