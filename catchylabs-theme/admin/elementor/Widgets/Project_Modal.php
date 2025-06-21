<?php

namespace CL\Elementor\Theme\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Project_Modal extends Widget_Base {
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'b3ea-project-modal';
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
		return __( 'Project Modal', 'cl-elementor' );
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
		return 'eicon-drag-n-drop';
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

		/*
        $this->add_control(
            'modal_id', [
                'label' => __( 'Modal ID', 'plugin-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
        );
		*/

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

		$this->add_control(
			'project_link',
			[
				'label' => esc_html__( 'Project Link', 'plugin-name' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'plugin-name' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
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

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style Settings', 'cl-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_width',
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
					'{{WRAPPER}} .cl-project-modal-container .cl-project-link img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		$this->end_controls_section();

		$this->start_controls_section(
            'modal_content',
            [
                'label' => __( 'Modal Content', 'dg-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'modal_on',
			[
				'label' => esc_html__( 'Show Modal', 'plugin-name' ),
				'description' => 'Only works while editing.',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
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

		

		$this->end_controls_section();

		$this->start_controls_section(
            'third_party_section',
            [
                'label' => __( 'Third Party', 'dg-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
            'third_image',
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
				'name' => 'third_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

		$this->add_control(
            'third_content',
            [
                'label' => __( 'Third Party Content', 'plugin-domain' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Default description', 'plugin-domain' ),
                'placeholder' => __( 'Type your description here', 'plugin-domain' ),
            ]
        );

		$this->add_control(
			'third_link',
			[
				'label' => esc_html__( 'Link', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'plugin-name' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

        $this->end_controls_section();
		*/
    }

    /**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        $settings = $this->get_settings_for_display();

		$img = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );

		//echo '<pre>'.print_r($settings['project_link'], true).'</pre>';
		$target = $follow = '';
		$url = 'href="'.$settings['project_link']['url'].'"';
		if ($settings['project_link']['is_external']) {
			$target = 'target="_blank"';
		}
		if ($settings['project_link']['nofollow']) {
			$follow = 'rel="nofollow"';
		}

		/*
		$target2 = $follow2 = '';
		$url2 = 'href="'.$settings['third_link']['url'].'"';
		if ($settings['third_link']['is_external']) {
			$target = 'target="_blank"';
		}
		if ($settings['third_link']['nofollow']) {
			$follow = 'rel="nofollow"';
		}
		*/
        ?>

<div class="cl-project-modal-container">
	<?php if (!empty($settings['project_link']['url'])) : ?>
		<a <?php echo $url .' '. $target .' '.$follow; ?> class="cl-project-link">
	<?php endif; ?>
			<?php echo $img ?>
	<?php if (!empty($settings['project_link']['url'])) : ?>
		</a>
	<?php endif; ?>
	<?php /*
	<div class="cl-project-modal <?php echo ($settings['modal_on'] == 'yes') ? 'modal-on' : ''; ?>" id="<?php echo $settings['modal_id'] ?>">
		<div class="modal-background container ui-widget-header" style="">
			<div class="inner clearfi">
				<a class="close" href="#close" title="Close">
					<i class="far fa-times-circle"></i>
				</a>
				<a <?php echo $url .' '. $target .' '.$follow; ?> class="cl-project-image">
					<?php echo $img ?>
				</a>
				<div class="content">
					<div class="inner">
						<h3><?php echo $settings['name'] ?></h3>
						<?php echo $settings['content'] ?>
						<a href="<?php echo $settings['project_link']['url']; ?>" target="_blank">Visit the Project. <i class="fa-solid fa-arrow-right"></i></a>
					</div>	
					<?php if ( !empty($settings['third_content']) || !empty($settings['third_image']) ) : ?>
						<div class="third-party-content">
							<div class="inner">
								<?php if ( !empty($settings['third_content']) ) : ?>
									<div class="third-content">
										<?php echo $settings['third_content'] ?>
									</div>
								<?php endif; ?>
								<div class="third-image">
									<?php if ( !empty($settings['third_link']) ) : ?>
										<a <?php echo $url2 .' '. $target2 .' '.$follow2; ?> class="cl-third-image">
									<?php endif; ?>
									<?php
									if ( !empty($settings['third_image']) ) {
										echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'third_thumbnail', 'third_image' );
									} 
									?>
									<?php if ( !empty($settings['third_link']) ) : ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<a class="off" href="#close" title="Close"></a>
		</div>
	</div>
	*/ ?>
</div>


        <?php
    }
}
