<?php
	/*
	* Generate a unique ID for each form and a string containing an aria-label if
	* one was passed to get_search_form() in the args array.
	* Taken from twentytwenty theme.
	*/
    $unique_id = esc_attr( uniqid( 'search-form-' ) );
    $aria_label = ! empty( $args['label'] ) ? 'aria-label="' . esc_attr( $args['label'] ) . '"' : '';
?>
<form role="search" <?php echo $aria_label; ?> method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>">
		<span class="screen-reader-text">
			<?php _e( 'Search for:', 'btrailers-theme' );  ?>
		</span>
		<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'btrailers-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required />
	</label>
		<input type="submit" value="<?php echo _x( 'Submit Search', 'label', 'btrailers-theme' ); ?>" class="search-submit" >
</form>
