<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team Carousel
 */
class Restimo_Team_Carousel extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iteamcarousel';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Team Carousel', 'restimo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-slider-push';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_restimo' ];
	}

	protected function register_controls() {

		/**TAB_CONTENT**/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Team', 'restimo' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
	       'member_image',
	        [
	            'label' => esc_html__( 'Photo', 'restimo' ),
	            'type'  => Controls_Manager::MEDIA,
		    ]
		);

	    $repeater->add_control(
		    'member_name',
	      	[
	          	'label' => esc_html__( 'Name', 'restimo' ),
	          	'type'  => Controls_Manager::TEXT,
				'default' => esc_html__( 'Peter Perish', 'restimo' ),
				'label_block' => true
	    	]
	    );

	    $repeater->add_control(
		    'member_extra',
	      	[
	          	'label' => esc_html__( 'Extra/Job', 'restimo' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => esc_html__( 'co-founder of company', 'restimo' ),
	    	]
	    );

	    $repeater->add_control(
			'link',
			[
				'label' => __( 'Link To Details', 'restimo' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://', 'restimo' ),
			]
		);

		$repeater->add_control(
			'socials',
			[
				'label' => __( 'Socials', 'restimo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'restimo' ),
				'label_off' => __( 'Hide', 'restimo' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);

	    $repeater->add_control(
		    'social1',
	      	[
	          	'label' => esc_html__( 'Icon Social 1', 'restimo' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-twitter',
					'library' => 'fa-brand',
				],
				'condition' => [
					'socials' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social1_link',
			[
				'label' => __( 'Link Social 1', 'restimo' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://twitter.com/', 'restimo' ),
				'condition' => [
					'socials' => 'yes',
				],
			]
		);

		$repeater->add_control(
		    'social2',
	      	[
	          	'label' => esc_html__( 'Icon Social 2', 'restimo' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-facebook-f',
					'library' => 'fa-brand',
				],
				'separator' => 'before',
				'condition' => [
					'socials' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social2_link',
			[
				'label' => __( 'Link Social 2', 'restimo' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://facebook.com/', 'restimo' ),
				'condition' => [
					'socials' => 'yes',
				],
			]
		);

		$repeater->add_control(
		    'social3',
	      	[
	          	'label' => esc_html__( 'Icon Social 3', 'restimo' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-pinterest-p',
					'library' => 'fa-brand',
				],
				'separator' => 'before',
				'condition' => [
					'socials' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social3_link',
			[
				'label' => __( 'Link Social 3', 'restimo' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://pinterest.com/', 'restimo' ),
				'condition' => [
					'socials' => 'yes',
				],
			]
		);

		$this->add_control(
		    'members',
		    [
		        'label'       => esc_html__( 'Team', 'restimo' ),
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{member_name}}}',
		    ]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'member_image_size',
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

		$slides_show = range( 1, 10 );
		$slides_show = array_combine( $slides_show, $slides_show );

		$this->add_responsive_control(
			'tshow',
			[
				'label' => __( 'Slides To Show', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'restimo' ),
				] + $slides_show,
				'default' => ''
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' => __( 'Yes', 'restimo' ),
					'false' => __( 'No', 'restimo' ),
				]
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => __( 'Yes', 'restimo' ),
					'false' => __( 'No', 'restimo' ),
				]
			]
		);
		$this->add_control(
			'timeout',
			[
				'label' => __( 'Autoplay Timeout', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 20000,
						'step' => 1000,
					],
				],
				'default' => [
					'size' => 7000,
				],
				'condition' => [
					'autoplay' => 'true',
				]
			]
		);
		$this->add_control(
			'arrows',
			[
				'label' => __( 'Arrows', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true'   => __( 'Yes', 'restimo' ),
					'false'  => __( 'No', 'restimo' ),
				],
			]
		);
		$this->add_control(
			'dots',
			[
				'label' => __( 'Dots', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'   => __( 'Yes', 'restimo' ),
					'false'  => __( 'No', 'restimo' ),
				],
			]
		);
		$this->add_responsive_control(
			'w_gaps',
			[
				'label' => __( 'Gap Width', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);

		$this->end_controls_section();

		/**TAB_STYLE**/
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'General', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'radius_box',
			[
				'label' => __( 'Border Radius', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .xp-team',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'info_style',
			[
				'label' => esc_html__( 'Info Box', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_info_box',
			[
				'label' => __( 'General', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'restimo' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'restimo' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'restimo' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'restimo' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'selectors' => [
					'{{WRAPPER}} .xp-team' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding_box',
			[
				'label' => __( 'Padding Box', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .team-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'bg_box',
			[
				'label' => __( 'Background', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-info' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'info_box_shadow',
				'selector' => '{{WRAPPER}} .team-info',
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
				'label' => esc_html__( 'Spacing', 'restimo' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-team h6' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'restimo' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .xp-team h6, {{WRAPPER}} .xp-team h6 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label'     => esc_html__( 'Color Hover', 'restimo' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .xp-team h6 a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!'  => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'restimo' ),
				'selector' => '{{WRAPPER}} .xp-team h6',
			]
		);

		/* extra */
		$this->add_control(
			'heading_job',
			[
				'label' => __( 'Extra/Job', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'job_space',
			[
				'label' => esc_html__( 'Spacing', 'restimo' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'job_color',
			[
				'label'     => esc_html__( 'Color', 'restimo' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-info span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'job_typography',
					'label'    => esc_html__( 'Typography', 'restimo' ),
					'selector' => '{{WRAPPER}} .team-info span',
				]
		);

		$this->end_controls_section();

		/* socials */
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Socials', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_social_space',
			[
				'label' => esc_html__( 'Spacing', 'restimo' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'radius_socials',
			[
				'label' => __( 'Border Radius', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_social_color',
			[
				'label'     => esc_html__( 'Color', 'restimo' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-social svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_social_bg',
			[
				'label'     => esc_html__( 'Background', 'restimo' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'background: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label'     => esc_html__( 'Color Hover', 'restimo' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-social a:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'social_hover_bg',
			[
				'label'     => esc_html__( 'Background Hover', 'restimo' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Dots.
		$this->start_controls_section(
			'navigation_section',
			[
				'label' => __( 'Dots', 'restimo' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'dots' => 'true',
				],
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
			[
				'label' => __( 'Spacing', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'dots_bgcolor',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .owl-dots button.owl-dot span' => 'background: {{VALUE}};',
				],
            ]
        );

        $this->add_control(
            'dots_active_bgcolor',
            [
                'label' => __( 'Color Active', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .owl-dots button.owl-dot.active span' => 'background: {{VALUE}};',
				],
            ]
        );

        $this->end_controls_section();

        // Arrows.
		$this->start_controls_section(
			'style_nav',
			[
				'label' => __( 'Arrows', 'restimo' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arrows' => 'true',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_spacing',
			[
				'label' => __( 'Spacing', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_width',
			[
				'label' => __( 'Width', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 70,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_control(
			'arrow_bg_color',
			[
				'label' => __( 'Background', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_hcolor',
			[
				'label' => __( 'Color Hover', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_bg_hcolor',
			[
				'label' => __( 'Background Hover', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'radius_arrow',
			[
				'label' => __( 'Border Radius', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$shows  = !empty( $settings['tshow'] ) ? $settings['tshow'] : 3;
		$tshows = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $shows;
		$mshows = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $tshows;
		$gaps   = isset( $settings['w_gaps']['size'] ) && is_numeric( $settings['w_gaps']['size'] ) ? $settings['w_gaps']['size'] : 30;
		$tgaps  = isset( $settings['w_gaps_tablet']['size'] ) && is_numeric( $settings['w_gaps_tablet']['size'] ) ? $settings['w_gaps_tablet']['size'] : $gaps;
		$mgaps  = isset( $settings['w_gaps_mobile']['size'] ) && is_numeric( $settings['w_gaps_mobile']['size'] ) ? $settings['w_gaps_mobile']['size'] : $tgaps;

		?>
		<div class="xp-team-carousel"
    data-loop="<?php echo esc_attr( $settings['loop'] ); ?>"
    data-auto="<?php echo esc_attr( $settings['autoplay'] ); ?>"
    data-time="<?php echo esc_attr( $settings['timeout']['size'] ); ?>"
    data-arrows="<?php echo esc_attr( $settings['arrows'] ); ?>"
    data-dots="<?php echo esc_attr( $settings['dots'] ); ?>"
    data-show="<?php echo esc_attr( $shows ); ?>"
    data-tshow="<?php echo esc_attr( $tshows ); ?>"
    data-mshow="<?php echo esc_attr( $mshows ); ?>"
    data-gaps="<?php echo esc_attr( $gaps ); ?>"
    data-tgaps="<?php echo esc_attr( $tgaps ); ?>"
    data-mgaps="<?php echo esc_attr( $mgaps ); ?>">
			<div class="owl-carousel owl-theme">
				<?php foreach ( $settings['members'] as $key => $mem ) : 
					$photo_url = Group_Control_Image_Size::get_attachment_image_src( $mem['member_image']['id'], 'member_image_size', $settings );
					$photo = '<img src="' . esc_url( $photo_url ) . '" alt="' . esc_attr( $mem['member_name'] ) . '">';
					$tname = $mem['member_name'];

		            if ( ! empty( $mem['link']['url'] ) ) {
						$this->add_render_attribute( 'm_link' . $key, 'href', $mem['link']['url'] );

						if ( $mem['link']['is_external'] ) {
							$this->add_render_attribute( 'm_link' . $key, 'target', '_blank' );
						}

						if ( $mem['link']['nofollow'] ) {
							$this->add_render_attribute( 'm_link' . $key, 'rel', 'nofollow' );
						}
						$photo = '<a ' .$this->get_render_attribute_string( 'm_link' . $key ). '>' .$photo. '</a>';
						$tname = '<a ' .$this->get_render_attribute_string( 'm_link' . $key ). '>' .$tname. '</a>';
					}
				?>
				<div class="xp-team team-2 circle-social">
					<div class="team-thumb">
						<?php if( $mem['member_image']['url'] ) { echo wp_kses_post( $photo ); } ?>
					</div>
					<div class="team-info">
						<?php if ( $mem['member_name'] ) { echo '<h6 class="tname">' .$tname. '</h6>'; } ?>
						<?php if ( $mem['member_extra'] ) { echo '<span>' .$mem['member_extra']. '</span>'; } ?>
						<?php if ( $mem['socials'] ) : ?>
						<div class="team-social">
							<a <?php if( $mem['social1_link']['is_external'] ){ echo 'target="_blank"'; }else{ echo 'rel="nofollow"'; } ?> 
								href="<?php echo esc_url( $mem['social1_link']['url'] ); ?>">
								<?php Icons_Manager::render_icon( $mem['social1'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
							<?php if ( ! empty( $mem['social2'] ) ) : ?>
							<a <?php if( $mem['social2_link']['is_external'] ){ echo 'target="_blank"'; }else{ echo 'rel="nofollow"'; }?> 
								href="<?php echo esc_url( $mem['social2_link']['url'] ); ?>">
								<?php Icons_Manager::render_icon( $mem['social2'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
							<?php endif; ?>
							<?php if ( ! empty( $mem['social3'] ) ) : ?>
							<a <?php if( $mem['social3_link']['is_external'] ){ echo 'target="_blank"'; }else{ echo 'rel="nofollow"'; }?> 
								href="<?php echo esc_url( $mem['social3_link']['url'] ); ?>">
								<?php Icons_Manager::render_icon( $mem['social3'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
							<?php endif; ?>
						</div>  
						<?php endif; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	        
	    <?php
	}
}
// After the Restimo_Team_Carousel class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_Team_Carousel() );