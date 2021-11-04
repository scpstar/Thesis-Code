<?php include "includes/init.php" ?>
<?php
    //checking if there is a user
    if (isset($_GET['user'])) {
        //if there is then create a php variable which is equal to the value of the key-value pair in get array
        $user = $_GET['user'];
        //checking if there is activation code
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            //if there is key we check if it matches with database key and passing it to user
            $db_code = get_validationcode($user, $pdo);
            //if key matches
            if ($code == $db_code) {
                //setting active field to 1 and executing with the user
                try {
                    $stmnt=$pdo->prepare("UPDATE users SET active=1 WHERE username=:username");
                    $stmnt->execute([':username'=>$user]);
                    set_msg("Activated User, Please login to access your knowledge base","success");
                    redirect('index.php');
                } catch(PDOException $e) {
                    echo "Error: {$e}";
                }
            } else {
                set_msg("Validation key does not match the database");
                redirect('index.php');
            }
        } else {
            set_msg("No validation key involved with activate request");
            redirect('index.php');
        }
    } else {
        set_msg("No user involved with activate request");
        redirect('index.php');
    }
?>