<?php include("../includes/init.php");?>
<?php
  if (logged_in()){
      $usrname=$_SESSION['username'];
      //checking if logged in user to only access his content and other's don't
      if(!user_verify_group($pdo, $usrname, "Admin")){
          set_msg("User '{$usrname}' does not have permission to view this page");
          redirect('../index.php');
      }
  }  else {
          set_msg("Please log-in and try again");
        //go back one directory an include index.php file
          redirect('../index.php');
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
            <h1 class="text-center">Admin</h1>
            <!-- three tabs inside admin page -->
            <ul class="nav nav-tabs">
                <!-- first tab will be selected by default -->
                  <li id="users" class="tab-label active"><a href="#">Users</a></li>
                <!-- to navigate to other tabs admin will have to select -->
                  <li id="groups" class="tab-label"><a href="#">Groups</a></li>
                  <li id="pages" class="tab-label"><a href="#">Pages</a></li>
            </ul>
            <div id='tab-users' class='tab-content'>
                <?php
                try{
                        //fields that need to be displayed in users tab for admin
                        $result = $pdo->query("SELECT id,fname, lname, username, emailaddress, active, datejoined, lastlogin FROM users ORDER BY username");
                        if($result->rowCount()>0){
                            echo "<table class='table'>";
                            //displaying headers
                            echo "<tr><th>ID</th><th>Firstname</th><th>Lastname</th><th>Username</th><th>Email Address</th><th>Active</th><th>Date Joined</th><th>Last Login</th></tr>";
                            foreach($result as $row){
                                //this is for admin to activate or deactivate user
                                //instead of showing 1 and 0 from database. This display yes or no for better display
                                if ($row['active']) {
                                   $active = "Yes";
                                   $action = "Deactivate User";
                                } else {
                                   $active = "No";
                                   $action = "Activate User";
                                }
                                echo "<tr><td>{$row['id']}</td><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['username']}</td><td>{$row['emailaddress']}</td><td>{$active}</td><td>{$row['datejoined']}</td><td>{$row['lastlogin']}</td><td><a href='admin_deactivate_user.php?id={$row['id']}'>{$action}</a></td></td><td><a href='admin_edit_user.php?id={$row['id']}'>Edit</a></td><td><a class='confirm-delete' href='admin_delete.php?id={$row['id']}&tbl=users'>Delete</a></td></tr>";
                            }
                             echo "</table>";
                        }else{
                            echo "No users in users table";
                        }
                    }catch(PDOException $e){
                    echo "Oops there was an error<br><br>".$e->getMessage();
                } 
            ?>
            </div>
            <div id='tab-groups' class='tab-content'>
                <?php
                try{
                        //fields that need to be displayed in groups tab for admin
                        $result = $pdo->query("SELECT id,gname,gdesc FROM groups ORDER BY gname");
                        if($result->rowCount()>0){
                            echo "<table class='table'>";
                            //displaying headers
                            echo "<tr><th>Group ID</th><th>Group Name</th><th>Group Description</th><th>Users</th><th>Pages</th></tr>";
                            foreach($result as $row){
                                 $user_count=count_field_val($pdo,"users_groups_link","group_id",$row['id']);
                                $page_count=count_field_val($pdo,"pages","group_id",$row['id']);
                                echo "<tr><td>{$row['id']}</td><td>{$row['gname']}</td><td>{$row['gdesc']}</td><td>{$user_count}</td><td>{$page_count}</td><td><a href='admin_manage_users.php?id={$row['id']}'>Manage Users</a></td><td><a class='confirm-delete' href='admin_delete.php?id={$row['id']}&tbl=groups'>Delete</a></td><td><a href='admin_edit_group.php?id={$row['id']}'>Edit</a></td></tr>";
                            }
                             echo "</table>";
                        }else{
                            //if row count not greater than 0
                            echo "No groups in groups table<br>";
                        }
                    }catch(PDOException $e){
                    echo "Oops there was an error<br><br>".$e->getMessage();
                } 
            ?>
                <!--button going to add group.php page-->
                <a href='admin_add_group.php' class="btn btn-success">Add Group</a>
            </div>
            <div id='tab-pages' class='tab-content'>
                <?php
                try{
                         //fields that need to be displayed in pages tab for admin
                        $result = $pdo->query("SELECT id, pname, url, group_id, pdesc, authorname FROM pages ORDER BY pname");
                        if($result->rowCount()>0){
                            echo "<table class='table'>";
                            //displaying headers
                            echo "<tr><th>ID</th><th>Page Name</th><th>Page url</th><th>Group Name</th><th>Page Description</th><th>Author Name</th></tr>";
                            foreach($result as $row){
                                //linking to specific group
                                $group_row=return_field_data($pdo,"groups","id",$row['group_id']);
                                echo "<tr><td>{$row['id']}</td><td>{$row['pname']}</td><td>{$row['url']}</td><td>{$group_row['gname']}</td><td>{$row['pdesc']}</td><td>{$row['authorname']}</td><td><a class='confirm-delete' href='admin_delete.php?id={$row['id']}&tbl=pages'>Delete</a></td><td><a href='admin_edit_pages.php?id={$row['id']}'>Edit</a></td></tr>";
                            }
                             echo "</table>";
                        }else{
                            echo "No pages in pages table<br>";
                        }
                    }catch(PDOException $e){
                    echo "Oops there was an error<br><br>".$e->getMessage();
                } 
            ?>
                <!--button going to add page.php page-->
                <a href='admin_add_page.php' class="btn btn-success">Add Page</a>
            </div>
        </div> <!--Container-->
        <?php include "../includes/footer.php" ?>
        <script>
            $(".confirm-delete").click(function(e){
                 if (!confirm("Are you sure you want to delete this record?")){
                     e.preventDefault();
                 }                          
            });
            //this will tell which tab we want open
            if (getParameterByName("tab")){
                gotoTab(getParameterByName("tab"));
            }else{
                gotoTab("users");
            }
            gotoTab("users");
            $(".tab-label").click(function(){
                gotoTab($(this).attr('id'));
            });
            //this is the function to navigate to different tabs such as users, groups, pages
            function gotoTab(label){
                var current_tab="#tab-"+label;
                console.log("'"+current_tab+"'");
                $(".tab-content").hide();
                //removes active class from non selected label
                $(".tab-label").removeClass("active");
                //shows content for current tab selected
                $(current_tab).show();
                //and adds active class to the selected tab label
                $("#"+label).addClass("active");
            }
        </script>
    </body>
</html>