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
                        'grid'       => __( 'Grid 1', 'cl-elementor' ),
                        'grid2'      => __( 'Grid 2', 'cl-elementor' ),
                        'grid3'      => __( 'Grid 3', 'cl-elementor' ),
                        'full'       => __( 'Full Article(s)', 'cl-elementor' ),
                        'titles'     => __( 'Title Only', 'cl_elementor' ),
                        'elegant'    => __( 'Elegant', 'cl_elementor' ),
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

            $this->add_control(
                'link_to_post',
                [
                    'label'     => __('Link to Post?', 'cl-elementor'),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content2',
            [
                'label' => __('Sorting Filters', 'cl-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control( // xx Layout
                'layout_heading3',
                [
                    'label'   => __( 'Sorting Filters:', 'cl-elementor' ),
                    'type'    => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'add_filters',
                [
                    'label'     => __('Add Filters', 'cl-elementor'),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'no',
                ]
            );

            $this->add_control(
                'tax_to_filter',
                [
                    'label' => __( 'Select Taxonomies for filtering', 'cl-elementor' ),
                    'type' => Controls_Manager::SELECT2,
                    'multiple'    => true,
                    'default' => '',
                    'label_block' => true,
                    'options'   => $this->get_all_post_taxonomies(),
                    'condition' => [
                        'add_filters' => 'yes',
                    ],
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

        // Styling
        // Layout Specific
        $this->start_controls_section(
            'section_styling_grid_layout',
            [
                'label' => __( 'Grid Styles', 'cl-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'grid',
                    'layout' => 'grid2',
                    'layout' => 'grid3'
                ],
            ]
        );

            $this->add_responsive_control(
                'grid_layout_gap',
                [
                    'label'          => __( 'Grid Gap', 'elementor' ),
                    'type'           => Controls_Manager::SLIDER,
                    'default'        => [
                        'unit' => 'px',
                    ],
                    'tablet_default' => [
                        'unit' => 'px',
                    ],
                    'mobile_default' => [
                        'unit' => 'px',
                    ],
                    'size_units'     => [ 'px', '%' ],
                    'range'          => [
                        '%'  => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'      => [
                        '{{WRAPPER}} .b3-posts-grid .b3-content-items' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'grid2_typography',
                    'global'   => [
                        'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                    ],
                    'selector' => '{{WRAPPER}} .b3-posts-grid .b3-content-items.grid2 h3, {{WRAPPER}} .b3-posts-grid .b3-content-items.grid3 h3',
                ]
            );

            $this->add_control(
                'grid2_text_color',
                [
                    'label' => __( 'Content Hover BG Color', 'cl-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .b3-posts-grid .b3-content-items.grid2 .entry-title,
                         {{WRAPPER}} .b3-posts-grid .b3-content-items.grid3 .entry-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'grid2_text_color_hover',
                [
                    'label' => __( 'Content Hover BG Color', 'cl-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .b3-posts-grid .b3-content-items.grid2 .post-link:hover .entry-title,
                         {{WRAPPER}} .b3-posts-grid .b3-content-items.grid3 .post-link:hover .entry-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'grid2_bg_color',
                [
                    'label' => __( 'Content Hover BG Color', 'cl-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .b3-posts-grid .b3-content-items.grid2 .post-content,
                         {{WRAPPER}} .b3-posts-grid .b3-content-items.grid3 .post-content' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'grid2_bg_color_hover',
                [
                    'label' => __( 'Content BG Color', 'cl-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .b3-posts-grid .b3-content-items.grid2 .post-link:hover .post-content,
                         {{WRAPPER}} .b3-posts-grid .b3-content-items.grid3 .post-link:hover .post-content' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'grid2_padding',
                [
                    'label' => __( 'Content Padding', 'cl-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .b3-posts-grid .b3-content-items.grid2 .post-content,
                         {{WRAPPER}} .b3-posts-grid .b3-content-items.grid3 .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'grid2_margin',
                [
                    'label' => __( 'Content Margin', 'cl-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .b3-posts-grid .b3-content-items.grid2 .post-content,
                         {{WRAPPER}} .b3-posts-grid .b3-content-items.grid3 .post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

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
                        '{{WRAPPER}} .b3-posts .post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'stick_list_margin',
                [
                    'label' => __( 'Margin List Posts', 'cl-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .b3-posts .post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .b3-posts-stick .column-right > .content-inner, {{WRAPPER}} .b3-posts .post' => 'background-color: {{VALUE}};',
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
                        '{{WRAPPER}} .b3-posts .content-inner .entry-title, {{WRAPPER}} .b3-posts .content-inner .entry-title a' => 'color: {{VALUE}} !important;',
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

            $this->add_control(
                'post_box_meta_color',
                [
                    'label' => __( 'List Posts Meta Color', 'cl-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .b3-posts .post .entry-meta, {{WRAPPER}} .b3-posts .post .entry-meta a' => 'color: {{VALUE}};',
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

        if ($settings['layout'] == 'grid2' || $settings['layout'] == 'grid3') {
            $layout = 'grid';
        } else {
            $layout = $settings['layout'];
        }

        if( !empty($settings['layout']) ) {
            require CL_ELEMENTOR_PATH . 'elementor/Widgets/templates/posts-'. $layout .'.php';
        }
    }

    /**
     * 
     */
    function get_all_post_taxonomies() {
        // Get all registered taxonomies
        $taxonomies = get_taxonomies(
            array(
                'public'   => true,
                '_builtin' => false // Include both built-in and custom taxonomies
            ),
            'objects'
        );
        
        $taxonomy_array = array();
        
        // Loop through taxonomies and create array with slug as key and label as value
        foreach ( $taxonomies as $taxonomy ) {
            $taxonomy_array[ $taxonomy->name ] = $taxonomy->labels->singular_name;
        }
        
        return $taxonomy_array;
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

        // Handle taxonomy filters from GET parameters
        $tax_queries = array();
        
        if($cats){
            if( is_array($cats) && count($cats) > 0 ){
                $field_name = is_numeric($cats[0]) ? 'term_id':'slug';
                $tax_queries[] = array(
                    'taxonomy' => 'category',
                    'terms' => $cats,
                    'field' => $field_name,
                    'include_children' => false
                );
            }
        }
        
        // Add filtering from GET parameters if filters are enabled
        if ($settings['add_filters'] === 'yes' && !empty($settings['tax_to_filter']) && isset($_GET['tax_filter'])) {
            foreach ($_GET['tax_filter'] as $taxonomy => $terms) {
                // Only process if this taxonomy is in the allowed list
                if (in_array($taxonomy, $settings['tax_to_filter']) && !empty($terms)) {
                    // Remove empty values
                    $terms = array_filter($terms);
                    if (!empty($terms)) {
                        $tax_queries[] = array(
                            'taxonomy' => $taxonomy,
                            'terms' => $terms,
                            'field' => 'slug',
                            'operator' => 'IN'
                        );
                    }
                }
            }
        }
        
        // Set tax_query if we have any taxonomy queries
        if (!empty($tax_queries)) {
            if (count($tax_queries) > 1) {
                $query_args['tax_query'] = array_merge(array('relation' => 'AND'), $tax_queries);
            } else {
                $query_args['tax_query'] = $tax_queries;
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
