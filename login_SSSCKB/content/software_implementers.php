<?php include "../includes/init.php" ?>
<?php
  if (logged_in()){
      $usrname=$_SESSION['username'];
      if(!user_verify_group($pdo, $usrname, "External Implementation Team")){
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
            <h1 clsss = "text-center">Software Implementers Help</h1>
            </div> <!--Container-->
            <ul class="nav nav-tabs">
                  <li id="pages" class="tab-label"><a href="#">Pages</a></li>
            </ul>
            <div id='tab-pages' class='tab-content'>
                
                <!--button going to add page.php page-->
                <a href='implementers_add_page.php' class="btn btn-success">Add Page</a>
            
        </div> <!--Container-->

        <?php include "../includes/footer.php" ?>
    </body>
</html>