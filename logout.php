<?php 
    include("page_header.php");
    //$call_log = call_log($_SESSION["ses_person_id"], "person_tbl", $_SESSION["ses_person_id"], "LOGOUT", "");

    $_SESSION["ses_user"]       = "";
    $_SESSION["ses_fullName"]   = "";
    $_SESSION["ses_lock"]       = 0;
    
    header("Location: ".$base_url);
?>