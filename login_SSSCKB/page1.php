<?php include "includes/init.php" ?>
<!DOCTYPE html>
<html lang="en">
    <?php include "includes/header.php" ?>
    <body>
        <?php include "includes/nav.php" ?>

        <div class="container">
             <?php 
                show_msg();
            ?>
<style>
    footer .glyphicon {
    font-size: 20px;
    margin-bottom: 20px;
    color: #f4511e;
  }
     .logo-small {
    color: #f4511e;
    font-size: 50px;
  }
  .logo {
    color: #f4511e;
    font-size: 200px;
  }
    .container-fluid {
    padding: 20px 50px;
    }
    .img{
        width:50%;
    }

</style>

<div id="services" class="container-fluid text-center">
  <h2>SERVICES</h2>
  <h4>What we offer</h4>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <img src="pics/coding.png" alt="development" width="110">
      <h4>DEVELOPMENT</h4>
      <p>We develop apps and websites..</p>
    </div>
    <div class="col-sm-4">
      <img src="pics/customer-service.png" alt="IT Support" width="110">
      <h4>IT Support</h4>
      <p>IT Customer Support..</p>
    </div>
    <div class="col-sm-4">
      <img src="pics/security.png" alt="IT Security" width="110">
      <h4>SECURITY</h4>
      <p>Security For Services..</p>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <img src="pics/networking.png" alt="IT Networking" width="110" >
      <h4>NETWORKING</h4>
      <p>Hardware/Software Networking..</p>
    </div>
    <div class="col-sm-4">
      <img src="pics/analysis.png" alt="IT data analysis" width="110">
      <h4>DATA ANALYSIS</h4>
      <p>Analysing Data For Business..</p>
    </div>
    <div class="col-sm-4">
     <img src="pics/training.png" alt="IT data analysis" width="110">
      <h4 style="color:#303030;">TRAINING</h4>
      <p>Training on Services Provided..</p>
    </div>
  </div>
</div>
        </div> <!--Container-->
        
        
        <?php include "includes/footer.php" ?>
    </body>
</html>