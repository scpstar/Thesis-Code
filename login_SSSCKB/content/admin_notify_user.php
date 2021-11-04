<?php include "../includes/init.php" ?>
<?php
    //sending email
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $usrname=$_POST['username'];
        if(count_field_val($pdo,"users","username",$usrname)>0){
            $row=return_field_data($pdo,"users","username",$usrname);
            $body = "You are added to the team. If you are interested to know more about the work in the team please reply back 😊";
            send_mail($row['emailaddress'], "Confirmation email", $_POST["comments"], $from_email, $reply_email);
            redirect('admin.php');
        }else{
            set_msg("User '{$usrname}' was not found in the database");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "../includes/header.php" ?>
    <body>
        <?php include "../includes/nav_bar.php" ?>
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
                                    <h3 class="text-center">Notify user that they are added to the group</h3>
								    <form id="login-form"  method="post" role="form" style="display: block;">
                                        <!-- form to add any comments before clicking notify button--> 
									    <div class="form-group">
										    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" required>
									    </div>
                                        <div class="form-group">
                                            <textarea name="comments" id="comments" tabindex="2" class="form-control"  placeholder="Comments"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="reset-submit" id="reset-submit" tabindex="4" class="form-control btn btn-custom" value="Notify">
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