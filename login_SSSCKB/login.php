<?php include "includes/init.php" ?>
<?php
    //if user clicks submit
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        //setting username and password
        $usrname=$_POST['username'];
        $pword=$_POST['password'];
        //checking if remember is set
        if(isset($_POST['remember'])){
            //set to on
            $remember = "on";
        }else{
            //set php variable value to off
            $remember = "off";
        }
        //checking if user exists
        //if value greater than 0 then user exists in the database
        if(count_field_val($pdo,"users","username",$usrname)>0){
            $user_data = return_field_data($pdo, "users", "username", $usrname);
            //checking if users is active or not active. If not activated then user can't log in
            if($user_data['active']==1){
                //verifying password which was used during registration
                if(password_verify($pword, $user_data['pwd'])){
                    set_msg("Hurray!!!You have logged in successfully","success");
                    //setting last login date
                    update_login_date($pdo, $usrname);
                    $_SESSION['username']=$usrname;
                    if($remember="on"){
                        //86400 seconds in a day->so cookie will expire after a day
                        setcookie("username", $usrname, time()+86400);
                    }
                    //redirecting to user's dashboard
                    redirect("mycontent.php");
                }else{
                    set_msg("Password is invalid");
                }
            }else{
            set_msg("User '{$usrname}' found but has not been activated");
                }
        }else{
            //if user does not exist in databse
            set_msg("User '{$usrname}' does not exist in database");
        }
    }else{
        //setting to empty string if not submitted
        $usrname="";
        $pword="";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "includes/header.php" ?>
    <body>
        <?php include "includes/nav_bar.php" ?>
        <div class="container">
    	    <div class="row">
			    <div class="col-md-6 col-md-offset-3">
                     <?php 
                        show_msg();
                    ?>
				    <div class="panel panel-login">
					    <div class="panel-body">
						    <div class="row">
							    <div class="col-lg-12">
								    <form id="login-form"  method="post" role="form" style="display: block;">
                                        <!-- form which provides fields to enter username and password during login-->
									    <div class="form-group">
										    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value='<?php echo $usrname; ?>' required>
									    </div>
									    <div class="form-group">
										    <input type="password" name="password" id="login-
										password" tabindex="2" class="form-control" placeholder="Password" value='<?php echo $pword; ?>' required>
                                        </div>
                                        <!-- checkbox to keep user logged in for a day -->
                                        <div class="form-group text-center">
                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                            <label for="remember">Stay logged in</label>
                                        </div>
                                        <!-- submit button -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-custom" value="Log In">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <!-- if user has fprgotton the password then can reset using this link -->
                                                        <a href="passwordreset_1.php" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                    </div>
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