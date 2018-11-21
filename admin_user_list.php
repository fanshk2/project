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
                            <th>Employee ID</th>
                            <th class="hidden-xs w-25">Name</th>
                            <th class="hidden-xs w-25">Email</th>
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
        if(is_array($arr_data["tab_user"]))
        {
            foreach($arr_data["tab_user"] as $key=>$val)
            {
                $usrID = $arr_data["tab_user"][$key]["usrID"];
                $fullName = $arr_data["tab_user"][$key]["fullName"];
                $email = $arr_data["tab_user"][$key]["email"];                
    ?>
    <tr>
        <td class="text-left"><?php echo $no; ?></td>
        <td><?php echo $usrID; ?></td>
        <td class="hidden-xs"><?php echo $fullName; ?></td>
        <td class="hidden-xs"><?php echo $email; ?></td>
        <td class="text-center">
            <div class="btn-group">
                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit <?php echo $fullName; ?>" onclick="CallAjax('edit_ajax', '<?php echo $v_modul; ?>', '<?php echo $usrID; ?>')"><i class="ion-edit"></i></button>
                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove <?php echo $fullName; ?>" onclick="CallAjax('delete_ajax', '<?php echo $v_modul; ?>', '<?php echo $usrID; ?>')"><i class="ion-close"></i></button>
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