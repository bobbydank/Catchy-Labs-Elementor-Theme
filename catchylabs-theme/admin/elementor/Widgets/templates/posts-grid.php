<?php
    $query = $this->query_posts();
    if ( ! $query->found_posts ) {
        return;
    }

    //$this->add_render_attribute('wrapper', 'class', ['b3-posts-list clearfix b3-posts']);
?>

<div class="b3-posts-grid clearfix b3-posts ">
    <?php if ($settings['add_filters'] === 'yes' && !empty($settings['tax_to_filter'])): ?>
        <div class="post-feed-filters">
            <form method="get" class="filter-form" action="">
                <?php 
                // Preserve existing GET parameters
                foreach ($_GET as $key => $value) {
                    if (!in_array($key, ['tax_filter', 'apply_filters'])) {
                        if (is_array($value)) {
                            foreach ($value as $val) {
                                echo '<input type="hidden" name="' . esc_attr($key) . '[]" value="' . esc_attr($val) . '">';
                            }
                        } else {
                            echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
                        }
                    }
                }
                ?>
                
                <?php foreach ($settings['tax_to_filter'] as $taxonomy): ?>
                    <?php 
                    $tax_obj = get_taxonomy($taxonomy);
                    if (!$tax_obj) continue;
                    
                    $terms = get_terms(array(
                        'taxonomy' => $taxonomy,
                        'hide_empty' => true,
                    ));
                    
                    if (empty($terms) || is_wp_error($terms)) continue;
                    
                    $selected_terms = isset($_GET['tax_filter'][$taxonomy]) ? $_GET['tax_filter'][$taxonomy] : array();
                    $selected_count = count(array_filter($selected_terms));
                    ?>
                    
                    <div class="filter-group">
                        <label><?php echo esc_html($tax_obj->labels->name); ?>:</label>
                        <div class="custom-dropdown" data-taxonomy="<?php echo esc_attr($taxonomy); ?>">
                            <div class="dropdown-toggle">
                                <span class="dropdown-text">
                                    <?php if ($selected_count > 0): ?>
                                        <?php echo $selected_count; ?> selected
                                    <?php else: ?>
                                        All <?php echo esc_html($tax_obj->labels->name); ?>
                                    <?php endif; ?>
                                </span>
                                <span class="dropdown-arrow">▼</span>
                            </div>
                            <div class="dropdown-menu">
                                <div class="dropdown-options">
                                    <?php foreach ($terms as $term): ?>
                                        <label class="checkbox-option" data-term-name="<?php echo esc_attr($term->name); ?>">
                                            <input type="checkbox" 
                                                   name="tax_filter[<?php echo esc_attr($taxonomy); ?>][]" 
                                                   value="<?php echo esc_attr($term->slug); ?>"
                                                   <?php echo in_array($term->slug, $selected_terms) ? 'checked' : ''; ?>>
                                            <span class="checkmark"></span>
                                            <?php echo esc_html($term->name); ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                                <div class="dropdown-actions">
                                    <button type="button" class="select-all-btn">Select All</button>
                                    <button type="button" class="clear-all-btn">Clear All</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <div class="filter-actions">
                    <button type="submit" name="apply_filters" value="1" class="apply-filters-btn">Apply Filters</button>
                    <a href="<?php echo esc_url(strtok($_SERVER['REQUEST_URI'], '?')); ?>" class="clear-filters-btn">Clear Filters</a>
                </div>
            </form>
        </div>
    <?php endif; ?>
    
    <div class="b3-content-items <?php echo $settings['layout']; ?>">
        <?php
        global $post;
        $count = 0;

        while ( $query->have_posts() ) : 
            $query->the_post();
            $post->loop = $count++;
            $post->post_count = $query->post_count;
            set_query_var( 'layout', $settings['layout'] );

            $beginning = '<a href="'. get_the_permalink() .'" class="post-link">';
            $end = '</a>';
            if ($settings['link_to_post'] !== 'yes') {
                $beginning = '<div class="post-link">';
                $end = '</div>';
            } 
            ?>
                    
                <?php echo $beginning; ?>
                    <?php if ( has_post_thumbnail() && $settings['show_featured_image'] == 'yes' ) : ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php else : ?>
                        <?php if (!empty($settings['placeholder_image']['id']) && $settings['show_featured_image'] == 'yes' ) : ?>
                            <?php echo wp_get_attachment_image( $settings['placeholder_image']['id'], 'medium' ); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="post-content">
                        <div class="content-inner">
                            <h3 class="entry-title"><?php the_title(); ?></h3>
                        </div>
                    </div>
                <?php echo $end; ?>

            <?php 
        endwhile; ?>
    </div>
    <?php if($settings['pagination'] == 'yes'): ?>
        <div class="post-list-pagination">
            <?php
            $big = 999999999; // need an unlikely integer

            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $query->max_num_pages,
                'prev_text' => __('< Previous'),
                'next_text' => __('Next >'),
            ) );
            ?>
        </div>
    <?php endif; ?>
</div>
<?php

wp_reset_postdata();
