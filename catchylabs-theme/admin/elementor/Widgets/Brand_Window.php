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
class Brand_Window extends Widget_Base {
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'cl-brand-window';
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
		return __( 'Brand Window', 'cl-elementor' );
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
		return 'eicon-banner';
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
      'content',
      [
        'label' => __( 'Content', 'cl-elementor' ),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    //https://developers.elementor.com/elementor-controls/repeater-control/
    $repeater = new \Elementor\Repeater();

    //creates the media control
    //https://developers.elementor.com/elementor-controls/media-control/
    $repeater->add_control(
      'image',
      [
        'label' => __( 'Choose Icon', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $repeater->add_control(
      'caption', [
        'label' => __( 'Text', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'windows',
      [
        'label' => __( 'Icon Sliders', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'caption' => __( 'Title #1', 'plugin-domain' ),
          ],
          [
            'caption' => __( 'Title #2', 'plugin-domain' ),
          ],
        ],
        'title_field' => '{{{ caption }}}',
      ]
    );

    $this->add_control(
      'title', [
        'label' => __( 'Name', 'plugin-domain' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

		$this->add_control(
			'full_height',
			[
				'label' => __( 'Full Height', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'zooming',
			[
				'label' => __( 'Ken Burns Effect', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

    $this->add_control(
      'time', [
        'label' => __( 'Time between slides (ms)', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 100,
        'max' => 20000,
        'step' => 100,
        'default' => 6000
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

		$classes  = '';
		$classes .= ('yes' === $settings['full_height']) ? ' full-height' : '';
		$classes .= ('yes' === $settings['zooming']) ? ' zooming-mark' : '';
?>

<div class="brand-window <?php echo $classes; ?>" data-time="<?php echo $settings['time'] ?>">
	<div class="container">
		<?php foreach ( $settings['windows'] as $item ) : ?>
			<div class="brand-image <?php echo $count == 0 ? 'active' : ''; ?>" data-count="<?= $count ?>">
				<div class="brand-image-img" style="background-image:url(<?php echo $item['image']['url']; ?>);"></div>
				<div class="brand-caption" style="display:none;"><?php echo $item['caption']; ?></div>
			</div>
		<?php $count++; endforeach; ?>
	</div>
	<div class="brand-statement">
		<h1><?php echo $settings['title'] ?></h1>
	</div>
</div>

<?php
        //echo '<pre>'.print_r($img, true).'</pre>';
    }
}
