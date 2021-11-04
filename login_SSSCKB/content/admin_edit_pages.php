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
    if(isset($_GET['id'])){
        $page_id=$_GET['id'];
        if(count_field_val($pdo,"pages","id",$page_id)>0){
        $row=return_field_data($pdo, "pages", "id", $page_id);
        $pname = $row['pname'];
        $url = $row['url'];
        $group_id = $row['group_id'];
        $pdesc = $row['pdesc'];
        }else{
            redirect('admin.php');
        }
    }else{
        redirect('admin.php');
    }
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $pname = $_POST['pname'];
        $url = $_POST['url'];
        $group_id = $_POST['group_id'];
        $pdesc = $_POST['pdesc'];
        
        if (!isset($error)){
     
             try{
            //adding placeholder because of security risk from attackers
            //PASSWORD_BCRYPT generates a 60 character hash
            $sql = "UPDATE pages SET pname=:pname, url=:url, group_id=:group_id, pdesc=:pdesc WHERE id=:id";
            $stmnt = $pdo->prepare($sql);
            $user_data = [':pname'=>$pname,':url'=>$url,':group_id'=>$group_id,':pdesc'=>$pdesc,':id'=>$page_id];
            //submits insert statement to database
            $stmnt->execute($user_data);
            redirect('admin.php?tab=pages');
            } catch(PDOException $e) {
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
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                     <?php 
                show_msg();
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
                                        <!-- form which shows field to edit page details -->
                                        <div class="form-group">
                                            <input type="text" name="pname" id="pname" tabindex="1" class="form-control" placeholder="Page Name" required value="<?php echo $pname ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="url" id="url" tabindex="2" class="form-control" placeholder="Page URL" required value="<?php echo $url ?>" >
                                        </div>
                                        <div class="form-group">
                                            <select name='group_id' id='group_id' class='form-control' required>
                                                <?php
                                                    try{
                                                        $result=$pdo->query("SELECT id, gname FROM groups ORDER BY gname");
                                                        foreach($result as $row){
                                                            //while editing users, giving default group so that there won't be confusion later
                                                            if($row['id']==$group_id){
                                                                $selected = " selected";
                                                            }else{
                                                                $selected="";
                                                            }
                                                            echo "<option value={$row['id']}{$selected}>{$row['gname']}</option>";
                                                        }
                                                    }catch(PDOException $e){
                                                        echo "Error: ".$e->getMessage();
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="pdesc" id="pdesc" tabindex="3" class="form-control" placeholder="Description"> <?php echo $pdesc ?> </textarea> 
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <!-- button to submit after editing details-->
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="update-submit" id="update-submit" tabindex="4" class="form-control btn btn-custom" value="Update Page">
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