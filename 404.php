<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */

get_header();
?>
<div class="error-404">
	<h2>404</h2>
	<h3>Oops! It looks like nothing was found at this location.</h3>
	<div class="error-404__link"><a href="<?php echo site_url(''); ?>">Go Back</a>
	</div>
</div><!-- .error-404 -->

<?php
get_footer();
