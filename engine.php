<?php 
    include("page_header.php");
    
    if(!isset($_REQUEST["ajax_type"])){ $ajax_type = isset($_REQUEST["ajax_type"]); } else { $ajax_type = $_REQUEST["ajax_type"]; }
    if(!isset($_POST["iframe_action"])){ $iframe_action = isset($_POST["iframe_action"]); } else { $iframe_action = $_POST["iframe_action"]; }
    
    if($ajax_type!="")
    {
        if($ajax_type=="open_menu")
        {
            if(!isset($_GET["v_menu_id"])){ $v_menu_id = isset($_GET["v_menu_id"]); } else { $v_menu_id = $_GET["v_menu_id"]; }
            
            $sql = "
                    SELECT 
                        menu_id,
                        menu_name,
                        menu_group,
                        menu_root,
                        menu_url,
                        sort_by, 
                        first_cursor 
                    FROM
                        menu_tbl
                    WHERE
                        1=1
                        AND menu_id = '".$v_menu_id."'
                    ORDER BY
                        sort_by ASC
            "; 
            $arr_data["menu_tbl"] = SQL_SELECT($sql, $db["dbms"]);
            
            $sql = "
                SELECT
                  *
                FROM
                  task_user_tbl
                WHERE
                  1=1
                  AND ip_user = '".get_client_ip()."'
                  AND menu_id = '".$v_menu_id."'
                ORDER BY
                    task_user_tbl.task_id ASC
            ";
            $arr_data["check_task_user_tbl"] = SQL_SELECT($sql, $db["dbms"]);
            
            if($arr_data["menu_tbl"][0]["menu_name"]=="Lock")
            {
                echo "";
                echo "@#@";    
                echo "";
                echo "@#@";
                echo $arr_data["menu_tbl"][0]["menu_name"];
                echo "@#@";
                include($arr_data["menu_tbl"][0]["menu_url"]);
                echo "@#@"; 
                echo "RELOAD_NEW_PAGE";
                echo "@#@";
                echo $arr_data["menu_tbl"][0]["first_cursor"];
            }
            else
            {
                if(is_array($arr_data["check_task_user_tbl"]))
                {
                    $sql = "
                        SELECT
                          menu_tbl.menu_id,
                          menu_tbl.menu_name
                        FROM
                          task_user_tbl
                          INNER JOIN menu_tbl ON 
                            menu_tbl.menu_id = task_user_tbl.menu_id
                        WHERE
                          1=1
                          AND ip_user = '".get_client_ip()."'
                        ORDER BY
                            task_user_tbl.task_id ASC
                    ";
                    $arr_data["task_user_tbl"] = SQL_SELECT($sql, $db["dbms"]);
                    
                    echo $arr_data["check_task_user_tbl"][0]["task_id"];
                    echo "@#@";
                    ?>
                    <a href="javascript:void(0)" data-toggle="dropdown"><i class="ion-ios-browsers"></i> <span class="badge"><?php echo count($arr_data["task_user_tbl"]); ?></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header">Recent Task</li>
                        <?php 
                            if(is_array($arr_data["task_user_tbl"]))
                            {
                                foreach($arr_data["task_user_tbl"] as $key=>$val)
                                {
                                    $menu_id    = $arr_data["task_user_tbl"][$key]["menu_id"];
                                    $menu_name  = $arr_data["task_user_tbl"][$key]["menu_name"];
                        ?>
                        <li>
                            <a tabindex="-1" href="javascript:void(0)" onclick="CallAjax('open_menu', '<?php echo $menu_id; ?>')"> <?php echo $menu_name; ?> </a>
                        </li>
                        <?php 
                                }
                            }
                        ?>
                        
                        <li class="divider"></li>
                        <li>
                            <a tabindex="-1" href="<?php echo $base_url; ?>">Close All</a>
                        </li>
                    </ul> 
                    <?php
                    echo "@#@";
                    echo $arr_data["menu_tbl"][0]["menu_name"];
                    echo "@#@";
                    echo "";    
                    echo "@#@";
                    echo "RELOAD_OLD_PAGE";
                    echo "@#@";
                    echo $arr_data["menu_tbl"][0]["first_cursor"];
                }
                else
                {
                    $sql = "
                        SELECT
                          COUNT(cid) AS last_task_id
                        FROM
                          task_user_tbl
                        WHERE
                          1=1
                          AND ip_user = '".get_client_ip()."'
                        ORDER BY
                            task_user_tbl.task_id ASC
                    ";
                    $arr_data["last_task_id"] = SQL_SELECT($sql, $db["dbms"]);
                    
                    $new_task_id = ($arr_data["last_task_id"][0]["last_task_id"]*1)+1;
                    
                    $sql = "
                            INSERT INTO
                              task_user_tbl
                            SET
                              menu_id = '".$v_menu_id."',
                              task_id = '".$new_task_id."',
                              ip_user = '".get_client_ip()."'
                    ";
                    $execute = SQL_EXECUTE($sql, $db["dbms"]);
                    
                    $sql = "
                        SELECT
                          menu_tbl.menu_id,
                          menu_tbl.menu_name,
                          menu_tbl.menu_url
                        FROM
                          task_user_tbl
                          INNER JOIN menu_tbl ON 
                            menu_tbl.menu_id = task_user_tbl.menu_id
                        WHERE
                          1=1
                          AND ip_user = '".get_client_ip()."'
                        ORDER BY
                            task_user_tbl.task_id ASC
                    ";
                    $arr_data["task_user_tbl"] = SQL_SELECT($sql, $db["dbms"]);
                    
                    echo $new_task_id;
                    echo "@#@";
                    ?>
                    <a href="javascript:void(0)" data-toggle="dropdown"><i class="ion-ios-browsers"></i> <span class="badge"><?php echo count($arr_data["task_user_tbl"]); ?></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header">Recent Task</li>
                        <?php 
                            if(is_array($arr_data["task_user_tbl"]))
                            {
                                foreach($arr_data["task_user_tbl"] as $key=>$val)
                                {
                                    $menu_id    = $arr_data["task_user_tbl"][$key]["menu_id"];
                                    $menu_name  = $arr_data["task_user_tbl"][$key]["menu_name"];
                        ?>
                        <li>
                            <a tabindex="-1" href="javascript:void(0)" onclick="CallAjax('open_menu', '<?php echo $menu_id; ?>')"> <?php echo $menu_name; ?> </a>
                        </li>
                        <?php 
                                }
                            }
                        ?>
                        
                        <li class="divider"></li>
                        <li>
                            <a tabindex="-1" href="<?php echo $base_url; ?>">Close All</a>
                        </li>
                    </ul> 
                    <?php
                    echo "@#@";
                    echo $arr_data["menu_tbl"][0]["menu_name"];
                    echo "@#@";
                    include($arr_data["menu_tbl"][0]["menu_url"]);
                    echo "@#@";
                    echo "RELOAD_NEW_PAGE";
                    echo "@#@";
                    echo $arr_data["menu_tbl"][0]["first_cursor"];
                }
            }
        }
        
        else if($ajax_type=="search_ajax")
        {
            $v_modul = $_GET["v_modul"];
            $q = save_char($_GET["q"]);
            
            if($v_modul=="menu")
            {
                $arr_keyword[0] = "menu_tbl.menu_id";
                $arr_keyword[1] = "menu_tbl.menu_name";
                $arr_keyword[2] = "menu_tbl.menu_group";
                $arr_keyword[3] = "menu_tbl.menu_url";

                $where = search_keyword($q, $arr_keyword);  
                
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
                    
                    $arr_data["list_data_root_temp"][$menu_id] = $menu_id;
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
                                ".$where."
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
                    
                    $arr_data["list_data_root_temp"][$menu_id] = $menu_id;
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
                                ".$where."
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
                
                
                if(is_array($arr_data["list_data"]))
                {
                    foreach($arr_data["list_data"] as $menu_root=>$val)
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
                                    AND menu_root = '0'
                                    AND menu_id = '".$menu_root."'
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
                        }
                        
                    }
                }
                
                $_SESSION["list_file"]["menu"] = "tbody";
                include("admin_menu_list.php");
            }
            else if($v_modul=="role_access")
            {
                $arr_keyword[0] = "role_access_tbl.role_access_name";
                $arr_keyword[1] = "role_access_tbl.POSITION_ID";
                $arr_keyword[2] = "role_access_tbl.EMPLOYEE_ID";
                $arr_keyword[3] = "role_access_tbl.NOTE";

                $where = search_keyword($q, $arr_keyword); 
                $p = 1; 
                
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
                            ".$where."
                        ORDER BY 
                           role_access_name ASC 
                "; 
                $arr_data["role_access_tbl_all"] = SQL_SELECT($sql, $db["dbms"]);
                $arr_data["jml_data"][$v_modul] = count($arr_data["role_access_tbl_all"]); 
                $start_limit = (($v_page-1)*$max_page);
                
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
                            ".$where." 
                        ORDER BY
                            role_access_name ASC
                        LIMIT
                            0, ".$max_page."
                ";
                $arr_data["role_access_tbl"] = SQL_SELECT($sql, $db["dbms"]);
                
                include("paging.php");
                
                echo "@#@";
                
                $_SESSION["list_file"][$v_modul] = "tbody";
                include("admin_".$v_modul."_list.php");
            }
        }
        
        else if($ajax_type=="add_ajax" || $ajax_type=="edit_ajax")
        {
            $v_modul = $_GET["v_modul"];
            $v_cid = save_char($_GET["v_cid"]);   
            
            if($v_modul=="menu")
            {
                if($ajax_type=="edit_ajax")
                {
                    $title_menu = "Edit Menu";
                }
                else if($ajax_type=="add_ajax")
                {
                    $title_menu = "Add Menu";
                }
                
                $sql = "
                        SELECT
                            *
                        FROM
                            menu_tbl
                        WHERE
                            1=1
                            AND menu_id = '".$v_cid."'
                        LIMIT
                            0,1
                ";
                $arr_data["menu_tbl"] = SQL_SELECT($sql, $db["dbms"]);
                
                $sql = "
                        SELECT
                            menu_id,
                            menu_name
                        FROM
                            menu_tbl
                        WHERE
                            1=1
                            AND menu_root = '0'
                            AND menu_group != 'MENU PROFILE'
                        ORDER BY
                            menu_id ASC
                ";
                $arr_data["list_menu_root"] = SQL_SELECT($sql, $db["dbms"]);
                
                
                
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $title_menu; ?></h4>
                            </div>
                            <div class="card-block">
                                <form class="form-horizontal m-t-sm" method="post" target="my_iframe_<?php echo $v_modul; ?>" name="theform_<?php echo $v_modul; ?>" id="theform_<?php echo $v_modul; ?>" enctype="multipart/form-data" action="<?php echo $base_url; ?>/engine.php" onsubmit="return validasi_<?php echo $v_modul; ?>('<?php echo $v_modul; ?>')">
                                <input type="hidden" name="iframe_action" value="<?php echo $ajax_type; ?>">
                                <input type="hidden" name="v_modul" value="<?php echo $v_modul; ?>">
                                <input type="hidden" name="v_<?php echo $v_modul; ?>_cid" value="<?php echo $v_cid; ?>">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="v_<?php echo $v_modul; ?>_menu_name" name="v_<?php echo $v_modul; ?>_menu_name" value="<?php echo $arr_data["menu_tbl"][0]["menu_name"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_menu_name">Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="v_<?php echo $v_modul; ?>_menu_group" name="v_<?php echo $v_modul; ?>_menu_group" value="<?php echo $arr_data["menu_tbl"][0]["menu_group"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_menu_group">Group</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                 <select class="form-control" id="v_<?php echo $v_modul; ?>_menu_root" name="v_<?php echo $v_modul; ?>_menu_root" size="1">
                                                    <option <?php if($arr_data["menu_tbl"][0]["menu_root"]==0){ echo "selected='selected'"; } ?> value="0">ROOT</option>
                                                    <?php 
                                                        if(is_array($arr_data["list_menu_root"]))
                                                        {
                                                            foreach($arr_data["list_menu_root"] as $key=>$val)
                                                            {
                                                                ?>
                                                                <option <?php if($arr_data["menu_tbl"][0]["menu_root"]==$arr_data["list_menu_root"][$key]["menu_id"]){ echo "selected='selected'"; } ?> value="<?php echo $arr_data["list_menu_root"][$key]["menu_id"]; ?>"><?php echo $arr_data["list_menu_root"][$key]["menu_name"]; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?> 
                                                </select>
                                                <label for="v_<?php echo $v_modul; ?>_menu_root">Root</label> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="v_<?php echo $v_modul; ?>_menu_url" name="v_<?php echo $v_modul; ?>_menu_url" value="<?php echo $arr_data["menu_tbl"][0]["menu_url"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_menu_url">URL</label>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="v_<?php echo $v_modul; ?>_first_cursor" name="v_<?php echo $v_modul; ?>_first_cursor" value="<?php echo $arr_data["menu_tbl"][0]["first_cursor"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_first_cursor">First Cursor</label>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="v_<?php echo $v_modul; ?>_sort_by" name="v_<?php echo $v_modul; ?>_sort_by" value="<?php echo $arr_data["menu_tbl"][0]["sort_by"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_sort_by">Sort By</label>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-9">
                                            <button class="btn btn-app" type="submit">Submit</button>
                                            <button class="btn btn-app" type="button" onclick="CallAjax('back_ajax', '<?php echo $v_modul; ?>')">Back</button>
                                        </div>
                                    </div> 
                                </form>
                                <iframe id="my_iframe_<?php echo $v_modul; ?>" name="my_iframe_<?php echo $v_modul; ?>" style="width: 100%; height: 0px; border: 0px;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                                 
                <?php    
            }
            
            else if($v_modul=="role_access")
            {
                if($ajax_type=="edit_ajax")
                {
                    $title_menu = "Edit Role Access";
                }
                else if($ajax_type=="add_ajax")
                {
                    $title_menu = "Add Role Access";
                }
                
                $sql = "
                        SELECT
                            *
                        FROM
                            role_access_tbl
                        WHERE
                            1=1
                            AND cid = '".$v_cid."'
                        LIMIT
                            0,1
                ";
                $arr_data["role_access_tbl"] = SQL_SELECT($sql, $db["dbms"]);
                
                
                
                
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $title_menu; ?></h4>
                            </div>
                            <div class="card-block">
                                <form class="form-horizontal m-t-sm" method="post" target="my_iframe_<?php echo $v_modul; ?>" name="theform_<?php echo $v_modul; ?>" id="theform_<?php echo $v_modul; ?>" enctype="multipart/form-data" action="<?php echo $base_url; ?>/engine.php" onsubmit="return validasi_<?php echo $v_modul; ?>('<?php echo $v_modul; ?>')">
                                <input type="hidden" name="iframe_action" value="<?php echo $ajax_type; ?>">
                                <input type="hidden" name="v_modul" value="<?php echo $v_modul; ?>">
                                <input type="hidden" name="v_<?php echo $v_modul; ?>_cid" value="<?php echo $v_cid; ?>">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="v_<?php echo $v_modul; ?>_role_access_name" name="v_<?php echo $v_modul; ?>_role_access_name" value="<?php echo $arr_data["role_access_tbl"][0]["role_access_name"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_role_access_name">Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" readonly="readonly" type="text" id="v_<?php echo $v_modul; ?>_POSITION_ID" name="v_<?php echo $v_modul; ?>_POSITION_ID" value="<?php echo $arr_data["role_access_tbl"][0]["POSITION_ID"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_POSITION_ID">Position</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" readonly="readonly" type="text" id="v_<?php echo $v_modul; ?>_EMPLOYEE_ID" name="v_<?php echo $v_modul; ?>_EMPLOYEE_ID" value="<?php echo $arr_data["role_access_tbl"][0]["EMPLOYEE_ID"]; ?>" onclick="CallAjax('modal_ajax', '<?php echo $v_modul; ?>', 'EMPLOYEE_ID', 'modal-lg')" />
                                                <label for="v_<?php echo $v_modul; ?>_EMPLOYEE_ID">Employee</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="v_<?php echo $v_modul; ?>_NOTE" name="v_<?php echo $v_modul; ?>_NOTE" value="<?php echo $arr_data["role_access_tbl"][0]["NOTE"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_NOTE">Note</label>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="v_<?php echo $v_modul; ?>_first_cursor" name="v_<?php echo $v_modul; ?>_first_cursor" value="<?php echo $arr_data["menu_tbl"][0]["first_cursor"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_first_cursor">Status</label>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                   
                                    
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-9">
                                            <button class="btn btn-app" type="submit">Submit</button>
                                            <button class="btn btn-app" type="button" onclick="CallAjax('back_ajax', '<?php echo $v_modul; ?>')">Back</button>
                                        </div>
                                    </div> 
                                </form>
                                <iframe id="my_iframe_<?php echo $v_modul; ?>" name="my_iframe_<?php echo $v_modul; ?>" style="width: 100%; height: 0px; border: 0px;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                                 
                <?php    
            }
            
            else if($v_modul=="user")
            {
                if($ajax_type=="edit_ajax")
                {
                    $title_menu = "Edit User";
                }
                else if($ajax_type=="add_ajax")
                {
                    $title_menu = "Add User";
                }
                
                $sql = "
                        SELECT
                            *
                        FROM
                            tab_user
                        WHERE
                            1=1
                            AND usrID = '".$v_cid."'
                        LIMIT
                            0,1
                ";
                $arr_data["tab_user"] = SQL_SELECT($sql, $db["dbms"]);
                
                
                
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $title_menu; ?></h4>
                            </div>
                            <div class="card-block">
                                <form class="form-horizontal m-t-sm" method="post" target="my_iframe_<?php echo $v_modul; ?>" name="theform_<?php echo $v_modul; ?>" id="theform_<?php echo $v_modul; ?>" enctype="multipart/form-data" action="<?php echo $base_url; ?>/engine.php" onsubmit="return validasi_<?php echo $v_modul; ?>('<?php echo $v_modul; ?>')">
                                <input type="hidden" name="iframe_action" value="<?php echo $ajax_type; ?>">
                                <input type="hidden" name="v_modul" value="<?php echo $v_modul; ?>">
                                <input type="hidden" name="v_<?php echo $v_modul; ?>_cid" value="<?php echo $v_cid; ?>">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="v_<?php echo $v_modul; ?>_menu_name" name="v_<?php echo $v_modul; ?>_menu_name" value="<?php echo $arr_data["menu_tbl"][0]["menu_name"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_menu_name">Employee ID</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="v_<?php echo $v_modul; ?>_menu_group" name="v_<?php echo $v_modul; ?>_menu_group" value="<?php echo $arr_data["menu_tbl"][0]["menu_group"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_menu_group">FullName</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-9">
                                            <button class="btn btn-app" type="submit">Submit</button>
                                            <button class="btn btn-app" type="button" onclick="CallAjax('back_ajax', '<?php echo $v_modul; ?>')">Back</button>
                                        </div>
                                    </div> 
                                </form>
                                <iframe id="my_iframe_<?php echo $v_modul; ?>" name="my_iframe_<?php echo $v_modul; ?>" style="width: 100%; height: 0px; border: 0px;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                                 
                <?php    
            }
            ?>
                 
            <?php
        }
        
        else if($ajax_type=="delete_ajax")
        {
            $v_modul = $_GET["v_modul"];
            $v_cid = save_char($_GET["v_cid"]);   
            
            if($v_modul=="menu")
            {   
                $sql = "
                        SELECT
                            *
                        FROM
                            menu_tbl
                        WHERE
                            1=1
                            AND menu_id = '".$v_cid."'
                        LIMIT
                            0,1
                ";
                $arr_data["menu_tbl"] = SQL_SELECT($sql, $db["dbms"]);
                
                $sql = "
                        SELECT
                            menu_id,
                            menu_name
                        FROM
                            menu_tbl
                        WHERE
                            1=1
                            AND menu_root = '0'
                            AND menu_id = '".$arr_data["menu_tbl"][0]["menu_root"]."'
                        ORDER BY
                            menu_id ASC
                ";
                $arr_data["list_menu_root"] = SQL_SELECT($sql, $db["dbms"], "menu_id");
                
                $menu_root = $arr_data["menu_tbl"][0]["menu_root"];
                
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Remove Menu</h4>
                            </div>
                            <div class="card-block">
                                <form class="form-horizontal m-t-sm" method="post" target="my_iframe_<?php echo $v_modul; ?>" name="theform_<?php echo $v_modul; ?>" id="theform_<?php echo $v_modul; ?>" enctype="multipart/form-data" action="<?php echo $base_url; ?>/engine.php" onsubmit="return validasi_<?php echo $v_modul; ?>('<?php echo $v_modul; ?>')">
                                <input type="hidden" name="iframe_action" value="<?php echo $ajax_type; ?>">
                                <input type="hidden" name="v_modul" value="<?php echo $v_modul; ?>">
                                <input type="hidden" name="v_<?php echo $v_modul; ?>_cid" value="<?php echo $v_cid; ?>">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" disabled="disabled" type="text" id="v_<?php echo $v_modul; ?>_menu_name" name="v_<?php echo $v_modul; ?>_menu_name" value="<?php echo $arr_data["menu_tbl"][0]["menu_name"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_menu_name">Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" disabled="disabled" type="text" id="v_<?php echo $v_modul; ?>_menu_group" name="v_<?php echo $v_modul; ?>_menu_group" value="<?php echo $arr_data["menu_tbl"][0]["menu_group"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_menu_group">Group</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                 <input class="form-control" disabled="disabled" type="text" id="v_<?php echo $v_modul; ?>_menu_root" name="v_<?php echo $v_modul; ?>_menu_root" value="<?php echo $arr_data["list_menu_root"][$menu_root]["menu_name"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_menu_root">Root</label> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" disabled="disabled" type="text" id="v_<?php echo $v_modul; ?>_menu_url" name="v_<?php echo $v_modul; ?>_menu_url" value="<?php echo $arr_data["menu_tbl"][0]["menu_url"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_menu_url">URL</label>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" disabled="disabled" type="text" id="v_<?php echo $v_modul; ?>_first_cursor" name="v_<?php echo $v_modul; ?>_first_cursor" value="<?php echo $arr_data["menu_tbl"][0]["first_cursor"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_first_cursor">First Cursor</label>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="form-material">
                                                <input class="form-control" disabled="disabled" type="text" id="v_<?php echo $v_modul; ?>_sort_by" name="v_<?php echo $v_modul; ?>_sort_by" value="<?php echo $arr_data["menu_tbl"][0]["sort_by"]; ?>" />
                                                <label for="v_<?php echo $v_modul; ?>_sort_by">Sort By</label>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-9">
                                            <button class="btn btn-danger" type="submit">Remove</button>
                                            <button class="btn btn-app" type="button" onclick="CallAjax('back_ajax', '<?php echo $v_modul; ?>')">Back</button>
                                        </div>
                                    </div> 
                                </form>
                                <iframe id="my_iframe_<?php echo $v_modul; ?>" name="my_iframe_<?php echo $v_modul; ?>" style="width: 100%; height: 0px; border: 0px;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                                 
                <?php    
            }
            ?>
                 
            <?php
        }
        
        else if($ajax_type=="back_ajax")
        {
            $v_modul = $_GET["v_modul"];
            
            if($v_modul=="menu")
            {
                $modul = "menu";
    
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
                
                $_SESSION["list_file"]["menu"] = "all";
                include("admin_menu_list.php");
            }
            ?>
                 
            <?php
        }
        
        else if($ajax_type=="page_ajax")
        {
            $v_modul = $_GET["v_modul"];
            $v_page  = $_GET["v_page"];
            
            $p = $_GET["v_page"];
            $q = save_char($_GET["q"]);
            
            if($v_modul=="role_access")
            {
                $arr_keyword[0] = "role_access_tbl.role_access_name";
                $arr_keyword[1] = "role_access_tbl.POSITION_ID";
                $arr_keyword[2] = "role_access_tbl.EMPLOYEE_ID";
                $arr_keyword[3] = "role_access_tbl.NOTE";

                $where = search_keyword($q, $arr_keyword);  
                
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
                            ".$where."
                        ORDER BY 
                           role_access_name ASC 
                "; 
                $arr_data["role_access_tbl_all"] = SQL_SELECT($sql, $db["dbms"]);
                $arr_data["jml_data"][$v_modul] = count($arr_data["role_access_tbl_all"]); 
                $start_limit = (($v_page-1)*$max_page);
                
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
                            ".$where." 
                        ORDER BY
                            role_access_name ASC
                        LIMIT
                            ".$start_limit.", ".$max_page." 
                ";
                $arr_data["role_access_tbl"] = SQL_SELECT($sql, $db["dbms"]);
                
                include("paging.php");
                
                echo "@#@";
                
                $_SESSION["list_file"][$v_modul] = "tbody";
                include("admin_".$v_modul."_list.php");
            }
        }
        
        else if($ajax_type=="modal_ajax")
        {
            $v_modul    = $_GET["v_modul"];
            $v_target   = $_GET["v_target"];   
            
            if($v_modul=="role_access" && $v_target=="EMPLOYEE_ID")
            {
                echo "title";
                echo "@#@";
                echo "content";
            }
        }
        
       
        exit();
    }
    
    if($iframe_action)
    {
        if($iframe_action=="login")
        {
            if(!isset($_POST["btn_login"])){ $btn_login = isset($_POST["btn_login"]); } else { $btn_login = $_POST["btn_login"]; }    

            if($btn_login || true)
            {
                if(!isset($_POST["v_username"])){ $v_username = isset($_POST["v_username"]); } else { $v_username = $_POST["v_username"]; }    
                if(!isset($_POST["v_password"])){ $v_password = isset($_POST["v_password"]); } else { $v_password = $_POST["v_password"]; }    
                
                $v_username = save_char($v_username);
                
                $sql = "
                        SELECT
                          usrID,
                          fullName
                        FROM
                          tab_user
                        WHERE
                          1=1
                          AND usrID = '".$v_username."'
                        LIMIT
                            0,1
                ";
                $arr_data["check_user"] = SQL_SELECT($sql, $db["dbms"]);
                
                $sql = "
                        SELECT
                          usrID,
                          fullName
                        FROM
                          tab_user
                        WHERE
                          1=1
                          AND usrID = '".$v_username."'
                          AND password = '".md5($v_password)."' 
                        LIMIT
                            0,1
                ";
                $arr_data["tab_user"] = SQL_SELECT($sql, $db["dbms"]); 
                
                if($v_username=="")
                {
                    $msg = "NIK harus diisi";
                    ?>
                    <script>
                        parent.document.getElementById("div_message").style.display = '';
                        parent.document.getElementById("content_message").innerHTML = '<?php echo $msg; ?>';
                        parent.document.getElementById("v_username").focus();
                    </script>
                    <?php
                    die();
                }
                else if($v_password=="")
                {
                    $msg = "Password harus diisi";
                    ?>
                    <script>
                        parent.document.getElementById("div_message").style.display = '';
                        parent.document.getElementById("content_message").innerHTML = '<?php echo $msg; ?>';
                        parent.document.getElementById("v_password").focus();
                    </script>
                    <?php
                    die();
                }
                else if(!is_array($arr_data["check_user"]))
                {
                    $msg = "User ".$v_username." tidak ditemukan";
                    ?>
                    <script>
                        parent.document.getElementById("div_message").style.display = '';
                        parent.document.getElementById("content_message").innerHTML = '<?php echo $msg; ?>';
                        parent.document.getElementById("v_username").focus();
                    </script>
                    <?php
                    die();
                }
                else if(!is_array($arr_data["tab_user"]))
                {
                    $msg = "Password tidak sesuai untuk User ".$v_username;
                    ?>
                    <script>
                        parent.document.getElementById("div_message").style.display = '';
                        parent.document.getElementById("content_message").innerHTML = '<?php echo $msg; ?>';
                        parent.document.getElementById("v_password").focus();
                    </script>
                    <?php
                    die();
                }
                else
                {
                    $_SESSION["ses_user"]       = $arr_data["tab_user"][0]["usrID"];
                    $_SESSION["ses_fullName"]   = $arr_data["tab_user"][0]["fullName"];
                    $_SESSION["ses_lock"]       = 0;

                    ?>
                        <script>
                            parent.get_url('<?php echo $base_url; ?>');
                        </script>
                    <?php
                } 
            }
        } 
        else if($iframe_action=="change_password")
        {
            if(!isset($_POST["v_".$iframe_action."_password_old"])){ $v_password_old = isset($_POST["v_".$iframe_action."_password_old"]); } else { $v_password_old = $_POST["v_".$iframe_action."_password_old"]; }    
            if(!isset($_POST["v_".$iframe_action."_password_new"])){ $v_password_new = isset($_POST["v_".$iframe_action."_password_new"]); } else { $v_password_new = $_POST["v_".$iframe_action."_password_new"]; }    
            if(!isset($_POST["v_".$iframe_action."_cpass"])){ $v_password_cnew = isset($_POST["v_".$iframe_action."_cpass"]); } else { $v_password_cnew = $_POST["v_".$iframe_action."_cpass"]; }    
                    
            $sql = "SELECT usrID FROM tab_user WHERE usrID = '".$_SESSION["ses_user"]."' AND password = '".md5($v_password_old)."' ";
            $arr_data["check_tab_user"] = SQL_SELECT($sql, $db["dbms"]);
            
            if(is_array($arr_data["check_tab_user"]))
            {
                $sql = "
                        UPDATE 
                            tab_user 
                        SET
                            password = '".md5($v_password_new)."'
                        WHERE
                            1=1
                            AND usrID = '".$_SESSION["ses_user"]."' 
                ";
                if(mysql_query($sql))
                {   
                    ?>
                        <script>
                            alert("Berhasil mengganti password...");    
                            parent.document.getElementById('v_<?php echo $iframe_action; ?>_password_old').value = '';
                            parent.document.getElementById('v_<?php echo $iframe_action; ?>_password_new').value = '';
                            parent.document.getElementById('v_<?php echo $iframe_action; ?>_cpass').value = '';
                            parent.document.getElementById('v_<?php echo $iframe_action; ?>_password_old').focus();
                        </script>
                    <?php
                    die();              
                }
            }
            else
            {
                ?>
                    <script>
                        alert("Password Lama tidak sesuai...");    
                        parent.document.getElementById('v_<?php echo $iframe_action; ?>_password_old').focus();
                    </script>
                <?php
                die();     
            } 
            
            
        }  
        else if($iframe_action=="lock")
        {
            if(!isset($_POST["v_".$iframe_action."_password"])){ $v_password = isset($_POST["v_".$iframe_action."_password"]); } else { $v_password = $_POST["v_".$iframe_action."_password"]; }        
            
            $sql = "SELECT usrID FROM tab_user WHERE usrID = '".$_SESSION["ses_user"]."' AND password = '".md5($v_password)."' ";
            $arr_data["check_tab_user"] = SQL_SELECT($sql, $db["dbms"]);
            
            if(is_array($arr_data["check_tab_user"]))
            {
                ?>
                    <script>
                        //alert("0");
                        parent.document.getElementById("div_recent_task").style.display = '';
                        //alert("1");
                        parent.document.getElementById("div_content_1").style.display   = '';
                        //alert("2");
                        
                        parent.document.getElementById("div_content_lock").style.display = 'none';
                        //alert("3");
                        //parent.document.getElementById("div_content_lock").innerHTML     = '';
                        
                        //alert("a");
                        parent.open_menu_profile();
                        //alert("b");
                    </script>
                <?php
                die();                              
            }
            else
            {
                ?>
                    <script>
                        alert("Password tidak sesuai...");    
                        parent.document.getElementById('v_<?php echo $iframe_action; ?>_password').focus();
                    </script>
                <?php
                die();     
            }  
            
            
        } 
        else if($iframe_action=="forgot")
        {
            if(!isset($_POST["v_username"])){ $v_username = isset($_POST["v_username"]); } else { $v_username = $_POST["v_username"]; }    
            if(!isset($_POST["v_birthday"])){ $v_birthday = isset($_POST["v_birthday"]); } else { $v_birthday = $_POST["v_birthday"]; }    
            
            $v_username = save_char($v_username);
            $v_birthday = save_char($v_birthday);
            
            $sql = "
                    SELECT
                      usrID
                    FROM
                      tab_user
                    WHERE
                      1=1
                      AND usrID = '".$v_username."'
                    LIMIT
                        0,1
            ";
            $arr_data["check_user"] = SQL_SELECT($sql, $db["dbms"]);
            
            $sql = "
                    SELECT
                      usrID,
                      email
                    FROM
                      tab_user
                    WHERE
                      1=1
                      AND usrID = '".$v_username."'
                      AND DAY(birthday) = '".substr($v_birthday,0,2)."' 
                      AND MONTH(birthday) = '".substr($v_birthday,2,2)."' 
                      AND YEAR(birthday) = '".substr($v_birthday,4,4)."' 
                    LIMIT
                        0,1
            ";
            $arr_data["tab_user"] = SQL_SELECT($sql, $db["dbms"]); 
            
            if($v_username=="")
            {
                $msg = "NIK harus diisi";
                ?>
                <script>
                    parent.document.getElementById("div_message_success").style.display = 'none';
                    parent.document.getElementById("content_message_success").innerHTML = '';
                    
                    parent.document.getElementById("div_message_error").style.display = '';
                    parent.document.getElementById("content_message_error").innerHTML = '<?php echo $msg; ?>';
                    parent.document.getElementById("v_username").focus();
                </script>
                <?php
                die();
            }
            else if($v_birthday=="")
            {
                $msg = "Tanggal Lahir harus diisi";
                ?>
                <script>
                    parent.document.getElementById("div_message_success").style.display = 'none';
                    parent.document.getElementById("content_message_success").innerHTML = '';
                    
                    parent.document.getElementById("div_message_error").style.display = '';
                    parent.document.getElementById("content_message_error").innerHTML = '<?php echo $msg; ?>';
                    parent.document.getElementById("v_birthday").focus();
                </script>
                <?php
                die();
            }
            else if(!is_array($arr_data["check_user"]))
            {
                $msg = "NIK ".$v_username." tidak ditemukan";
                ?>
                <script>
                    parent.document.getElementById("div_message_success").style.display = 'none';
                    parent.document.getElementById("content_message_success").innerHTML = '';
                    
                    parent.document.getElementById("div_message_error").style.display = '';
                    parent.document.getElementById("content_message_error").innerHTML = '<?php echo $msg; ?>';
                    parent.document.getElementById("v_username").focus();
                </script>
                <?php
                die();
            }
            else if(!is_array($arr_data["tab_user"]))
            {
                $msg = "NIK dan Tanggal Lahir tidak sesuai";
                ?>
                <script>
                    parent.document.getElementById("div_message_success").style.display = 'none';
                    parent.document.getElementById("content_message_success").innerHTML = '';
                    
                    parent.document.getElementById("div_message_error").style.display = '';
                    parent.document.getElementById("content_message_error").innerHTML = '<?php echo $msg; ?>';
                    parent.document.getElementById("v_birthday").focus();
                </script>
                <?php
                die();
            }
            else
            {
                $cid        = get_counter_int($db["dbms"],"reset_tbl","cid",100);
                $reset_id   = md5($cid.date("d-m-Y-h-i-s")."reset");
                $VALID_TO   = date("Y-m-d", parsedate(date("Y-m-d"))+(86400*7));
                
                if($arr_data["tab_user"][0]["email"]=="")
                {
                    $sql = "
                            SELECT 
                                tab_nominatif.EMPLOYEE_ID,
                                tab_nominatif.email
                            FROM
                                tab_nominatif 
                            WHERE
                                1=1
                                AND EMPLOYEE_ID = 
                                (
                                    SELECT
                                        SUPERVISOR_ID
                                    FROM
                                        tab_nominatif
                                    WHERE
                                        1=1
                                        AND EMPLOYEE_ID = '".$arr_data["tab_user"][0]["usrID"]."'
                                )
                            LIMIT
                                0,1 
                    ";
                    $arr_data["tab_nominatif_atasan"] = SQL_SELECT($sql, $db["dbms"]);    
                    
                    $email = $arr_data["tab_nominatif_atasan"][0]["email"];
                }
                else
                {
                    $email = $arr_data["tab_user"][0]["email"];
                }
                
                if($email=="")
                {
                    $msg = "Tidak dapat Reset Password, karena NIK ".$arr_data["tab_user"][0]["usrID"]." tidak memiliki Email<br>Silahkan Hubungi hubungi Administrator";
                    ?>
                    <script>
                        parent.document.getElementById("div_message_success").style.display = 'none';
                        parent.document.getElementById("content_message_success").innerHTML = '';
                        
                        parent.document.getElementById("div_message_error").style.display = '';
                        parent.document.getElementById("content_message_error").innerHTML = '<?php echo $msg; ?>';
                    </script>
                    <?php
                    die();    
                }
                else
                {
                    $sql = "
                        INSERT INTO
                          reset_tbl
                        SET
                          cid = '".$cid."',
                          reset_id = '".$reset_id."',
                          reset_date = NOW(),
                          EMPLOYEE_ID = '".$arr_data["tab_user"][0]["usrID"]."',
                          email = '".$email."',
                          status_reset = 'Open',
                          VALID_FROM = NOW(),
                          VALID_TO = '".$VALID_TO."'
                    ";
                    $execute = SQL_EXECUTE($sql, $db["dbms"]);
                    
                    
                    $msg = "Berhasil, Silahkan Cek Email ".$email." untuk melakukan Reset Password<br>Link Reset akan Expired setelah H+7";
                    ?>
                    <script>
                        parent.document.getElementById("div_message_error").style.display = 'none';
                        parent.document.getElementById("content_message_error").innerHTML = '';
                        
                        parent.document.getElementById("div_message_success").style.display = '';
                        parent.document.getElementById("content_message_success").innerHTML = '<?php echo $msg; ?>';
                        
                        parent.document.getElementById("v_username").value = '';
                        parent.document.getElementById("v_birthday").value = '';
                    </script>
                    <?php
                    die();
                }
                
            } 
            
        } 
        
        else if($iframe_action=="add_ajax")
        {
            if(!isset($_POST["v_modul"])){ $v_modul = isset($_POST["v_modul"]); } else { $v_modul = $_POST["v_modul"]; }       
            
            if($v_modul=="menu")
            {
                if(!isset($_POST["v_".$v_modul."_menu_name"])){ $v_menu_name = isset($_POST["v_".$v_modul."_menu_name"]); } else { $v_menu_name = $_POST["v_".$v_modul."_menu_name"]; }       
                if(!isset($_POST["v_".$v_modul."_menu_group"])){ $v_menu_group = isset($_POST["v_".$v_modul."_menu_group"]); } else { $v_menu_group = $_POST["v_".$v_modul."_menu_group"]; }       
                if(!isset($_POST["v_".$v_modul."_menu_root"])){ $v_menu_root = isset($_POST["v_".$v_modul."_menu_root"]); } else { $v_menu_root = $_POST["v_".$v_modul."_menu_root"]; }       
                if(!isset($_POST["v_".$v_modul."_menu_url"])){ $v_menu_url = isset($_POST["v_".$v_modul."_menu_url"]); } else { $v_menu_url = $_POST["v_".$v_modul."_menu_url"]; }       
                if(!isset($_POST["v_".$v_modul."_first_cursor"])){ $v_first_cursor = isset($_POST["v_".$v_modul."_first_cursor"]); } else { $v_first_cursor = $_POST["v_".$v_modul."_first_cursor"]; }       
                if(!isset($_POST["v_".$v_modul."_sort_by"])){ $v_sort_by = isset($_POST["v_".$v_modul."_sort_by"]); } else { $v_sort_by = $_POST["v_".$v_modul."_sort_by"]; }       
                
                $v_menu_name = save_char($v_menu_name);
                $v_menu_group = save_char($v_menu_group);
                $v_menu_url = save_char($v_menu_url);
                $v_first_cursor = save_char($v_first_cursor);
                
                $menu_id = get_counter_int($db["dbms"],"menu_tbl","menu_id",100);
                
                $sql = "
                        INSERT INTO
                          menu_tbl
                        SET
                          menu_id = '".$menu_id."', 
                          menu_name = '".$v_menu_name."',
                          menu_group = '".$v_menu_group."',
                          menu_root = '".$v_menu_root."',
                          menu_url = '".$v_menu_url."',
                          content = '',
                          first_cursor = '".$v_first_cursor."',
                          sort_by = '".$v_sort_by."'
                ";
                $execute = SQL_EXECUTE($sql, $db["dbms"]);
                ?>
                    <script>
                        alert('Berhasil');
                        parent.CallAjax('back_ajax', '<?php echo $v_modul; ?>')
                    </script>
                <?php
            }    
        }
        
        else if($iframe_action=="edit_ajax")
        {
            if(!isset($_POST["v_modul"])){ $v_modul = isset($_POST["v_modul"]); } else { $v_modul = $_POST["v_modul"]; }       
            
            if($v_modul=="menu")
            {
                if(!isset($_POST["v_".$v_modul."_cid"])){ $v_cid = isset($_POST["v_".$v_modul."_cid"]); } else { $v_cid = $_POST["v_".$v_modul."_cid"]; }       
                if(!isset($_POST["v_".$v_modul."_menu_name"])){ $v_menu_name = isset($_POST["v_".$v_modul."_menu_name"]); } else { $v_menu_name = $_POST["v_".$v_modul."_menu_name"]; }       
                if(!isset($_POST["v_".$v_modul."_menu_group"])){ $v_menu_group = isset($_POST["v_".$v_modul."_menu_group"]); } else { $v_menu_group = $_POST["v_".$v_modul."_menu_group"]; }       
                if(!isset($_POST["v_".$v_modul."_menu_root"])){ $v_menu_root = isset($_POST["v_".$v_modul."_menu_root"]); } else { $v_menu_root = $_POST["v_".$v_modul."_menu_root"]; }       
                if(!isset($_POST["v_".$v_modul."_menu_url"])){ $v_menu_url = isset($_POST["v_".$v_modul."_menu_url"]); } else { $v_menu_url = $_POST["v_".$v_modul."_menu_url"]; }       
                if(!isset($_POST["v_".$v_modul."_first_cursor"])){ $v_first_cursor = isset($_POST["v_".$v_modul."_first_cursor"]); } else { $v_first_cursor = $_POST["v_".$v_modul."_first_cursor"]; }       
                if(!isset($_POST["v_".$v_modul."_sort_by"])){ $v_sort_by = isset($_POST["v_".$v_modul."_sort_by"]); } else { $v_sort_by = $_POST["v_".$v_modul."_sort_by"]; }       
                
                $v_menu_name = save_char($v_menu_name);
                $v_menu_group = save_char($v_menu_group);
                $v_menu_url = save_char($v_menu_url);
                $v_first_cursor = save_char($v_first_cursor);
                
                $sql = "
                        UPDATE
                          menu_tbl
                        SET
                          menu_name = '".$v_menu_name."',
                          menu_group = '".$v_menu_group."',
                          menu_root = '".$v_menu_root."',
                          menu_url = '".$v_menu_url."',
                          content = '',
                          first_cursor = '".$v_first_cursor."',
                          sort_by = '".$v_sort_by."'
                        WHERE menu_id = '".$v_cid."' 
                ";
                $execute = SQL_EXECUTE($sql, $db["dbms"]);
                ?>
                    <script>
                        alert('Berhasil');
                        parent.CallAjax('back_ajax', '<?php echo $v_modul; ?>')
                    </script>
                <?php
            }    
        }
        
        else if($iframe_action=="delete_ajax")
        {
            if(!isset($_POST["v_modul"])){ $v_modul = isset($_POST["v_modul"]); } else { $v_modul = $_POST["v_modul"]; }       
            
            if($v_modul=="menu")
            {
                if(!isset($_POST["v_".$v_modul."_cid"])){ $v_cid = isset($_POST["v_".$v_modul."_cid"]); } else { $v_cid = $_POST["v_".$v_modul."_cid"]; }       
                
                $sql = "DELETE FROM menu_tbl WHERE menu_id = '".$v_cid."' ";
                $execute = SQL_EXECUTE($sql, $db["dbms"]);
                ?>
                    <script>
                        alert('Berhasil');
                        parent.CallAjax('back_ajax', '<?php echo $v_modul; ?>')
                    </script>
                <?php
            }    
        }

    }
    
    SQL_CLOSE($db["dbms"]);
?>