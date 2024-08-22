<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Button
 */
class Restimo_Features_Service extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ifearuresservice';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Features Service', 'restimo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-background';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_restimo' ];
	}

	/**
	 * Get button sizes.
	 *
	 * Retrieve an array of button sizes for the button widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return array An array containing button sizes.
	 */

	protected function register_controls() {

		//Content Features Service List
		$this->start_controls_section(
			'fservice_section',
			[
				'label' => __( 'Button', 'restimo' ),
			]
        );

        $repeater = new Repeater();

        $repeater->add_control(
			'fservice_image',
			[
				'label' => __( 'Image', 'restimo' ),
				'type' => Controls_Manager::MEDIA,
			]
		);

        $repeater->add_control(
			'fservice_number',
			[
				'label' => __( 'Number:', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '01', 'restimo' ),
			]
		);

        $repeater->add_control(
			'fservice_title',
			[
				'label' => __( 'Title & Content', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Service Title', 'restimo' ),
				'placeholder' => __( 'Service Title', 'restimo' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'fservice_content',
			[
				'label' => __( 'Description', 'restimo' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Accelerate your innovation and transformation with a fully integrated suite of capabilities that puts digital at the heart of everything you do.', 'restimo' ),
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'restimo' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'restimo' ),
			]
		);

		$this->add_control(
			'fservice_lists',
			[
				'label' => __( 'Features Service List Items', 'restimo' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'fservice_number' => __( '01', 'restimo' ),
						'fservice_title' => __( 'Title #1', 'restimo' ),
						'fservice_content' => __( 'Accelerate your innovation and transformation with a fully integrated suite of capabilities that puts digital at the heart of everything you do.', 'restimo' ),
						'link' => '#',
					],
					[
						'fservice_number' => __( '02', 'restimo' ),
						'fservice_title' => __( 'Title #2', 'restimo' ),
						'fservice_content' => __( 'Accelerate your innovation and transformation with a fully integrated suite of capabilities that puts digital at the heart of everything you do.', 'restimo' ),
						'link' => '#',
					],
				],
				'title_field' => '{{{ fservice_title }}}',
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => __( 'Label Button', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'restimo' ),
			]
		);

		$this->add_responsive_control(
			'fservice_height',
			[
				'label' => __( 'Height', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 745,
				],
				'selectors' => [
					'{{WRAPPER}} .features-service-wrapper .features-service-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
		//Style

		$this->start_controls_section(
			'style_fservice_section',
			[
				'label' => __( 'General', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'fservice_list_padding',
			[
				'label' => __( 'Padding Box', 'restimo' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'fservice_padding',
			[
				'label' => 'Padding Content',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .features-service-item .features-service-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'fservice_content_style' );
		$this->start_controls_tab(
			'fservice_style_normal',
			[
				'label' => __( 'Normal', 'restimo' ),
			]
		);

		$this->add_control(
			'fservice_number_color',
			[
				'label' => __( 'Number', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-service-item .features-service-title span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'fservice_title_color',
			[
				'label' => __( 'Title', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-service-item .features-service-title h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'fservice_desc_color',
			[
				'label' => __( 'Description', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-service-item .features-service-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'fservice_style_hover',
			[
				'label' => __( 'Hover', 'restimo' ),
			]
		);
		$this->add_control(
			'fservice_number_hcolor',
			[
				'label' => __( 'Number', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-service-item:hover .features-service-title span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'fservice_title_hcolor',
			[
				'label' => __( 'Title', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-service-item:hover .features-service-title h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'fservice_desc_hcolor',
			[
				'label' => __( 'Description', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-service-item:hover .features-service-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'fservice_overlay_color',
			[
				'label' => __( 'Overlay', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-service-item .features-service-overlay' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Number
		$this->add_control(
			'heading_number',
			[
				'label' => __( 'Number', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'number_space',
			[
				'label' => __( 'Spacing', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .features-service-item .features-service-title span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .features-service-item .features-service-title span',
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .features-service-item .features-service-title h4',
			]
		);

		//Description
		$this->add_control(
			'heading_desc',
			[
				'label' => __( 'Description', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .features-service-item .features-service-content',
			]
		);
		$this->end_controls_section();

		// Button
		$this->start_controls_section(
			'style_section_btn',
			[
				'label' => __( 'Button', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Normal
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'restimo' ),
			]
		);

		$this->add_control(
			'button_icon_color',
			[
				'label' => __( 'Icon Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-service-wrapper .btn-details' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-service-wrapper .btn-details' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-service-wrapper .btn-details' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		//Hover

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'restimo' ),
			]
		);

		$this->add_control(
			'btn_icon_hcolor',
			[
				'label' => __( 'Icon', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-service-wrapper .btn-details:hover i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_text_hcolor',
			[
				'label' => __( 'Text Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-service-wrapper .btn-details:hover .btn-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg_hcolor',
			[
				'label' => __( 'Background Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-service-wrapper .btn-details:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_border_hcolor',
			[
				'label' => __( 'Border Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-service-wrapper .btn-details:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		?>
		<div class="features-service-wrapper">
			<?php if ( $settings['fservice_lists'] ) : foreach ( $settings['fservice_lists'] as $key => $data ) { 
				$url = $data['fservice_image']['url'];
				$photo = wp_get_attachment_image( $data['fservice_image']['id'], 'full' );

				if ( ! empty( $data['link']['url'] ) ) {
					$this->add_render_attribute( 'link' . $key, 'href', $data['link']['url'] );

					if ( $data['link']['is_external'] ) {
						$this->add_render_attribute( 'link' . $key, 'target', '_blank' );
					}

					if ( $data['link']['nofollow'] ) {
						$this->add_render_attribute( 'link' . $key, 'rel', 'nofollow' );
					}
				}
				$this->add_render_attribute( 'link' . $key, 'class', 'btn-details btn-text-indent' );
				?>
					<div class="features-service-item" <?php if( $key === 0 ){ echo 'data-default="yes"'; } ?>>
						<div class="features-service-content">
							<div class="features-service-title">
								<span class='features-service-number'><?php echo esc_html( $data['fservice_number'] ); ?></span>
								<h4><?php echo esc_html( $data['fservice_title'] ); ?></h4>
							</div>
							<div class="features-service-desc">
								<?php if($data['fservice_content']){ ?><p><?php echo wp_kses_post( $data['fservice_content'] ); ?></p><?php } ?>
							</div>
							<?php if( $data['link']['url'] ) { ?>
							<div class="flex-middle features-service-link">
								<a <?php echo $this->get_render_attribute_string('link' . $key); ?>>
									<span class="btn-text"><?php echo esc_html($settings['btn_text']); ?></span>
									<i class="xp-flaticon-trajectory"></i>
								</a>
							</div>
							<?php } ?>
							<div class="features-service-overlay"></div>
						</div>
						<div class="features-service-img-reposive" style="background-image: url(<?php echo esc_url( $url ); ?>)"></div>
					</div>
					<figure class="features-service-img">
						<?php if( $data['fservice_image']['url'] ) { echo esc_url( $photo ); } ?>
					</figure>
			<?php } endif; ?>
		</div>

	    <?php
	}

}
// After the Restimo_Features_Service class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_Features_Service() );