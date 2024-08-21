<?php
namespace Elementor;

// Ensure this file is only accessed via WordPress
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Register the widget
class Custom_Template_Widget extends Widget_Base {

    // Return the widget name
    public function get_name() {
        return 'custom_template_widget';
    }

    // Return the widget title
    public function get_title() {
        return __( 'Custom Template Widget', 'restimo' );
    }

    // Return the widget icon
    public function get_icon() {
        return 'eicon-library-save';
    }

    // Define the widget categories
    public function get_categories() {
        return [ 'general' ];
    }

    // Register the widget controls
    protected function register_controls() {
        // Start the content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'restimo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add a control to select the template
        $this->add_control(
            'template_id',
            [
                'label' => __( 'Select Template', 'restimo' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_elementor_templates(),
                'default' => '',
            ]
        );

        // End the content section
        $this->end_controls_section();
    }

    // Get the list of Elementor templates
    private function get_elementor_templates() {
        $templates = [];
        $elementor_templates = get_posts([
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ]);

        if ( ! empty( $elementor_templates ) ) {
            foreach ( $elementor_templates as $template ) {
                $templates[ $template->ID ] = $template->post_title;
            }
        }

        return $templates;
    }

    // Render the selected template
    protected function render() {
        $settings = $this->get_settings_for_display();
        $template_id = $settings['template_id'];

        if ( ! empty( $template_id ) ) {
            echo Plugin::instance()->frontend->get_builder_content_for_display( $template_id );
        }
    }

    // Render the content template for the editor (optional, can be left empty)
    protected function content_template() {}
}

// Register the widget with Elementor
Plugin::instance()->widgets_manager->register_widget_type( new Custom_Template_Widget() );
