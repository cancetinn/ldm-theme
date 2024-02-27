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
            'default' => 'info@arinadigital.com',
        ],
        [
            'id' => 'social_linkedin',
            'title' => 'linkedin URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_facebook',
            'title' => 'facebook URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_instagram',
            'title' => 'instagram URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_youtube',
            'title' => 'youtube URL',
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_x',
            'title' => 'X URL',
            'type' => 'text',
            'default' => '#',
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
            'id'        => 'footer_logo',
            'type'      => 'media',
            'url'       => true,
            'title'     => 'Footer logo',
            'default'   => [
                'url'   => ARINA_ASSETS_URI . '/icons/black_logo.svg'
            ]
        ],
        [
            'id'        => 'footer_bg',
            'type'      => 'media',
            'url'       => true,
            'title'     => 'Footer bg',
            'default'   => [
                'url'   => ARINA_ASSETS_URI . '/img/footer-bg.png'
            ]
        ],
        [
            'id'    => 'footer_adressTR',
            'type'  => 'textarea',
            'title' => 'Footer adress TR',
            'default' => 'Sair Nedim Cd. No:20 Kat:6  Besiktas, Istanbul TURKEY',
        ],
        [
            'id'    => 'footer_phoneTR',
            'type'  => 'text',
            'title' => 'Footer phone TR',
            'default' => '+90 212 381 2222',
        ],
        [
            'id'    => 'footer_adressEN',
            'type'  => 'textarea',
            'title' => 'Footer adress EN',
            'default' => '55 East 59th Street, 24th floor  New York, NY USA',
        ],
        [
            'id'    => 'footer_phoneEN',
            'type'  => 'text',
            'title' => 'Footer phone EN',
            'default' => '+1 212 616 0400',
        ],
        [
            'id'    => 'footer_copyright',
            'type'  => 'text',
            'title' => 'Footer copyright',
            'default' => '© 2024 BLG Varlık',
        ],
        [
            'id'    => 'footer_disclamer',
            'type'  => 'text',
            'title' => 'Disclaimer',
            'default' => 'Disclaimer',
        ],
        [
            'id'    => 'footer_disclamer_url',
            'type'  => 'text',
            'title' => 'Disclaimer url',
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
