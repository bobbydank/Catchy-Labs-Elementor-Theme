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
			'type',
			[
				'label'   => __( 'Type', 'cl-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => __( 'system' , 'plugin-domain' ),
				'options' => array(
					'system'  => 'System',
					'custom'  => 'Custom',
				),
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
				'condition' => [
                    'type' => 'system',
                ],
			]
		);

		//https://developers.elementor.com/elementor-controls/repeater-control/
		$repeater = new \Elementor\Repeater();
	
		$repeater->add_control(
			'title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '#',
				]
			]
		);
	
		$this->add_control(
			'custom_breadcrumb',
			[
				'label' => __( 'Custom Breadcrumb', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
				[
					'title' => __( 'Title #1', 'plugin-domain' ),
				],
				[
					'title' => __( 'Title #2', 'plugin-domain' ),
				],
				],
				'title_field' => '{{{ title }}}',
				'condition' => [
					'type' => 'custom',
				],
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
					'{{WRAPPER}} .cl-breadcrumbs a, {{WRAPPER}} .cl-breadcrumbs span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __( 'Overall Typography', 'cl-elementor' ),
				'global'   => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .cl-breadcrumbs a',
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
				'name'     => 'active_typography',
				'label'    => __( 'Active Typography', 'cl-elementor' ),
				'global'   => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .cl-breadcrumbs a:last-child',
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

		if ($settings['type'] == 'custom') {
			$x = 0; 
			?>
			<p class="cl-breadcrumbs">

				<?php
				foreach ( $settings['custom_breadcrumb'] as $item ) {
					if ($x > 0) {
						echo '<span class="seperator">'.$separator.'</span>';
					} else {
						$x++;
					}

					$this->add_link_attributes( 'link', $item['link'] ); 
					?>

						<a <?php $this->print_render_attribute_string( 'link' ); ?>>
							<?php echo $item['title'] ?>
						</a>

					<?php
				}
				?>

			</p>
			<?php
		} else {
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
}
