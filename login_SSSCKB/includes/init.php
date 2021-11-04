<?php
//starting output buffering in order to redirect a page
ob_start();
//starting session before we can use SESSION in any page
session_start();
    //connecting to postgresSQL by giving hostname and database name with port number used in database
    $dsn = "pgsql:host=localhost;dbname=login_SSSCKB;port=5432";
    $opt = [
        PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES      => false
    ];
    //we access database using a pdo object with username and password
    // here I used superuser name and password
    $pdo = new PDO($dsn,'postgres','Cyril@2009.',$opt);

$root_dir = "login_SSSCKB";
//adress while sending email- gives who sent and whom to reply
$from_email = "sonalcp95@gmail.com";
$reply_email = "sonalcp95@gmail.com";
include "php_functions.php";
?>
