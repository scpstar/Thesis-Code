    <?php
        //withour init we won't have access to session variable so inclusing init file
        include "includes/init.php";
        //unsetting session variable to log out
        unset($_SESSION['username']);
        if(isset($_COOKIE['username'])){
            //destroying cookie if set
            //giving expiration date in the past so that cookie will be automatically destroyed
            setcookie('username', 'delete', time()-3600);
    }
    //once logged out user will be sent to home page
    redirect('index.php');
    ?>