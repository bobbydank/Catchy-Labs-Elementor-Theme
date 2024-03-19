<?php

namespace CL\Elementor\Theme\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Search extends Widget_Base {
    
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-search';
	}
    
    /**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Site Search', 'cl-elementor' );
	}
    
    /**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-search';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'theme-widgets' ];
	}
    
    /**
	 * Register widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
        //creates the content section where everything is going.
        $this->start_controls_section(
			'content',
			[
				'label' => __( 'Content', 'cl-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'search_type',
			[
				'label'   => __( 'Search Type', 'cl-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'icon'  => 'Icon (opens overlay)',
					'form'  => 'Search Form'
				),
			]
		);

		$this->add_responsive_control( 
            'form_align', 
            [
                'label'     => __( 'Form Alignment', 'elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start'   => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end'  => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #searchform' => 'justify-content: {{VALUE}};',
                ],
				'condition' => array(
					'search_type' => 'form',
				),
		    ] 
        );
        
        $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa-solid fa-magnifying-glass',
					'library' => 'solid',
				],
				'condition' => array(
					'search_type' => 'icon',
				),
			]
		);

        $this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cl-search-icon' => 'color: {{VALUE}}',
				],
				'condition' => array(
					'search_type' => 'icon',
				),
			]
		);

        $this->add_responsive_control( 
            'icon_align', 
            [
                'label'     => __( 'Alignment', 'elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cl-search-icon' => 'text-align: {{VALUE}};',
                ],
				'condition' => array(
					'search_type' => 'icon',
				),
		    ] 
        );

        $this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'rem', 'em' ],
				'range' => [
					'rem' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
                    ],
                    'em' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .cl-search-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => array(
					'search_type' => 'icon',
				),
			]
		);
        
        $this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Settings', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hide_button',
			[
				'label' => esc_html__( 'Special Last Item', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'your-plugin' ),
				'label_off' => esc_html__( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => '',
				'selectors'  => [
					'{{WRAPPER}} #searchform .submit' => 'display:none;',
				],
			]
		);

		$this->add_control(
			'form_width',
			[
				'label' => esc_html__( 'Form Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} #searchform .input' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 'text_align', [
			'label'     => __( 'Form Alignment', 'elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => __( 'Left', 'elementor' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'elementor' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'elementor' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'selectors' => [
				'{{WRAPPER}} #searchform' => 'text-align: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
    }
    
    /**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings_for_display();
		
		
		if ($settings['search_type'] == 'icon') : ?>
			<div class="cl-search-icon">
				<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</div>
		<?php else : ?>
			<?php get_search_form(); ?>
		<?php
		endif;
	}
}