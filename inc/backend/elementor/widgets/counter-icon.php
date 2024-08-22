<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Counter 2
 */
class Restimo_Counter2 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'icounter2';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Counter 2', 'restimo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-counter';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_restimo' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Counter', 'restimo' ),
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
					'{{WRAPPER}} .xp-counter-2' => 'text-align: {{VALUE}};',
				],
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
				'label' => __( 'Title:', 'restimo' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Current Clients', 'restimo' ),
			]
		);

		$this->add_control(
			'number',
			[
				'label' => 'Number:',
				'type' => Controls_Manager::TEXT,
				'default' => __( '180', 'restimo' ),
			]
		);

		$this->add_control(
			'after_number',
			[
				'label' => __( 'After Number:', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'restimo' ),
			]
		);		

		$this->add_control(
			'time',
			[
				'label' => __( 'Duration', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 10000,
						'step' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2000,
				],
			]
		);

		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Style', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/* icon */
		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
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
					'{{WRAPPER}} .xp-counter-2 i, {{WRAPPER}} .xp-counter-2 svg' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xp-counter-2 i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .xp-counter-2 svg' => 'fill: {{VALUE}};',
				]
			]
		);

		/* number */
		$this->add_control(
			'heading_number',
			[
				'label' => __( 'Number', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-counter-2 span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .xp-counter-2 span',
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
					'{{WRAPPER}} .xp-counter-2 > p' => 'margin-top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .xp-counter-2 > p' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .xp-counter-2 > p',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="xp-counter-2 icounter" data-counter="<?php echo esc_attr( $settings['number'] ); ?>">
			<?php if ( ! empty( $settings['icon_font']['value'] ) ) { Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); } ?>
        	<div class="c-number font-second">
        		<span class="num" data-to="<?php echo esc_attr( $settings['number'] ); ?>" data-time= "<?php echo esc_attr( $settings['time']['size'] ); ?>"></span><?php if( $settings['after_number'] ) { echo '<span>' .$settings['after_number']. '</span>'; } ?>
        	</div>
        	<?php if( $settings['title'] ) { echo '<p>' .$settings['title']. '</p>'; } ?>      				        
	    </div>
	    <?php
	}

	public function get_keywords() {
		return [ 'number', 'funfact' ];
	}
}
// After the Restimo_Counter class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_Counter2() );