<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Icon Box Grid
 */
class Restimo_IconBox_Grid extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iiconbox_grid';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Icon Box Grid', 'restimo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_restimo' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Icon Boxes', 'restimo' ),
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
					],
				],
				// 'prefix_class' => 'restimo%s-align-',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'column_grid',
			[
				'label' => __( 'Columns', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'col-md-4',
				'options' => [
					'col-md-12' => __( '1', 'restimo' ),
					'col-md-6'  => __( '2', 'restimo' ),
					'col-md-4'  => __( '3', 'restimo' ),
					'col-md-3'  => __( '4', 'restimo' ),
				]
			]
		);

		$repeater = new Repeater();

		
		$repeater->add_control(
			'icon_font',
			[
				'label' => __( 'Icon', 'restimo' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Content Marketing', 'restimo' ),
			]
		);

		$repeater->add_control(
			'des',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'You can provide the answers that your potential customers are trying to find, so you can become the industry.', 'restimo' ),
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
		    'icon_boxes',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		            [
		            	'icon_font' => __( 'fas fa-star', 'restimo' ),
		             	'title' => esc_html__( 'Content Marketing', 'restimo' ),
		                'des'	=> esc_html__( 'You can provide the answers that your potential customers are trying to find, so you can become the industry.', 'restimo' ),
		             	'link' => '',
		            ],
		            [
		            	'icon_font' => __( 'fas fa-star', 'restimo' ),
		             	'title' => esc_html__( 'Content Marketing', 'restimo' ),
		                'des'	=> esc_html__( 'You can provide the answers that your potential customers are trying to find, so you can become the industry.', 'restimo' ),
		             	'link' => '',
		            ],
		            [
		            	'icon_font' => __( 'fas fa-star', 'restimo' ),
		             	'title' => esc_html__( 'Content Marketing', 'restimo' ),
		                'des'	=> esc_html__( 'You can provide the answers that your potential customers are trying to find, so you can become the industry.', 'restimo' ),
		             	'link' => '',
		            ]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);
		$this->add_control(
			'header_size',
			[
				'label' => __( 'Title HTML Tag', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h6',
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_box_section',
			[
				'label' => __( 'Boxes', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bg_box',
			[
				'label' => __( 'Background', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bg_hover_box',
			[
				'label' => __( 'Border Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Border Radius', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box-grid' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding Box', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'heading_shadow',
			[
				'label' => __( 'Hover Box Shadow', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .icon-box:hover',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-main i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-main svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-main i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-main svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_space',
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
					'{{WRAPPER}} .icon-main' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .title-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .title-box' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title-box',
			]
		);

		//Description
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
					'{{WRAPPER}} .icon-box p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .icon-box p',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'heading', 'class', 'title-box' );		
		?>
		<div class="icon-box-grid">
			<?php if ( ! empty( $settings['icon_boxes'] ) ) : foreach ( $settings['icon_boxes'] as $key => $boxes ) : ?>
			<div class="<?php echo esc_attr( $settings['column_grid'] ); ?> no-padding">
				<div class="icon-box">
					<div class="icon-main">
						<?php if ( ! empty( $boxes['icon_font']['value'] ) ) { Icons_Manager::render_icon( $boxes['icon_font'], [ 'aria-hidden' => 'true' ] ); } ?>
					</div>
			        <div class="content-box">
			        	<?php 
							$title = $boxes['title'];
							$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $title );
							if ( ! empty( $boxes['link']['url'] ) ) {
								$this->add_render_attribute( 'iconbox'.$key, 'href', $boxes['link']['url'] );

								if ( $boxes['link']['is_external'] ) {
									$this->add_render_attribute( 'iconbox'.$key, 'target', '_blank' );
								}

								if ( $boxes['link']['nofollow'] ) {
									$this->add_render_attribute( 'iconbox'.$key, 'rel', 'nofollow' );
								}
								$title_html = sprintf( '<%1$s %2$s><a ' .$this->get_render_attribute_string( 'iconbox'.$key ). '>%3$s</a></%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $title );
							}
			        	?>
			            <?php if( ! empty( $boxes['title'] ) ) { echo wp_kses_post( $title_html ); } ?>
			            <?php if( $boxes['des'] ) { echo '<p>' .$boxes['des']. '</p>'; } ?>
			        </div>
			    </div>
		    </div>
		    <?php endforeach; endif; ?>
		</div>
	    <?php
	}

	public function get_keywords() {
		return [ 'service', 'grid' ];
	}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_IconBox_Grid() );