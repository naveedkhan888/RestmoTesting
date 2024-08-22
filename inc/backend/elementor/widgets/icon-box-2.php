<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Icon Box 2
 */
class Restimo_IconBox2 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iiconbox2';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Icon Box 2', 'restimo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-icon-box';
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
				'label' => __( 'Icon Box', 'restimo' ),
			]
		);
		$this->add_control(
			'box_style',
			[
				'label' => __( 'Box Style', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'default' => 's1',
				'options' => [
					's1'   => __( 'Style 1', 'restimo' ),
					's2'   => __( 'Style 2', 'restimo' ),
				],
				'prefix_class' => 'box-',
			]
		);
		$this->add_responsive_control(
			'icon_pos',
			[
				'label' => __( 'Icon Position', 'restimo' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'restimo' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'restimo' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'icon-',
				'toggle' => false,
			]
		);
		$this->add_control(
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

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'restimo' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Design & Planning', 'restimo' ),
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
				'default' => 'h5',
			]
		);

		$this->add_control(
			'des',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'We will help you to get the result you dreamed of.', 'restimo' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'restimo' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'restimo' ),
				'default'	=> [
					'url'	=> '#'
				],
			]
		);

		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'style_box_section',
			[
				'label' => __( 'General', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);		

		$this->add_control(
			'is_line',
			[
				'label'   => esc_html__( 'Bottom Line', 'restimo' ),
				'type'    => Controls_Manager::SWITCHER,
				'prefix_class' => 'bline-',
				'default' => 'no',
				'condition' => [
					'box_style'	=> 's1'
				]
			]
		);
		$this->add_control(
			'line_color',
			[
				'label' => __( 'Line Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box .content-box' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'is_line'	=> 'yes',
					'box_style'	=> 's1'
				]
			]
		);
		$this->add_control(
			'hiver_line_color',
			[
				'label' => __( 'Hover Line Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box .content-box:after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'is_line'	=> 'yes',
					'box_style'	=> 's1'
				]
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'restimo' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'prefix_class' => 'elementor-animation-',
			]
		);

		$this->start_controls_tabs( 'tabs_box_style' );
		$this->start_controls_tab(
			'tab_bg_normal',
			[
				'label' => __( 'Normal', 'restimo' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-main i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-main svg' => 'fill: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'icon_bg',
			[
				'label' => __( 'Background Icon', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-main' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box .title-box, {{WRAPPER}} .icon-box .title-box a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'des_color',
			[
				'label' => __( 'Description Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box p' => 'color: {{VALUE}};',
				],
				'condition' => [
					'des!' => ''
				]
			]
		);

		$this->add_control(
			'bg_box',
			[
				'label' => __( 'Background Box', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .content-box' => 'background: {{VALUE}};',
				],
				'condition' => [
					'box_style'	=> 's2'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .content-box',
				'condition' => [
					'box_style'	=> 's2'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_bg_hover',
			[
				'label' => __( 'Hover', 'restimo' ),
			]
		);
		$this->add_control(
			'bg_hover_icon_color',
			[
				'label' => __( 'Icon Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover .icon-main' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-box:hover svg' => 'fill: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'bg_hover_icon_bg',
			[
				'label' => __( 'Background Icon', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover .icon-main' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover .title-box, {{WRAPPER}} .icon-box:hover .title-box a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'des_hcolor',
			[
				'label' => __( 'Description Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover p' => 'color: {{VALUE}};',
				],
				'condition' => [
					'des!' => ''
				]
			]
		);
		$this->add_control(
			'bg_hover_box',
			[
				'label' => __( 'Background Box', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover .content-box' => 'background: {{VALUE}};',
				],
				'condition' => [
					'box_style'	=> 's2'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hover_box_shadow',
				'selector' => '{{WRAPPER}} .icon-box:hover .content-box',
				'condition' => [
					'box_style'	=> 's2'
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.icon-left .content-box' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.icon-right .content-box' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'box_style'	=> 's1'
				]
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
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-main i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-main svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'icon_bg_width',
			[
				'label' => __( 'Background Width', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-main' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-main i' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.box-s2.icon-left .icon-box' => 'padding-left: calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}}.box-s2.icon-right .icon-box' => 'padding-right: calc({{SIZE}}{{UNIT}}/2);',
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
					'{{WRAPPER}} .icon-main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'selector' => '{{WRAPPER}} .icon-main',
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

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => 'Padding Content',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}.box-s2 .content-box, {{WRAPPER}}.box-s1 .icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'restimo' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'title_space_top',
			[
				'label' => __( 'Top Spacing', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box .title-box' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'box_style'	=> 's1'
				]
			]
		);
		$this->add_responsive_control(
			'title_space_bottom',
			[
				'label' => __( 'Bottom Spacing', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box .title-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Hover Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box .title-box a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!' => '',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .icon-box .title-box',
			]
		);

		//Description
		$this->add_control(
			'heading_des',
			[
				'label' => __( 'Description', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'des!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .icon-box p',
				'condition' => [
					'des!' => ''
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'heading', 'class', 'title-box' );
		$title = $settings['title'];
		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $title );
		
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'iconbox', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'iconbox', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'iconbox', 'rel', 'nofollow' );
			}
			$title_html = sprintf( '<%1$s %2$s><a ' .$this->get_render_attribute_string( 'iconbox' ). '>%3$s</a></%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $title );
		}

		?>
		<div class="icon-box icon-box-2">
			<div class="icon-main">
		        <?php if( $settings['icon_font'] != '' ) { Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); } ?>
	        </div>
	        <div class="content-box">
				<?php if( $settings['title'] ) { echo wp_kses_post( $title_html ); } ?>
				<?php if( $settings['des'] ) { echo '<p>' .$settings['des']. '</p>'; } ?>
			</div>
	    </div>
	    <?php
	}

	public function get_keywords() {
		return [ 'service' ];
	}
}
// After the Restimo_IconBox2 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_IconBox2() );