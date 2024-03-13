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
        'key' => 'group_65de3917dff8b',
        'title' => 'Header Button',
        'fields' => array(
            array(
                'key' => 'field_65de391848307',
                'label' => 'button',
                'name' => 'button',
                'aria-label' => '',
                'type' => 'checkbox',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'Button' => 'Button',
                ),
                'default_value' => array(
                    0 => 'button',
                ),
                'return_format' => 'value',
                'allow_custom' => 0,
                'layout' => 'vertical',
                'toggle' => 0,
                'save_custom' => 0,
                'custom_choice_button_text' => 'Yeni seçenek ekle',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'nav_menu_item',
                    'operator' => '==',
                    'value' => 'all',
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
        'key' => 'group_65db79f9b4e67',
        'title' => 'Tournament Settings',
        'fields' => array(
            array(
                'key' => 'field_65f1b2b92e1e2',
                'label' => 'Banner',
                'name' => 'banner',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
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
                'key' => 'field_65f1b268293f5',
                'label' => 'Page Template',
                'name' => 'page_template',
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
                    'TEMPLATE_ONE' => 'TEMPLATE_ONE',
                    'TEMPLATE_TWO' => 'TEMPLATE_TWO',
                    'TEMPLATE_THREE' => 'TEMPLATE_THREE',
                ),
                'default_value' => 'TEMPLATE_ONE',
                'return_format' => 'value',
                'allow_null' => 0,
                'layout' => 'horizontal',
            ),
            array(
                'key' => 'field_65f1b22079a84',
                'label' => 'Tournament URL',
                'name' => 'tournament_url',
                'aria-label' => '',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
            array(
                'key' => 'field_65db79f9a7024',
                'label' => 'Platform',
                'name' => 'platform',
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
                'default_value' => 'PC',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_65db7a19a7025',
                'label' => 'Team Capacity',
                'name' => 'team_capacity',
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
                'default_value' => '5V5',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_65db7a96a7026',
                'label' => 'Price',
                'name' => 'price',
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
                'default_value' => 'FREE',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_65db7b06776aa',
                'label' => 'Prize Pool',
                'name' => 'prize_pool',
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
                'default_value' => '$0',
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
                    'value' => 'tournaments',
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
} );

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




