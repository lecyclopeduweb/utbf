<?php
/**
 * Initialize Extension
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'UTBF_initialize_extension' ) ):

	/**
	 * Creates the extension's main class instance.
	 *
	 * @since 1.0.0
	 */
	function UTBF_initialize_extension() {
		require_once UTBF_DIVI_PATH . '/includes/DiviCustomModules.php';
	}
	add_action( 'divi_extensions_init', 'UTBF_initialize_extension' );

endif;
