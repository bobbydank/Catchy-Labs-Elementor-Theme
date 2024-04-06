<?php
    $query = $this->query_posts();
    if ( ! $query->found_posts ) {
        return;
    }

    //$this->add_render_attribute('wrapper', 'class', ['b3-posts-list clearfix b3-posts']);
?>

<div class="b3-post-slider" data-time="<?php echo $settings['time'] ?>">
    <div class="b3-post-slider-container">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="b3-post-slide">
                <div class="box-title">
                    <a href="<?php the_permalink(); ?>">
                        <h3><?php the_title(); ?></h3>
                    </a>
                </div>
                <a class="link-image-content" href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('full'); ?>
                    <?php else : ?>
                        <img src="/wp-content/uploads/2022/05/featured-placeholder.jpg" style="opacity:0;" alt="<?php the_title(); ?>" />
                    <?php endif; ?>
                    <img src="/wp-content/uploads/2022/02/more-button-green.svg" alt="Read More" class="read-more" />
                </a>
                <div class="excerpt">
                    <?php echo b3_custom_excerpt(get_the_content(), 65); //the_excerpt(); ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <a class="b3-slider-button left"></a>
    <a class="b3-slider-button right"></a>
</div>

<?php
wp_reset_postdata();