<?php
/**
 * Restimo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Restimo
 */

if ( ! function_exists( 'restimo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function restimo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change 'restimo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'restimo', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'restimo' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'link',
			'quote',
			'gallery',
			'audio',
		) );

		/* Add image sizes */
		add_image_size( 'restimo-post-thumbnail-grid', 600, 400, array( 'center', 'center' ) );
		add_image_size( 'restimo-portfolio-thumbnail-grid', 600, 600, array( 'center', 'center' ) );
		add_image_size( 'restimo-portfolio-thumbnail-grid-wdouble', 1200, 600, array( 'center', 'center' ) );
		add_image_size( 'restimo-portfolio-thumbnail-grid-whdouble', 1200, 1200, array( 'center', 'center' ) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
	 	 */
		add_editor_style( array( 'css/editor-style.css', restimo_fonts_url() ) );
		
	}
endif;
add_action( 'after_setup_theme', 'restimo_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function restimo_widgets_init() {
	/* Register the 'primary' sidebar. */
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'restimo' ),
		'id'            => 'primary',
		'description'   => esc_html__( 'Add widgets here.', 'restimo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
	/* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'restimo_widgets_init' );

/**
 * Register custom fonts.
 */
if ( ! function_exists( 'restimo_fonts_url' ) ) :
/**
 * Register Google fonts for Blessing.
 *
 * Create your own restimo_fonts_url() function to override in a child theme.
 *
 * @since Blessing 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function restimo_fonts_url() {
	$fonts_url = '';
	$font_families     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Roboto Slab, translate this to 'off'. Do not translate into your own language. */

	$body_font = restimo_get_option( 'body_typo', [] );
	$second_font = restimo_get_option( 'second_font', [] );

	if ( !isset( $body_font['font-family'] ) || $body_font['font-family'] == '' ) {
		$font_families[] = 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
	}

	if ( !isset( $second_font['font-family'] ) || $second_font['font-family'] == '' ) {
		$font_families[] = 'Merienda:300,400,500,600,700,800,900';
	}

	if ( $font_families ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Enqueue scripts and styles.
 */
function restimo_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'restimo-fonts', restimo_fonts_url(), array(), null );

	/** All frontend css files **/ 
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '4.0', 'all');
	
	/** load fonts icons **/
    wp_enqueue_style( 'restimo-flaticon', get_template_directory_uri().'/css/flaticon.css');

    /** Owl slider **/
	wp_enqueue_style( 'owl-slider', get_template_directory_uri().'/css/owl.carousel.min.css');
	
	/** Lightgallery Popup **/
    wp_enqueue_style( 'lightgallery', get_template_directory_uri().'/css/lightgallery.css');

	/** Theme stylesheet. **/
	wp_enqueue_style( 'restimo-style', get_stylesheet_uri() );	

	if( restimo_get_option('preload') != false ){
		wp_enqueue_script( 'royal-preloader', get_template_directory_uri()."/js/royal_preloader.min.js", array('jquery'), '20200716', true);
	}

	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'isotope', get_template_directory_uri().'/js/jquery.isotope.min.js', array('jquery'), '20200716',  true );
	wp_enqueue_script( 'lightgallery', get_template_directory_uri() . '/js/lightgallery-all.min.js', array( 'jquery' ), '20200716', true );
	wp_enqueue_script( 'owl-slider', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '20200716', true );
	wp_enqueue_script( 'easypiechart', get_template_directory_uri() . '/js/easypiechart.min.js', array( 'jquery' ), '20200716', true );
	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array( 'jquery' ), '20180910', true );
    wp_enqueue_script( 'restimo-elementor', get_template_directory_uri() . '/js/elementor.js', array( 'jquery' ), '20200716', true );
	wp_enqueue_script( 'restimo-elementor-header', get_template_directory_uri() . '/js/elementor-header.js', array('jquery'), '20200716', true );
	wp_enqueue_script( 'restimo-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '20200716', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'restimo_scripts' );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/frontend/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/frontend/template-functions.php';

/**
 * Custom Page Header for this theme.
 */
require get_template_directory() . '/inc/frontend/page-header/breadcrumbs.php';
require get_template_directory() . '/inc/frontend/page-header/page-header.php';

/**
 * Functions which add more to backend.
 */
require get_template_directory() . '/inc/backend/admin-functions.php';

/**
 * Custom metabox for this theme.
 */
require get_template_directory() . '/inc/backend/meta-boxes.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/backend/customizer/customizer.php';

/**
 * Register the required plugins for this theme.
 */
require get_template_directory() . '/inc/backend/plugin-requires.php';
require get_template_directory() . '/inc/backend/importer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/backend/color.php';

/**
 * Preloader js & css
 */
require get_template_directory() . '/inc/frontend/preloader.php';

/**
 * Elementor functions.
 */

require get_template_directory() . '/inc/backend/elementor/elementor.php';
require get_template_directory() . '/inc/frontend/builder.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'woocommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce/woocommerce.php';
}
