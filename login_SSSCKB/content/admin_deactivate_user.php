<?php include("../includes/init.php");?>
<?php
  //protects page from anybody trying to access it withour permission
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
        $user_id=$_GET['id'];
        $row=return_field_data($pdo, "users", "id", $user_id);
        //if user is not activated then the system will show to activate else viceversa
        if($row['active']==0){
            $active=1;
        }else{
            $active=0;
        }
        try{
            $stmnt=$pdo->prepare("UPDATE users SET active={$active} WHERE id=:id");
            $stmnt->execute([':id'=>$user_id]);
            redirect('admin.php');
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }else{
        redirect('admin.php');
    }
?>