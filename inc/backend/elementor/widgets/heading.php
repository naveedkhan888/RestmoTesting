<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Heading 
 */
class Restimo_Heading extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iheading';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Heading', 'restimo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-icon-box';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_restimo' ];
	}

	public static function get_subtitle_style() {
		return [
			'' 				=> __( 'Default', 'restimo' ),
			'is_highlight' 	=> __( 'Highlight', 'restimo' ),
			'is_line' 		=> __( 'Line', 'restimo' ),
		];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'restimo' ),
			]
		);

		$this->add_control(
			'sub',
			[
				'label' => __( 'Subtitle', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'our services', 'restimo' ),
				'placeholder' => __( 'Enter your subtitle', 'restimo' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'What we do', 'restimo' ),
				'placeholder' => __( 'Enter your title', 'restimo' ),
				'label_block' => true,
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
				'default' => 'h2',
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
				'default' => '',
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Heading', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Subtitle
		$this->add_control(
			'heading_stitle',
			[
				'label' => __( 'Subtitle', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'subtitle_style',
			[
				'label' => __( 'Subtitle Style', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => self::get_subtitle_style(),
			]
		);
		$this->add_responsive_control(
			'line_width',
			[
				'label' => __( 'Width', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span.is_line:before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xp-heading > span.is_line' => 'padding-left: calc({{SIZE}}{{UNIT}} + 15px);',
				],
				'condition'	=> [
					'subtitle_style'	=> 'is_line'
				]
			]
		);

		$this->add_control(
			'stitle_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .xp-heading > span.is_line:before' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'stitle_bg',
			[
				'label' => __( 'Background color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'background: {{VALUE}};',
				],
				'condition'	=> [
					'subtitle_style'	=> 'is_highlight'
				]
			]
		);
		$this->add_control(
			'stitle_border',
			[
				'label' => __( 'Border Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'border-color: {{VALUE}};',
				],
				'condition'	=> [
					'subtitle_style'	=> 'is_highlight'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'stitle_typography',
				'selector' => '{{WRAPPER}} .xp-heading > span',
			]
		);
		$this->add_responsive_control(
			'stitle_bottom_space',
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
					'{{WRAPPER}} .xp-heading > span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
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
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading .main-head' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .xp-heading .main-head',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$hl = $settings['subtitle_style'];
		

		$this->add_render_attribute( 'subtitle', 'class', $hl );
		$this->add_render_attribute( 'heading', 'class', 'main-head' );
		$title = $settings['title'];
		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $title );
		?>
		<div class="xp-heading">
	        <?php if( ! empty( $settings['sub'] ) ) { echo '<span '.$this->get_render_attribute_string( 'subtitle' ).'>' .$settings['sub']. '</span>'; } ?>
	        <?php if( ! empty( $settings['title'] ) ) { echo wp_kses_post( $title_html ); } ?>
	    </div>
	    <?php
	}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_Heading() );