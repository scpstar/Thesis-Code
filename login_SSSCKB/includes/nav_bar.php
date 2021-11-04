<!--this file contains everything that is needed for navigation bar-->    
<nav class="navbar navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="navbar-brand">Software Service Supply Chain</span>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <!--making link absolute-->
                    <li class="active"><a href="/<?php echo $root_dir ?>/index.php">Home</a></li>
                    <li><a href="/<?php echo $root_dir ?>/services.php">Services</a></li>
                    <li><a href="/<?php echo $root_dir ?>/aboutUs.php">About Us</a></li>
                    <li><a href="/<?php echo $root_dir ?>/contact.php">Contact Us</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (logged_in())
                    {
                        //giving access to pages if logged in
                        echo "<li><a href='/{$root_dir}/mycontent.php'>{$_SESSION['username']}'s Content</a></li>";
                        echo "<li><a href='/{$root_dir}/logout.php'>Logout</a></li>";
                    }else{
                        //if not logged in then employees will have to register or login
                        echo "<li><a href='/{$root_dir}/login.php'>Login</a></li>";
                        echo "<li><a href='/{$root_dir}/register.php'>Register</a></li>";
                    }
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
