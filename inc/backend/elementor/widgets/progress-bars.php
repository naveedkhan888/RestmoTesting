<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Progress Bars 
 */
class Restimo_Progress_Bars extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iprogress';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Progress Bars', 'restimo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-skill-bar';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_restimo' ];
	}

	protected function register_controls() {

		//Content Progress Bars
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'restimo' ),
			]
		);

		$this->add_control(
			'bar_style',
			[
				'label' 	=> __( 'Bar Style', 'restimo' ),
				'type'  	=> Controls_Manager::SELECT,
				'default' 	=> 'line',
				'options' 	=> [
					'line'    => __( 'Style 1: Line', 'restimo' ),
					'circle'  => __( 'Style 2: Circle', 'restimo' ),
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => 'Title',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Keyword Research', 'restimo' ),
			]
		);
		$this->add_control(
			'percent',
			[
				'label' => 'Percentage',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70,
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'percent_text',
			[
				'label'   => esc_html__( 'Show Percent Text', 'restimo' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
				'condition' => [
					'right_text!' => 'yes',
					'bar_style' => 'circle',
				]
			]
		);

		$this->end_controls_section();

		/* style */
		$this->start_controls_section(
			'bar_style_section',
			[
				'label' => __( 'Progress Bar', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bar_bg',
			[
				'label' => __( 'Background', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .circle-progress .inner-bar' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'bar_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#C19977',
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_responsive_control(
			'bar_height',
			[
				'label' => __( 'Height', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'default' => [
					'size' => 4,
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_responsive_control(
			'bar_size',
			[
				'label' => __( 'Circle Width', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'size' => 160,
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_control(
			'lbar_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#C19977',
				'selectors' => [
					'{{WRAPPER}} .progress-bar' => 'background: {{VALUE}};',
				],
				'condition' => [
					'bar_style' => 'line',
				]
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Line Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .inner-bar:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .iprogress' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'line_height_circle',
			[
				'label' => __( 'Line Height', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .inner-bar:after' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .iprogress' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'radius_line',
			[
				'label' => __( 'Border Radius', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .iprogress, {{WRAPPER}} .progress-bar' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'bar_style' => 'line',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_text_section',
			[
				'label' => __( 'Text', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/* title */
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
					'{{WRAPPER}} .line-progress h6' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .circle-progress h6' => 'margin-top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} h6' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} h6',
			]
		);

		/* percentage */
		$this->add_control(
			'heading_percent',
			[
				'label' => __( 'Percent', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'per_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .percent' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'per_bg',
			[
				'label' => __( 'Background', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .percent' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'per_typography',
				'selector' => '{{WRAPPER}} .percent',
			]
		);
		$this->add_responsive_control(
			'per_width',
			[
				'label' => __( 'Width', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .percent' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<?php if( $settings['bar_style'] == 'line' ) { ?>
		<div class="line-progress" data-percent="<?php echo esc_attr( $settings['percent']['size'] ); ?>">
	        <?php if( $settings['title'] ) echo '<h6>' . $settings['title'] . '</h6>'; ?>			
	        <div class="iprogress">
				<div class="progress-bar">
					<?php if( $settings['percent_text'] ) echo '<span class="percent"></span>'; ?>
				</div>
			</div>
	    </div>
		<?php }else{ ?>
		<div class="circle-progress" data-color="<?php echo esc_attr( $settings['bar_color'] ); ?>" data-height="<?php echo esc_attr( $settings['bar_height']['size'] ); ?>" data-size="<?php echo esc_attr( $settings['bar_size']['size'] ); ?>">
			<div class="inner-bar" data-percent="<?php echo esc_attr( $settings['percent']['size'] ); ?>">
				<span>
					<?php if( $settings['percent_text'] ) echo '<span class="percent">' . $settings['percent']['size'] . '</span>'; ?>
				</span>
			</div>
			<?php if( $settings['title'] ) echo '<h6>' . $settings['title'] . '</h6>'; ?>
		</div>
		
	    <?php }
	}

	public function get_keywords() {
		return [ 'circle', 'percent' ];
	}
}
// After the Restimo_Progress_Bars class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_Progress_Bars() );