<?php
namespace CL\Elementor\Theme\Widgets;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Breadcrumbs extends \Elementor\Widget_Base {
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-breadcrumbs';
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
		return __( 'Breadcrumbs', 'cl-elementor' );
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
		return 'eicon-align-start-h';
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
	protected function _register_controls() {
        $this->start_controls_section(
            'content', [
                'label' => __( 'Content', 'cl-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'seperator', [
                'label' => __( 'Seperator', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '»' , 'plugin-domain' ),
                'label_block' => true,
            ]
        );

		$this->add_control(
			'include_home', [
				'label' => __( 'Include Home Page?', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Settings', 'cl-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'seperator_spacing',
			[
				'label' => esc_html__( 'Seperator Spacing', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .cl-breadcrumbs .seperator' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control( 
            'text_align', [
                'label'     => __( 'Alignment', 'elementor' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .cl-breadcrumbs' => 'text-align: {{VALUE}};',
                ],
		    ] 
        );

        $this->add_control(
			'text_color',
			[
				'label'     => __( 'Text color', 'cl-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'std'       => '#333',
				'selectors' => [
					'{{WRAPPER}} .cl-breadcrumbs a' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'active_color',
			[
				'label'     => __( 'Active color', 'cl-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'std'       => '#333',
				'selectors' => [
					'{{WRAPPER}} .cl-breadcrumbs a:last-child' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'global'   => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .cl-breadcrumbs a',
			]
		);

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
    
        global $post;
        $string = '';
        $separator = $settings['seperator'];
    
        // Initialize the home array if 'include_home' is set to 'Yes'
        $home = array();
        if ($settings['include_home'] == 'yes') {
            $home = array(get_option('page_on_front'));
        }
    
        // Initialize ancestors array and handle cases where $post->ancestors might not be set
        $ancestors = array();
        if (!empty($post->ancestors)) {
            $ancestors = array_reverse($post->ancestors);
        }
    
        // Merge home, ancestors, and the current post ID
        $ancestors = array_merge($home, $ancestors, array($post->ID));
    
        // Build the breadcrumb string
        foreach ($ancestors as $key => $ancestor) {
            if ($key > 0) {
                $string .= '<span class="seperator">'.$separator.'</span>';
            }
            $string .= '<a href="'.get_permalink($ancestor).'">'.get_the_title($ancestor).'</a>';
        }
    
        // Output the breadcrumb
        if (!empty($string)) {
            echo '<p class="cl-breadcrumbs">' . $string . '</p>';
        }
    }
}
