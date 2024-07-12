<?php

namespace CL\Elementor\Theme\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Before_After_Image extends Widget_Base {

	/**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-before-after-image';
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
		return __( 'Before After Image', 'cl-elementor' );
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
		return 'eicon-shrink';
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

		$locations = array();

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Settings', 'cl-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'before_image',
			[
			  'label' => __( 'Before Image', 'plugin-domain' ),
			  'type' => \Elementor\Controls_Manager::MEDIA,
			  'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			  ],
			]
		);

		$this->add_control(
			'before_title', [
			  'label' => __( 'Title', 'plugin-domain' ),
			  'type' => Controls_Manager::TEXT,
			  'default' => __( '' , 'plugin-domain' ),
			  'label_block' => true,
			]
		);

		$this->add_control(
			'after_image',
			[
			  'label' => __( 'After Image', 'plugin-domain' ),
			  'type' => \Elementor\Controls_Manager::MEDIA,
			  'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			  ],
			]
		);

		$this->add_control(
			'after_title', [
			  'label' => __( 'Title', 'plugin-domain' ),
			  'type' => Controls_Manager::TEXT,
			  'default' => __( '' , 'plugin-domain' ),
			  'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style Settings', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'bg_color',
            [
                'label' => __('Background Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cl-image-comparison' => 'color: {{VALUE}}',
                ],
            ]
        );


		$this->add_control(
			'image_compare_width',
			[
				'label'          => __( 'Width', 'elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units'     => [ '%', 'px', 'vw' ],
				'range'          => [
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .cl-image-comparison' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_compare_max_width',
			[
				'label'          => __( 'Max Width', 'elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units'     => [ '%', 'px', 'vw' ],
				'range'          => [
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .cl-image-comparison' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End style_section

		$this->start_controls_section(
            'border_section',
            [
                'label' => __('Border', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'border_color',
			[
				'label'     => __( 'Border color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-image-comparison .imageAfter' => 'border-left-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label'          => __( 'Border Width', 'elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units'     => [ '%', 'px', 'vw' ],
				'range'          => [
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .cl-image-comparison .imageAfter' => 'border-right-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End border_section

		$this->start_controls_section(
            'titles_section',
            [
                'label' => __('Titles', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .cl-image-comparison h3',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-image-comparison h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_bgcolor',
			[
				'label'     => __( 'Background color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#000',
				'selectors' => [
					'{{WRAPPER}} .cl-image-comparison h3' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => __( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cl-image-comparison h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_borderrad',
			[
				'label'      => __( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cl-image-comparison h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 
			'text_align', 
			[
				'label'     => __( 'Alignment', 'elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'top'   => [
						'title' => __( 'Top', 'elementor' ),
						'icon'  => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom'  => [
						'title' => __( 'Bottom', 'elementor' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
			]
		);

		$this->end_controls_section(); // End titles_section
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
		
        <div class="cl-image-comparison <?php echo $settings['text_align'] ?>">
			<div class="image-comparison-hover before"></div>
			<div class="image-comparison-hover after"></div>
			<?php if ($settings['before_title']) : ?>
				<h3 class="before-title"><?php echo $settings['before_title']; ?></h3>
			<?php endif; ?>
			<?php if ($settings['after_title']) : ?>
				<h3 class="after-title"><?php echo $settings['after_title']; ?></h3>
			<?php endif; ?>
			<div class="imageBox imageBefore">
				<?php echo wp_get_attachment_image( $settings['before_image']['id'], 'large' ); ?>
			</div>
			<div class="imageBox imageAfter">
				<?php echo wp_get_attachment_image( $settings['after_image']['id'], 'large' ); ?>
			</div>
		</div>
		
		<?php 
	}

}

// Register the widget
//\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \CL\Elementor\Theme\Widgets\Before_After_Image());
