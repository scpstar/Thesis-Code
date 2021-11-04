<?php include "../includes/init.php" ?>
<?php
  if (logged_in()){
      $usrname=$_SESSION['username'];
      if(!user_verify_group($pdo, $usrname, "SSSKB Client")){
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
            <h1 clsss = "text-center">Client Help</h1>
            <p>For any development queries regarding your project contact us at xxxxxxxxxx</p>
            </div> <!--Container-->
        
        
        <?php include "../includes/footer.php" ?>
    </body>
</html>