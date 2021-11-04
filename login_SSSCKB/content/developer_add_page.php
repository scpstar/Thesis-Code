<?php include("../includes/init.php");?>
<?php
  if (logged_in()){
      $usrname=$_SESSION['username'];
      if(!user_verify_group($pdo, $usrname, "Internal developers")){
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
          //reading page name, description, url and group id
        $pname=$_POST['pname'];
        $pdesc=$_POST['pdesc'];
        $url=$_POST['url'];
        $authorname=$_POST['authorname'];
        $group_id=$_POST['group_id'];
        
        //error checking 
        if(strlen($pname)<3){
            $error[]="Make sure that page name is atleast 3 characters long";
        }
        if(strlen($url)<3){
            $error[]="Make sure that URL is atleast 3 characters long";
        }
        //testing if group id matches page
        if (count_field_val($pdo, "groups","id",$group_id)==0){
            $error[]="Group ID could not found in group table";
        }
        //if error is not set then we can add to database
        if(!isset($error)){
             //try catch incase if there are database errors
            try{
                $stmnt=$pdo->prepare("INSERT INTO pages (pname, pdesc, url, group_id, authorname) VALUES (:pname, :pdesc, :url, :group_id,:authorname)");
                $stmnt->execute([":pname"=>$pname,":pdesc"=>$pdesc,":url"=>$url,":group_id"=>$group_id,":authorname"=>$authorname]);
                set_msg("Page '{$pname}' has been added", "success");
                redirect("admin.php?tab=pages");
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }
        }
    }else{
        $pname="";
        $pdesc="";
        $url="";
        $authorname="";
        $group_id="";
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
                                    <form id="register-form" method="post" role="form" >
                                        <div class="form-group">
                                            <input type="text" name="pname" id="pname" tabindex="1" class="form-control" placeholder="Page Name" required value="<?php echo $pname ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="url" id="url" tabindex="2" class="form-control" placeholder="Page URL" required value="<?php echo $url ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="authorname" id="authorname" tabindex="2" class="form-control" placeholder="Author Name" required value="<?php echo $authorname ?>">
                                        </div>
                                        <div class="form-group">
                                            <!--options menu to select from number of groups available-->
                                            <select name='group_id' id='group_id' class='form-control' required>
                                                <?php
                                                    try{
                                                        //looking for id and name of group from database so that we don't have to add manually using select
                                                        $result=$pdo->query("SELECT id, gname FROM groups ORDER BY gname");
                                                        foreach($result as $row){
                                                            echo "<option value={$row['id']}>{$row['gname']}</option>";
                                                        }
                                                    }catch(PDOException $e){
                                                        echo "Error: ".$e->getMessage();
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="pdesc" id="pdesc" tabindex="8" class="form-control" placeholder="Enter your page description"><?php echo $pdesc ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-custom" value="Add Page">
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
