<input type="hidden" name="v_base_url" id="v_base_url" value="<?php echo $base_url; ?>">
<input type="hidden" name="v_max_recent_task" id="v_max_recent_task" value="<?php echo $max_recent_task; ?>">
<input type="hidden" name="v_max_menu_profile" id="v_max_menu_profile" value="<?php echo count($arr_data["menu_profile_tbl"]); ?>">
<input type="hidden" name="v_menu_hidden" id="v_menu_hidden" value="0">
<!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
<script src="<?php echo $base_url; ?>/assets/js/core/jquery.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/core/jquery.slimscroll.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/core/jquery.scrollLock.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/core/jquery.placeholder.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/app.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/app-custom.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- Page Plugins -->
<script src="<?php echo $base_url; ?>/assets/js/plugins/slick/slick.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/plugins/chartjs/Chart.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/plugins/flot/jquery.flot.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/plugins/flot/jquery.flot.stack.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/plugins/flot/jquery.flot.resize.min.js"></script>




<!-- Page JS Code -->
<script src="<?php echo $base_url; ?>/assets/js/pages/index.js"></script>
<script src="<?php echo $base_url; ?>/main.js?ver=2"></script>
<script>
    $(function()
    {
        // Init page helpers (Slick Slider plugin)
        App.initHelpers('slick');
    });
</script> 