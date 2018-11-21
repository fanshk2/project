<?php 
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
                AND menu_tbl.menu_group = 'MENU PROFILE'
            ORDER BY
                sort_by ASC
    "; 
    $arr_data["menu_profile_tbl"] = SQL_SELECT($sql, $db["dbms"]);
?>

<!-- Header -->
    <header class="app-layout-header">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    
                    <button class="pull-left hidden-lg hidden-md navbar-toggle" type="button" data-toggle="layout" data-action="sidebar_toggle">
                        <span class="sr-only">Toggle drawer</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    
                    
                    
                    <span class="navbar-page-title">    
                        <span id="span_menu"><img onclick="show_hide_menu()" class="visible-lg" src="<?php echo $base_url; ?>/assets/img/menu_icon.png" height="25" style="float: left; cursor: pointer;">&nbsp;&nbsp;</span>
                        <span id="loading_ajax"></span> <span id="div_content_title">HRIS</span>
                    </span>
                </div>
                <?php 
                    /*
                <div class="collapse navbar-collapse" id="header-navbar-collapse">
                    <!-- Header search form -->
                    <form class="navbar-form navbar-left app-search-form" role="search">
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control" type="search" id="search-input" placeholder="Search..." />
                                <span class="input-group-btn">
                                    <button class="btn" type="button"><i class="ion-ios-search-strong"></i></button>
                                </span>
                            </div>
                        </div>
                    </form>

                    
                    <ul id="main-menu" class="nav navbar-nav navbar-left">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown">English <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">French</a></li>
                                <li><a href="javascript:void(0)">German</a></li>
                                <li><a href="javascript:void(0)">Italian</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown">Pages <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">Analytics</a></li>
                                <li><a href="javascript:void(0)">Visits</a></li>
                                <li><a href="javascript:void(0)">Changelog</a></li>
                            </ul>
                        </li>
                    </ul>
                    */
                    ?>
                    <!-- .navbar-left -->

                    <ul class="nav navbar-nav navbar-right navbar-toolbar hidden-sm hidden-xs">
                        
                        <li class="dropdown" id="div_recent_task" style="display: none;">
                            <a href="javascript:void(0)" data-toggle="dropdown"><i class="ion-ios-browsers"></i> <span class="badge">2</span></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-header">Recent Task</li>
                                <li>
                                    <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">3</span> News </a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">1</span> Messages </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="<?php echo $base_url; ?>">Close All</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="dropdown" style="display: none;">
                            <a href="javascript:void(0)" data-toggle="dropdown"><i class="ion-ios-bell"></i> <span class="badge">3</span></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-header">Profile</li>
                                <li>
                                    <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">3</span> News </a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">1</span> Messages </a>
                                </li>
                                <li class="divider"></li>
                                <li class="dropdown-header">More</li>
                                <li>
                                    <a tabindex="-1" href="javascript:void(0)">Edit Profile..</a>
                                </li>
                            </ul>
                        </li>

                        <?php 
                            if($_SESSION["ses_user"])
                            {
                        ?>
                        
                        <li class="dropdown dropdown-profile">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <span class="m-r-sm"><?php echo $_SESSION["ses_fullName"]; ?> <span class="caret"></span></span>
                                
                                <?php 
                                    if(file_exists("assets/img/avatars/".$_SESSION["ses_user"].".jpg"))
                                    {
                                ?>
                                
                                <img class="img-avatar img-avatar-48" src="<?php echo $base_url; ?>/assets/img/avatars/<?php echo $_SESSION["ses_user"]; ?>.jpg" alt="<?php echo $_SESSION["ses_fullName"]; ?>" />
                                <?php        
                                    }
                                    else
                                    {
                                ?>
                                
                                <img class="img-avatar img-avatar-48" src="<?php echo $base_url; ?>/assets/img/avatars/avatar3.jpg" alt="<?php echo $_SESSION["ses_fullName"]; ?>" />
                                <?php 
                                    }
                                ?>
                                
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <?php 
                                    $no = 1;
                                    if(is_array($arr_data["menu_profile_tbl"]))
                                    {
                                        foreach($arr_data["menu_profile_tbl"] as $key=>$val)
                                        {
                                            $menu_id = $arr_data["menu_profile_tbl"][$key]["menu_id"];
                                            $menu_name = $arr_data["menu_profile_tbl"][$key]["menu_name"];
                                ?>
                                <li id="div_menu_profile_<?php echo $no; ?>"><a href="javascript:void()" onclick="CallAjax('open_menu', '<?php echo $menu_id; ?>')"><?php echo $menu_name; ?></a></li>
                                <?php 
                                            $no++;
                                        }
                                    }
                                ?>
                                <li><a href="javascript:void(0)" onclick="confirm_logout()">Logout</a></li>
                            </ul>
                        </li>
                        <?php 
                            }
                            else
                            {
                        ?>
                        <li class="dropdown dropdown-profile">
                            <a href="<?php echo $base_url; ?>/login">
                                <span class="m-r-sm">Login <span class="caret"></span></span>
                                <img class="img-avatar img-avatar-48" src="assets/img/login_icon.png" alt="Login" />
                            </a>
                            
                        </li>
                        <?php        
                            }
                        ?>
                        
                        
                    </ul>
                    <!-- .navbar-right -->
                </div>
            </div>
            <!-- .container-fluid -->
        </nav>
        <!-- .navbar-default -->
    </header>
    <!-- End header --> 