<?php 
    if($_SESSION["list_file"][$v_modul]=="all")
    {
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" title="Add Menu" onclick="CallAjax('add_ajax', '<?php echo $v_modul; ?>')"><i class="fa fa-plus-circle"></i></button> Add</h4>
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
                            <th class="hidden-xs w-25">Position</th>
                            <th class="hidden-xs w-25">Employee</th>
                            <th class="hidden-xs w-5">Active</th> 
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="td_body_<?php echo $v_modul; ?>">
                        <?php
                            $_SESSION["list_file"][$v_modul] = "tbody"; 
                            include("admin_".$v_modul."_list.php");
                        ?>    
                    </tbody>    
                    
                    <?php 
                        if($arr_data["jml_data"][$v_modul]>$max_page)
                        {
                    ?>
                    <tfoot id="tfoot_<?php echo $v_modul; ?>">
                        <?php 
                            include("paging.php");
                        ?>
                    </tfoot>
                    <?php 
                        }
                    ?>
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
    else if($_SESSION["list_file"][$v_modul]=="tbody")
    {
        $no = (($p-1)*$max_page) + 1;
        if(is_array($arr_data["role_access_tbl"]))
        {
            foreach($arr_data["role_access_tbl"] as $key=>$val)
            {
                $cid = $arr_data["role_access_tbl"][$key]["cid"];
                $role_access_name = $arr_data["role_access_tbl"][$key]["role_access_name"];
                $POSITION_ID = $arr_data["role_access_tbl"][$key]["POSITION_ID"];
                $EMPLOYEE_ID = $arr_data["role_access_tbl"][$key]["EMPLOYEE_ID"];
                $Active      = $arr_data["role_access_tbl"][$key]["Active"];
                
                if($Active==1)
                {
                    $active_echo = '<i class="ion-checkmark text-green"></i>';
                }
                else
                {
                    $active_echo = '<i class="ion-close text-red"></i>';    
                }
                
    ?>
    <tr>
        <td class="text-left"><?php echo $no; ?></td>
        <td style="font-weight: bold;"><?php echo $role_access_name; ?></td>
        <td class="hidden-xs"><?php echo $POSITION_ID; ?></td>
        <td class="hidden-xs"><?php echo $EMPLOYEE_ID; ?></td>
        <td class="hidden-xs"><?php echo $active_echo; ?></td>
        <td class="text-center">
            <div class="btn-group">
                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit <?php echo $role_access_name; ?>" onclick="CallAjax('edit_ajax', '<?php echo $v_modul; ?>', '<?php echo $cid; ?>')"><i class="ion-edit"></i></button>
                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove <?php echo $role_access_name; ?>" onclick="CallAjax('delete_ajax', '<?php echo $v_modul; ?>', '<?php echo $cid; ?>')"><i class="ion-close"></i></button>
            </div>
        </td>
    </tr>
    <?php 
                $no++;
            }
        } 
        else
        {
            ?>
            <tr>
                <td colspan="100%" style="text-align: center;">No Data</td>
            </tr> 
            <?php
        }
            
    }
?>