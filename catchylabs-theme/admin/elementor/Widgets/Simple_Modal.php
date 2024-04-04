<?php

namespace CL\Elementor\Theme\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Simple_Modal extends Widget_Base {
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'b3ea-simple-modal';
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
		return __( 'Simple Modal', 'cl-elementor' );
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
		return 'eicon-product-description';
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
      'content_section',
      [
        'label' => __( 'Settings', 'cl-elementor' ),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'modal_id', [
        'label' => __( 'Modal ID', 'plugin-domain' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

    $this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

    $this->add_control(
      'name', [
        'label' => __( 'Name', 'plugin-domain' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'position', [
        'label' => __( 'Position', 'plugin-domain' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'content',
      [
        'label' => __( 'Content', 'plugin-domain' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __( 'Default description', 'plugin-domain' ),
        'placeholder' => __( 'Type your description here', 'plugin-domain' ),
      ]
    );

	$this->add_control(
		'button_text', [
		  'label' => __( 'Button Text', 'plugin-domain' ),
		  'type' => Controls_Manager::TEXT,
		  'default' => __( '' , 'plugin-domain' ),
		  'label_block' => true,
		]
	  );
  

	$this->add_control(
		'button_link',
		[
			'label' => __( 'Button Link', 'plugin-domain' ),
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

	$this->end_controls_section();

	$this->start_controls_section(
		'style_section',
		[
			'label' => __( 'Settings', 'cl-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		]
	);

	$this->add_control(
		'close_color',
		[
			'label'     => __( 'Close color', 'cl-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'std'       => '#000',
			'selectors' => [
				'{{WRAPPER}} .cl-simple-modal .close .fa-times-circle' => 'color: {{VALUE}};',
			],
		]
	);

	$this->add_control(
		'background_color',
		[
			'label'     => __( 'Background color', 'cl-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'std'       => '#000',
			'selectors' => [
				'{{WRAPPER}} .cl-simple-modal section' => 'background-color: {{VALUE}};',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name'     => 'name_typography',
			'label'    => 'Name Type',
			'global'   => [
				'default' => Global_Typography::TYPOGRAPHY_ACCENT,
			],
			'selector' => '{{WRAPPER}} .cl-simple-modal .content h3',
		]
	);

	$this->add_control(
		'name_color',
		[
			'label'     => __( 'Name color', 'cl-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'std'       => '#000',
			'selectors' => [
				'{{WRAPPER}} .cl-simple-modal .content h3' => 'color: {{VALUE}};',
			],
		]
	);

	$this->add_responsive_control(
		'name_margin',
		[
			'label'      => __( 'Name Margin', 'elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%', 'rem' ],
			'selectors'  => [
				'{{WRAPPER}} .cl-simple-modal .content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name'     => 'position_typography',
			'label'    => 'Position Type',
			'global'   => [
				'default' => Global_Typography::TYPOGRAPHY_ACCENT,
			],
			'selector' => '{{WRAPPER}} .cl-simple-modal .content p.position',
		]
	);

	$this->add_control(
		'position_color',
		[
			'label'     => __( 'Position color', 'cl-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'std'       => '#000',
			'selectors' => [
				'{{WRAPPER}} .cl-simple-modal .content p.position' => 'color: {{VALUE}};',
			],
		]
	);

	$this->add_responsive_control(
		'position_margin',
		[
			'label'      => __( 'Position Margin', 'elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%', 'rem' ],
			'selectors'  => [
				'{{WRAPPER}} .cl-simple-modal .content p.position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name'     => 'content_typography',
			'label'    => 'Content Type',
			'global'   => [
				'default' => Global_Typography::TYPOGRAPHY_ACCENT,
			],
			'selector' => '{{WRAPPER}} .cl-simple-modal  .content p',
		]
	);

	$this->add_control(
		'content_color',
		[
			'label'     => __( 'Content color', 'cl-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'std'       => '#000',
			'selectors' => [
				'{{WRAPPER}} .cl-simple-modal .content p' => 'color: {{VALUE}};',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name'     => 'button_typography',
			'label'    => 'Button Type',
			'global'   => [
				'default' => Global_Typography::TYPOGRAPHY_ACCENT,
			],
			'selector' => '{{WRAPPER}} .cl-simple-modal  .content a.btn',
		]
	);

	$this->add_control(
		'button_color',
		[
			'label'     => __( 'Button color', 'cl-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'std'       => '#000',
			'selectors' => [
				'{{WRAPPER}} .cl-simple-modal .content a.btn' => 'color: {{VALUE}};',
			],
		]
	);

	$this->add_control(
		'button_bg_color',
		[
			'label'     => __( 'Button BG color', 'cl-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'std'       => '#000',
			'selectors' => [
				'{{WRAPPER}} .cl-simple-modal .content a.btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
			],
		]
	);

	$this->add_responsive_control(
		'button_margin',
		[
			'label'      => __( 'Button Margin', 'elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%', 'rem' ],
			'selectors'  => [
				'{{WRAPPER}} .cl-simple-modal .content a.btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$class = '';

		$image_alt = get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', TRUE );
		$img = wp_get_attachment_image_src( $settings['image']['id'], $settings['thumbnail_size']);

		if (!$img) {
			$class = 'lone';
		}

        ?>

<div class="cl-simple-modal" id="<?php echo $settings['modal_id'] ?>">
	<div class="modal-background container ui-widget-header" style="">
		<div class="inner">
			<section class="clearfix">
				<a class="close" href="#close" title="Close">
					<i class="far fa-times-circle"></i>
				</a>
				<?php if ($img) : ?>
					<div class="image">
						<img src="<?php echo $img[0] ?>" alt="<?php echo $image_alt ?>" />
					</div>
				<?php endif; ?>
				<div class="content <?php echo $class ?>">
					<h3><?php echo $settings['name'] ?></h3>
					<?php if ($settings['position']) : ?>
						<p class="position"><?php echo $settings['position'] ?></p>
					<?php endif; ?>
					<?php echo $settings['content'] ?>
					<?php if ( ! empty( $settings['button_link']['url'] ) ) {
						$this->add_link_attributes( 'website_link', $settings['button_link'] );
						echo $button = '<a class="read-more btn" '. $this->get_render_attribute_string( 'website_link' ) .'>'.$settings['button_text'].'</a>';
					} ?>
				</div>
		  	</section>
		</div>
  </div>
</div>

        <?php
        //echo '<pre>'.print_r($img, true).'</pre>';
    }
}
