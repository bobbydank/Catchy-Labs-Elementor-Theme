<?php
/**
 * The template for displaying a site wide search.
 *
 * DG\Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<div id="search-form-overlay" class="search-overlay hidden">
    <i class="fa-solid fa-circle-xmark icon-cancel" title="Close search bar"></i>
    <div class="search-overlay-content">
        <form action="<?php echo home_url( '/' ); ?>" role="search" method="get">
            <input type="text" placeholder="Enter text to search" name="s">
            <button type="submit">Search</button>
        </form>
    </div>
</div>