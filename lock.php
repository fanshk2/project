<?php 
    $modul = "lock";
    $_SESSION["ses_lock"] = 1;
?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-block">
                <form class="form-horizontal m-t-sm" method="post" target="my_iframe_<?php echo $modul; ?>" name="theform_<?php echo $modul; ?>" id="theform_<?php echo $modul; ?>" enctype="multipart/form-data" action="<?php echo $base_url; ?>/engine.php" onsubmit="return validasi_<?php echo $modul; ?>('<?php echo $modul; ?>')">
                <input type="hidden" name="iframe_action" value="<?php echo $modul; ?>">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material">
                                <input class="form-control" type="password" id="v_<?php echo $modul; ?>_password" name="v_<?php echo $modul; ?>_password">
                                <label for="v_username">Password</label>
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group m-b-0">
                        <div class="col-sm-12">
                            <button class="btn btn-app" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
                <iframe id="my_iframe_<?php echo $modul; ?>" name="my_iframe_<?php echo $modul; ?>" style="width: 100%; height: 100px; border: 0px;"></iframe>    
            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
    </div>
    <!-- .col-md-6 -->

    <?php 
        include("page_portal_left.php");
    ?>
</div>
<!-- .row -->                              