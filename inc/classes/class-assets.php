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
        wp_dequeue_style('redux-extendify-styles');
    }

    function register_scripts()
    {
        // Dynamic scrip versions
        $theme_js = filemtime( ARINA_ASSETS_DIR . '/js/theme.min.js' );

        // Register scripts
        wp_register_script('lazysizes', ARINA_OUTSIDE . '/plugins/lazysizes.min.js', [], '5.3.2', true);
        //wp_register_style('fancybox', ARINA_OUTSIDE . '/plugins/fancybox.min.css', [], '5.0', 'all');
        //wp_register_script('fancybox', ARINA_OUTSIDE . '/plugins/fancybox.min.js', [], '5.0', true);
        /*wp_register_style('aos', ARINA_OUTSIDE . '/plugins/aos.min.css', [], '3.0.0', 'all');
        wp_register_script('aos', ARINA_OUTSIDE . '/plugins/aos.min.js', [], '3.0.0', 'all');*/
        wp_register_script('theme', ARINA_ASSETS_URI . '/js/theme.min.js', [], $theme_js, true);

        // Enqueue scripts
        wp_enqueue_script('lazysizes');
        //wp_enqueue_style('fancybox');
        //wp_enqueue_script('fancybox');
        /*wp_enqueue_style('aos');
        wp_enqueue_script('aos');*/
        wp_enqueue_script('theme');

        if ( is_singular('investments') ) {
            //wp_register_style('swiper', ARINA_OUTSIDE . '/plugins/swiper.min.css', [], '5.0.0', 'all');
            //wp_register_script('swiper', ARINA_OUTSIDE . '/plugins/swiper.min.js', [], '5.0.0', true);

            //wp_enqueue_style('swiper');
            //wp_enqueue_script('swiper');
        }
    }

    function arina_admin_enqueue()
    {
        global $pagenow;
        $page = !empty($_GET['page']) ? $_GET['page'] : '';

        if ($page == 'arina-theme-settings' || $pagenow == 'customize.php') :
            wp_enqueue_style('redux', ADMIN_STYLE . '/redux.css');
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
