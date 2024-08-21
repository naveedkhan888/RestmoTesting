<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Menu
 */
class Restimo_Menu extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'imenu';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Nav Menu', 'restimo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_restimo_header' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Menu', 'restimo' ),
			]
		);

		$menus = $this->get_available_menus();
		$this->add_control(
			'nav_menu',
			[
				'label' => esc_html__( 'Select Menu', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'options' => $menus,
				'default' => array_keys( $menus )[0],
				'save_default' => true,

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
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/*** Style ***/
		//menu parents
		$this->start_controls_section(
			'style_menu_section',
			[
				'label' => __( 'Menu Parents', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'space_item',
			[
				'label' => __( 'Spacing Items', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-navigation > ul > li' => 'margin: 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .main-navigation > ul > li:last-child' => 'margin-right: 0;',
					'{{WRAPPER}} .main-navigation > ul > li:first-child' => 'margin-left: 0;',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation > ul > li > a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Arrow Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation > ul > li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_hover_color',
			[
				'label' => __( 'Text Hover Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul > li:hover > a, {{WRAPPER}} .main-navigation ul > li.menu-item-has-children:hover > a:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .main-navigation > ul > li:before' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'selector' => '{{WRAPPER}} .main-navigation > ul',
			]
		);

		$this->end_controls_section();

		//menu child
		$this->start_controls_section(
			'style_smenu_section',
			[
				'label' => __( 'Dropdown Menus', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'smenu_width',
			[
				'label' => __( 'Width', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 250,
						'max' => 700,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul li ul' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'smenu_radius',
			[
				'label' => __( 'Border Radius', 'restimo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'smenu_shadow',
				'selector' => '{{WRAPPER}} .main-navigation ul ul',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'bg_s_color',
			[
				'label' => __( 'Background Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul, {{WRAPPER}} .main-navigation ul ul:after' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'item_title',
			[
				'label' => __( 'Menu Items', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'text_s_color',
			[
				'label' => __( 'Text Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul a, {{WRAPPER}} .main-navigation ul ul > li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_s_hover_color',
			[
				'label' => __( 'Text Hover Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul a:hover, {{WRAPPER}} .main-navigation ul ul li.current-menu-item > a, {{WRAPPER}} .main-navigation ul > li.menu-item-has-children > a:hover:after' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'bg_s_hover_color',
			[
				'label' => __( 'Background Hover Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul li li a:hover, {{WRAPPER}} .main-navigation ul ul li.current-menu-item > a' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'border_s_color',
			[
				'label' => __( 'Border Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul li li a' => 'border-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'smenu_typography',
				'selector' => '{{WRAPPER}} .main-navigation ul ul a',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

	}

	protected function get_available_menus(){

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
   }

   	protected function render() {
		$settings = $this->get_settings_for_display();
		$active_mmenu = in_array('xp_mega-menu/xp_mega-menu.php', apply_filters('active_plugins', get_option('active_plugins')));
	?>
			<nav id="site-navigation" class="main-navigation">			
				<?php
					wp_nav_menu( array(
						'menu' 			 => $settings['nav_menu'],
						'menu_id'        => 'primary-menu',
						'container'      => 'ul',
						'theme_location' => '__no_such_location',
    					'fallback_cb'    => '__return_empty_string', 
    					'walker'         => $active_mmenu ? new \Xp_Mega_Menu_Walker() : '',
					) );
				?>
			</nav>
	    <?php
	}

}
// After the Restimo_Menu class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_Menu() );