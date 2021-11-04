<!--includes properties from init.php file-->
<?php include "includes/init.php" ?>
<!DOCTYPE html>
<html lang="en">
    <!--includes properties from header.php file-->
    <?php include "includes/header.php" ?>
    <body>
        <!--includes properties from nav_bar.php file-->
        <?php include "includes/nav_bar.php" ?>

        <div class="container">
             <?php 
                show_msg();
            ?>
        <!-- styling the about us page -->
        <style>
          body {
            font: 400 15px Lato, sans-serif;
            line-height: 1.8;
            color: #818181;
          }
          h2 {
            font-size: 24px;
            text-transform: uppercase;
            color: seagreen;
            font-weight: 600;
            margin-bottom: 30px;
          }
          h4 {
            font-size: 19px;
            line-height: 1.375em;
            color: seagreen;
            font-weight: 400;
            margin-bottom: 30px;
          }  
          .jumbotron {
            background-color: #f4511e;
            color: #fff;
            padding: 100px 25px;
            font-family: Montserrat, sans-serif;
          }
          .container-fluid {
            padding: 60px 50px;
          }
          .bg-grey {
            background-color: #f6f6f6;
          }
          .thumbnail {
            padding: 0 0 15px 0;
            border: none;
            border-radius: 0;
          }
          .thumbnail img {
            width: 100%;
            height: 100%;
            margin-bottom: 10px;
          }
          .carousel-control.right, .carousel-control.left {
            background-image: none;
            color: #f4511e;
          }
          .carousel-indicators li {
            border-color: #f4511e;
          }
          .carousel-indicators li.active {
            background-color: #f4511e;
          }
          .item h4 {
            font-size: 19px;
            line-height: 1.375em;
            font-weight: 400;
            font-style: italic;
            margin: 70px 0;
          }
          .item span {
            font-style: normal;
          }
          .panel {
            border: 1px solid #f4511e; 
            border-radius:0 !important;
            transition: box-shadow 0.5s;
          }
          .panel:hover {
            box-shadow: 5px 0px 40px rgba(0,0,0, .2);
          }
          .panel-footer .btn:hover {
            border: 1px solid #f4511e;
            background-color: #fff !important;
            color: #f4511e;
          }
          .panel-heading {
            color: #fff !important;
            background-color: #f4511e !important;
            padding: 25px;
            border-bottom: 1px solid transparent;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
          }
          .panel-footer {
            background-color: white !important;
          }
          .panel-footer h3 {
            font-size: 32px;
          }
          .panel-footer h4 {
            color: #aaa;
            font-size: 14px;
          }
          .panel-footer .btn {
            margin: 15px 0;
            background-color: #f4511e;
            color: #fff;
          }
          footer .glyphicon {
            font-size: 20px;
            margin-bottom: 20px;
            color: #f4511e;
          }
          .slideanim {visibility:hidden;}
          .slide {
            animation-name: slide;
            -webkit-animation-name: slide;
            animation-duration: 1s;
            -webkit-animation-duration: 1s;
            visibility: visible;
          }
          @keyframes slide {
            0% {
              opacity: 0;
              transform: translateY(70%);
            } 
            100% {
              opacity: 1;
              transform: translateY(0%);
            }
          }
          @-webkit-keyframes slide {
            0% {
              opacity: 0;
              -webkit-transform: translateY(70%);
            } 
            100% {
              opacity: 1;
              -webkit-transform: translateY(0%);
            }
          }
          @media screen and (max-width: 768px) {
            .col-sm-4 {
              text-align: center;
              margin: 25px 0;
            }
            .btn-lg {
              width: 100%;
              margin-bottom: 35px;
            }
          }
          @media screen and (max-width: 480px) {
            .logo {
              font-size: 150px;
            }
          }
            div {
          text-align: justify;
          text-justify: inter-word;
        }
        </style>
            <!-- Container (About Section) -->
            <div id="about" class="container-fluid">
              <div class="row">
                <div class="col-sm-8">
                  <h2>Who are we?</h2>
                  <h4>We are a tech startup.</h4>
                  <p>We use technology to imrpove your everyday life by automating tasks. We provide solutions to your businesses until your businesses reach the target for success. We have a team of data analysts, network engineers and software engineers who provide various solutions to your businesses. We also develop customised products and provide regular maintenance after product delivery.</p>
                  <br><button class="btn btn-default btn-lg"><a href="contact.php">Get in Touch</a></button>
                </div>
                <div class="col-sm-4">

                  <img src="pics/Aboutus.png" alt="who are we" width="250" height="250">
                </div>
              </div>
            </div>

            <div class="container-fluid bg-grey">
              <div class="row">
                <div class="col-sm-4">
                  <img src="pics/vision.png" alt="who are we" width="200" height="200">
                </div>
                <div class="col-sm-8">
                    <h2>Our Values</h2>
                  <h4><strong>MISSION:</strong> Our mission is to save your time and money by automating your everyday tasks.</h4>
                  <p><strong>VISION:</strong> Our vision is to be a leading global company leveraging the power of innovation to realize an information society friendly to humans and the earth..</p>
                </div>
              </div>
            </div>
        </div>
        
        <?php include "includes/footer.php" ?>
    </body>
</html>