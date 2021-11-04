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
    //checking only valid user to to be added
    if(isset($_GET['id'])){
        $group_id=$_GET['id'];
    }else{
        redirect('admin.php');
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $user_id= $_POST['user_id'];
            try{
                $stmnt=$pdo->prepare("INSERT INTO users_groups_link (user_id, group_id) VALUES (:user_id, :group_id)");
                $stmnt->execute([":user_id"=>$user_id,":group_id"=>$group_id]);
                set_msg("User '{$user_id}' has been added to group '{$group_id}'", "success");
               
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }
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
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <?php
                     try{
                         //checking users are added to the group or not and displaying who is added
                        $result = $pdo->query("SELECT id,user_id FROM users_groups_link WHERE group_id={$group_id}");
                        if($result->rowCount()>0){
                            echo "<table class='table'>";
                            echo "<tr><th>ID</th><th>Username</th><th>First Name</th><th>Last Name</th></tr>";
                            foreach($result as $row){
                                $user_row=return_field_data($pdo, "users", "id", $row['user_id']);
                                echo "<tr><td>{$user_row['id']}</td><td>{$user_row['username']}</td><td>{$user_row['fname']}</td><td>{$user_row['lname']}</td><td><a class='confirm-delete' href='admin_delete.php?id={$row['id']}&tbl=users_groups_link&group={$group_id}'>Delete</a></td><td><a href='admin_notify_user.php?id={$row['id']}&tbl=groups'>Notify</a></td></tr>";
                            }
                             echo "</table>";
                        }else{
                            echo "<h4> No users in the table</h4>";
                        }
                    }catch(PDOException $e){
                    echo "Oops there was an error<br><br>".$e->getMessage();
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
                                        <div class="form-group">
                                            <!--to get users to add to the group using manage users link-->
                                            <select name="user_id" id="user_id" tabindex="8" class="form-control">
                                                 <?php
                                                    try{
                                                        $result=$pdo->query("SELECT id, username FROM users ORDER BY username");
                                                        foreach($result as $row){
                                                            $user_row=return_field_data($pdo, "users", "id", $row['id']);
                                                             $group_row=return_field_data($pdo, "groups", "id", $group_id);
                                                            if(!user_verify_group($pdo, $user_row['username'], $group_row['gname'])){
                                                                 echo "<option value={$row['id']}>{$row['username']}</option>";
                                                            }
                                                        }
                                                    }catch(PDOException $e){
                                                        echo "Error: ".$e->getMessage();
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <!--button to add user-->
                                                    <input type="submit" name="manage-submit" id="manage-submit" tabindex="4" class="form-control btn btn-custom" value="Add user to group">
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
