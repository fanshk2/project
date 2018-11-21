<?php 
    if($_SESSION["list_file"]["menu"]=="all")
    {
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" title="Add Menu" onclick="CallAjax('add_ajax', '<?php echo $v_modul; ?>')"><i class="fa fa-plus-circle"></i></button> Add Menu</h4>
            </div>
            
            <div class="card-block">
                
                
                <div class="form-group">
                    <div class="col-md-4">
                        <input class="form-control" type="text" id="q_<?php echo $v_modul; ?>" name="q_<?php echo $v_modul; ?>" placeholder="Please a Keyword for Search" onkeydown="if(event.keyCode==13) { CallAjax('search_ajax','<?php echo $v_modul; ?>'); return false; }" />
                    </div>
                    <div class="col-md-2" style="text-align: left;">
                        <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" title="Search" onclick="CallAjax('search_ajax','<?php echo $v_modul; ?>')"><i class="fa fa-search"></i></button>
                    </div>
                </div> 
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th>Name</th>
                            <th class="hidden-xs w-25">Group</th>
                            <th class="hidden-xs w-25">URL</th>
                            <th class="hidden-xs w-5">Sort</th> 
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="td_body_<?php echo $v_modul; ?>">
                        <?php
                            $_SESSION["list_file"]["menu"] = "tbody"; 
                            include("admin_menu_list.php");
                        ?>    
                    </tbody>    
                </table> 
                
                
            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
    </div>
    <!-- .col-md-6 -->
</div> 
<?php 
    }
    else if($_SESSION["list_file"]["menu"]=="tbody")
    {
        $no = 0;
        if(is_array($arr_data["list_data_root"]))
        {
            foreach($arr_data["list_data_root"] as $key_group=>$val_group)
            {
                $no++;
                $menu_name = $arr_data["menu_name"][$val_group];
                $menu_group = $arr_data["menu_group"][$val_group];
                $menu_url = $arr_data["menu_url"][$val_group]; 
                $sort_by = $arr_data["sort_by"][$val_group]; 
    ?>
    <tr>
        <td class="text-left"><?php echo $no; ?></td>
        <td style="font-weight: bold;"><?php echo $menu_name; ?></td>
        <td class="hidden-xs"><?php echo $menu_group; ?></td>
        <td class="hidden-xs"><?php echo $menu_url; ?></td>
        <td class="hidden-xs"><?php echo $sort_by; ?></td>
        <td class="text-center">
            <div class="btn-group">
                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit <?php echo $menu_name; ?>" onclick="CallAjax('edit_ajax', '<?php echo $v_modul; ?>', '<?php echo $val_group; ?>')"><i class="ion-edit"></i></button>
                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove <?php echo $menu_name; ?>" onclick="CallAjax('delete_ajax', '<?php echo $v_modul; ?>', '<?php echo $val_group; ?>')"><i class="ion-close"></i></button>
            </div>
        </td>
    </tr>
    <?php 
                if(is_array($arr_data["list_data"][$val_group]))
                {
                    foreach($arr_data["list_data"][$val_group] as $key=>$val)
                    {
                        $menu_name = $arr_data["menu_name"][$val];
                        $menu_group = $arr_data["menu_group"][$val];
                        $menu_url = $arr_data["menu_url"][$val]; 
                        $sort_by = $arr_data["sort_by"][$val]; 
                
                        $no++;  
                        ?>
                        <tr>
                            <td class="text-left"><?php echo $no; ?></td>
                            <td style="padding-left: 50px;"><?php echo $menu_name; ?></td>
                            <td class="hidden-xs"><?php echo $menu_group; ?></td>
                            <td class="hidden-xs"><?php echo $menu_url; ?></td>
                            <td class="hidden-xs"><?php echo $sort_by; ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit <?php echo $menu_name; ?>" onclick="CallAjax('edit_ajax', '<?php echo $v_modul; ?>', '<?php echo $val; ?>')"><i class="ion-edit"></i></button>
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove <?php echo $menu_name; ?>" onclick="CallAjax('delete_ajax', '<?php echo $v_modul; ?>', '<?php echo $val; ?>')"><i class="ion-close"></i></button>
                                </div>
                            </td>
                        </tr> 
                        <?php             
                        
                    }
                }
            }
        } 
            
    }
?>