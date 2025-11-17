<?php
    $query = $this->query_posts();
    if ( ! $query->found_posts ) {
        return;
    }

    //$this->add_render_attribute('wrapper', 'class', ['b3-posts-list clearfix b3-posts']);
?>
  
<div class="b3-posts-full clearfix b3-posts">
    <?php 
    // Render taxonomy filters if enabled
    $this->render_taxonomy_filters($settings);
    ?>
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

        <div <?php post_class( 'site-main' ); ?>>
	        <div class="page-content">
                <div class="content-inner">
		            <h3 class="entry-title"><?php the_title(); ?></h3>
                </div>
                <div class="page-subhead">
                    <p>Published on: <?php the_time('M d, Y'); ?></p>
                    <p><?php echo cl_calculate_reading_time( get_the_ID() ); ?></p>
                </div>
		
                <div class="the-content"><?php the_content(); ?></div>
                <div class="post-tags">
                    <?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'cl-elementor' ), null, '</span>' ); ?>
                </div>
                <?php wp_link_pages(); ?>
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
