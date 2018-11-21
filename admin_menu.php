<?php 
    $v_modul = "menu";
    
    $sql = "
            SELECT 
                menu_id,
                menu_name,
                menu_group,
                menu_root,
                menu_url,
                sort_by 
            FROM
                menu_tbl
            WHERE
                1=1
                AND menu_tbl.menu_group NOT IN('MENU PORTAL', 'MENU PROFILE')
                AND menu_root = '0'
            ORDER BY
                sort_by ASC
    ";
    $qry = mysql_query($sql);
    while($row = mysql_fetch_array($qry))
    {
        list(
            $menu_id,
            $menu_name,
            $menu_group,
            $menu_root,
            $menu_url,
            $sort_by  
        ) = $row;
        
        $arr_data["list_data_root"][$menu_id] = $menu_id;
        $arr_data["menu_name"][$menu_id] = $menu_name;
        $arr_data["menu_group"][$menu_id] = $menu_group;
        $arr_data["menu_url"][$menu_id] = $menu_url;
        $arr_data["sort_by"][$menu_id] = $sort_by;
        
        $sql = "
                SELECT 
                    menu_id,
                    menu_name,
                    menu_group,
                    menu_root,
                    menu_url,
                    sort_by 
                FROM
                    menu_tbl
                WHERE
                    1=1
                    AND menu_root = '".$menu_id."'
                ORDER BY
                    sort_by ASC
        ";
        $qry2 = mysql_query($sql);
        while($row2 = mysql_fetch_array($qry2))
        {
            list(
                $menu_id,
                $menu_name,
                $menu_group,
                $menu_root,
                $menu_url,
                $sort_by  
            ) = $row2; 
            
            $arr_data["list_data"][$menu_root][$menu_id] = $menu_id;   
            $arr_data["menu_name"][$menu_id] = $menu_name;
            $arr_data["menu_group"][$menu_id] = $menu_group;
            $arr_data["menu_url"][$menu_id] = $menu_url;
            $arr_data["sort_by"][$menu_id] = $sort_by;
        }
    }  
    
    $sql = "
            SELECT 
                menu_id,
                menu_name,
                menu_group,
                menu_root,
                menu_url,
                sort_by 
            FROM
                menu_tbl
            WHERE
                1=1
                AND menu_tbl.menu_group = 'MENU PORTAL'
                AND menu_root = '0'
            ORDER BY
                sort_by ASC
    ";
    $qry = mysql_query($sql);
    while($row = mysql_fetch_array($qry))
    {
        list(
            $menu_id,
            $menu_name,
            $menu_group,
            $menu_root,
            $menu_url,
            $sort_by  
        ) = $row;
        
        $arr_data["list_data_root"][$menu_id] = $menu_id;
        $arr_data["menu_name"][$menu_id] = $menu_name;
        $arr_data["menu_group"][$menu_id] = $menu_group;
        $arr_data["menu_url"][$menu_id] = $menu_url;
        $arr_data["sort_by"][$menu_id] = $sort_by;
        
        $sql = "
                SELECT 
                    menu_id,
                    menu_name,
                    menu_group,
                    menu_root,
                    menu_url,
                    sort_by 
                FROM
                    menu_tbl
                WHERE
                    1=1
                    AND menu_tbl.menu_group = 'MENU PORTAL'
                    AND menu_root = '".$menu_id."'
                ORDER BY
                    sort_by ASC
        ";
        $qry2 = mysql_query($sql);
        while($row2 = mysql_fetch_array($qry2))
        {
            list(
                $menu_id,
                $menu_name,
                $menu_group,
                $menu_root,
                $menu_url,
                $sort_by  
            ) = $row2; 
            
            $arr_data["list_data"][$menu_root][$menu_id] = $menu_id;   
            $arr_data["menu_name"][$menu_id] = $menu_name;
            $arr_data["menu_group"][$menu_id] = $menu_group;
            $arr_data["menu_url"][$menu_id] = $menu_url;
            $arr_data["sort_by"][$menu_id] = $sort_by;
        }
    } 
?>

<div id="div_content_<?php echo $v_modul; ?>">
<?php 
    $_SESSION["list_file"]["menu"] = "all";
    include("admin_menu_list.php");
?>
</div>
<!-- .row -->                              