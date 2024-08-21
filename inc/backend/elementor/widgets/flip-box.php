<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Flip Box
 */
class Restimo_Flip_Box extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iflip_box';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Flip Box', 'restimo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-flip-box';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_restimo' ];
	}

	protected function register_controls() {

		//Content Flip box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Flip Box', 'restimo' ),
			]
		);
		$this->add_control(
	       'image_box',
	        [
	           'label' => esc_html__( 'Image Box', 'restimo' ),
	           'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
			  	],
		    ]
	    );

	    $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_box_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'number',
			[
				'label' => __( 'Number', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '01', 'restimo' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'restimo' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Client Learning Programs', 'restimo' ),
			]
		);

		$this->add_control(
			'des',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Our firm has helped clients engaged in more than 100 different subsectors of the aerospace, space markets.', 'restimo' ),
			]
		);

		$this->add_control(
			'label_link',
			[
				'label' => 'Label Button',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '<i class="xp-flaticon-trajectory"></i> Explore More', 'restimo' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'restimo' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'restimo' ),
				'condition' => [
					'label_link!' => '',
				],
			]
		);

		$this->end_controls_section();

		/***Style***/

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/* gereral */
		$this->add_control(
			'heading_gereral',
			[
				'label' => __( 'Gereral', 'restimo' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding Box', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .number-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'radius_box',
			[
				'label' => __( 'Border Radius', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-flip-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		/* title */
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_space',
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
					'{{WRAPPER}} .number-title h4' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .number-title h4' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .number-title h4',
			]
		);

		/* number */
		$this->add_control(
			'heading_num',
			[
				'label' => __( 'Number', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'num_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .number-title span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'num_typography',
				'selector' => '{{WRAPPER}} .number-title span',
			]
		);

		$this->end_controls_section();

		//Hover
		$this->start_controls_section(
			'style_overlay_section',
			[
				'label' => __( 'Hover', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'overlay_padding',
			[
				'label' => __( 'Padding Box', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-flip-box .overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'overlay_bg',
			[
				'label' => __( 'Background', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-flip-box .overlay' => 'background: {{VALUE}};',
				],
			]
		);

		/* description */
		$this->add_control(
			'heading_des',
			[
				'label' => __( 'Description', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'des_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .overlay' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .overlay',
			]
		);

		/* button */
		$this->add_control(
			'heading_btn',
			[
				'label' => __( 'Button', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'btn_space',
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
					'{{WRAPPER}} .inner > a' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .inner > a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_control(
			'btn_hcolor',
			[
				'label' => __( 'Hover Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .inner > a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .inner > a',
				'condition' => [
					'label_link!' => '',
				],
			]
		);
	
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}
		$this->add_render_attribute( 'button', 'class', 'link-details' );

		?>

		<div class="xp-flip-box">
			<div class="inner-box">
				<div class="overlay flex-middle">
					<div class="inner">
						<?php if( $settings['des'] ) { echo '<p>' .$settings['des']. '</p>'; } ?>
						<?php if( $settings['label_link'] ){ echo '<a ' .$this->get_render_attribute_string( 'button' ). '>' .$settings['label_link']. '</a>'; } ?>
					</div>
				</div>
				<div class="content-box">
					<div class="number-title">
						<?php if( $settings['number'] ) { echo '<span>' .$settings['number']. '</span>'; } ?>
						<?php if( $settings['title'] ) { echo '<h4>' .$settings['title']. '</h4>'; } ?>
					</div>
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_box_size', 'image_box' ); ?>
				</div>
			</div>
	    </div>

	    <?php
	}

}
// After the Restimo_Flip_Box class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_Flip_Box() );