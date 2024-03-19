<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc;

use ARINA_THEME\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Options
{
    use Singleton;

    protected function __construct()
    {
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        // ACTIONS
        add_action('after_setup_theme', [$this, 'support_theme']);
        add_action('tgmpa_register', [$this, 'plugins_activation']);
        add_action('widgets_init', [$this, 'register_sidebars']);
        add_action('pre_get_posts', [$this, 'exclude_pages_from_search']);

        // FILTERS
        add_filter('wp_get_attachment_image_attributes', [$this, 'image_lazyload_class'], 10, 3);
        add_filter('get_the_archive_title', [$this, 'archive_title_etc_remove']);
        add_filter('get_avatar', [$this, 'disabled_gravatar']);
        add_filter('script_loader_tag', [$this, 'defer_parsing_of_js'], 10);
        add_filter('body_class', [$this, 'body_filter_classes'], 10, 1);
        add_filter('wp_nav_menu_args', [$this, 'change_widget_menu_class']);
        add_filter('widget_tag_cloud_args', [$this, 'arina_tag_cloud_font_change']);
        add_filter('wp_list_categories', [$this, 'arina_list_categories_output_change']);

        // disabled login lang
        add_filter( 'login_display_language_dropdown', '__return_false' );
        // Disabled wp lazyload
        add_filter('wp_lazy_loading_enabled', '__return_false');
    }

    public function support_theme()
    {
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', [
            'navigation-widgets',
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
        ]);

        // Add image size
        add_image_size( 'news_thumb', 301, 281, true );
        add_image_size( 'team_thumb', 301, 408, true );
        add_image_size( 'blog_thumb', 523, 330, true );
        add_image_size( 'inv_thumb', 412, 412, true );

        //Remove widgets block editor
        remove_theme_support('widgets-block-editor');

        // WooCommerce
        if (class_exists('WooCommerce')) :
            add_theme_support('woocommerce');
            add_theme_support('wc-product-gallery-slider');
        endif;

        // Elementor default settings
        if (did_action('elementor/loaded')) :
            update_option('elementor_global_image_lightbox', '');
            update_option('elementor_disable_color_schemes', 'yes');
            update_option('elementor_disable_typography_schemes', 'yes');
        endif;

        //flush_rewrite_rules( false );

        register_post_type('tournaments', [
                'labels' => [
                    'name' => __('Tournaments', ARINA_TEXT),
                    'singular_name' => __('Tournaments', ARINA_TEXT)
                ],
                'menu_icon'     => 'dashicons-games',
                'menu_position' => 4,
                'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
                'rewrite'       => array('slug' => 'tournaments'),
                'show_ui'       => true,
                'has_archive'   => false,
                'public'        => true,
                'show_in_rest'  => true, // gutenberg
                //'publicly_queryable'  => false,
            ]
        );

        register_post_type('casestudies', [
                'labels' => [
                    'name' => __('Case Studies', ARINA_TEXT),
                    'singular_name' => __('Casestudies', ARINA_TEXT)
                ],
                'menu_icon'     => 'dashicons-heart',
                'menu_position' => 5,
                'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
                'rewrite'       => array('slug' => 'case-study'),
                'show_ui'       => true,
                'has_archive'   => false,
                'public'        => true,
                'show_in_rest'  => true, // gutenberg
                //'publicly_queryable'  => false,
            ]
        );

        register_post_type('newsletter', [
            'labels' => [
                'name' => __('Newsletter', ARINA_TEXT),
                'singular_name' => __('Newsletter', ARINA_TEXT)
            ],
            'menu_icon'     => 'dashicons-email',
            'menu_position' => 6,
            'supports'      => array('title'),
            'rewrite'       => array('slug' => 'newsletter'),
            'show_ui'       => true,
            'has_archive'   => false,
            'public'        => false,
            'show_in_rest'  => false,
                'capabilities' => array(

                    'create_posts' => false,
                ),
            'publicly_queryable'  => false,
        ]
        );

    }



    public function plugins_activation()
    {
        $plugins = [
            array(
                'order'     => 1,
                'name'      => 'Redux Framework',
                'slug'      => 'redux-framework',
                'required'  => true,
            ),

            array(
                'order'     => 2,
                'name'      => 'Elementor Page Builder',
                'slug'      => 'elementor',
                'required'  => true,
            ),

            array(
                'name'      => 'ACF',
                'slug'      => 'advanced-custom-fields',
                'required'  => true,
            ),

            array(
                'name'      => 'Yoast SEO',
                'slug'      => 'wordpress-seo',
                'required'  => false,
            )
        ];

        $config = [
            'id' => ARINA_TEXT,
            'default_path' => '',
            'menu' => 'arina-install-plugins',
            'has_notices' => true,
            'dismissable' => true,
            'dismiss_msg' => '',
            'is_automatic' => true,
            'message' => '',
        ];

        tgmpa($plugins, $config);
    }

    public function register_sidebars()
    {
        // Sidebar: Blog
        register_sidebar([
            'name'          => esc_html__('Blog Widget', ARINA_TEXT),
            'id'            => 'sidebar-blog',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="title regular">',
            'after_title'   => '</h3>'
        ]);

        register_sidebars( 4, [
            'name'          => esc_html__('Footer Sidebar %d', ARINA_TEXT),
            'id'            => 'sidebar-footer',
            'before_widget' => '<ul id="%1$s" class="fLinks %2$s">',
            'after_widget'  => '</ul>',
            'before_title'  => '<h3 class="title small dropdown_link">',
            'after_title'   => '</h3>'
        ]);
    }

    public function image_lazyload_class($attr, $attachment, $size)
    {
        if (is_admin()) return $attr;
        if (str_contains($attr['class'], 'no_lazy')) return $attr;

        if ($attachment->post_mime_type === 'image/svg+xml') {
            unset($attr['loading']);
        }

        // Get image w/h
        $img_id = $attachment->ID;
        $crop_img = image_get_intermediate_size($img_id, $size);

        if ($crop_img) {
            $width = $crop_img['width'];
            $height = $crop_img['height'];
        } else {
            $image_meta = wp_get_attachment_metadata($img_id);
            $width = $image_meta['width'];
            $height = $image_meta['height'];
        }

        if (isset($attr['src'])) {
            $attr['data-src'] = $attr['src'];
            $attr['src'] = "data:image/svg+xml,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20width%3D'$width'%20height%3D'$height'%20viewBox%3D'0%200%20360%20320'%2F%3E";
        }

        if (isset($attr['srcset'])) {
            $attr['data-srcset'] = $attr['srcset'];
            $attr['srcset'] = '';
        }

        $attr['class'] .= ' lazyload';

        return $attr;
    }

    public function archive_title_etc_remove($title)
    {
        if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_author()) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        } elseif (is_tax()) {
            $title = single_term_title('', false);
        }
        return $title;
    }

    public function disabled_gravatar($avatar)
    {
        return preg_replace(
            "/http.*?gravatar\.com[^\']*/",
            ARINA_ASSETS_URI . '/img/icon.png', $avatar
        );
    }

    public function defer_parsing_of_js($url)
    {
        if ( is_admin() ) return $url;
        if ( !str_contains($url, '.js') ) return $url;

        // Add the files to exclude from defer.
        $exclude_files = [
            'jquery/jquery',
            'hooks.min',
            'i18n.min'
        ];

        foreach ($exclude_files as $file) {
            if (str_contains($url, $file)) {
                return $url;
            }
        }

        return str_replace( ' src', ' defer src', $url );
    }

    public function body_filter_classes($classes)
    {
        // page light mode
        if ( getField('light_mode') === "light" ) {
            $classes[] = "lightmode";
        }

        /*if (class_exists('woocommerce')) :
            $classes[] = 'arina-woocommerce';

            if (in_array("woocommerce-no-js", $classes)) {
                remove_action('wp_footer', 'wc_no_js');
                $classes = array_diff($classes, array('woocommerce-no-js'));
            }
        endif;*/

        return array_values($classes);
    }

    public function change_widget_menu_class( $args )
    {
        if ( $args['menu_class'] == 'menu' ) {
            $args['menu_class'] = 'link-list dropdown_content';
            $args['container'] = false;
            $args['depth'] = 1;
        }
        return $args;
    }

    public function arina_tag_cloud_font_change( $args )
    {
        $args['smallest'] = 9;
        $args['largest']  = 9;
        $args['format']  = 'list';

        return $args;
    }

    public function arina_list_categories_output_change( $links )
    {
        $links = str_replace('</a> (', '</a> <span>', $links);
        $links = str_replace(')', '</span>', $links);

        return $links;
    }

    public function exclude_pages_from_search($query)
    {
        if ( !is_admin() && $query->is_main_query() ) {
            if ( $query->is_search ) {
                $query->set( 'post_type', ['post'] );
            }
        }
    }
}
