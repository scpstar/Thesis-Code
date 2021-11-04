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
            <!-- styling the contact us page -->
            <style>
            body {
              font-family: Arial, Helvetica, sans-serif;
              margin: 0;
            }

            html {
              box-sizing: border-box;
            }

            *, *:before, *:after {
              box-sizing: inherit;
            }

            .column {
              float: left;
              width: 33.3%;
              margin-bottom: 16px;
              padding: 0 8px;
            }

            .card {
              box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
              margin: 8px;
            }

            .about-section {
              padding: 50px;
              text-align: center;
              background-color: seagreen;
              color: white;
            }
            .center {
              display: block;
              margin-left: auto;
              margin-right: auto;
              width: 50%;
            }

            @media screen and (max-width: 650px) {
              .column {
                width: 100%;
                display: block;
              }
            }
            </style>
            <body>
            <!-- contents in contact us page -->
            <div class="about-section">
              <h1>Get In Touch</h1>
                <p>For general enquiries: </p>
              <p>Email: admin@sssckb.com</p>
              <p>Contact Number: 0449 111 222</p>
            </div>

            <h2 style="text-align:center">Our Team</h2>
            <div class="row">
              <div class="column">
                <div class="card">
                  <img src="pics/woman-Sonal.png" alt="Sonal Pereira" style="width:50%" class="center">
                    <h2><center>Sonal Pereira</center></h2>
                    <p class="title"><center>CEO and Founder</center></p>
                    <p><center>Software Engineer</center></p>
                    <p><center>sonal@sssckb.com</center></p>
                </div>
              </div>

                <div class="column">
                <div class="card">
                  <img src="pics/Man-Ken.png" alt="Ken Vas" style="width:50%" class="center">
                    <h2><center>Ken Vas</center></h2>
                    <p class="title"><center>Manager</center></p>
                    <p><center>Electrical Engineer</center></p>
                    <p><center>ken@sssckb.com</center></p>
                </div>
              </div>

                <div class="column">
                <div class="card">
                  <img src="pics/female-Dainy.png" alt="Dainy Dsouza" style="width:50%" class="center">
                    <h2><center>Dainy Dsouza</center></h2>
                    <p class="title"><center>Senior Developer</center></p>
                    <p><center>Computer Science Engineer</center></p>
                    <p><center>dainy@sssckb.com</center></p>
                </div>
              </div>
            </div>

            </body>
            <br>
        </div> <!--Container-->
        
        <?php include "includes/footer.php" ?>
    </body>
</html>