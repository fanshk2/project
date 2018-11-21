<!DOCTYPE html>

<html class="app-ui">

    <head>
        <?php
            include("page_asset_header.php");
        ?>
    </head>

    <body class="app-ui layout-has-drawer layout-has-fixed-header" id="div_body">
        <div class="app-layout-canvas">
            <div class="app-layout-container">

                <?php 
                    include("page_drawer.php");
                    include("page_header_html.php");
                ?>

                <main class="app-layout-content">

                    <!-- Page Content -->
                    <div class="container-fluid p-y-md" id="div_content_1">
                            
                            
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Lupa Password </h4>
                                    </div>
                                    <div class="card-block">
                                        <form class="form-horizontal m-t-sm" method="post" target="my_iframe" name="theform" id="theform" enctype="multipart/form-data" action="<?php echo $base_url; ?>/engine.php" onsubmit="return validasi()">
                                        <input type="hidden" name="iframe_action" value="forgot">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="form-material">
                                                        <input class="form-control" type="text" id="v_username" name="v_username" maxlength="30" autocomplete="off">
                                                        <label for="v_username">NIK</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="form-material">
                                                        <input class="form-control" type="text" id="v_birthday" name="v_birthday" placeholder="ddmmyyyy" maxlength="8" autocomplete="off">
                                                        <label for="v_birthday">Tanggal Lahir</label>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="form-group m-b-0">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-app" type="submit">Reset</button>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group" id="div_message_error" style="display: none;">
                                                <div class="col-sm-12">
                                                    <br>
                                                    <div class="alert alert-danger">
                                                        <p id="content_message_error"><?php echo $msg; ?></p>
                                                    </div> 
                                                </div>
                                            </div>
                                            
                                            <div class="form-group" id="div_message_success" style="display: none;">
                                                <div class="col-sm-12">
                                                    <br>
                                                    <div class="alert alert-success">
                                                        <p id="content_message_success"><?php echo $msg; ?></p>
                                                    </div> 
                                                </div>
                                            </div>
                                            
                                        </form>
                                        <iframe id="my_iframe" name="my_iframe" style="width: 100%; height: 0px; border: 0px;"></iframe> 
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
                               
                    </div>
                    <!-- End Page Content -->
                    
                    <?php 
                        for($i=2;$i<=$max_recent_task;$i++)
                        {
                    ?>
                    <div style="display: none;" class="container-fluid p-y-md" id="div_content_<?php echo $i;?>"></div>
                    <?php 
                        }
                    ?>
                    
                    

                </main>

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <div class="app-ui-mask-modal"></div>

        <?php 
            include("page_asset_footer.php");
        ?>
        <script src="<?php echo $base_url; ?>/assets/js/pages/forgot_password.js"></script>
    </body>
</html> 