<?php
    $query = $this->query_posts();
    if ( ! $query->found_posts ) {
        return;
    }

    //$this->add_render_attribute('wrapper', 'class', ['b3-posts-list clearfix b3-posts']);
?>

<div class="b3-posts">
    <?php 
    global $post;
    $count = 0;
    while ( $query->have_posts() ) : 
        $query->the_post();
        ?>
            <div class="entry-content">
                <div class="content-inner">
                    <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                </div>
            </div>
        <?php
    endwhile;
    ?>
</div>

<?php
wp_reset_postdata();
