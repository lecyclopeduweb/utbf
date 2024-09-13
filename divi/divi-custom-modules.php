<?php
if ( ! function_exists( 'dicm_initialize_extension' ) ):

	/**
	 * Creates the extension's main class instance.
	 *
	 * @since 1.0.0
	 */
	function dicm_initialize_extension() {
		require_once UTBF_DIVI_PATH . '/includes/DiviCustomModules.php';
	}
	add_action( 'divi_extensions_init', 'dicm_initialize_extension' );

endif;
