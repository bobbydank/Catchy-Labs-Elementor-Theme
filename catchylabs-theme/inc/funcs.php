<?php

/**
 * Calculate the reading time of a post.
 *
 * Gets the post content, counts the images, strips shortcodes, and strips tags.
 * Then counts the words. Converts images into a word count. And outputs the
 * total reading time.
 *
 * @since 1.0.0
 *
 * @param int   $rt_post_id The Post ID.
 * @param array $rt_options The options selected for the plugin.
 * @return string|int The total reading time for the article or string if it's 0.
 */
function cl_calculate_reading_time( $rt_post_id ) {

    $rt_content       = get_post_field( 'post_content', $rt_post_id );
    $number_of_images = substr_count( strtolower( $rt_content ), '<img ' );

    /*
    if ( ! isset( $rt_options['include_shortcodes'] ) ) {
        $rt_content = strip_shortcodes( $rt_content );
    }*/

    $rt_content = wp_strip_all_tags( $rt_content );
    $word_count = count( preg_split( '/\s+/', $rt_content ) );

    /*
    if ( isset( $rt_options['exclude_images'] ) && ! $rt_options['exclude_images'] ) {
        // Calculate additional time added to post by images.
        $additional_words_for_images = $this->rt_calculate_images( $number_of_images, $rt_options['wpm'] );
        $word_count                 += $additional_words_for_images;
    }*/

    $word_count = apply_filters( 'rtwp_filter_wordcount', $word_count );

    $reading_time = $word_count / 300;

    // If the reading time is 0 then return it as < 1 instead of 0.
    if ( 1 > $reading_time ) {
        $reading_time = __( '< 1', 'reading-time-wp' );
    } else {
        $reading_time = ceil( $reading_time );
    }

    return $reading_time . ' min read.';

}

/** 
 * Filter the except length to any specified length of words. 
 * 
 * @param string $content the content 
 * @param int $length Excerpt length. 
 * @return int (Maybe) modified excerpt length. 
 */
function cl_custom_excerpt($content, $limit) {
    $excerpt = explode(' ', strip_tags($content), $limit);

    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt);
    } else {
        $excerpt = implode(" ",$excerpt);
    }  

    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}
