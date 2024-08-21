<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Tabs
 */
class Restimo_Tabs extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'itabs';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Tabs', 'restimo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-tabs';
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
				'label' => __( 'Tabs', 'restimo' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Description', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'restimo' ),
				'placeholder' => __( 'Tab Title', 'restimo' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'restimo' ),
				'default' => __( 'Tab Content', 'restimo' ),
				'placeholder' => __( 'Tab Content', 'restimo' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		$this->add_control(
			'xp_tabs',
			[
				'label' => __( 'Tabs Items', 'restimo' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Tab #1', 'restimo' ),
						'tab_content' => __( 'We help ambitious businesses like yours generate more profits by building awareness, driving web traffic, connecting with customers, and growing overall sales. Give us a call.', 'restimo' ),
					],
					[
						'tab_title' => __( 'Tab #2', 'restimo' ),
						'tab_content' => __( 'We help ambitious businesses like yours generate more profits by building awareness, driving web traffic, connecting with customers, and growing overall sales. Give us a call.', 'restimo' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->end_controls_section();

		//Style
		/* title */
		$this->start_controls_section(
			'style_title',
			[
				'label' => __( 'Title', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'title_width',
			[
				'label' => __( 'Width', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-tabs .tab-link' => 'min-width: {{SIZE}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .xp-tabs .tab-link' => 'margin: 0 calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .xp-tabs .tabs-heading' => 'margin: 0 calc(-{{SIZE}}{{UNIT}}/2);',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .xp-tabs .tab-link',
				'separator' => 'before',
			]
		);
		
		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'restimo' ),
			]
		);

		$this->add_control(
			'title_bgcolor',
			[
				'label' => __( 'Background', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-tabs .tab-link:not(.current)' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-tabs .tab-link:not(.current)' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .xp-tabs .tab-link',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Active/Hover', 'restimo' ),
			]
		);

		$this->add_control(
			'title_bg_active',
			[
				'label' => __( 'Background', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-tabs .tab-link.current, {{WRAPPER}} .xp-tabs .tab-link:hover' => 'background: {{VALUE}};',
				]
			]
		);
		
		$this->add_control(
			'title_color_active',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-tabs .tab-link.current, {{WRAPPER}} .xp-tabs .tab-link:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_border_active',
			[
				'label' => __( 'Border Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-tabs .tab-link.current, {{WRAPPER}} .xp-tabs .tab-link:hover' => 'border-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/* content */
		$this->start_controls_section(
			'style_content',
			[
				'label' => __( 'Content', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-tabs .tab-content' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tab-content ul li:before, {{WRAPPER}} .tab-content ol li:before' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .xp-tabs .tab-content',
			]
		);
		
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-tabs .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="xp-tabs">
			<?php $random = rand(1,1000); if ( $settings['xp_tabs'] ) : ?>
			<ul class="tabs-heading unstyle">
				<?php $i = 1; foreach ( $settings['xp_tabs'] as $tabs ) { ?>
				<li class='tab-link' data-tab='tab-<?php echo esc_attr( $i . $random ); ?>'>
				    <?php echo esc_html( $tabs['tab_title'] ); ?>
				</li>
				<?php $i++; } ?>
			</ul>
			<?php $j = 1; foreach ( $settings['xp_tabs'] as $tabs ) { ?>
			<div id="tab-<?php echo esc_attr($j.$random); ?>" class="tab-content">
				<?php echo wp_kses_post( $tabs['tab_content'] ); ?>
			</div>
			<?php $j++; } endif; ?>
	    </div>

	    <?php
	}

}
// After the Restimo_Tabs class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_Tabs() );