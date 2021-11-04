<?php include "includes/init.php" ?>
<?php
    if ($_GET['user']){
        //checking if key was sent as GET parameter
        if($_GET['code']){
            //checking if user is valid user
             $usrname=$_GET['user'];
            //checking if key is valid key
             $vcode=$_GET['code'];
            //checking if user exists
           if (count_field_val($pdo, "users", "username", $usrname)>0) {
               //if valid user then return field data
                $row=return_field_data($pdo, "users", "username", $usrname);
               //if validation key does not match
                 if ($vcode!=$row['validationkey']) {
                    set_msg("Validation key does not match database");
                    redirect("index.php");
                }
            } else {
                set_msg("User '{$usrname}' not found in database");
                redirect("index.php");
            }
        } else {
           set_msg("No validation key included with reset request");
           redirect("index.php");
        }
    } else {
        set_msg("No user included with reset request");
        redirect("index.php");
    }
    //checking if there are any POST parameters, if there is then we update password
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        try {
            //checking if passwords match
            $pword=$_POST['password']; 
            $conf_pword=$_POST['password_confirm'];
            //if passwords match
            if ($pword==$conf_pword) {
                //updating password for proper username
                $stmnt=$pdo->prepare("UPDATE users SET pwd=:password WHERE username=:username");
                $user_data=[':password'=>password_hash($pword, PASSWORD_BCRYPT), ':username'=>$usrname];
                $stmnt->execute($user_data);
                set_msg("Password reset successful. Please log in");
                redirect("login.php");
            } else {
                set_msg("Passwords don't match");
            }
        } catch(PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "includes/header.php" ?>
    <body>
        <?php include "includes/nav_bar.php" ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                     <?php 
                show_msg();
                    ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="register-form" method="post" role="form" >
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="5" class="form-control" placeholder="Password" required>
                                        </div>
                                        <div class="form-group"> 
                                            <input type="password" name="password_confirm" id="confirm-password" tabindex="6" class="form-control" placeholder="Confirm Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="reset-submit" id="reset-submit" tabindex="4" class="form-control btn btn-custom" value="Reset Password">
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
        <?php include "includes/footer.php" ?>
    </body>
</html>