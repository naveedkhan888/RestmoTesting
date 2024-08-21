<!-- Main header start -->
<div class="xptf-main-header">
	<div class="xptf-area-wrap">
		<div class="container xptf-mainbar-container">
			<div class="xptf-mainbar">
				<div class="xptf-mainbar-row xptf-row">
					<div class="xptf-col logo-col">
						<div id="site-logo" class="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img  src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.svg" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							</a>
						</div>
					</div>
					<div class="xptf-col menu-col">
						<nav id="site-navigation" class="main-navigation">			
							<?php
								$menus = wp_get_nav_menus();
								if( $menus ){
									$options = [];
									foreach ( $menus as $menu ) {
										$options[ $menu->slug ] = $menu->name;
									}
									wp_nav_menu( array(
										'menu' 			 => array_keys( $options )[0],
										'menu_id'        => 'primary-menu',
										'container'      => 'ul',
									) );
								}
								else{
									wp_nav_menu( array(
										'theme_location' => 'primary',
										'menu_id'        => 'primary-menu',
										'container'      => 'ul',
									) );
								}
							?>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
<!-- Main header close -->