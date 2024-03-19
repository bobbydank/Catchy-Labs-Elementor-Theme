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
class Icon_Slider extends Widget_Base {
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'cl-icon-slider';
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
		return __( 'Icon Clider', 'cl-elementor' );
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
		return 'eicon-slider-video';
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
      'title', [
        'label' => __( 'Text', 'plugin-domain' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __( '' , 'plugin-domain' ),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'list',
      [
        'label' => __( 'Icon Sliders', 'plugin-domain' ),
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

<div class="cl-icon-sliders" data-time="<?php echo $settings['time'] ?>">
	<div class="cl-icon-sliders-container">
		<?php foreach ( $settings['list'] as $item ) : ?>
	    <div class="cl-icon-slider <?php echo ($count) ? '' : 'active'; ?>" data-count="<?php echo $count; ?>">
	      <img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['title'] ?>" class="b3-slider-image" />
	      <p><?php echo $item['title'] ?></p>
	    </div>
	  <?php endforeach; ?>
	</div>

  <div class="cl-icon-slider-controls">
    <i class="fas fa-arrow-left"></i>
    <i class="fas fa-arrow-right"></i>
  </div>
</div>

<?php
        //echo '<pre>'.print_r($img, true).'</pre>';
    }
}
