<?php
/**
 * The template for displaying simple search.
 *
 * DG\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<form action="<?php bloginfo('url'); ?>" id="searchform" method="get">
    <div class="input">
        <label for="s" class="screen-reader-text">Search for:</label>
        <input type="text" id="s" name="s" value="<?php echo get_query_var('s') ?>" placeholder="SEARCH" />
    </div>
    <div class="submit">
        <input type="submit" value="Search" id="searchsubmit" />
    </div>        
</form>