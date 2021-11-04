<?php include "../includes/init.php" ?>
<?php
    //checking if logged in user is admin, if not other users should not able to access this page
  if (logged_in()){
      $usrname=$_SESSION['username'];
      if(!user_verify_group($pdo, $usrname, "Admin")){
          set_msg("User '{$usrname}' does not have permission to view this page");
          redirect('../index.php');
      }
  }  else {
          set_msg("Please log-in and try again");
          redirect('../index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "../includes/header.php" ?>
    <body>
        <?php include "../includes/nav_bar.php" ?>

        <div class="container">
             <?php 
                show_msg();
            ?>
            <h1 clsss = "text-center">Admin Help</h1>
            <br>
            <p><h3>This page can give useful information for Admin to operate this website</h3></p>
            <br>
            <p><h4>This is the user guide for the website</h4></p>
            <p><h4>Good luck with the system</h4></p>
            </div> <!--Container-->
            </div> <!--Container-->
        
        
        <?php include "../includes/footer.php" ?>
    </body>
</html>