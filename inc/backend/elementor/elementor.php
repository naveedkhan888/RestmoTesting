<?php

// Load the theme's custom Widgets so that they appear in the Elementor element panel.
add_action( 'elementor/widgets/register', 'restimo_register_elementor_widgets' );
function restimo_register_elementor_widgets() {

    require_once( get_template_directory() . '/inc/backend/elementor/widgets/widgets.php' );
    require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/widgets.php' );

}

// Add a custom 'category_restimo' category for to the Elementor element panel so that our theme's widgets have their own category.
add_action( 'elementor/init', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_restimo',
        [
            'title' => __( 'Restimo', 'restimo' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        1 // position
    );
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_restimo_header',
        [
            'title' => __( 'XP Header', 'restimo' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        2 // position
    );
});

// Post types with Elementor
function restimo_add_cpt_support() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'xp_portfolio', 'xp_header_builders', 'xp_footer_builders' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    
    //if it DOES exist, but portfolio is NOT defined
    else {
        $xp_portfolio       = in_array( 'xp_portfolio', $cpt_support );
        $xp_header_builders = in_array( 'xp_header_builders', $cpt_support );
        $xp_footer_builders = in_array( 'xp_footer_builders', $cpt_support );
        if( !$xp_portfolio ){
            $cpt_support[] = 'xp_portfolio'; //append to array
        }
        if( !$xp_header_builders ){
            $cpt_support[] = 'xp_header_builders'; //append to array
        }
        if( !$xp_footer_builders ){
            $cpt_support[] = 'xp_footer_builders'; //append to array
        }
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    
    //otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action( 'elementor/init', 'restimo_add_cpt_support' );

// Upload SVG for Elementor
function restimo_unfiltered_files_upload() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_unfiltered_files_upload' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = '1'; //create string value default to enable upload svg
        update_option( 'elementor_unfiltered_files_upload', $cpt_support ); //write it to the database
    }
}
add_action( 'elementor/init', 'restimo_unfiltered_files_upload' );

// Header post type
add_action( 'init', 'restimo_create_header_builder' ); 
function restimo_create_header_builder() {
    register_post_type( 'xp_header_builders',
        array(
            'labels' => array(
                'name' => 'Header Builders',
                'singular_name' => 'Header Builder',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Header Builder',
                'edit' => 'Edit',
                'edit_item' => 'Edit Header Builder',
                'new_item' => 'New Header Builder',
                'view' => 'View',
                'view_item' => 'View Header Builder',
                'search_items' => 'Search Header Builders',
                'not_found' => 'No Header Builders found',
                'not_found_in_trash' => 'No Header Builders found in Trash',
                'parent' => 'Parent Header Builder'
            ),
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'menu_position' => 60,
            'supports' => array( 'title', 'editor' ),
            'menu_icon' => 'dashicons-editor-kitchensink',
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'capability_type' => 'post'
        )
    );
}

// Footer post type
add_action( 'init', 'restimo_create_footer_builder' ); 
function restimo_create_footer_builder() {
    register_post_type( 'xp_footer_builders',
        array(
            'labels' => array(
                'name' => 'Footer Builders',
                'singular_name' => 'Footer Builder',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Footer Builder',
                'edit' => 'Edit',
                'edit_item' => 'Edit Footer Builder',
                'new_item' => 'New Footer Builder',
                'view' => 'View',
                'view_item' => 'View Footer Builder',
                'search_items' => 'Search Footer Builders',
                'not_found' => 'No Footer Builders found',
                'not_found_in_trash' => 'No Footer Builders found in Trash',
                'parent' => 'Parent Footer Builder'
            ),
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'menu_position' => 60,
            'supports' => array( 'title', 'editor' ),
            'menu_icon' => 'dashicons-editor-kitchensink',
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'capability_type' => 'post'
        )
    );
}

/*Fix Elementor Pro*/
function restimo_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'restimo_register_elementor_locations' );

/*** add options to sections ***/
add_action('elementor/element/container/section_layout/after_section_end', function( $container, $args ) {

    /* header options */
    $container->start_controls_section(
        'header_custom_class',
        [
            'label' => __( 'For Header', 'restimo' ),
            'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $container->add_control(
        'sticky_class',
        [
            'label'        => __( 'Sticky On/Off', 'restimo' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'is-fixed',
            'prefix_class' => '',
        ]
    );
    $container->add_control(
        'sticky_background',
        [
            'label'     => __( 'Background Scroll', 'restimo' ),
            'type'      => Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}.is-fixed.is-stuck' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]
    );
    $container->add_responsive_control(
        'offset_space',
        [
            'label' => __( 'Offset', 'restimo' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}.is-stuck' => 'top: {{SIZE}}{{UNIT}};',
                '.admin-bar {{WRAPPER}}.is-stuck' => 'top: calc({{SIZE}}{{UNIT}} + 32px);',
            ],
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]
    );

    $container->end_controls_section();

}, 10, 2 );

/*** add options to columns ***/
if ( did_action( 'elementor/loaded' ) ) {
    require get_template_directory() . '/inc/backend/elementor/column.php';
}