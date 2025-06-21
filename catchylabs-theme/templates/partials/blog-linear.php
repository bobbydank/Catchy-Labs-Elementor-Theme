<div class="linear-layout">
    <h1 class="blog-title"><?php the_title(); ?></h1>
    <p><strong>By: <a href="https://twitter.com/CatchyLabs/" target="_blank"><?php the_author(); ?></a></strong></p>
    <div class="page-subhead">
        <p>Published on: <?php the_time('M d, Y'); ?></p>
        <p><?php echo cl_calculate_reading_time( get_the_ID() ); ?></p>
    </div>

    <div class="the-content"><?php the_content(); ?></div>
    <div class="post-tags">
        <?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'cl-elementor' ), null, '</span>' ); ?>
    </div>
    <?php wp_link_pages(); ?>

    <?php comments_template(); ?>
</div>