<?php
/**
 * Arina Digital
 *
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

// General
Redux::setSection( $opt_name, [
    'title'     => 'General',
    'id'        => 'general',
    'icon'      => 'el el-wrench',
    'fields'    => [
        [
            'id' => 'social_mail',
            'title' => 'E-posta',
            'type' => 'text',
            'default' => 'info@lidoma.com',
        ],
        [
            'id'=>'global-subsection-start',
            'type' => 'section',
            'title' => __('Global Social Media', 'global-social-media'),
            'indent' => true
        ],
        [
            'id' => 'global_social_instagram',
            'title' => 'Global Instagram URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'global_social_x',
            'title' => 'Global X URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'global_social_youtube',
            'title' => 'LATAM Youtube URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id'=>'global-subsection-end',
            'type' => 'section',
            'indent' => false
        ],
        [
            'id'=>'latam-subsection-start',
            'type' => 'section',
            'title' => __('LATAM Social Media', 'latam-social-media'),
            'indent' => true
        ],
        [
            'id' => 'latam_social_instagram',
            'title' => 'LATAM Instagram URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'latam_social_x',
            'title' => 'LATAM X URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'latam_social_youtube',
            'title' => 'LATAM Youtube URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id'=>'latam-subsection-end',
            'type' => 'section',
            'indent' => false
        ],
        [
            'id'=>'turkey-subsection-start',
            'type' => 'section',
            'title' => __('Turkey Social Media', 'turkey-social-media'),
            'indent' => true
        ],
        [
            'id' => 'turkey_social_instagram',
            'title' => 'Turkey Instagram URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'turkey_social_x',
            'title' => 'Turkey X URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'turkey_social_youtube',
            'title' => 'Turkey Youtube URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id'=>'turkey-subsection-end',
            'type' => 'section',
            'indent' => false
        ],
        [
            'id'=>'asia-subsection-start',
            'type' => 'section',
            'title' => __('Asia Social Media', 'asia-social-media'),
            'indent' => true
        ],
        [
            'id' => 'asia_social_instagram',
            'title' => 'Asia Instagram URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'asia_social_x',
            'title' => 'Asia X URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'asia_social_youtube',
            'title' => 'Asia Youtube URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id'=>'asia-subsection-end',
            'type' => 'section',
            'indent' => false
        ],
    ]
]);

// Header
Redux::setSection( $opt_name, [
    'title'     => 'Header Ayarları',
    'id'        => 'header-options',
    'icon'      => 'el el-wrench',
    'fields'    => [
        [
            'id'        => 'black_logo',
            'type'      => 'media',
            'url'       => true,
            'title'     => 'Logo Yükle',
            'default'   => [
                'url'   => ARINA_ASSETS_URI . '/icons/logo.svg'
            ]
        ],
        [
            'id'        => 'white_logo',
            'type'      => 'media',
            'url'       => true,
            'title'     => 'Beyaz Logo Yükle',
            'default'   => [
                'url'   => ''
            ]
        ],
    ]
]);

// Footer
Redux::setSection( $opt_name, [
    'title'  => 'Footer Ayarları',
    'id'     => 'footer-options',
    'icon'   => 'el el-wrench',
    'fields' => [
        [
            'id'    => 'footer_copyright',
            'type'  => 'text',
            'title' => 'Footer copyright',
            'default' => 'Copyright © 2024 Lidoma',
        ],
        [
            'id'    => 'footer_disclamer',
            'type'  => 'text',
            'title' => 'Terms and Conditions',
            'default' => 'Terms and Conditions',
        ],
        [
            'id'    => 'footer_disclamer_url',
            'type'  => 'text',
            'title' => 'Terms and Conditions',
            'default' => '#',
        ],
        [
            'id'    => 'footer_privacy',
            'type'  => 'text',
            'title' => 'footer privacy',
            'default' => 'Privacy Policy',
        ],
        [
            'id'    => 'footer_privacy_url',
            'type'  => 'text',
            'title' => 'footer privacy url',
            'default' => '#',
        ],
    ]
]);

// Blog Settings
Redux::setSection( $opt_name, [
    'title'  => 'Blog options',
    'id'     => 'inv-options',
    'icon'   => 'el el-wrench',
    'fields' => [
        [
            'id'    => 'news_title',
            'type'  => 'text',
            'title' => 'News page title',
            'default' => 'News & Insights',
        ],
        [
            'id'        => 'sidebar_logo',
            'type'      => 'media',
            'url'       => true,
            'title'     => 'News sidebar logo',
            'default'   => [
                'url'   => ARINA_ASSETS_URI . '/icons/side__logo.svg'
            ]
        ],
        [
            'id'    => 'sidebar_button',
            'type'  => 'text',
            'title' => 'News sidebar button text',
            'default' => 'View Original Source',
        ],
        [
            'id'    => 'sidebar_button_url',
            'type'  => 'text',
            'title' => 'News sidebar button url',
            'default' => '#',
        ],
        [
            'id'   =>'blog_divider1',
            'type' => 'divide'
        ],
        [
            'id'    => 'team_bread_text',
            'type'  => 'text',
            'title' => 'Team page bradcrumb text',
            'default' => 'Team',
        ],
        [
            'id'    => 'team_bread_url',
            'type'  => 'text',
            'title' => 'Team page bradcrumb url',
            'default' => '/team',
        ],
        [
            'id'   =>'blog_divider2',
            'type' => 'divide'
        ],
        [
            'id'    => 'title_view',
            'type'  => 'text',
            'title' => 'View Project text',
            'default' => "View Project",
        ],
    ]
]);

// Page Settings
Redux::setSection( $opt_name, [
    'title'  => 'Page options',
    'id'     => 'page-options',
    'icon'   => 'el el-wrench',
    'fields' => [
        [
            'id'    => 'bread_home_text',
            'type'  => 'text',
            'title' => 'breadcrump Home text',
            'default' => 'Home',
        ],
    ]
]);

// Contact Form Settings
Redux::setSection( $opt_name, [
    'title'  => 'Contact Form',
    'id'     => 'cForm-options',
    'icon'   => 'el el-wrench',
    'fields' => [
        [
            'id'    => 'form_check',
            'type'  => 'editor',
            'title' => 'Contact Form Check',
            'default' => 'Personal data',
        ],
        [
            'id'    => 'checkbox_validation',
            'type'  => 'textarea',
            'title' => 'Checkbox Validation message',
            'default' => 'Please give your consent to send the form',
        ],
    ]
]);

// 404
Redux::setSection( $opt_name, [
    'title'  => '404 Ayarları',
    'id'     => '404-options',
    'icon'   => 'el el-wrench',
    'fields' => [
        [
            'id'    => '404_content',
            'type'  => 'textarea',
            'title' => '404 Content',
            'default' => 'The requested page was not found!',
        ],
        [
            'id'    => '404_button',
            'type'  => 'text',
            'title' => '404 button text',
            'default' => 'Go Back Home',
        ],
    ]
]);

// Style
Redux::setSection( $opt_name, [
    'title'  => 'Styling',
    'id'     => 'styling',
    'icon'   => 'el el-brush',
    'fields' => [
        [
            'id' => 'primary_color',
            'type' => 'color',
            'title' => 'Primary color',
            'default' => '',
        ],
        [
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => 'Secondary color',
            'default' => '',
        ]
    ]
]);
