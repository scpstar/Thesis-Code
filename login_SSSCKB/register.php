<?php include "includes/init.php" ?>
<?php
    //testing if there is any post data
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $fstname = $_POST['firstname'];
        $lstname = $_POST['lastname'];
        $usrname = $_POST['username'];
        $email = $_POST['email'];
        $conf_email = $_POST['email_confirm'];
        $pword = $_POST['password'];
        $conf_pword = $_POST['password_confirm'];
        $comments = $_POST['comments'];
        
        //validating employee entered details as per set rules
        if(strlen($lstname)<3){
            $error[] = "Last name must be atleast 3 characters long";
        }
        if(strlen($usrname)<6){
            $error[] = "User name must be atleast 6 characters long";
        }
        if(strlen($pword)<6){
            $error[] = "Password must be atleast 6 characters long";
        }
        if($pword != $conf_pword){
            $error[] = "Passwords do not match";
        }
        if($email != $conf_email){
            $error[] = "Email addresses do not match";
        }
        if (count_field_val($pdo, "users", "username", $usrname)!=0){
            $error[] = "Username '{$usrname}' already exists";
        }
        if (count_field_val($pdo, "users", "emailAddress", $email)!=0){
            $error[] = "Email '{$email}' already exists";
        }
        
        //if error message is not not set then data will be enetered in the database
        if (!isset($error)){
            $vcode=generate_token();
             try{
            //adding placeholder because of security risk from attackers
            //PASSWORD_BCRYPT generates a 60 character hash
                 
            //generating sql statement to insert data into database
            //placeholders are used to reduce sql attacks during POST data
            $sql = "INSERT INTO users (fname,lname,username,emailAddress,pwd,comments,validationkey,active,dateJoined,lastLogin) VALUES  (:firstname,:lastname,:username,:email,:password,:comments, :vcode, 0,current_date,current_date)";
            $stmnt = $pdo->prepare($sql);
            
            //to execute the above sql statement
            $user_data = [':firstname'=>$fstname,':lastname'=>$lstname,':username'=>$usrname,':email'=>$email,':password'=>password_hash($pword, PASSWORD_BCRYPT),':comments'=>$comments, ':vcode'=>$vcode];
            //submits insert statement to database
            $stmnt->execute($user_data);
                 
            $body = "<p>Please go to http://{$_SERVER['SERVER_NAME']}/{root_dir}/activate.php?user={$usrname}&code={$vcode} in order to activate account<p>";
                 
            send_mail($email, "Account Activation", $body, $from_email, $reply_email);
            
            } catch(PDOException $e) {
                 //echoing out error message
                echo "Error: ".$e->getMessage();
            }
        }
       
    }else{
        //populating the variables created above with blank else when we echo out these variable php editor will get confused 
        $fstname="";
        $lstname="";
        $usrname="";
        $email="";
        $conf_email="";
        $pword="";
        $conf_pword="";
        $comments="";
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
                        //if there are errors then will loop through entire array and in each loop of array will get error msg
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
                                    <form id="register-form" method="post" role="form" >
                                        <!--form which will be visible to the employees to add details-->
                                        <div class="form-group">
                                            <input type="text" name="firstname" id="firstname" tabindex="1" class="form-control" placeholder="First Name" value="<?php echo $fstname ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="lastname" id="lastname" tabindex="2" class="form-control" placeholder="Last Name" value="<?php echo $lstname ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" tabindex="3" class="form-control" placeholder="Username" value="<?php echo $usrname ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" id="register_email" tabindex="4" class="form-control" placeholder="Email Address" value="<?php echo $email ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email_confirm" id="confirm_email" tabindex="4" class="form-control" placeholder="Confirm Email Address" value="<?php echo $conf_email ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="5" class="form-control" placeholder="Password" value= "<?php echo $pword ?>" required>
                                        </div>
                                        <div class="form-group"> 
                                            <input type="password" name="password_confirm" id="confirm-password" tabindex="6" class="form-control" placeholder="Confirm Password" value= "<?php echo $conf_pword ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="comments" id="comments" tabindex="7" class="form-control"  placeholder="Comments"><?php echo $comments ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-custom" value="Register Now">
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