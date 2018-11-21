<!DOCTYPE html>

<html class="app-ui">

    <head>
        <?php
            include("page_asset_header.php");
        ?>
    </head>

    <body class="app-ui layout-has-drawer layout-has-fixed-header">
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
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Page Not Found </h4>
                                    </div>
                                    <div class="card-block" align="center">
                                        <img src="<?php echo $base_url; ?>/assets/img/page-not-found.png" class="img-responsive">
                                    </div>
                                    <!-- .card-block -->
                                </div>
                                <!-- .card -->
                            </div>
                            <!-- .col-md-6 -->
                        </div>
                        <!-- .row -->                             
                               
                    </div>
                    <!-- End Page Content -->
                                    </main>

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <div class="app-ui-mask-modal"></div>

        <?php 
            include("page_asset_footer.php");
        ?>

    </body>
</html> 