<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc;

use ARINA_THEME\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Assets
{
    use Singleton;

    protected function __construct()
    {
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        // Front scripts
        if (!is_admin()){
            add_action('wp_enqueue_scripts', [$this, 'register_styles']);
            add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
        }

        // admin scripts
        add_action('admin_enqueue_scripts', [$this, 'arina_admin_enqueue']);

        // remove jQuery migrate script
        add_action('wp_default_scripts', [$this, 'remove_jquery_migrate']);
    }

    function register_styles()
    {
        // Dynamic style versions
        $theme_css = filemtime( ARINA_ASSETS_DIR . '/css/theme.min.css' );

        // Register style
        wp_register_style('theme', ARINA_ASSETS_URI . '/css/theme.min.css', [], $theme_css, 'all');

        // Enqueue style
        wp_enqueue_style('style', get_stylesheet_uri(), [], ARINA_VERSION, 'all');
        wp_enqueue_style('theme');

        // Removed block/global/classic styles
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-blocks-style');
        wp_dequeue_style('global-styles');
        wp_dequeue_style('classic-theme-styles');
    }

    function register_scripts()
    {
        // Dynamic scrip versions
        $theme_js = filemtime( ARINA_ASSETS_DIR . '/js/theme.min.js' );

        // Register scripts
        wp_register_script('theme', ARINA_ASSETS_URI . '/js/theme.min.js', [], $theme_js, true);

        // disabled jQuery
        /*wp_deregister_script('jquery');
        wp_register_script('jquery', false);*/

        // Enqueue scripts
        //wp_enqueue_script('jquery');
        wp_enqueue_script('theme');
    }

    function arina_admin_enqueue()
    {
        global $pagenow;
        $page = !empty($_GET['page']) ? $_GET['page'] : '';

        if ($page == 'arina-theme-settings' || $pagenow == 'customize.php') :
            wp_enqueue_style('redux', ARINA_THEME_URI . '/dev/admin/redux.css');
        endif;
    }

    function remove_jquery_migrate($scripts)
    {
        if (!is_admin() && isset($scripts->registered['jquery'])) {
            $script = $scripts->registered['jquery'];

            if ($script->deps) {
                $script->deps = array_diff($script->deps, array('jquery-migrate'));
            }
        }
    }
}
