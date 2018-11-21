
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
                                        <h4>Silahkan Login </h4>
                                    </div>
                                    <div class="card-block">
                                        <form class="form-horizontal m-t-sm" method="post" target="my_iframe" name="theform" id="theform" enctype="multipart/form-data" action="<?php echo $base_url; ?>/engine.php" onsubmit="return validasi()">
                                        <input type="hidden" name="iframe_action" value="login">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="form-material">
                                                        <input class="form-control" type="text" id="v_username" name="v_username" maxlength="10" autocomplete="off">
                                                        <label for="material-text2">NIK</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="form-material">
                                                        <input class="form-control" type="password" id="v_password" name="v_password">
                                                        <label for="material-password2">Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="form-group m-b-0">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-app" type="submit" name="btn_login" id="btn_login">Login</button>
                                                    
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="<?php echo $base_url; ?>/forgot-password">Lupa Password</a>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group" id="div_message" style="display: none;">
                                                <div class="col-sm-12">
                                                    <br>
                                                    <div class="alert alert-danger">
                                                        <p id="content_message"><?php echo $msg; ?></p>
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
                    <div style="display: none;" class="container-fluid p-y-md" id="div_content_lock">&nbsp;</div>
                    
                    

                </main>

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <div class="app-ui-mask-modal"></div>

        <?php 
            include("page_asset_footer.php");
        ?>
        <script src="<?php echo $base_url; ?>/assets/js/pages/login.js"></script>

    </body>
</html> 