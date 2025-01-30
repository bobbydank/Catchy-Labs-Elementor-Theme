<div class="blog-default">
    <div class="blog-default-content">
        <div class="inner">
            <div class="post-head">
                <?php the_post_thumbnail( 'large', ['class' => 'post-thumbnail', 'title' => get_the_title()] ); ?>
                <p><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('l, F j, Y'); ?></time></p>
                <h1 class="page-title"><?php the_title(); ?></h1>
                
            </div>

            <?php
            // Default WordPress content
            the_content();
            ?>

            <div class="post-discussion">
                <div class="post-tags">
                    <?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'cl-elementor' ), null, '</span>' ); ?>
                </div>

                <?php wp_link_pages(); ?>
                <?php comments_template(); ?>
            </div>
        </div>
    </div>
    <div class="blog-default-sidebar">
        <?php
        // Query the last 5 published blog posts
        $recent_posts_query = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 5,
            'post_status'    => 'publish',
        ]);

        // Check if there are posts
        if ($recent_posts_query->have_posts()) : ?>
            <div class="blog-recent">
                <h3>Recent Posts</h3>
                <ul class="recent-posts-widget">
                    <?php while ($recent_posts_query->have_posts()) : $recent_posts_query->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <?php wp_reset_postdata(); // Reset the global post data ?>
        <?php endif; ?>

        <?php dynamic_sidebar( 'blog_sidebar' ) ?>
    </div>
</div>