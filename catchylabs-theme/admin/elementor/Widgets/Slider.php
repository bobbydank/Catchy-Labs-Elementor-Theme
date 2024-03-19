<?php

namespace CL\Elementor\Theme\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Slider extends Widget_Base {
    
    /**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-slider';
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
		return __( 'Slider', 'cl-elementor' );
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
		return 'eicon-slider-3d';
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
				'label' => __( 'Content', 'cl-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        //https://developers.elementor.com/elementor-controls/repeater-control/
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
			'title', [
				'label' => __( 'Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( '' , 'plugin-domain' ),
				'label_block' => true,
			]
		);
        
        $repeater->add_control(
          'content',
          [
            'label' => __( 'Name', 'plugin-domain' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '', 'plugin-domain' ),
            'placeholder' => __( 'Type your description here', 'plugin-domain' ),
          ]
        );

		$repeater->add_control(
			'lower_title',
			[
			  'label' => __( 'Lower Title', 'plugin-domain' ),
			  'type' => Controls_Manager::TEXT,
			  'default' => __( '', 'plugin-domain' ),
			  'placeholder' => __( 'Type your description here', 'plugin-domain' ),
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

        <div class="b3-sliders" data-time="<?php echo $settings['time'] ?>">
			<div class="b3-slider-container">
				<?php foreach ( $settings['list'] as $item ) : ?>
				<div class="b3-slider <?php echo ($count) ? '' : 'active'; ?>">
					<div class="b3-slider-inner">
						<div class="b3-slider-heading">
							<h4>
								<?php echo $item['title'] ?>
							</h4>
						</div>  
						<div class="b3-slider-content">
							<p>
								<strong><?php echo $item['content'] ?></strong>
							</p>
						</div>
						<div class="b3-slider-lower">
							<p>
								<?php echo $item['lower_title'] ?>
							</p>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
        </div>

		<?php

	}
}