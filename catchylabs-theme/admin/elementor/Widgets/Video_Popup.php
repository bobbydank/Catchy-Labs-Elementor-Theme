<?php

namespace CL\Elementor\Theme\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Video_Popup extends Widget_Base {
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'cl-video-popup';
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
		return __( 'Video Popup', 'cl-elementor' );
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
		return 'eicon-video-camera';
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
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

		$this->add_control(
			'youtube_url', [
				'label' => __( 'Youtube Url', 'plugin-domain' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$this->add_control(
            'title', [
                'label' => __( 'Video Title', 'plugin-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
        );

		$this->add_control(
			'width', [
				'label' => __( 'Width', 'plugin-domain' ),
				'type' => Controls_Manager::NUMBER,
				'default' => __( '' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'height', [
				'label' => __( 'Height', 'plugin-domain' ),
				'type' => Controls_Manager::NUMBER,
				'default' => __( '' , 'plugin-domain' ),
				'label_block' => true,
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

		$img = wp_get_attachment_image_src( $settings['image']['id'], $settings['thumbnail_size']);
		$image_alt = get_post_meta($settings['image']['id'], '_wp_attachment_image_alt', TRUE);

		$title = $settings['title'];
		if ( !empty($title) ) {
			$title = 'data-title="'.$title.'"';
		}

		if (!empty($settings['youtube_url'])) {
			$patterns = [
				// Match the youtu.be short URLs
				'/https:\/\/youtu\.be\/([a-zA-Z0-9_-]+)/',
				// Match the full YouTube URLs with or without additional parameters
				'/https:\/\/www\.youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)(?:&[^\s]*)?/',
				// Match the full YouTube URLs with embed form already in place (for completeness)
				'/https:\/\/www\.youtube\.com\/embed\/([a-zA-Z0-9_-]+)/'
			];
		
			// Replacement format to convert to the embed URL
			$replacement = 'https://www.youtube.com/watch?v=$1';
		
			// Replace the URLs in the content using all patterns
			foreach ($patterns as $pattern) {
				if ( $url = preg_replace($pattern, $replacement, $settings['youtube_url']) ) {
					break;
				}
			}
		}
        ?>

<div class="cl-video-popup">
  <a href="<?php echo $url; ?>" <?php echo wp_is_mobile() ? 'target="_blank"' : 'class="popup-video"'; ?> <?php echo $title; ?>>
    <img src="<?php echo $img[0] ?>" alt="<?php echo (!empty($settings['title'])) ? $settings['title'] : $image_alt; ?>" />
  </a>
</div>

        <?php
        //echo '<pre>'.print_r($img, true).'</pre>';
    }
}
