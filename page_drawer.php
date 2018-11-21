<?php 
if($db["dbms"]=="mysql")
{
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
        
        $arr_data["list_menu_root"][$menu_id] = $menu_id;
        $arr_data["menu_name"][$menu_id] = $menu_name;
        $arr_data["menu_url"][$menu_id] = $menu_url;
        
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
            
            $arr_data["list_menu"][$menu_root][$menu_id] = $menu_id;   
            $arr_data["menu_name"][$menu_id] = $menu_name;
            $arr_data["menu_url"][$menu_id] = $menu_url;
        }
    }
    
    if($_SESSION["ses_user"])
    {
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
            
            $arr_data["list_menu_root_login"][$menu_id] = $menu_id;
            $arr_data["menu_name"][$menu_id] = $menu_name;
            $arr_data["menu_url"][$menu_id] = $menu_url;
            
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
                
                $arr_data["list_menu_login"][$menu_root][$menu_id] = $menu_id;   
                $arr_data["menu_name"][$menu_id] = $menu_name;
                $arr_data["menu_url"][$menu_id] = $menu_url;
            }
        } 
    }
}
else if($db["dbms"]=="mysqli")
{
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
    $qry = mysqli_query($sql);
    while($row = mysqli_fetch_array($qry))
    {
        list(
            $menu_id,
            $menu_name,
            $menu_group,
            $menu_root,
            $menu_url,
            $sort_by  
        ) = $row;
        
        $arr_data["list_menu_root"][$menu_id] = $menu_id;
        $arr_data["menu_name"][$menu_id] = $menu_name;
        $arr_data["menu_url"][$menu_id] = $menu_url;
        
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
        $qry2 = mysqli_query($sql);
        while($row2 = mysqli_fetch_array($qry2))
        {
            list(
                $menu_id,
                $menu_name,
                $menu_group,
                $menu_root,
                $menu_url,
                $sort_by  
            ) = $row2; 
            
            $arr_data["list_menu"][$menu_root][$menu_id] = $menu_id;   
            $arr_data["menu_name"][$menu_id] = $menu_name;
            $arr_data["menu_url"][$menu_id] = $menu_url;
        }
    }
}
else if($db["dbms"]=="pg")
{
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
    $qry = pg_query($sql);
    while($row = pg_fetch_array($qry))
    {
        list(
            $menu_id,
            $menu_name,
            $menu_group,
            $menu_root,
            $menu_url,
            $sort_by  
        ) = $row;
        
        $arr_data["list_menu_root"][$menu_id] = $menu_id;
        $arr_data["menu_name"][$menu_id] = $menu_name;
        $arr_data["menu_url"][$menu_id] = $menu_url;
        
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
        $qry2 = pg_query($sql);
        while($row2 = pg_fetch_array($qry2))
        {
            list(
                $menu_id,
                $menu_name,
                $menu_group,
                $menu_root,
                $menu_url,
                $sort_by  
            ) = $row2; 
            
            $arr_data["list_menu"][$menu_root][$menu_id] = $menu_id;   
            $arr_data["menu_name"][$menu_id] = $menu_name;
            $arr_data["menu_url"][$menu_id] = $menu_url;
        }
    }
}
    
?>

<!-- Drawer -->
<aside class="app-layout-drawer">

    <!-- Drawer scroll area -->
    <div class="app-layout-drawer-scroll" >
        <!-- Drawer logo -->
        <div id="logo" class="drawer-header">
            <a href="javascript:void(0)"><img class="img-responsive" src="assets/img/logo/logo-backend.png" title="AppUI" alt="AppUI" /></a>
        </div>

        <!-- Drawer navigation -->
        <nav class="drawer-main">
            <ul class="nav nav-drawer">
                
                <?php 
                    if(is_array($arr_data["list_menu_root_login"]))
                    {
                        ?>
                        <li class="nav-item nav-drawer-header" style="display: none;">Welcome</li>
                        <?php
                        foreach($arr_data["list_menu_root_login"] as $menu_root=>$val)
                        {
                            $menu_name_root = $arr_data["menu_name"][$menu_root];
                            $menu_url_root  = $arr_data["menu_url"][$menu_root];
                            
                            if($menu_url_root=="")
                            {
                                $menu_url_root = "javascript:void(0)";
                            }
                            else
                            {
                                $menu_url_root = "CallAjax('open_menu', '".$menu_root."')";
                            }
                            
                            ?>
                            <li class="nav-item nav-item-has-subnav">
                                <a href="javascript:void(0)" onclick="<?php echo $menu_url_root; ?>"><i class="ion-ios-monitor-outline"></i> <?php echo $menu_name_root; ?></a>
                                <ul class="nav nav-subnav">
                                    <?php 
                                        if(is_array($arr_data["list_menu_login"][$menu_root]))
                                        {
                                            foreach($arr_data["list_menu_login"][$menu_root] as $menu_id=>$val)
                                            {
                                                $menu_name = $arr_data["menu_name"][$menu_id];
                                                $menu_url  = $arr_data["menu_url"][$menu_id];
                                    ?>                              
                                    <li class="active">
                                        <a href="javascript:void(0)" onclick="CallAjax('open_menu', '<?php echo $menu_id; ; ?>')" title="<?php echo $menu_name; ?>"><?php echo $menu_name ?></a>
                                    </li>
                                    <?php 
                                            }
                                        }
                                    ?>
                                    
                                </ul>
                            </li>
                            <?php     
                            
                        }    
                    }
                ?>
                
                <li class="nav-item nav-drawer-header">MENU PORTAL</li>
                <?php 
                    if(is_array($arr_data["list_menu_root"]))
                    {
                        foreach($arr_data["list_menu_root"] as $menu_root=>$val)
                        {
                            $menu_name_root = $arr_data["menu_name"][$menu_root];
                            $menu_url_root  = $arr_data["menu_url"][$menu_root];
                            
                            if($menu_url_root=="")
                            {
                                $menu_url_root = "javascript:void(0)";
                            }
                            else
                            {
                                $menu_url_root = "CallAjax('open_menu', '".$menu_root."')";
                            }
                ?>
                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)" onclick="<?php echo $menu_url_root; ?>"><i class="ion-ios-monitor-outline"></i> <?php echo $menu_name_root; ?></a>
                    <ul class="nav nav-subnav">
                        <?php 
                            if(is_array($arr_data["list_menu"][$menu_root]))
                            {
                                foreach($arr_data["list_menu"][$menu_root] as $menu_id=>$val)
                                {
                                    $menu_name = $arr_data["menu_name"][$menu_id];
                                    $menu_url  = $arr_data["menu_url"][$menu_id];
                        ?>                              
                        <li class="active">
                            <a href="javascript:void(0)" onclick="CallAjax('open_menu', '<?php echo $menu_id; ; ?>')" title="<?php echo $menu_name; ?>"><?php echo $menu_name ?></a>
                        </li>
                        <?php 
                                }
                            }
                        ?>
                        
                    </ul>
                </li>
                <?php 
                        }
                    }
                ?>
                
            </ul>
        </nav>
        <!-- End drawer navigation -->
       
    </div>
    <!-- End drawer scroll area -->
</aside>
<!-- End drawer --> 