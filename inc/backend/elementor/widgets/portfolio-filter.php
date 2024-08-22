<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Portfolio Filter
 */
class Restimo_PortfolioGrid extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ipfilter';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Portfolio Filter', 'restimo' );
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

		//Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'restimo' ),
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style Layout', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'p-grid',
				'options' => [
					'p-grid'  	 => __( 'Grid', 'restimo' ),
					'p-masonry'  => __( 'Masonry', 'restimo' ),
					'p-metro'  => __( 'Metro', 'restimo' ),
				],
			]
		);
		$this->add_control(
			'project_cat',
			[
				'label' => __( 'Select Categories', 'restimo' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_project(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'restimo' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'filter',
			[
				'label' => __( 'Show Filter', 'restimo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'restimo' ),
				'label_off' => __( 'Hide', 'restimo' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'all_text',
			[
				'label' => __( 'All Text', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'All',
				'condition' => [
					'filter' => 'yes',
				],
			]
		);
		$this->add_control(
			'count',
			[
				'label' => __( 'Show Count', 'restimo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'restimo' ),
				'label_off' => __( 'Hide', 'restimo' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'filter' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrow',
			[
				'label' => __( 'Show Arrow', 'restimo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'restimo' ),
				'label_off' => __( 'Hide', 'restimo' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'filter' => 'yes',
				],
			]
		);
		$this->add_control(
			'column',
			[
				'label' => __( 'Columns', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'pf_3_cols',
				'options' => [
					'pf_2_cols' => __( '2 Column', 'restimo' ),
					'pf_3_cols'	=> __( '3 Column', 'restimo' ),
					'pf_4_cols' => __( '4 Column', 'restimo' ),
					'pf_5_cols' => __( '5 Column', 'restimo' ),
				],
				'separator' => 'before',
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
				'selectors' => [
					'{{WRAPPER}} .project-item' => 'padding: calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .project-item.double_w .projects-thumbnail img' => 'margin-top: calc(-{{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .projects-grid' => 'margin: calc(-{{SIZE}}{{UNIT}}/2);',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'project_num',
			[
				'label' => __( 'Show Number Projects', 'restimo' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '6',
				'separator' => 'before',
			]
		);		
		$this->add_control(
			'load_more',
			[
				'label' => __( 'Load More Button', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Load More',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'loading_more',
			[
				'label' => __( 'Loading Text', 'restimo' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Loading...',
				'condition' => [
					'load_more[value]!' => '',
				]
			]
		);
		$this->add_control(
			'p_more',
			[
				'label' => __( 'Load Number Projects', 'restimo' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '3',
				'condition' => [
					'load_more[value]!' => '',
				]
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => __( 'Info Box Style', 'restimo' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  	=> __( 'Background Overlay', 'restimo' ),
					'style-2' 	=> __( 'Background Solid', 'restimo' ),
					'style-3' 	=> __( 'Hidden', 'restimo' ),
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'popup_thumb',
			[
				'label' => __( 'Popup Gallery', 'restimo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'restimo' ),
				'label_off' => __( 'No', 'restimo' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => 'style-3',
				],
			]
		);
		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'filter_style_section',
			[
				'label' => __( 'Filter', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'filter' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'filter_align',
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
					'{{WRAPPER}} .project_filters' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'filter_spacing',
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
					'{{WRAPPER}} .project_filters' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'filter_color',
			[
				'label' => __( 'Button Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .project_filters li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'filter_hcolor',
			[
				'label' => __( 'Active Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .project_filters li a:hover, {{WRAPPER}} .project_filters li a.selected, {{WRAPPER}} .project_filters li a:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_typography',
				'selector' => '{{WRAPPER}} .project_filters li a',
			]
		);
		$this->add_control(
			'count_color',
			[
				'label' => __( 'Count Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .project_filters li a span' => 'color: {{VALUE}};',
				],
				'condition' => [
					'count' => 'yes',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'count_typography',
				'selector' => '{{WRAPPER}} .project_filters li a span',
				'condition' => [
					'count' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'overlay_style_section',
			[
				'label' => __( 'Project Items', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_general',
			[
				'label' => __( 'General', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'overlay_align',
			[
				'label' => __( 'Alignment Info', 'restimo' ),
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
					'{{WRAPPER}} .projects-box .portfolio-info .portfolio-info-inner' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style-1','style-2'],
				]
			]
		);
		$this->add_control(
			'position',
			[
				'label' => __( 'Position Info', 'restimo' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'flex-start' => [
						'title' => __( 'Top', 'restimo' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Middle', 'restimo' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => __( 'Bottom', 'restimo' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style-1'],
				]
			]
		);
		$this->add_control(
			'overlay_background',
			[
				'label' => __( 'Background Overlay', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info, {{WRAPPER}} .style-3 .projects-thumbnail .overlay' => 'background: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style-1','style-3'],
				]
			]
		);
		$this->add_control(
			'info_background',
			[
				'label' => __( 'Background Info', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .style-2 .portfolio-info-inner' => 'background: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'style-2',
				]
			]
		);
		$this->add_responsive_control(
			'info_padding',
			[
				'label' => 'Padding Info',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .style-2 .portfolio-info-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'style-2',
				],
			]
		);
		$this->add_control(
			'scale_thumb',
			[
				'label' => __( 'Animation Image Hover', 'restimo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'restimo' ),
				'label_off' => __( 'No', 'restimo' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'radius_thumb',
			[
				'label' => __( 'Border Radius Image', 'restimo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .projects-box' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		/* icon */
		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon Button', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout' => ['style-1','style-3'],
				]
			]
		);
		$this->add_control(
			'show_icon',
			[
				'label' => __( 'Show Button', 'restimo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'restimo' ),
				'label_off' => __( 'Hide', 'restimo' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => ['style-1','style-3'],
				]
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info .plus, {{WRAPPER}} .style-3 .projects-thumbnail i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style-1','style-3'],
					'show_icon' => 'yes',
				]
			]
		);
		$this->add_control(
			'icon_bg',
			[
				'label' => __( 'Background', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info .plus, {{WRAPPER}} .style-3 .projects-thumbnail i' => 'background: {{VALUE}}; border-color: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style-1','style-3'],
					'show_icon' => 'yes',
				]
			]
		);

		/* title */
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout' => ['style-1','style-2'],
				]
			]
		);
		$this->add_responsive_control(
			'title_spacing',
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
					'{{WRAPPER}} .projects-box .portfolio-info h5' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['style-1','style-2'],
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
					'{{WRAPPER}} .projects-box .portfolio-info h5 a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style-1','style-2'],
				]
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Hover Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info h5 a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style-1','style-2'],
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .projects-box .portfolio-info h5 a',
				'condition' => [
					'layout' => ['style-1','style-2'],
				]
			]
		);

		/* category */
		$this->add_control(
			'heading_cat',
			[
				'label' => __( 'Category', 'restimo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout' => ['style-1','style-2'],
				]
			]
		);
		$this->add_control(
			'show_cat',
			[
				'label' => __( 'Show Category', 'restimo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'restimo' ),
				'label_off' => __( 'Hide', 'restimo' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => ['style-1','style-2'],
				]
			]
		);
		$this->add_control(
			'cat_color',
			[
				'label' => __( 'Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info .portfolio-cates a' => 'color: {{VALUE}}; background-image: linear-gradient(0deg, {{VALUE}}, {{VALUE}});',
					'{{WRAPPER}} .projects-box .portfolio-info .portfolio-cates' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_cat' => 'yes',
					'layout' => ['style-1','style-2'],
				]
			]
		);
		$this->add_control(
			'cat_hcolor',
			[
				'label' => __( 'Hover', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info .portfolio-cates a:hover' => 'color: {{VALUE}}; background-image: linear-gradient(0deg, {{VALUE}}, {{VALUE}});',
				],
				'condition' => [
					'show_cat' => 'yes',
					'layout' => ['style-1','style-2'],
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'selector' => '{{WRAPPER}} .projects-box .portfolio-info .portfolio-cates a, {{WRAPPER}} .projects-box .portfolio-info .portfolio-cates span',
				'condition' => [
					'show_cat' => 'yes',
					'layout' => ['style-1','style-2'],
				]
			]
		);
		$this->end_controls_section();	
		
		/* button */
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Load More Button', 'restimo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'load_more[value]!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'btn_align',
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
					'{{WRAPPER}} .btn-block' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'btn_spacing',
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
					'{{WRAPPER}} .xptf-btn' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'restimo' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xptf-btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xptf-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'restimo' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xptf-btn:hover, {{WRAPPER}} .xptf-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'restimo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xptf-btn:hover, {{WRAPPER}} .xptf-btn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="project-filter-wrapper">
			<?php if( 'yes' === $settings['filter'] ) { ?>
	        	<div class="container">
	        		<ul class="project_filters <?php if( 'yes' !== $settings['arrow'] ) echo 'no-arrow'; ?>">
	        			<?php if( $settings['all_text'] != '' ) { ?>
	        			 	<li><a href="#" data-filter="*" class="selected"><?php echo esc_html( $settings['all_text'] ); if( $settings['count'] ) echo '<span class="filter-count"></span>'; ?></a></li>
	        			<?php } ?>
		                <?php
		                if( $settings['project_cat'] ){
		                    $categories = $settings['project_cat'];
		                    foreach( (array)$categories as $categorie){
		                        $cates = get_term_by('term_id', $categorie, 'portfolio_cat');
		                        $cat_name = $cates->name;
		                        $cat_slug = $cates->slug;
		                        $cat_id   = 'category-' . $cates->term_id;

		                ?>
		                	<li>
								<a href='#' data-filter='.<?php echo esc_attr( $cat_id ); ?>'><?php echo esc_html( $cat_name ); if( $settings['count'] ) echo '<span class="filter-count"></span>'; ?></a>
							</li>	                   
		                <?php } }else{
		                    $categories = get_terms('portfolio_cat');
		                    foreach( (array)$categories as $categorie){
		                        $cat_name = $categorie->name;
		                        $cat_slug = $categorie->slug;
		                        $cat_id   = 'category-' . $categorie->term_id;
		                    ?>
		                    <li>
								<a href='#' data-filter='.<?php echo esc_attr( $cat_id ); ?>'><?php echo esc_html( $cat_name ); if( $settings['count'] ) echo '<span class="filter-count"></span>'; ?></a>
							</li>	                    
		                <?php } } ?>
					</ul>
				</div>
	        <?php } ?>
			<?php 
				$cat_ids = '';
	        	if( $settings['project_cat'] ) {
	                $args = array(	                    
	                    'post_type' => 'xp_portfolio',
	                    'post_status' => 'publish',
	                    'tax_query' => array(
	                        array(
	                            'taxonomy' => 'portfolio_cat',
	                            'field' => 'term_id',
	                            'terms' => $settings['project_cat'],
	                        ),
	                    ),              
					);
					$cat_ids = implode(",", $settings['project_cat']);
	            } else {
	                $args = array(
	                    'post_type' => 'xp_portfolio',
	                    'post_status' => 'publish',
	                );
	            }
	            $the_query = new \WP_Query($args);
				$count = $the_query->found_posts;
	        ?>
	        <div class="projects-grid <?php echo esc_attr( $settings['column'].' '.$settings['layout']; if( $settings['popup_thumb'] ) echo ' img-popup'; if( $settings['scale_thumb'] ) echo ' img-scale'; if( !$settings['show_cat'] ) echo ' no-cat'; if( !$settings['show_icon'] ) echo ' no-icon'; ?>" data-load="<?php echo esc_attr( $settings['p_more'] ); ?>" data-count="<?php echo esc_attr( $count ); ?>">
			<div class="grid-sizer"></div>
	            <?php
	            if( $settings['project_cat'] ){
	                $args = array(	                    
	                    'post_type' => 'xp_portfolio',
	                    'post_status' => 'publish',
	                    'posts_per_page' => $settings['project_num'],
	                    'tax_query' => array(
	                        array(
	                            'taxonomy' => 'portfolio_cat',
	                            'field' => 'term_id',
	                            'terms' => $settings['project_cat'],
	                        ),
	                    ),              
	                );
	            }else{
	                $args = array(
	                    'post_type' => 'xp_portfolio',
	                    'post_status' => 'publish',
	                    'posts_per_page' => $settings['project_num'],
	                );
	            }
	            $wp_query = new \WP_Query($args);
	            while ($wp_query -> have_posts()) : $wp_query -> the_post();
				
				if( $settings['style'] == 'p-masonry' ){
					get_template_part( 'template-parts/content', 'project-masonry' );
				}elseif( $settings['style'] == 'p-metro' ){
					get_template_part( 'template-parts/content', 'project-metro' );
				}else{
					get_template_part( 'template-parts/content', 'project' );
				}

	            endwhile; wp_reset_postdata(); ?>
			</div>

			<?php if( $settings['load_more'] && $count >= $settings['project_num'] ) echo '<div class="btn-block"><span class="btn-loadmore xptf-btn" data-category="'.$cat_ids.'" data-loaded="'.$settings['load_more'].'" data-loading="'.$settings['loading_more'].'" data-style="'.$settings['style'].'">'.$settings['load_more'].'</span></div>'; ?>
	    </div>
										
	    <?php
	}

	public function get_keywords() {
		return [ 'isotope', 'project', 'grid' ];
	}

	protected function select_param_cate_project() {
		$category = get_terms( 'portfolio_cat' );
		$cat = array();
		foreach( $category as $item ) {
		   if( $item ) {
			  $cat[$item->term_id] = $item->name;
		   }
		}
		return $cat;
	}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_PortfolioGrid() );