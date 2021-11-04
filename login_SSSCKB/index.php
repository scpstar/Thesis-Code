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
            <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
        .container {
          position: relative;
          font-family: Arial;
        }

        .btn-block {
          position: absolute;
          top: 20px;
          left: 20px;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
          padding-top: 40px;
        
        }
        .block {
          display: block;
          width: 25%;
          border: black;
          background-color: lightskyblue;
          color: white;
          padding: 14px 28px;
          font-size: 16px;
          cursor: pointer;
          text-align: center;
          border-radius: 12px; 
        }

        .block:hover {
          background-color: #ddd;
          color: black;
        }
            .button{
                color: white;
            }
        </style>
        </head>
        <body>
        <!-- Index or home page contents-->
        <div class="container">
          <img src="pics/SSSCKBHome.jpg" alt="dashboard" style="width:100%;">
          <div class="btn-block">
           <button class="block"><a href="contact.php">Let's Get Started!!!</a></button>
          </div>
        </div>

        </body>
        </div> <!--Container-->
        
         <!--includes properties from footer.php file-->
        <?php include "includes/footer.php" ?>
    </body>
</html>