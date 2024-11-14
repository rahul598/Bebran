<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--<link href="style.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body{
  font-family:"poppins";
  background-color: #f2f2f2;
  overflow-x: hidden;
  
}
.header{
  background-color: #ffffff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
  .header-col{
    display: flex;
    padding-top: 10px;
  }
  .header-col-img{
    width: 30%;
    padding-left: 50px;
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .next-section {
    display: flex;
    gap: 5%;
    padding-right: 50px;
    padding-top: 20px;
    justify-content: flex-end;
}
.flag-img {
    width: 36px;
    margin-top: -4px;
}
.account{
  display: flex;
}
.circle {
    background-color: #062c6d;
    color: white;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 10px;
    font-family: Arial, sans-serif;
    font-size: 18px;
}
        select {
    border: none;
    outline: none;
    font-family: Arial, sans-serif;
    font-size: 16px;
    margin-top: -19px;
    padding: 5px;
}
.bell-icon{
  position: relative;
  display: inline-block;
  font-size: 17px; 
}
.bell-icon i {
    padding-top: 7px;
}

.notification-dot {
    position: absolute;
    top: 5px;
    left: 9px;
    width: 7px;
    height: 7px;
    background-color: yellow;
    border-radius: 50%;
    border: 1px solid #fff;
}
.lower-dashboard{
  display: flex;
}
.sidebar{
  background-color: #ffffff;
}
.sidebar li a img{
  padding-right: 5px;
}
.sidebar i{
  padding-left: 10px;
  color: #062c6d;
}
.sidebar li {
    list-style-type: none;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-top: 30px;
}
.sidebar li a{
    text-decoration: none;
    color: #062c6d;
    font-size: 16px;
}
.sidebar-box {
    background: #ffffff;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    width: 20%;
}
.more p{
  padding-left: 50px;
  font-weight: 600;
  color: #062c6d;
  font-size: 18px;
}
.more li{
  padding-bottom: 10px !important;
  padding-top: 10px;
}
.right-side-box{
  display: flex;
  justify-content: center;
}
.inner-box {
    background: #ffffff;
    border-radius: 10px;
    height: 700px;
    padding: 10px;
    margin-bottom: 20px;
}
.inner-box h2{
  color: #062c6d;
  font-size: 35px;
  font-weight: 500;
  padding-left: 30px;
  padding-top: 20px;
}
.inner-box p{
  font-size: 15px;
  font-weight: 300;
  padding-left: 30px;
}
.details {
    display: flex;
    padding-left: 30px;
    margin-bottom: 15px;
    gap: 2%;
    padding-right: 20px;
}
.content-90{
  display: flex;
}
.content-90 p {
    padding-left: 0px;
    font-size: 13px;
    padding-right: 10px;
}
.content-90 h3 {
    font-size: 23px;
    color: #062c6d;
}
.content-90 img {
    margin-left: 25px;
    width: 61px;
}
.inner-details{
  width: 50%;
  border: 1px solid #062c6d;
  border-radius: 10px;
  padding: 10px;
}
.content-footer {
    display: flex;
    justify-content: space-between;
}
.content-footer p {
    margin-bottom: 0px;
    font-size: 13px;
}
.content-footer i{
  padding-right: 20px;
    font-size: 17px;
    color: #062c6d;
}
.image-div{
  width: 90%;
}
.line-hr{
  margin:5px !important;
}
@media (max-width:990px){
    .header-col-img {
    width: 65% !important;
    padding-left: 50px;
    padding-top: 10px;
    padding-bottom: 10px;
}
}
@media(max-width:768px){
    .details {
    display: flex;
    padding-left: 30px;
    margin-bottom: 15px;
    gap: 2%;
    padding-right: 20px;
    flex-direction: column;
}
.content-90 {
    display: flex;
    flex-direction: column;
}
.content-90 h3 {
    font-size: 23px;
    color: #062c6d;
    padding-left: 27px;
    padding-top: 10px;
}
.content-90 p {
    padding-left: 0px;
    font-size: 13px;
    padding-left: 27px;
    padding-right: 10px;
}
.inner-box {
    background: #ffffff;
    border-radius: 10px;
    height: auto;
    margin-right: 10px;
    margin-left: 10px;
    padding: 10px;
    margin-bottom: 20px;
}
.inner-details {
    width: 100%;
    margin-bottom: 20px;
    border: 1px solid #062c6d;
    border-radius: 10px;
    padding: 10px;
}
.image-div {
    margin-right: 20px;
}
.image-div {
    width: auto !important;
}
}
@media (max-width:991px){
.sidebar-box {
    background: #ffffff;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    width: 20%;
    display: none;
}
.desktop-header{
    display:none;
}
.mobile-header{
    display:block !important;
}
.header-col-img {
    width: 65%;
    padding-left: 50px;
    padding-top: 10px;
    padding-bottom: 10px;
}
.header-col {
    display: flex;
    padding-top: 10px;
    justify-content: space-between;
}
}
.bars i.fa-solid.fa-bars {
    font-size: 23px;
    padding-top: 4px;
    padding-left: 5px;
}
.sidebar-top {
    background-color: #ffffff;
    width: 100%;
    padding-right: 20px;
}
#toggle-sidebar{
    display:none;
}
.toggle-div {
    display: flex;
    justify-content: right;
    position: absolute;
}
.sidebar-top {
    background-color: #ffffff;
    width: 100%;
    padding-right: 20px;
    position: relative;
    right: -13px;
    top: 0px;
    z-index: 9999999999;
}
.mobile-header{
    display:none;
}
@media(max-width:540px){
         .header-col {
        display: flex;
        padding-top: 10px;
        flex-direction: column !important;
    }
.next-section {
    display: flex;
    gap: 5%;
     padding-right:0px !important; 
    padding-top: 20px;
    justify-content: center;
}
.logo-mobile{
    display:flex;
    justify-content:center;
}
}



</style>
</head>
<body>
 
    <div class="container-fluid header p-0 desktop-header">
      <div class="row">
        <div class="col-lg-12 header-col">
          <div class="col-lg-6">
            <img src="./images/web-logo.webp" alt="" class="header-col-img">
          </div>
          <div class="col-lg-6 next-section">
                    

            <div class="flag">
              <img src="./images/icons8-india-48.png" class="flag-img">
              </div>
              <div class="account">
                <p class="circle">A</p>
        <select>
            <option>Admin</option>
            <option>Admin2</option>
        </select>
              </div>
              <div class="bell-icon">
                <i class="fa-regular fa-bell"></i>
                <span class="notification-dot"></span>
              </div>
          </div>
        </div>
      </div>
    </div>
    
      <div class="container-fluid header p-0 mobile-header">
      <div class="row">
        <div class="col-lg-12 header-col">
          <div class="col-lg-6 logo-mobile">
            <img src="./images/web-logo.webp" alt="" class="header-col-img">
          </div>
          <div class="col-lg-6 next-section">
                    

            <div class="flag">
              <img src="./images/icons8-india-48.png" class="flag-img">
              </div>
              <div class="account">
                <p class="circle">A</p>
        <select>
            <option>Admin</option>
            <option>Admin2</option>
        </select>
              </div>
              <div class="bell-icon">
                <i class="fa-regular fa-bell"></i>
                <span class="notification-dot"></span>
              </div>
              <div class="bars" >
                  <i class="fa-solid fa-bars" id=toggle></i>
              </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="container-fluid" id=toggle-sidebar>
        <div class="row">
            <div class="col-lg-12 toggle-div">
                <div claas="col-lg-4">
                    <section class=" sidebar sidebar-top">
            <ul>
            <li><a href="#"><img src="./images/dashboard 1.png">  Dashboard</a></li>
            <li><a href="#"><img src="./images/3d-square 1.png">  Keywords</a>  <i class="fa-solid fa-circle-arrow-right"></i></li>
            <li><a href="#"><img src="./images/icons8-analytics-80 1.png">  Analytics</a>  <i class="fa-solid fa-circle-arrow-right"></i></li>
            <li><a href="#"><img src="./images/icons8-analytics-80 2.png">  Ranking</a>  <i class="fa-solid fa-circle-arrow-right"></i></li>
            <li><a href="#"><img src="./images/icons8-analytics-80 3.png">  Projects</a>  <i class="fa-solid fa-circle-arrow-right"></i></li>
            <li><a href="#"><img src="./images/icons8-analytics-80 4.png">  Help</a>  <i class="fa-solid fa-circle-arrow-right"></i></li>
         </ul>
            <div class="more">
            <p>See Others</p>
            <ul>
              <li><a href="#"><img src="./images/icons8-analytics-80 2.png"> Pre Built</a></li>
              <li><a href="#"><img src="./images/icons8-analytics-80 5.png"> Pricing</a></li>
              <li><a href="#"><img src="./images/icons8-analytics-80 6.png"> invoice</a></li>
              <li><a href="#"><img src="./images/icons8-analytics-80 7.png"> Other-Details</a></li>
            </ul>
          </div>
          </section>
                </div>
            </div>
        </div>
    </div>
    
  <div class="container-fluid lower-container-dashboard p-0 mt-3">
    <div class="row">
      <div class="col-lg-12 lower-dashboard">
        <div class="col-lg-3 sidebar-box">
          <sidebar class="sidebar">
               <!--<button class="sidebar-toggle btn btn-primary">☰</button>-->
            <ul>
            <li><a href="#"><img src="./images/dashboard 1.png">  Dashboard</a></li>
            <li><a href="#"><img src="./images/3d-square 1.png">  Keywords</a>  <i class="fa-solid fa-circle-arrow-right"></i></li>
            <li><a href="#"><img src="./images/icons8-analytics-80 1.png">  Analytics</a>  <i class="fa-solid fa-circle-arrow-right"></i></li>
            <li><a href="#"><img src="./images/icons8-analytics-80 2.png">  Ranking</a>  <i class="fa-solid fa-circle-arrow-right"></i></li>
            <li><a href="#"><img src="./images/icons8-analytics-80 3.png">  Projects</a>  <i class="fa-solid fa-circle-arrow-right"></i></li>
            <li><a href="#"><img src="./images/icons8-analytics-80 4.png">  Help</a>  <i class="fa-solid fa-circle-arrow-right"></i></li>
         </ul>
            <div class="more">
            <p>See Others</p>
            <ul>
              <li><a href="#"><img src="./images/icons8-analytics-80 2.png"> Pre Built</a></li>
              <li><a href="#"><img src="./images/icons8-analytics-80 5.png"> Pricing</a></li>
              <li><a href="#"><img src="./images/icons8-analytics-80 6.png"> invoice</a></li>
              <li><a href="#"><img src="./images/icons8-analytics-80 7.png"> Other-Details</a></li>
            </ul>
          </div>
          </sidebar>

        </div>
        <div class="col-lg-9 right-side-box">
          <div class="col-lg-11  inner-box">
            <h2>Welcome, Admin</h2>
           <p>Welcome To Our Dashboard. Manage Your Account And Your Subscription.</p>
           <div class="details">
            <div class="inner-details">
              <div class="content-90">
                <div class="image-div">
                  <img src="./images/personal-information (1).png">
                </div>
                <div>
                  <h3>Personal Info</h3>
                  <p>Keep track of your personal details. View and update your profile information to ensure your account is Private and  always up-to-date.</p>
                </div>
              </div>
              <hr class="line-hr">
              <div class="content-footer">
                <p>Manage Your Account</p>
                <a href="#"><i class="fa-solid fa-circle-arrow-right"></i></a>
              </div>
            </div>
            <div class="inner-details">
              <div class="content-90">
                <div class="image-div">
                  <img src="./images/personal-information (1) 2.png">
                </div>
                <div>
                  <h3>Security Setting</h3>
                  <p>Enhance your account's security. Manage your passwords, enable two-factor authentication, and review recent activity to keep your information safe.</p>
                </div>
              </div>
              <hr class="line-hr">
              <div class="content-footer">
                <p>Account Setting</p>
                <a href="#"><i class="fa-solid fa-circle-arrow-right"></i></a>
              </div>
            </div>
           </div>
           <div class="details">
            <div class="inner-details">
              <div class="content-90">
                <div class="image-div">
                  <img src="./images/personal-information (1) 4.png">
                </div>
                <div>
                  <h3>Billing History</h3>
                  <p>Review your past transactions and billing details. Keep track of your payments, download invoices, and manage your financial records easily.</p>
                </div>
              </div>
              <hr class="line-hr">
              <div class="content-footer">
                <p>Payment History</p>
                <a href="#"><i class="fa-solid fa-circle-arrow-right"></i></a>
              </div>
            </div>
            <div class="inner-details">
              <div class="content-90">
                <div class="image-div">
                  <img src="./images/personal-information (1) 3.png">
                </div>
                <div>
                  <h3>Account Report</h3>
                  <p>Access detailed reports of your account activities. Monitor your usage, analyze performance, and gain insights to better manage your account.</p>
                </div>
              </div>
              <hr class="line-hr">
              <div class="content-footer">
                <p>Manage Subscription </p>
                <a href="#"><i class="fa-solid fa-circle-arrow-right"></i></a>
              </div>
            </div>
           </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    document.getElementById("toggle").addEventListener("click", function() {
    var sidebar = document.getElementById("toggle-sidebar");
    if (sidebar.style.display === "none" || sidebar.style.display === "") {
        sidebar.style.display = "block";
    } else {
        sidebar.style.display = "none";
    }
});

</script>

</body>
</html>
