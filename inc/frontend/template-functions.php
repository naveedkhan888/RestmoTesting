<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Restimo
 */

/** 
 * Add body class by filter 
 * 
 */
add_filter( 'body_class', 'restimo_body_class_names', 999 );
function restimo_body_class_names( $classes ) {
	
	$theme = wp_get_theme();
	if( is_child_theme() ) { $theme = wp_get_theme()->parent(); }

  	$classes[] = 'restimo-theme-ver-'.$theme->version;

  	$classes[] = 'wordpress-version-'.get_bloginfo( 'version' );

  	if ( restimo_get_option('footer_fixed') != false ){
		$classes[] = 'footer-fixed';
	}

  	return $classes;
}

/**
 *  Add specific CSS class to header
 */
function restimo_header_class() {

	$header_classes = '';

	if ( restimo_get_option('header_fixed') != false ){
		$header_classes = 'header-transparent';
	}else{
		$header_classes = 'header-static';
	}
	if ( function_exists('rwmb_meta') ) {
		if( rwmb_meta('is_trans') == 'yes'){
			$header_classes = 'header-transparent';
		}elseif( rwmb_meta('is_trans') == 'no'){
			$header_classes = 'header-static';
		}
	}
	
    echo $header_classes;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function restimo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'restimo_pingback_header' );

//Get layout post & page.
if ( ! function_exists( 'restimo_get_layout' ) ) :
	function restimo_get_layout() {
		// Get layout.
		if( is_page() && !is_home() && function_exists( 'rwmb_meta' ) ) {
			$page_layout = rwmb_meta('page_layout');
		}elseif( is_single() ){
			$page_layout = restimo_get_option( 'single_post_layout' );
		}else{
			$page_layout = restimo_get_option( 'blog_layout' );
		}

		return $page_layout;
	}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'restimo_content_columns' ) ) :
	function restimo_content_columns() {

		$blog_content_width = array();

		// Check if layout is one column.
		if ( 'content-sidebar' === restimo_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
		}elseif ('sidebar-content' === restimo_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right';
		}else{
			$blog_content_width[] = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
		}

		// return the $classes array
    	echo implode( ' ', $blog_content_width );
	}
endif;

/* Select blog style */
if ( ! function_exists( 'restimo_blog_style' ) ) :
	function restimo_blog_style() {

		$blog_style = array();

		// Check if layout is one column.
		if ( restimo_get_option( 'blog_style' ) === 'grid' ) {
			$blog_style[] = 'blog-grid';
			$blog_style[] = restimo_get_option( 'blog_columns' );
		} else {
			$blog_style[] = 'blog-list';
		}

		// return the $classes array
    	echo implode( ' ', $blog_style );
	}
endif;

/**
 * Portfolio Columns
 */
if ( ! function_exists( 'restimo_portfolio_option_class' ) ) :
	function restimo_portfolio_option_class() {

		$portfolio_option_class = array();

		if( restimo_get_option('portfolio_column') == "2cl" ){
			$portfolio_option_class[] = 'pf_2_cols';
		}elseif( restimo_get_option('portfolio_column') == "4cl" ) {
			$portfolio_option_class[] = 'pf_4_cols';
		}elseif( restimo_get_option('portfolio_column') == "5cl" ) {
			$portfolio_option_class[] = 'pf_5_cols';
		}else{
			$portfolio_option_class[] = '';
		}

		if( restimo_get_option('portfolio_style') == "style2" ) {
			$portfolio_option_class[] = 'style-2';
		}elseif( restimo_get_option('portfolio_style') == "style3" ) {
			$portfolio_option_class[] = 'style-3';
		}else{
			$portfolio_option_class[] = 'style-1';
		}

	    // return the $classes array
	    echo implode( ' ', $portfolio_option_class );
	}
endif;

/**
 * Change Posts Per Page for Portfolio Archive.
 * 
 * @param object $query data
 *
 */
