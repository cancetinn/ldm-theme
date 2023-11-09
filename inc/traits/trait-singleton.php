<?php
/**
 * Arina Digital
 * 
 **/

namespace ARINA_THEME\Inc\Traits;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

trait Singleton {
	protected function __construct(){}
	final protected function __clone(){}

	final public static function get_instance(){
		static $instance = [];

		$called_class = get_called_class();

		if (!isset( $instance[ $called_class ] )) {
			$instance[ $called_class ] = new $called_class;
			do_action( sprintf( 'arina_theme_singleton_init_%s', $called_class ) );
		}

		return $instance[ $called_class ];
	}

}
