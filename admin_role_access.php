<?php 
    $v_modul = "role_access";
    
    if($p*1==0){ $p = 1; }
    
    $sql = "
            SELECT
              cid,
              role_access_name,
              POSITION_ID,
              EMPLOYEE_ID,
              NOTE,
              Active
            FROM
              role_access_tbl 
            WHERE
                1=1
            ORDER BY 
               role_access_name ASC 
    "; 
    $arr_data["role_access_tbl_all"] = SQL_SELECT($sql, $db["dbms"]);
    
    $arr_data["jml_data"][$v_modul] = count($arr_data["role_access_tbl_all"]);
    
    $sql = "
            SELECT
              cid,
              role_access_name,
              POSITION_ID,
              EMPLOYEE_ID,
              NOTE,
              Active
            FROM
              role_access_tbl 
            WHERE
                1=1
            ORDER BY 
               role_access_name ASC 
            LIMIT
                0, ".$max_page." 
    "; 
    $arr_data["role_access_tbl"] = SQL_SELECT($sql, $db["dbms"]);
    
    //$max_page
?>

<div id="div_content_<?php echo $v_modul; ?>">
<?php 
    $_SESSION["list_file"][$v_modul] = "all";
    include("admin_".$v_modul."_list.php");
?>
</div>
<!-- .row -->                              