function restimo_change_portfolio_posts_per_page( $query ) {
	$portfolio_ppp = (!empty( restimo_get_option('portfolio_posts_per_page') ) ? restimo_get_option('portfolio_posts_per_page') : '6');

	if ( !is_singular() && !is_admin() ) {		
	    if ( $query->is_post_type_archive( 'xp_portfolio' ) || $query->is_tax('portfolio_cat') && ! is_admin() && $query->is_main_query() ) {
	        $query->set( 'posts_per_page', $portfolio_ppp );
	    }
	}
    return $query;
}
add_filter( 'pre_get_posts', 'restimo_change_portfolio_posts_per_page' );

/**
 * Load More Ajax Portfolio
 */
add_action( 'wp_enqueue_scripts', 'restimo_script_and_styles', 1 );
function restimo_script_and_styles() {
	global $wp_query;

	// register our main script but do not enqueue it yet
	wp_register_script( 'restimo_scripts', get_template_directory_uri() . '/js/myloadmore.js', array('jquery'), time() );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'restimo_scripts', 'restimo_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
	) );

 	wp_enqueue_script( 'restimo_scripts' );
}

add_action('wp_ajax_loadmore', 'restimo_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'restimo_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

function restimo_loadmore_ajax_handler(){
	$offset  = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
	$cat     = (isset($_POST['cat'])) ? $_POST['cat'] : 0;
	$ppp     = (isset($_POST['ppp'])) ? $_POST['ppp'] : 3;
	$style   = (isset($_POST['style'])) ? $_POST['style'] : 'p-grid';
	if( $_POST['cat'] != '' ){
		$args = array(
			'post_type' 	 => 'xp_portfolio',
			'posts_per_page' => $ppp,
			'offset'         => $offset,
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio_cat',
					'field' => 'term_id',
					'terms' => explode(",",$cat),
				),
			), 
		);
	}else{
		$args = array(
			'post_type' 	 => 'xp_portfolio',
			'posts_per_page' => $ppp,
			'offset'         => $offset,
		);
	}

	$wp_query = new \WP_Query($args);
		while ($wp_query -> have_posts()) : $wp_query -> the_post();
		if( $style == 'p-grid' ){
			get_template_part( 'template-parts/content', 'project' );
		}else{
			get_template_part( 'template-parts/content', 'project-masonry' );
		}
		endwhile; 

	die;
}

/**
 * Back-To-Top on Footer
 */
if( !function_exists('restimo_custom_back_to_top') ) {
    function restimo_custom_back_to_top() {     
	    if( restimo_get_option('backtotop') != false ){
	    	echo '<a id="back-to-top" href="#" class="show"><i class="xp-flaticon-left-arrow-2"></i></a>';
	    }
    }
}
add_action('wp_footer', 'restimo_custom_back_to_top');

/**
 * Google Analytics
 */
if ( ! function_exists( 'restimo_hook_javascript' ) ) {
	function restimo_hook_javascript() {
		if ( restimo_get_option('js_code') != '' ) {
	    ?>
	    	<!-- Google Analytics code -->
	    	<script type="text/javascript">
	            <?php echo restimo_get_option('js_code'); ?>
	        </script>
	    <?php
	    }
	}
}
add_action('wp_head', 'restimo_hook_javascript');

/**
 * Render date-time in Copyright
 */
function xpertpoin8_date_func( $atts ) {
    $date_format = shortcode_atts( array(
        'time_custom' => 'Y',        
    ), $atts );

    $dt = new DateTime("now");
    $gmt_timestamp = $dt->format("{$date_format['time_custom']}");

    return $gmt_timestamp;
}
add_shortcode( 'xpertpoin8_date', 'xpertpoin8_date_func' );

/* Convert hexdec color string to rgb(a) string */
 
function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
        return $default; 
 
	//Sanitize $color if "#" is provided 
    if ($color[0] == '#' ) {
    	$color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
       	$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
    	if(abs($opacity) > 1)
		$opacity = 1.0;
    	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
    	$output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}