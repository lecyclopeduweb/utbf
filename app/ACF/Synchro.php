<?php

declare( strict_types=1 );

namespace AppUtbf\ACF;

/**
 * ACF Save local Json
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Synchro {

    /**
     * __construct
     *
     * @return void
     */
	public function __construct() {

		add_filter( 'acf/settings/save_json', [ $this, 'acf_json_save_point' ] );
		add_filter( 'acf/settings/load_json', [ $this, 'acf_json_load_point' ] );

	}

	/**
	 * Save ACF Field
	 *
	 * @return 		string
	 */
	public function acf_json_save_point(): string
	{

		return UTBF_PATH_ACF_JSON;

	}

	/**
	 * Load ACF Field
	 *
	 * @param  		array  $paths  paths
	 *
	 * @return 		array
	 */
	public function acf_json_load_point(array $paths ):array
	{

		unset($paths[0]);
		$paths[] 			= UTBF_PATH_ACF_JSON;
		return $paths;

	}

}