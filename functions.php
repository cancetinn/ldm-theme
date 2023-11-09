<?php
/**
 * Arina Digital
 *
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

// Constants: Folder directories/uri's
define( 'ARINA_TEXT',       'arina' );
define( 'ARINA_VERSION',    '1.0' );
define( 'ARINA_THEME_DIR',  trailingslashit(get_template_directory()) );
define( 'ARINA_INC_DIR',    trailingslashit(get_template_directory()) . 'inc' );
define( 'ARINA_ASSETS_DIR', trailingslashit(get_template_directory()) . 'assets' );
define( 'ARINA_THEME_URI',  trailingslashit(get_template_directory_uri()) );
define( 'ARINA_ASSETS_URI', trailingslashit(get_template_directory_uri()) . 'assets' );

require_once ARINA_INC_DIR . '/helpers/plugin-activation.php';
require_once ARINA_INC_DIR . '/helpers/autoloader.php';
require_once ARINA_INC_DIR . '/helpers/theme-helpers.php';

// Get All Class
function arina_get_theme_instance(){
    \ARINA_THEME\Inc\Start::get_instance();
}
arina_get_theme_instance();

// Redux Framework
if(class_exists('Redux')) :
    include ARINA_THEME_DIR . 'framework/redux.php';
endif;

// Prevent ob_end_flush() notice when in debug mode
if (WP_DEBUG) {
    remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
    add_action( 'shutdown', function() {
        while ( @ob_end_flush() );
    });
}

// add paged to query vars
add_filter('query_vars', 'add_query_vars');
function add_query_vars($vars) {
    $vars[] = "paged";
    return $vars;
}

// disabled wp editor
define( 'DISALLOW_FILE_EDIT', true );

