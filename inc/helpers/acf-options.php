<?php
/**
 * Arina Digital
 *
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action( 'acf/include_fields', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'qef_simple_location_rules' => 0,
        'key' => 'group_65c4e473179d8',
        'title' => 'investments',
        'fields' => array(
            array(
                'allow_backendsearch' => 0,
                'show_column_filter' => false,
                'allow_bulkedit' => 1,
                'allow_quickedit' => 1,
                'show_column' => 0,
                'show_column_weight' => 1000,
                'show_column_sortable' => false,
                'key' => 'field_65c4e473ae3e1',
                'label' => 'Location',
                'name' => 'location',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'allow_backendsearch' => false,
                'show_column_filter' => false,
                'allow_bulkedit' => 0,
                'allow_quickedit' => 0,
                'show_column' => 0,
                'show_column_weight' => 1000,
                'show_column_sortable' => false,
                'key' => 'field_65ca0a0ab67c8',
                'label' => 'Logo',
                'name' => 'inv_logo',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'preview_size' => 'medium',
            ),
            array(
                'allow_backendsearch' => false,
                'show_column_filter' => false,
                'allow_bulkedit' => false,
                'allow_quickedit' => false,
                'show_column' => 0,
                'show_column_weight' => 1000,
                'show_column_sortable' => false,
                'key' => 'field_65c9bab7b3b55',
                'label' => 'Gallery',
                'name' => 'inv_gallery',
                'aria-label' => '',
                'type' => 'gallery',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '70',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'library' => 'all',
                'min' => '',
                'max' => '',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'insert' => 'append',
                'preview_size' => 'thumbnail',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'investments',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ) );

    acf_add_local_field_group( array(
        'qef_simple_location_rules' => 0,
        'key' => 'group_65c37d811a33b',
        'title' => 'Team fieds',
        'fields' => array(
            array(
                'allow_backendsearch' => 0,
                'show_column_filter' => false,
                'allow_bulkedit' => 1,
                'allow_quickedit' => 1,
                'show_column' => 0,
                'show_column_weight' => 1000,
                'show_column_sortable' => false,
                'key' => 'field_65c37d81c4a9c',
                'label' => 'Team Title',
                'name' => 'team_title',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'team',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ) );

    acf_add_local_field_group( array(
        'qef_simple_location_rules' => 0,
        'key' => 'group_65dd83d93303c',
        'title' => 'Page Options',
        'fields' => array(
            array(
                'allow_backendsearch' => false,
                'show_column_filter' => 0,
                'allow_bulkedit' => 0,
                'allow_quickedit' => 0,
                'show_column' => 0,
                'show_column_weight' => 1000,
                'show_column_sortable' => false,
                'key' => 'field_65dd83d9bf3ea',
                'label' => 'Dark/Light mode',
                'name' => 'light_mode',
                'aria-label' => '',
                'type' => 'button_group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'dark' => 'Dark',
                    'light' => 'Light',
                ),
                'default_value' => 'dark',
                'return_format' => 'value',
                'allow_null' => 0,
                'layout' => 'horizontal',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));

});

//Menu Button ACF
function custom_menu_class_from_acf($classes, $item, $args) {
    $acf_field_name = 'button';
    $menu_item_class = get_field($acf_field_name, $item);

    if (is_array($menu_item_class)) {
        $menu_item_class = implode(' ', $menu_item_class);
    }

    if ($menu_item_class) {
        $classes[] = 'menu-' . sanitize_title($menu_item_class);
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'custom_menu_class_from_acf', 10, 3);




