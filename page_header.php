<?php 
    ob_start();
    session_start();

    $apps_name          = "HRIS";
    $max_recent_task    = 20;
    $max_page           = 20;
    $base_url           = "http:localhost/hris";
    $db["dbms"]         = "mysql";
    
    if($db["dbms"]=="mysql")
    {
        $db["host"]    = "localhost";
        $db["user"]    = "root";
        $db["pass"]    = "wom";
        $db["master"]  = "hris_db";
        
        $db["connect"] = mysql_connect($db["host"], $db["user"], $db["pass"]) or die ('Failed to connect to MySQL');
        mysql_select_db($db["master"]); 
    }
    else if($db["dbms"]=="mysqli")
    {
        $db["host"]    = "localhost";
        $db["user"]    = "root";
        $db["pass"]    = "wom";
        $db["master"]  = "hris_db";
        
        $db["connect"] = mysqli_connect($db["host"], $db["user"], $db["pass"], $db["master"]);    
        mysqli_select_db($db["master"]); 
    }
    else if($db["dbms"]=="pg")
    {
        $db["host"]    = "localhost";
        $db["user"]    = "root";
        $db["pass"]    = "wom";
        $db["master"]  = "hris_db";
        
        $db["connect"] = pg_connect("host=".$db["host"]." port=65432 dbname=".$db["master"]." user=".$db["user"]." password='".$db["pass"]."'");
    }

    include("function.php");
?>