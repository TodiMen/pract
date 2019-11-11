<?php
/**
 * The searchform
 *
 * @package Mantra
 */

?>
<form method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _e( 'Search for:', 'mantra' ); ?></span>
		<input type="search" class="s" placeholder="<?php echo esc_attr_e( 'Search', 'mantra' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="searchsubmit"><span class="screen-reader-text"><?php echo _e( 'Search', 'mantra' ); ?></span>OK</button>
</form>
