<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign-Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 logo-col">
                <img src="./images/web-logo.webp" alt="web-logo">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 logo-col2">
                <div class="col-lg-6 sign-up-section">
                    <h2>Sign Up</h2>
                    <p>Let's Create You An Account</p>
                    <div class="sign-up-with-btn">
                      <button type="button" class="btn google-btn"><img src="./images/pngwing.com.png"> Sign In With Gmail</button>
                      <button type="button" class="btn facebook-btn"><img src="./images/vecteezy_facebook-logo-vector-facebook-icon-free-vector_18910798 1.png"> Sign In With Facebook</button>
                      <button type="button" class="btn apple-btn"><img src="./images/apple-logo-svgrepo-com.png"> Sign In With apple</button>
                    </div>
                    <div class="centered-content">
                      <hr class="left-line">
                      <p class="main-line">OR</p>
                      <hr class="right-line">
                  </div>
                  <div class="first-section-signup mt-4">
                    <input type="text" id="" value="" placeholder="First Name" autocomplete="off">
                    <input type="text" id="" value="" placeholder="Last Name" autocomplete="off">
                  </div>
                  <div class="first-section-signup ">
                      <div class="tel-div">
                     <input id="phone" type="tel" class="phone-input" placeholder="Enter phone number" autocomplete="off">
                     </div>
                    <input type="email" id="" value="" placeholder="Email" autocomplete="off">
                    
                  </div>
                  <div class="first-section-signup">
                    <input type="password" id="" value="" placeholder="Password" autocomplete="off">
                    <input type="password" id="" value="" placeholder="Confirm Password" autocomplete="off">
                  </div>
                  <div class="signup-btn">
                    <button type="button" class="btn">Sign Up</button>
                  </div>
                  <p class="pt-3 have-account">Already Have An Account?<a href="https://project.ambalainfo.com/subscribe/sign-in.php">Sign-In</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.querySelector("#phone");
            var iti = window.intlTelInput(input, {
                initialCountry: "in", // Sets default country to India
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });
        });
    </script>
  </body>
</html>