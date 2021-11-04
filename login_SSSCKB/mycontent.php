<?php include "includes/init.php" ?>
<?php
  if (logged_in()){
      //checking if the user is logged in
      //once we end the session even though if we want to access logged in user data it won't allow
      $usrname=$_SESSION['username'];
  }  else {
          set_msg("Oops!!!Please log-in and try again");
          redirect('index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "includes/header.php" ?>
    <body>
        <?php include "includes/nav_bar.php" ?>

        <div class="container">
             <?php 
                show_msg();
            ?>
            <!--Setting name of the user dashboard to the user's name once logged in-->
            <h1 class="text-center"><?php echo $usrname ?>'s Content</h1>
            <?php
                try{
                        //displays what pages and groups a user has access to inside users content page
                        $sql= "SELECT u.username, g.gname AS group_name, g.gdesc AS group_description, p.pname ";
                        $sql.="as page_name, p.pdesc as page_description, p.url ";
                        $sql.="from users u JOIN users_groups_link gu ON u.id=gu.user_id ";
                        $sql.="JOIN groups g ON gu.group_id=g.id ";
                        $sql.="JOIN pages p ON g.id = p.group_id ";
                        $sql.="WHERE username='{$usrname}' ";
                        $sql.="ORDER BY group_name ";
                        $result = $pdo->query($sql);
                        if($result->rowCount()>0){
                            $prev_group=" ";
                            echo "<table class='table'>";
                            foreach($result as $row){
                                //shows header as per the group assigned
                                if($prev_group!=$row['group_name']){
                                    echo "<tr style='background-color:#E9AA9D;'><td>{$row['group_name']}</td><td>{$row['group_description']}</td><td></td></tr>";
                                }
                                //pages will be displayed in third and fourth column
                                echo "<tr><td></td><td><a href='content/{$row['url']}'>{$row['page_name']}</a></td><td>{$row['page_description']}</td></tr>";
                                $prev_group=$row['group_name'];
                            }
                             echo "</table>";
                            $row=return_field_data($pdo,"Users","Username",$usrname);
                            $user_id=$row['id'];
                             echo "<a class='btn btn-success text-center' href='content/admin_edit_user.php?id={$user_id}'>Edit Profile</a>";
                        }else{
                            echo "<h4>No content available for {$usrname}</h4>";
                        }
                    }catch(PDOException $e){
                    echo "Oops there was an error<br><br>".$e->getMessage();
                } 
            ?>
            
        </div> <!--Container-->
        
        
        <?php include "includes/footer.php" ?>
    </body>
</html>