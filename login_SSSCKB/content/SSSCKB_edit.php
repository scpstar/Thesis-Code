<?php include "../includes/init.php" ?>

<!DOCTYPE html>
<html lang="en">
    <?php include "../includes/header.php" ?>
    <body>
        <?php include "../includes/nav_bar.php" ?>

        <div class="container">
             <?php 
                show_msg();
            ?>
            <h1 clsss = "text-center">SSSCKB Editors</h1>
            </div> <!--Container-->
                <br>
                <ul class="nav nav-tabs">
                  <li id="pages" class="tab-label"><a href="#">Pages</a></li>
                </ul>
                <div id='tab-pages' class='tab-content'>
                    <div id='tab-pages' class='tab-content'>
                <?php
                try{
                         //fields that need to be displayed in pages tab for admin
                        $result = $pdo->query("SELECT id, pname, url, group_id, pdesc FROM pages ORDER BY pname");
                        if($result->rowCount()>0){
                            echo "<table class='table'>";
                            //displaying headers
                            echo "<tr><th>ID</th><th>Page Name</th><th>Page url</th><th>Group Name</th><th>Page Description</th></tr>";
                            foreach($result as $row){
                                //linking to specific group
                                $group_row=return_field_data($pdo,"groups","id",$row['group_id']);
                                echo "<tr><td>{$row['id']}</td><td>{$row['pname']}</td><td>{$row['url']}</td><td>{$group_row['gname']}</td><td>{$row['pdesc']}</td><td><a href='user_edit_page.php?id={$row['id']}'>Edit</a></td></tr>";
                            }
                             echo "</table>";
                        }else{
                            echo "No pages in pages table<br>";
                        }
                    }catch(PDOException $e){
                    echo "Oops there was an error<br><br>".$e->getMessage();
                } 
            ?>
                </div>
        </div>
     
        <?php include "../includes/footer.php" ?>
    </body>
</html>