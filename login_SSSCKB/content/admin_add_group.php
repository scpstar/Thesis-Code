<?php include("../includes/init.php");?>
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
<?php
    //checking if submit button is pressed
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        //reading group name and description
        $gname=$_POST['gname'];
        $gdesc=$_POST['gdesc'];
        
        //error checking 
        if(strlen($gname)<3){
            $error[]="Group name must be atleast 3 characters long";
        }
        //if error is not set then we can add to database
        if(!isset($error)){
            //try catch incase if there are database errors
            try{
                $stmnt=$pdo->prepare("INSERT INTO groups (gname, gdesc) VALUES (:gname, :gdesc)");
                $stmnt->execute([":gname"=>$gname,":gdesc"=>$gdesc]);
                set_msg("Group '{$gname}' has been added", "success");
                redirect("admin.php?tab=groups");
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include "../includes/header.php" ?>
    <body>
        <?php include "../includes/nav_bar.php" ?>

        <div class="container">
            <!--displaying message-->
             <?php 
                show_msg();
            ?>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <?php
                     if(isset($error)){
                            foreach($error as $msg){
                                echo "<h4 class='bg-danger text-center'>{$msg}</h4>";
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- form to show fields to add group for admin -->
                                    <form id="register-form" method="post" role="form" >
                                        <div class="form-group">
                                            <input type="text" name="gname" id="gname" tabindex="1" class="form-control" placeholder="Group Name" required >
                                        </div>
                                        <div class="form-group">
                                            <textarea name="gdesc" id="gdesc" tabindex="8" class="form-control" placeholder="Enter your group description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-custom" value="Add Group">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../includes/footer.php" ?>
    </body>
</html>
