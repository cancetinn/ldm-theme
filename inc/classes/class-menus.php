<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc;

use ARINA_THEME\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Menus
{
    use Singleton;

    protected function __construct()
    {
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        // Actions.
        add_action('init', [$this, 'register_menus']);
    }

    public function register_menus()
    {
        register_nav_menus([
            'main-menu'     => 'Main Menu',
            'mobile-main'   => 'Mobile Main Menu',
            'top-menu'      => 'Top Menu',
            'mobile-top'    => 'Mobile Top Menu',
        ]);
    }

    public function get_menu_id($location)
    {
        // Get all the location
        $locations = get_nav_menu_locations();

        // Return object id by location
        return !empty($locations[$location]) ? $locations[$location] : '';
    }

    public function get_child_menu_items($menu_array, $parent_id): array
    {
        $child_menus = [];

        if (!empty($menu_array) && is_array($menu_array)) {
            foreach ($menu_array as $menu) {
                if (intval($menu->menu_item_parent) === $parent_id) {
                    $child_menus[] = $menu;
                }
            }
        }

        return $child_menus;
    }
}
