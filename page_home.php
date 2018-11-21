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
                                        <h4>Selamat Datang di Portal Human Capital </h4>
                                    </div>
                                    <div class="card-block">
                                        Berawal dari adanya kebutuhan sistem pelayanan kepegawaian yang lebih cepat dan efisien serta diperlukannya wadah penyimpan aspirasi human capital yang mumpuni, maka dikembangkanlah sistem aplikasi HR FasT. HR FasT adalah sebuah aplikasi front-end access system & Tracking yang merupakan rujukan utama bagi seluruh karyawan WOM Finance untuk berkomunikasi dengan pihak human capital dan menyelesaikan segala administrasi kepegawaiannya secara online. HR FasT menyediakan sejumlah informasi-informasi umum untuk menambah pengetahuan karyawan mengenai Human Capital WOM Finance. HR FasT juga menyediakan beragam informasi dan pelayanan kepegawaian yang bersifat rahasia dan hanya dapat diakses oleh karyawan yang bersangkutan dengan menggunakan user ID dan password.
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

    </body>
</html> 