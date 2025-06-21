<?php
    $query = $this->query_posts();
    if ( ! $query->found_posts ) {
        return;
    }

    //$this->add_render_attribute('wrapper', 'class', ['b3-posts-list clearfix b3-posts']);
?>
  
<div class="b3-posts-list clearfix b3-posts <?php echo $settings['list_layout']; ?>">
    <div class="b3-content-items"> 
    <?php
    global $post;
    $count = 0;
    while ( $query->have_posts() ) : 
        $query->the_post();
        $post->loop = $count++;
        $post->post_count = $query->post_count;
        set_query_var( 'layout', $settings['layout'] );
        ?>

            <div class="post post-block-small <?php echo ($settings['show_divider'] == 'yes') ? '' : 'no-divider'; ?>">      
                <div class="post-content">
                    <?php if ( has_post_thumbnail() && $settings['show_featured_image'] == 'yes' ) : ?>
                        <div class="post-thumbnail">
                            <a class="link-image-content" href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                    <?php else : ?>
                        <?php if (!empty($settings['placeholder_image']['id']) && $settings['show_featured_image'] == 'yes' ) : ?>
                            <div class="post-thumbnail">
                                <a class="link-image-content" href="<?php the_permalink(); ?>">
                                    <?php echo wp_get_attachment_image( $settings['placeholder_image']['id'], 'medium' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="content-inner">
                        <?php if ($settings['show_title'] == 'yes') : ?>
                            <h3 class="entry-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3> 
                        <?php endif; ?>
                        <?php if ($settings['show_date'] == 'yes') : ?>
                            <div class="entry-meta">
                                <p>Published on: <?php the_time('M d, Y'); ?> | <?php echo cl_calculate_reading_time( get_the_ID() ); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ($settings['show_content'] == 'yes') : ?>
                            <?php echo '<p class="the-excerpt">'.cl_custom_excerpt(get_the_content(), $settings['excerpt_length']['size']).' ...</p>'; ?>
                        <?php endif; ?>
                        <?php if ($settings['show_read_more'] == 'yes') : ?>
                            <a class="btn" href="<?php the_permalink(); ?>">
                                Read More &raquo;
                            </a>
                        <?php endif; ?>
                    </div>    
                </div>   
            </div>

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