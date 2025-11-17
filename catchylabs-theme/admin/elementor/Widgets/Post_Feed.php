<?php

namespace CL\Elementor\Theme\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Scheme_Typography;

/**
 * Class Menu
 * @package CL\Elementor\Widgets
 */
class Post_Feed extends Widget_Base {

	/**
	 * Get widget name.
	 **
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return CL_ELEMENTOR_PREFIX . '-post-feed';
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
		return __( 'Post Feed', 'cl-elementor' );
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
		return 'eicon-posts-grid';
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
	protected function register_controls() {
        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query & Layout', 'cl-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control( // xx Layout
            'layout_heading',
            [
                'label'   => __( 'Layout', 'cl-elementor' ),
                'type'    => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => __( 'Layout Display', 'cl-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'list',
                'options' => [
                    'list'       => __( 'List', 'cl-elementor' ),
                    'grid'       => __( 'Grid', 'cl-elementor' ),
                    'full'       => __( 'Full Article(s)', 'cl-elementor' ),
                    'titles'     => __( 'Title Only', 'cl_elementor' )
                ]
            ]
        );

        $this->add_control(
            'list_layout',
            [
                'label'   => __( 'List Layout', 'cl-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'side',
                'options' => [
                    'side'       => __( 'Side by Side', 'cl-elementor' ),
                    'top'        => __( 'Image Top', 'cl-elementor' ),
                ],
                'condition' => [
                    'layout' => 'list',
                ],
            ]
        );
        
        // Get all public post types
        $post_types = get_post_types(array('public' => true), 'objects');
        $post_type_options = [];

        // Loop through post types and prepare options
        foreach ($post_types as $post_type) {
            $post_type_options[$post_type->name] = $post_type->labels->singular_name;
        }

        // Add a control for selecting a post type
        $this->add_control(
            'selected_post_type',
            [
                'label' => __('Select Post Type', 'cl-elementor'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'post',
                'options' => $post_type_options,
                'description' => __('Choose the type of content you want to query.', 'cl-elementor')
            ]
        );

        $this->add_control( // xx Layout
            'query_heading',
            [
                'label'   => __( 'Query', 'cl-elementor' ),
                'type'    => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'category_ids',
            [
                'label' => __( 'Select By Category', 'cl-elementor' ),
                'type' => Controls_Manager::SELECT2,
                'multiple'    => true,
                'default' => '',
                'label_block' => true,
                'options'   => $this->get_categories_list()
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label' => __( 'Select Individually', 'cl-elementor' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple'    => true,
                'label_block' => true,
                'options'   => $this->get_posts()
            ]  
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Posts Per Page', 'cl-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => __( 'Order By', 'cl-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date'  => __( 'Date', 'cl-elementor' ),
                    'post_title' => __( 'Title', 'cl-elementor' ),
                    'menu_order' => __( 'Menu Order', 'cl-elementor' ),
                    'rand'       => __( 'Random', 'cl-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __( 'Order', 'cl-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => __( 'ASC', 'cl-elementor' ),
                    'desc' => __( 'DESC', 'cl-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'     => __('Pagination', 'cl-elementor'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'remove_latest',
            [
                'label'     => __('Remove Latest', 'cl-elementor'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'cl-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control( // xx Layout
            'layout_heading2',
            [
                'label'   => __( 'What to show:', 'cl-elementor' ),
                'type'    => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'show_featured_image',
            [
                'label'     => __('Featured Image', 'cl-elementor'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label'     => __('Title', 'cl-elementor'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label'     => __('Date', 'cl-elementor'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_content',
            [
                'label'     => __('Content', 'cl-elementor'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_read_more',
            [
                'label'     => __('Read More', 'cl-elementor'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_divider',
            [
                'label'     => __('Show Divider', 'cl-elementor'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
			'placeholder_image',
			[
			  'label' => __( 'Placeholder Featured Image', 'cl-elementor' ),
			  'type' => \Elementor\Controls_Manager::MEDIA,
			  'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			  ],
			]
		);

        $this->end_controls_section();

        // Taxonomy Filters Section
        $this->start_controls_section(
            'section_taxonomy_filters',
            [
                'label' => __('Taxonomy Filters', 'cl-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_filters',
            [
                'label'     => __('Enable Taxonomy Filters', 'cl-elementor'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'description' => __('Enable filtering by taxonomies', 'cl-elementor'),
            ]
        );

        // Get all public taxonomies
        $taxonomies = get_taxonomies(['public' => true], 'objects');
        $taxonomy_options = [];
        foreach ($taxonomies as $taxonomy) {
            if (!in_array($taxonomy->name, ['post_format', 'nav_menu', 'link_category'])) {
                $taxonomy_options[$taxonomy->name] = $taxonomy->label;
            }
        }

        $this->add_control(
            'filter_taxonomies',
            [
                'label' => __('Select Taxonomies for Filtering', 'cl-elementor'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $taxonomy_options,
                'default' => ['category'],
                'label_block' => true,
                'description' => __('Select which taxonomies to use for filtering. Each will have its own dropdown.', 'cl-elementor'),
                'condition' => [
                    'enable_filters' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filter_submit_text',
            [
                'label' => __('Submit Button Text', 'cl-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Apply Filters', 'cl-elementor'),
                'condition' => [
                    'enable_filters' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filter_clear_text',
            [
                'label' => __('Clear Button Text', 'cl-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Clear All', 'cl-elementor'),
                'condition' => [
                    'enable_filters' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Filter Style Section
        $this->start_controls_section(
            'section_filter_style',
            [
                'label' => __('Filter Colors', 'cl-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_filters' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filter_background_color',
            [
                'label' => __('Filter Container Background', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f8f9fa',
                'selectors' => [
                    '{{WRAPPER}} .post-feed-filters' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_dropdown_border_color',
            [
                'label' => __('Dropdown Border Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ddd',
                'selectors' => [
                    '{{WRAPPER}} .dropdown-toggle' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_primary_color',
            [
                'label' => __('Primary Color (Buttons & Active States)', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7fa186',
                'selectors' => [
                    '{{WRAPPER}} .dropdown-toggle:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .dropdown-toggle.active' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .dropdown-toggle.has-selections' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .dropdown-menu' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .checkbox-item input[type="checkbox"]:checked + .checkmark' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .filter-submit-btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .clear-all-btn' => 'border-color: {{VALUE}}; color: {{VALUE}};',
                    '{{WRAPPER}} .clear-all-btn:hover' => 'background-color: {{VALUE}}; color: white;',
                    '{{WRAPPER}} .selected-filter-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_primary_hover_color',
            [
                'label' => __('Primary Hover Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6d8a73',
                'selectors' => [
                    '{{WRAPPER}} .filter-submit-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_clear_all_color',
            [
                'label' => __('Clear All Filters Button Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#dc3545',
                'selectors' => [
                    '{{WRAPPER}} .clear-all-filters-btn' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .clear-all-filters-btn:hover' => 'background-color: {{VALUE}}cc;',
                ],
            ]
        );

        // Apply Filters Button Styles
        $this->add_control(
            'apply_button_heading',
            [
                'label' => __('Apply Filters Button', 'cl-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('apply_button_tabs');

        $this->start_controls_tab(
            'apply_button_normal',
            [
                'label' => __('Normal', 'cl-elementor'),
            ]
        );

        $this->add_control(
            'apply_button_text_color',
            [
                'label' => __('Text Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .filter-submit-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'apply_button_bg_color',
            [
                'label' => __('Background Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7fa186',
                'selectors' => [
                    '{{WRAPPER}} .filter-submit-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'apply_button_border_color',
            [
                'label' => __('Border Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7fa186',
                'selectors' => [
                    '{{WRAPPER}} .filter-submit-btn' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'apply_button_hover',
            [
                'label' => __('Hover', 'cl-elementor'),
            ]
        );

        $this->add_control(
            'apply_button_text_color_hover',
            [
                'label' => __('Text Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .filter-submit-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'apply_button_bg_color_hover',
            [
                'label' => __('Background Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6d8a73',
                'selectors' => [
                    '{{WRAPPER}} .filter-submit-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'apply_button_border_color_hover',
            [
                'label' => __('Border Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6d8a73',
                'selectors' => [
                    '{{WRAPPER}} .filter-submit-btn:hover' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Clear All Button Styles
        $this->add_control(
            'clear_button_heading',
            [
                'label' => __('Clear All Button', 'cl-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('clear_button_tabs');

        $this->start_controls_tab(
            'clear_button_normal',
            [
                'label' => __('Normal', 'cl-elementor'),
            ]
        );

        $this->add_control(
            'clear_button_text_color',
            [
                'label' => __('Text Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7fa186',
                'selectors' => [
                    '{{WRAPPER}} .clear-all-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'clear_button_bg_color',
            [
                'label' => __('Background Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .clear-all-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'clear_button_border_color',
            [
                'label' => __('Border Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7fa186',
                'selectors' => [
                    '{{WRAPPER}} .clear-all-btn' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'clear_button_hover',
            [
                'label' => __('Hover', 'cl-elementor'),
            ]
        );

        $this->add_control(
            'clear_button_text_color_hover',
            [
                'label' => __('Text Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .clear-all-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'clear_button_bg_color_hover',
            [
                'label' => __('Background Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7fa186',
                'selectors' => [
                    '{{WRAPPER}} .clear-all-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'clear_button_border_color_hover',
            [
                'label' => __('Border Color', 'cl-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7fa186',
                'selectors' => [
                    '{{WRAPPER}} .clear-all-btn:hover' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Styling
        $this->start_controls_section(
            'section_styling_blog_sticky',
            [
                'label' => __( 'List Posts Style', 'cl-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'stick_list_padding',
            [
                'label' => __( 'Padding List Posts', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts-list .post ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'stick_list_margin',
            [
                'label' => __( 'Padding List Posts', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts-list .post ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'stick_list_background',
            [
                'label' => __( 'Background List Posts', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .b3-posts-stick .column-right > .content-inner' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'stick_list_post_meta_color',
            [
                'label' => __( 'List Posts Meta Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .post-block-small .post-content .entry-meta .entry-date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Styling Posts Grid & Carousel
        $this->start_controls_section(
            'section_styling_post_content',
            [
                'label' => __( 'Post Content', 'cl-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label' => __( 'Excerpt Length', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'num' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'num',
                    'size' => 50,
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .b3-posts .content-inner p.the-excerpt',
			]
		);

        $this->add_responsive_control(
            'post_box_padding',
            [
                'label' => __( 'Padding Post Content', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_box_background',
            [
                'label' => __( 'Background Post Content', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        // Styling Posts Grid & Carousel
        $this->start_controls_section(
            'section_styling_featured_image',
            [
                'label' => __( 'Feature Image', 'cl-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_box_featured_margin',
            [
                'label' => __( 'Margin Featured Image', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .post-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_box_featured_padding',
            [
                'label' => __( 'Padding Featured Image', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .post-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_box_featured_border_radius',
            [
                'label' => __( 'Featured Image Border Radius', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .post-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Styling post title
        $this->start_controls_section(
            'section_styling_post_title',
            [
                'label' => __( 'Post Title', 'cl-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_box_title_color',
            [
                'label' => __( 'Color Title', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .entry-title, {{WRAPPER}} .b3-posts .content-inner .entry-title a' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'post_box_title_color_hover',
            [
                'label' => __( 'Color Title Hover', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .entry-title:hover, {{WRAPPER}} .b3-posts .content-inner .entry-title a:hover' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_box_title_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .b3-posts .content-inner .entry-title, {{WRAPPER}} .b3-posts .content-inner .entry-title a',
			]
		);

        $this->add_responsive_control(
            'post_title_margin',
            [
                'label' => __( 'Margin', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_title_padding',
            [
                'label' => __( 'Padding', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .entry-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Styling post date/meta
        $this->start_controls_section(
            'section_styling_post_meta',
            [
                'label' => __( 'Post Date/Meta', 'cl-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_box_meta_color',
            [
                'label' => __( 'Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .post .entry-meta, {{WRAPPER}} .b3-posts .post .entry-meta a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_meta_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .b3-posts .post .entry-meta, {{WRAPPER}} .b3-posts .post .entry-meta a, {{WRAPPER}} .b3-posts .post .entry-meta p',
            ]
        );

        $this->add_responsive_control(
            'post_meta_margin',
            [
                'label' => __( 'Margin', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .post .entry-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_meta_padding',
            [
                'label' => __( 'Padding', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .post .entry-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Styling post description
        $this->start_controls_section(
            'section_styling_post_description',
            [
                'label' => __( 'Post Description', 'cl-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_date' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'post_box_description_color',
            [
                'label' => __( 'Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .entry-meta' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_box_description_typography',
                'selector' => '{{WRAPPER}} .b3-posts .content-inner .entry-meta',
            ]
        );

        $this->end_controls_section();

        // Styling read more button
        $this->start_controls_section(
            'section_styling_read_more_button',
            [
                'label' => __( 'Read More Button', 'cl-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'read_more_typography',
                'selector' => '{{WRAPPER}} .b3-posts .content-inner .btn',
            ]
        );

        $this->add_responsive_control(
            'read_more_padding',
            [
                'label' => __( 'Padding', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_margin',
            [
                'label' => __( 'Margin', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'read_more_border',
                'selector' => '{{WRAPPER}} .b3-posts .content-inner .btn',
            ]
        );

        $this->add_responsive_control(
            'read_more_border_radius',
            [
                'label' => __( 'Border Radius', 'cl-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'read_more_style_tabs' );

        $this->start_controls_tab(
            'read_more_normal_tab',
            [
                'label' => __( 'Normal', 'cl-elementor' ),
            ]
        );

        $this->add_control(
            'read_more_color',
            [
                'label' => __( 'Text Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_background_color',
            [
                'label' => __( 'Background Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_hover_tab',
            [
                'label' => __( 'Hover', 'cl-elementor' ),
            ]
        );

        $this->add_control(
            'read_more_hover_color',
            [
                'label' => __( 'Text Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_background_color',
            [
                'label' => __( 'Background Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_border_color',
            [
                'label' => __( 'Border Color', 'cl-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .b3-posts .content-inner .btn:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'read_more_border_border!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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

        if( !empty($settings['layout']) ) {
            require CL_ELEMENTOR_PATH . 'elementor/Widgets/templates/posts-'. $settings['layout'] .'.php';
        }
    }


	/**
     * 
     */
    private function get_categories_list(){
        $categories = array();

        $categories['none'] = __( 'None', 'cl-elementor' );
        $taxonomy = 'category';
        $tax_terms = get_terms( $taxonomy );
        if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ){
            foreach( $tax_terms as $item ) {
                $categories[$item->term_id] = $item->name;
            }
        }
        return $categories;
    }

    /**
     * 
     */
    private function get_posts() {
        $posts = array();

        $loop = new \WP_Query( array(
            'post_type' => array('post'),
            'posts_per_page' => -1,
            'post_status'=>array('publish'),
        ) );

        $posts['none'] = __('None', 'cl-elementor');

        while ( $loop->have_posts() ) : $loop->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $posts[$id] = $title;
        endwhile;

        wp_reset_postdata();

        return $posts;
    }

	/**
     * Render taxonomy filters
     */
    private function render_taxonomy_filters($settings) {
        if ($settings['enable_filters'] !== 'yes' || empty($settings['filter_taxonomies'])) {
            return;
        }

        $filter_taxonomies = $settings['filter_taxonomies'];
        $submit_text = !empty($settings['filter_submit_text']) ? $settings['filter_submit_text'] : __('Apply Filters', 'cl-elementor');
        $clear_text = !empty($settings['filter_clear_text']) ? $settings['filter_clear_text'] : __('Clear All', 'cl-elementor');
        
        // Get current filter values from URL
        $current_filters = [];
        foreach ($filter_taxonomies as $taxonomy) {
            $param_name = 'filter_' . $taxonomy;
            if (isset($_GET[$param_name]) && is_array($_GET[$param_name])) {
                $current_filters[$taxonomy] = array_map('sanitize_text_field', $_GET[$param_name]);
            }
        }

        ?>
        <div class="post-feed-filters">
            <form method="get" class="filter-form" action="">
                <div class="filter-container">
                    <?php foreach ($filter_taxonomies as $taxonomy): 
                        $tax_obj = get_taxonomy($taxonomy);
                        if (!$tax_obj) continue;
                        
                        $terms = get_terms([
                            'taxonomy' => $taxonomy,
                            'hide_empty' => true,
                        ]);
                        
                        if (empty($terms) || is_wp_error($terms)) continue;
                        
                        $param_name = 'filter_' . $taxonomy;
                        $current_values = isset($current_filters[$taxonomy]) ? $current_filters[$taxonomy] : [];
                        $dropdown_id = 'dropdown-' . $taxonomy;
                        ?>
                        <div class="custom-dropdown">
                            <button type="button" class="dropdown-toggle" data-target="<?php echo esc_attr($dropdown_id); ?>">
                                <span class="dropdown-label"><?php echo esc_html($tax_obj->label); ?></span>
                                <span class="dropdown-arrow">▼</span>
                            </button>
                            <div class="dropdown-menu" id="<?php echo esc_attr($dropdown_id); ?>">
                                <?php foreach ($terms as $term): ?>
                                    <label class="checkbox-item">
                                        <input type="checkbox" 
                                               name="<?php echo esc_attr($param_name); ?>[]" 
                                               value="<?php echo esc_attr($term->slug); ?>"
                                               <?php echo in_array($term->slug, $current_values) ? 'checked' : ''; ?>>
                                        <span class="checkmark"></span>
                                        <?php echo esc_html($term->name); ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <button type="submit" class="filter-submit-btn"><?php echo esc_html($submit_text); ?></button>
                    <button type="button" class="clear-all-btn"><?php echo esc_html($clear_text); ?></button>
                </div>

                <?php if (!empty($current_filters)): ?>
                    <div class="selected-filters-container">
                        <div class="selected-filters-list">
                            <?php 
                            foreach ($current_filters as $taxonomy => $selected_terms) {
                                $tax_obj = get_taxonomy($taxonomy);
                                if (!$tax_obj) continue;
                                
                                foreach ($selected_terms as $term_slug) {
                                    $term = get_term_by('slug', $term_slug, $taxonomy);
                                    if (!$term) continue;
                                    
                                    // Build URL without this specific term
                                    $remove_filters = $current_filters;
                                    $key = array_search($term_slug, $remove_filters[$taxonomy]);
                                    if ($key !== false) {
                                        unset($remove_filters[$taxonomy][$key]);
                                    }
                                    if (empty($remove_filters[$taxonomy])) {
                                        unset($remove_filters[$taxonomy]);
                                    }
                                    
                                    $remove_url_params = [];
                                    foreach ($remove_filters as $tax => $terms) {
                                        $remove_url_params['filter_' . $tax] = array_values($terms);
                                    }
                                    
                                    $remove_url = empty($remove_url_params) ? strtok($_SERVER["REQUEST_URI"], '?') : add_query_arg($remove_url_params, strtok($_SERVER["REQUEST_URI"], '?'));
                                    ?>
                                    <a href="<?php echo esc_url($remove_url); ?>" class="selected-filter-item">
                                        <span class="filter-category"><?php echo esc_html($tax_obj->label); ?>:</span> 
                                        <?php echo esc_html($term->name); ?>
                                        <span class="remove-filter" title="Remove this filter">×</span>
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                            <a href="<?php echo strtok($_SERVER["REQUEST_URI"], '?'); ?>" class="clear-all-filters-btn">Clear All Filters</a>
                        </div>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <?php
    }

    /**
     * 
     */
    public static function get_query_args( $settings ) {
        $defaults = [
            'post_ids' => '',
            'category_ids' => '',
            'orderby' => 'date',
            'order' => 'desc',
            'posts_per_page' => 3,
            'offset' => 0,
        ];

        $settings = wp_parse_args( $settings, $defaults );
        $cats = $settings['category_ids'];
        $ids = $settings['post_ids'];

        $query_args = [
            'post_type' => $settings['selected_post_type'],
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status' => 'publish', // Hide drafts/private posts for admins
        ];

        // Handle taxonomy filters from URL parameters
        if (!empty($settings['enable_filters']) && $settings['enable_filters'] === 'yes' && !empty($settings['filter_taxonomies'])) {
            $tax_queries = [];
            
            foreach ($settings['filter_taxonomies'] as $taxonomy) {
                $param_name = 'filter_' . $taxonomy;
                if (isset($_GET[$param_name]) && is_array($_GET[$param_name])) {
                    $filter_values = array_map('sanitize_text_field', $_GET[$param_name]);
                    $filter_values = array_filter($filter_values);
                    
                    if (!empty($filter_values)) {
                        $tax_queries[] = [
                            'taxonomy' => $taxonomy,
                            'field' => 'slug',
                            'terms' => $filter_values,
                            'operator' => 'IN'
                        ];
                    }
                }
            }
            
            if (!empty($tax_queries)) {
                $query_args['tax_query'] = [
                    'relation' => 'AND',
                ];
                $query_args['tax_query'] = array_merge($query_args['tax_query'], $tax_queries);
            }
        }

        if($cats){
            if( is_array($cats) && count($cats) > 0 ){
                $field_name = is_numeric($cats[0]) ? 'term_id':'slug';
                
                // If tax_query already exists from filters, add to it
                if (isset($query_args['tax_query'])) {
                    $query_args['tax_query'][] = array(
                        'taxonomy' => 'category',
                        'terms' => $cats,
                        'field' => $field_name,
                        'include_children' => false
                    );
                } else {
                    $query_args['tax_query'] = array(
                        array(
                          'taxonomy' => 'category',
                          'terms' => $cats,
                          'field' => $field_name,
                          'include_children' => false
                        )
                    );
                }
            }
        }
        if( $ids ){
          if( is_array($ids) && count($ids) > 0 ){
            $query_args['post__in'] = $ids;
            $query_args['orderby'] = 'post__in';
          }
        }

        if ($settings['remove_latest'] === 'yes') {
            $query_args['offset'] = 1;
        }

        if(is_front_page()){
            $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        }else{
            $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
 
        return $query_args;
    }

    /**
     * 
     */
    public function query_posts() {
        $query_args = $this->get_query_args( $this->get_settings() );

        return new \WP_Query( $query_args );
    }
}
