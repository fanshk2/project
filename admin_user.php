<?php 
    $v_modul = "user";
    
    if($p*1==0){ $p = 1; }
    
    $sql = "
            SELECT
              *
            FROM
              tab_user
            WHERE
                1=1
            ORDER BY 
               fullName ASC 
    "; 
    $arr_data["tab_user_all"] = SQL_SELECT($sql, $db["dbms"]);
    
    $arr_data["jml_data"][$v_modul] = count($arr_data["tab_user_all"]);
    
    $sql = "
            SELECT
              *
            FROM
              tab_user
            WHERE
                1=1
            ORDER BY 
               fullName ASC 
            LIMIT
                0, ".$max_page." 
    "; 
    $arr_data["tab_user"] = SQL_SELECT($sql, $db["dbms"]);
    
    //$max_page
?>

<div id="div_content_<?php echo $v_modul; ?>">
<?php 
    $_SESSION["list_file"][$v_modul] = "all";
    include("admin_".$v_modul."_list.php");
?>
</div>
<!-- .row -->                              