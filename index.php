<?php 
    include("page_header.php");
    
    $sql = "DELETE FROM task_user_tbl WHERE ip_user = '".get_client_ip()."'";
    SQL_EXECUTE($sql, $db["dbms"]);
    
    if($_SESSION["ses_lock"]==1)
    {
        header("Location:".$base_url."/logout.php");
    }
    
    $requestURI = explode('/', $_SERVER['REQUEST_URI']);
    $scriptName = explode('/',$_SERVER['SCRIPT_NAME']);

    for ($i= 0; $i < sizeof($scriptName); $i++)
    {
        if ($requestURI[$i] == $scriptName[$i])
        {
            unset($requestURI[$i]);
        }
    } 
    
    $command = array_values($requestURI);
    
    if(count($command)>0)
    {
        $sql = "
                SELECT
                    friendly_url_tbl.page,
                    friendly_url_tbl.script
                FROM
                    friendly_url_tbl
                WHERE
                    1=1
                    AND friendly_url_tbl.page = '".$command[0]."'
                LIMIT
                    0,1
        ";
        $arr_data["friendly_url_tbl"] = SQL_SELECT($sql, $db["dbms"]); 
        
        if(is_array($arr_data["friendly_url_tbl"]))
        {    
            if($arr_data["friendly_url_tbl"][0]["script"]=="")
            {
                include("page_home.php");
            }
            else
            {
                include($arr_data["friendly_url_tbl"][0]["script"]);    
            } 
            
            ?>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="false">
                <div id="div_size_modal" class="modal-dialog">
                    <div class="modal-content">
                        <div class="card-header bg-green bg-inverse">
                            <h4 id="Modal_Title"></h4>
                            <ul class="card-actions">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-block" id="Modal_Content">
                            
                        </div>
                        <div class="modal-footer">
                            a
                        </div>
                    </div>
                </div>
            </div> 
            <?php
        }
        else
        {
            include("page_not_found.php");
        }
    }
    else
    {
        include("page_not_found.php");
    }  

    include("page_footer.php");
?>