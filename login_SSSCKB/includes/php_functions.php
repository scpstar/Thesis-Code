<?php
    //this function redirects to different page
    function redirect($loc) {
        header("Location: {$loc}");
    }
    //function that generates pseudo random string based on time and a random number
    function generate_token() {
        return md5(microtime().mt_rand());
    }
    function logged_in(){
         if (isset($_SESSION['username'])){
          return true;
      }  else {
        //if logged then checking of there is a cookie set to keep it logged in
          if(isset($_COOKIE['username'])){
               $usrname=$_COOKIE['username'];
              $_SESSION['username'] = $_COOKIE['username'];
              return true;
          }else{
              return false;
          }
      }
     }
    //function for differnt type message
     function set_msg($msg, $level='danger') {
         //checking if it's valid level
        if (($level!='primary') && ($level!='success') && ($level!='info') && ($level!='warning')) {
            $level='danger';
        }
         //if message is empty then we unset it with a key of message
        if (empty($msg)) {
            unset($_SESSION['message']);
        } else {
            //else setting with html code
            $_SESSION['message']="<h4 class='bg-{$level} text-center'>{$msg}</h4>";
        }
    }
    //function to show message
     function show_msg(){
         //if message is set then echo
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            //if echoed out then unset so that it won't display again
            unset($_SESSION['message']);
        }
    }
    //function which is used to send emails when notifying and while registering
    //it takes paremeters to-> send to, $subject-> includes subject of email, $body->body of email, $from->who sent, $reply->reply to
    function send_mail($to, $subject, $body, $from, $reply) {
        $headers = "From: {$from}"."\r\n"."Reply-To: {$reply} "." \r\n "."X-Mailer: PHP/".phpversion();
        if ($_SERVER['SERVER_NAME'] = "localhost") {
            mail($to, $subject, $body, $headers);  
            set_msg("Email sent to '{to}'. Please check email to activate your account");
            redirect('index.php');
        } else {
            echo "<hr><p>To: {$to}</p><p>Subject: {$subject}</p><p>{$body}</p><p>".$headers."</p><hr>";
        }
    }
    //accesses pdo object where it takes name of table, field and value
    //returns number of records in the table where this particular field has value we specified
    function count_field_val($pdo, $tbl, $fld, $val) {
         try {
              $sql="SELECT {$fld} FROM {$tbl} WHERE {$fld}=:value";
              $stmnt=$pdo->prepare($sql);
              $stmnt->execute([':value'=>$val]);
              //if stmnt executes successfully it return rowcount method of stmnt object
              return $stmnt->rowCount();
         } catch(PDOException $e) {
             //if it does not execute successfully error message will be thrown
              return $e->getMessage();
         }
    }
    function return_field_data($pdo, $tbl, $fld, $val) {
         try {
             //returns all fields where input field = input value
              $sql="SELECT * FROM {$tbl} WHERE {$fld}=:value";
              $stmnt=$pdo->prepare($sql);
              $stmnt->execute([':value'=>$val]);
              return $stmnt->fetch();
         } catch(PDOException $e) {
              return $e->getMessage();
         }
    }
    //function to get validation key from the database
    function get_validationcode($user, $pdo) {
         try {
              $stmnt=$pdo->prepare("SELECT validationkey FROM users WHERE username=:username");
              $stmnt->execute([':username'=>$user]);
             //returns all fields
              $row = $stmnt->fetch();
             //returns data as associative array
              return $row['validationkey'];
         } catch(PDOException $e) {
              return $e->getMessage();
         }        
    }
    //function that updates last login as per the last logged in user
    function update_login_date($pdo, $user) {
         try {
              $stmnt=$pdo->prepare("UPDATE users SET lastlogin=current_date WHERE username=:username");
              $stmnt->execute([':username'=>$user]);
         } catch(PDOException $e) {
              return $e->getMessage();
         }        
    }
    //function to check if proper user is accessing his group with assigned pages
    function user_verify_group($pdo, $user, $group){
        $user_row=return_field_data($pdo, "users", "username", $user);
        $user_id = $user_row['id'];
        $group_row=return_field_data($pdo, "groups", "gname", $group);
        $group_id = $group_row['id'];
        try {
              $sql="SELECT id FROM users_groups_link WHERE user_id={$user_id} AND group_id={$group_id}";
              $stmnt=$pdo->query($sql);
            //checking if there is a record in the group
            //if user is not assigned to the group then the page should not be accessed
             if($stmnt->rowCount()>0){
                 return true;
             }else{
                 return false;
             }
         } catch(PDOException $e) {
              echo $e->getMessage();
              return false;
         }
    }
?>