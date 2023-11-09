<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc;

use ARINA_THEME\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Start
{
    use Singleton;

    protected function __construct()
    {
        // load class
        Ajax::get_instance();
        Assets::get_instance();
        Core::get_instance();
        Menus::get_instance();
        Options::get_instance();
        Mail::get_instance();

        // Load Elementor
        if (did_action('elementor/loaded')) :
            Elementor::get_instance();
        endif;
    }
}
