<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Icon Box 1
 */
class Restimo_IconBox1 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iiconbox1';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Icon Box 1', 'restimo' );
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => 'center',
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

		$this->add_control(
			'btn_text',
			[
				'label' => __( 'Label Button', 'restimo' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '<i class="xp-flaticon-trajectory"></i> Learn More', 'restimo' ),
				'condition' => [
					'link[url]!' => '',
				]
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
				'default' => 'yes',
			]
		);
		$this->add_control(
			'line_color',
			[
				'label' => __( 'Line Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'is_line'	=> 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => 'Padding Box',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
			'bg_box',
			[
				'label' => __( 'Background Box', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .icon-box',
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
			'hover_dark',
			[
				'label'   => esc_html__( 'Dark Style', 'restimo' ),
				'type'    => Controls_Manager::SWITCHER,
				'prefix_class' => 'hover-dark-',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'bg_hover_box',
			[
				'label' => __( 'Background Box', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover' => 'background: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hover_box_shadow',
				'selector' => '{{WRAPPER}} .icon-box:hover',
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
				'separator' => 'before',
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
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hover_icon_shadow',
				'selector' => '{{WRAPPER}} .icon-box:hover .icon-main',
			]
		);
		$this->add_control(
			'bg_hover_title_color',
			[
				'label' => __( 'Title Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover .title-box, {{WRAPPER}} .icon-box:hover .title-box a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'bg_hover_des_color',
			[
				'label' => __( 'Description Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover p' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'des!' => ''
				]
			]
		);

		$this->add_control(
			'bg_hover_link_btn_color',
			[
				'label' => __( 'Button Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover .link-details' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'btn_text!'	 => '',
				]
			]
		);
		$this->add_control(
			'heading_hcircle',
			[
				'label' => __( 'Border Circle', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'is_border' => 'yes',
				]
			]
		);

		$this->add_control(
			'circle_hcolor',
			[
				'label' => __( 'Border Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box-1:hover .icon-main .circle-animate' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'is_border' => 'yes',
				]
			]
		);
		$this->add_control(
			'dot_hcolor',
			[
				'label' => __( 'Dot Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box-1:hover .icon-main .circle-animate:after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'is_border' => 'yes',
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
		$this->add_control(
			'is_border',
			[
				'label'   => esc_html__( 'Border Circle', 'restimo' ),
				'type'    => Controls_Manager::SWITCHER,
				'prefix_class' => 'with-border-',
				'default' => 'no',
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
					'{{WRAPPER}} .circle-animate' => 'width: calc({{SIZE}}{{UNIT}} + 30px); height: calc({{SIZE}}{{UNIT}} + 30px);',
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
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'restimo' ),
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
				'label' => __( 'Background', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-main' => 'background: {{VALUE}};',
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

		/* circle animate */
		$this->add_control(
			'heading_circle',
			[
				'label' => __( 'Border Circle', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'is_border' => 'yes',
				]
			]
		);
		$this->add_control(
			'circle_color',
			[
				'label' => __( 'Border Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .circle-animate' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'is_border' => 'yes',
				]
			]
		);
		$this->add_control(
			'dot_color',
			[
				'label' => __( 'Dot Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .circle-animate:after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'is_border' => 'yes',
				]
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
					'{{WRAPPER}} .icon-box .title-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .icon-box .title-box, {{WRAPPER}} .icon-box .title-box a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hover_color',
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
		$this->add_control(
			'des_color',
			[
				'label' => __( 'Color', 'restimo' ),
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

		//Button Link
		$this->add_control(
			'heading_link',
			[
				'label' => __( 'Button', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'link[url]!' => '',
					'btn_text!'	 => '',
				]
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
					'{{WRAPPER}} .icon-box .link-details' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'link[url]!' => '',
					'btn_text!'	 => '',
				]
			]
		);
		$this->add_control(
			'link_btn_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box .link-details' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!' => '',
					'btn_text!'	 => '',
				]
			]
		);
		$this->add_control(
			'link_btn_hover_color',
			[
				'label' => __( 'Hover Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box .link-details:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!' => '',
					'btn_text!'	 => '',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_btn_typography',
				'selector' => '{{WRAPPER}} .icon-box .link-details',
				'condition' => [
					'link[url]!' => '',
					'btn_text!'	 => '',
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
		<div class="icon-box icon-box-1">
			<div class="icon-main">
				<span class="circle-animate"></span>
		    	<?php if( $settings['icon_font'] != '' ) { Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); } ?>
	        </div>
	        <div class="content-box">
				<?php if( $settings['title'] ) { echo $title_html; } ?>
				<?php if( $settings['des'] ) { echo '<p>' .$settings['des']. '</p>'; } ?>
			</div>
			<?php if( $settings['btn_text'] ) { 
        	echo '<div class="link-box">
        			<a ' .$this->get_render_attribute_string( 'iconbox' ). 'class="link-details">' .$settings['btn_text']. '</a>
        		</div>';
	        } ?>	
	    </div>
	    <?php
	}

	public function get_keywords() {
		return [ 'service' ];
	}
}
// After the Restimo_IconBox1 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_IconBox1() );