<!-- #site-header-open -->
<header id="site-header" class="site-header <?php restimo_header_class(); ?>">

    <!-- #header-desktop-open -->
    <?php restimo_header_builder(); ?>
    <!-- #header-desktop-close -->

    <!-- #header-mobile-open -->
    <?php restimo_mobile_builder(); ?>
    <!-- #header-mobile-close -->

</header>
<!-- #site-header-close -->
<!-- #side-panel-open -->
<?php if ( !empty( restimo_get_option('is_sidepanel') ) && restimo_get_option('sidepanel_layout') != '' ) { ?>
    <div id="side-panel" class="side-panel <?php if( restimo_get_option('panel_left') ) echo 'on-left'; ?>">
        <a href="#" class="side-panel-close"><i class="xp-flaticon-cancel"></i></a>
        <div class="side-panel-block">
            <?php if ( did_action( 'elementor/loaded' ) ) restimo_sidepanel_builder(); ?>	
        </div>
    </div>
<?php } ?>
<!-- #side-panel-close -->