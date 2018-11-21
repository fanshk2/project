<?php 
    $start_data = (($p-1)*$max_page) + 1;
    $end_data   = ($start_data + count($arr_data["role_access_tbl"])) -1;
    
    $arr_data["jml_page"][$v_modul] = ceil($arr_data["jml_data"][$v_modul] / $max_page); 
    
    $echo_class_left = ""; if($p*1==1){ $echo_class_left = 'class="disabled"'; }
    $echo_class_right = ""; if($p*1==$arr_data["jml_page"][$v_modul]){ $echo_class_right = 'class="disabled"'; }
    
    $p_left  = $p-1;
    $p_right = $p+1;
?>

<tr>
    <td colspan="100%">
    <span style="float: left; padding-top: 20px;" class="hidden-xs">
        Showing <?php echo $start_data; ?>-<?php echo $end_data; ?> of <?php echo format_number($arr_data["jml_data"][$v_modul]); ?>
    </span>

    <span style="float: right; vertical-align: top;">

        <?php 
            if($arr_data["jml_page"][$v_modul]*1<6)
            {
        ?>
        <ul class="pagination pagination-sm">
            <li <?php echo $echo_class_left;?>>
                <a href="javascript:void(0)" <?php if($echo_class_left==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_left; ?>')" <?php } ?> ><i class="ion-chevron-left"></i></a>
            </li>
                
                <?php 
                    for($i_page=1;$i_page<=$arr_data["jml_page"][$v_modul];$i_page++)
                    {
                        $echo_class = '';
                        if($i_page==$p)
                        {
                            $echo_class = 'class="active"';
                        }
                ?>
            <li <?php echo $echo_class;?>>
                <a href="javascript:void(0)" <?php if($echo_class==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $i_page; ?>')" <?php } ?>><?php echo $i_page; ?></a>
            </li>
            <?php 
                    }
            ?>
            <li <?php echo $echo_class_right; ?>>
                <a href="javascript:void(0)" <?php if($echo_class_right==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_right; ?>')" <?php } ?>><i class="ion-chevron-right"></i></a>
            </li>
        </ul>
        <?php 
            }
            else
            {
                if($p*1==1 || $p*1==2)
                {
                    $p_curr_first = 1;
                    $p_curr_left  = $p-1;    
                    $p_curr_right = $p+1;   
                    $p_curr_last  = $arr_data["jml_page"][$v_modul];
                   ?>
                   <ul class="pagination pagination-sm">
                        <li <?php echo $echo_class_left;?>>
                            <a href="javascript:void(0)" <?php if($echo_class_left==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_left; ?>')" <?php } ?>><i class="ion-chevron-left"></i></a>
                        </li>

                        
                        <?php 
                            for($i_page=1;$i_page<=4;$i_page++)
                            {
                                $echo_class = '';
                                if($i_page==$p)
                                {
                                    $echo_class = 'class="active"';
                                }
                        ?>
                        <li <?php echo $echo_class;?>>
                            <a href="javascript:void(0)" <?php if($echo_class==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $i_page; ?>')" <?php } ?>><?php echo $i_page; ?></a>
                        </li>
                        <?php 
                            }
                        ?> 
                        
                        
                        
                        <li>
                            <a href="javascript:void(0)">..</a>
                        </li>
                        
                        <li>
                            <a href="javascript:void(0)" onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_curr_last; ?>')"><?php echo $p_curr_last; ?></a>
                        </li>
                        
                        
                        <li <?php echo $echo_class_right; ?>>
                            <a href="javascript:void(0)" <?php if($echo_class_right==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_right; ?>')" <?php } ?>><i class="ion-chevron-right"></i></a>
                        </li>
                    </ul> 
                    <?php   
                }
                else if($p*1==$arr_data["jml_page"][$v_modul] || $p*1==($arr_data["jml_page"][$v_modul]-1) )
                {
                    $p_curr_first = 1;
                    $p_curr_left  = $p-1;    
                    $p_curr_right = $p+1;   
                    $p_curr_last  = $arr_data["jml_page"][$v_modul];
                   ?>
                   <ul class="pagination pagination-sm">
                        <li <?php echo $echo_class_left;?>>
                            <a href="javascript:void(0)" <?php if($echo_class_left==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_left; ?>')" <?php } ?>><i class="ion-chevron-left"></i></a>
                        </li>

                        
                        <?php 
                            for($i_page=1;$i_page<=2;$i_page++)
                            {
                                $echo_class = '';
                                if($i_page==$p)
                                {
                                    $echo_class = 'class="active"';
                                }
                        ?>
                        <li <?php echo $echo_class;?>>
                            <a href="javascript:void(0)" <?php if($echo_class==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $i_page; ?>')" <?php } ?>><?php echo $i_page; ?></a>
                        </li>
                        <?php 
                            }
                        ?> 
                        
                        <li>
                            <a href="javascript:void(0)">..</a>
                        </li>
                        
                        <?php 
                            for($i_page=($arr_data["jml_page"][$v_modul]-1);$i_page<=$arr_data["jml_page"][$v_modul];$i_page++)
                            {
                                $echo_class = '';
                                if($i_page==$p)
                                {
                                    $echo_class = 'class="active"';
                                }
                        ?>
                        <li <?php echo $echo_class;?>>
                            <a href="javascript:void(0)" <?php if($echo_class==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $i_page; ?>')" <?php } ?>><?php echo $i_page; ?></a>
                        </li>
                        <?php 
                            }
                        ?> 
                        
                        
                        <li <?php echo $echo_class_right; ?>>
                            <a href="javascript:void(0)" <?php if($echo_class_right==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_right; ?>')" <?php } ?>><i class="ion-chevron-right"></i></a>
                        </li>
                    </ul> 
                    <?php    
                }
                else
                {
                    $p_curr_first = 1;
                    $p_curr_left  = $p-1;    
                    $p_curr_right = $p+1;   
                    $p_curr_last  = $arr_data["jml_page"][$v_modul];
                   ?>
                   <ul class="pagination pagination-sm">
                        <li <?php echo $echo_class_left;?>>
                            <a href="javascript:void(0)" <?php if($echo_class_left==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_left; ?>')" <?php } ?>><i class="ion-chevron-left"></i></a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_curr_first; ?>')"><?php echo $p_curr_first; ?></a>
                        </li>
                        
                        <li>
                            <a href="javascript:void(0)">..</a>
                        </li>
                        
                        <li>
                            <a href="javascript:void(0)" onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_curr_left; ?>')"><?php echo $p_curr_left; ?></a>
                        </li>
                        
                         
                        <li class="active">
                            <a href="javascript:void(0)"><?php echo $p; ?></a>
                        </li>
                        
                        <li>
                            <a href="javascript:void(0)" onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_curr_right; ?>')"><?php echo $p_curr_right; ?></a>
                        </li>
                        
                        <li>
                            <a href="javascript:void(0)">..</a>
                        </li>
                        
                        <li>
                            <a href="javascript:void(0)" onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_curr_last; ?>')"><?php echo $p_curr_last; ?></a>
                        </li>
                        
                        
                        <li <?php echo $echo_class_right; ?>>
                            <a href="javascript:void(0)" <?php if($echo_class_right==""){ ?> onclick="CallAjax('page_ajax', '<?php echo $v_modul; ?>', '<?php echo $p_right; ?>')" <?php } ?>><i class="ion-chevron-right"></i></a>
                        </li>
                    </ul> 
                   <?php   
                }      
            }
        ?> 
    </span>
    </td>
</tr> 