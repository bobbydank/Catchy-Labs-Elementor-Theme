<?php

namespace CL\Elementor\Theme\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Review_Slider extends Widget_Base {
    
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-review-slider';
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
		return __( 'Review Slider', 'cl-elementor' );
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
		return 'eicon-review';
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
        //creates the content section where everything is going.
        $this->start_controls_section(
			'content',
			[
				'label' => __( 'Content', 'dg-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        
        $repeater->add_control(
			'name', [
				'label' => __( 'Name', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title_top',
			[
				'label' => esc_html__( 'Title Position', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Top', 'your-plugin' ),
				'label_off' => esc_html__( 'Bottom', 'your-plugin' ),
				'return_value' => 'bottom',
				'default' => '',
			]
		);

        $repeater->add_control(
			'rating',
			[
				'label' => esc_html__( 'Rating', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
			]
		);

        $repeater->add_control(
			'review',
			[
				'label' => esc_html__( 'Review', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( '', 'textdomain' ),
				'placeholder' => esc_html__( 'Enter review text here.', 'textdomain' ),
			]
		);
        
        $repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( '', 'plugin-domain' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$repeater->add_control(
			'hide_stars',
			[
				'label' => esc_html__( 'Hide Stars', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'your-plugin' ),
				'label_off' => esc_html__( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
        
        $this->add_control(
			'list',
			[
				'label' => __( 'Hero Rotators', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'Review #1', 'plugin-domain' ),
					],
					[
						'name' => __( 'Review #2', 'plugin-domain' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);
        
        $this->add_control(
			'time', [
				'label' => __( 'Time between slides (ms)', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 20000,
				'step' => 100,
				'default' => 800
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

		$this->add_responsive_control( 'text_align', [
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
				'{{WRAPPER}} .cl-review-slider2 h3, {{WRAPPER}} .cl-review-slider2 p, {{WRAPPER}} .cl-review-slider2 a' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_control(
			'review-max-width',
			[
				'label' => esc_html__( 'Review Max-Width', 'textdomain' ),
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
					'{{WRAPPER}} .cl-review-slider2' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .cl-review-slider2 h3, {{WRAPPER}} .cl-review-slider2 p, {{WRAPPER}} .cl-review-slider2 a',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-review-slider2 h3, {{WRAPPER}} .cl-review-slider2 p, {{WRAPPER}} .cl-review-slider2 a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'review-padding',
			[
				'label'      => __( 'Review Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cl-review-slider2 .cl-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		

		$this->add_control(
			'arrow_color',
			[
				'label'     => __( 'Arrow color', 'cl-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'std'       => '#fff',
				'selectors' => [
					'{{WRAPPER}} .cl-review-slider2 .cl-slider-button' => 'color: {{VALUE}};',
				],
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
        $count = 0;
		?>

		<div class="cl-review-slider2" data-time="<?php echo $settings['time'] ?>">
			<div class="cl-review-container">
				<?php foreach ( $settings['list'] as $item ) : 
					if ( ! empty( $item['link']['url'] ) ) {
						$this->add_link_attributes( 'website_link', $item['link'] );

						$button = '<a class="read-more btn" '. $this->get_render_attribute_string( 'website_link' ) .'>Read more.</a>';
					}
					?>
					<div class="cl-review">
						<div class="cl-review-image">
							<?php echo wp_get_attachment_image( $item['image']['id'], 'thumbnail' ); ?>
						</div>
						<div class="cl-review-content">
							<?php if ($item['title_top'] !== 'bottom') : ?>
								<h3><?php echo $item['name'] ?></h3>
							<?php endif; ?>

							<?php if ($item['hide_stars'] !== 'yes') : ?>
								<div class="cl-star-rating" style="--rating: <?php echo $item['rating']['size'].$item['rating']['unit'] ?>;"></div>
							<?php endif; ?>
							<?php echo $item['review'] ?>
							<?php echo $button; ?>

							<?php if ($item['title_top'] === 'bottom') : ?>
								<h3><?php echo $item['name'] ?></h3>
							<?php endif; ?>
						</div>
					</div>
					<?php 
					//echo '<pre>'.print_r($item['rating'], true).'</pre>';
				endforeach; ?>
			</div>
			<i class="cl-slider-button fa-solid fa-arrow-left"></i>
			<i class="cl-slider-button fa-solid fa-arrow-right"></i>
		</div>

		<?php

	}
}
