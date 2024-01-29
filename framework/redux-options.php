<?php
/**
 * Arina Digital
 *
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

// General
Redux::setSection( $opt_name, [
    'title'     => __( 'General', ARINA_REDUX ),
    'id'        => 'general',
    'icon'      => 'el el-wrench',
    'fields'    => [
        [
            'id' => 'social_mail',
            'title' => esc_html__( 'E-posta', ARINA_REDUX ),
            'type' => 'text',
            'default' => 'info@gtech.com.tr',
        ],
        [
            'id' => 'social_linkedin',
            'title' => esc_html__( 'linkedin URL', ARINA_REDUX ),
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_facebook',
            'title' => esc_html__( 'facebook URL', ARINA_REDUX ),
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_instagram',
            'title' => esc_html__( 'instagram URL', ARINA_REDUX ),
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_youtube',
            'title' => esc_html__( 'youtube URL', ARINA_REDUX ),
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_x',
            'title' => esc_html__( 'X URL', ARINA_REDUX ),
            'type' => 'text',
            'default' => '#',
        ],
    ]
]);

// Header
Redux::setSection( $opt_name, [
    'title'     => __( 'Header Ayarları', ARINA_REDUX ),
    'id'        => 'header-options',
    'icon'      => 'el el-wrench',
    'fields'    => [
        [
            'id'        => 'logo-upload',
            'type'      => 'media',
            'url'       => true,
            'title'     => __( 'Logo Yükle', ARINA_REDUX ),
            'default'   => [
                'url'   => '' //ARINA_ASSETS_URI . '/img/logo.png'
            ]
        ],
    ]
]);

// Footer
Redux::setSection( $opt_name, [
    'title'  => __( 'Footer Ayarları', ARINA_REDUX ),
    'id'     => 'footer-options',
    'icon'   => 'el el-brush',
    'fields' => [
        [
            'id'    => 'footer_copyright',
            'type'  => 'text',
            'title' => esc_html__( 'Footer copyright', ARINA_REDUX ),
            'default' => '© Copyright GTech 2023',
        ],
        [
            'id'    => 'footer_poweredby',
            'type'  => 'editor',
            'title' => esc_html__( 'Footer powered by', ARINA_REDUX ),
            'default' => 'Arina Digital tarafından geliştirildi.',
        ]
    ]
]);

// Single
Redux::setSection( $opt_name, [
    'title'     => __( 'İçerik Ayarları', ARINA_REDUX ),
    'id'        => 'single-options',
    'icon'      => 'el el-wrench',
]);

Redux::setSection( $opt_name, [
    'title'     => __( 'Pozisyon ayarları', ARINA_REDUX ),
    'subsection' => true,
    'id'        => 'single-options-positions',
    'fields'    => [
        [
            'id'       => 'blog_readmore',
            'type'     => 'text',
            'title'    => esc_html__( 'Devamını oku yazısı', ARINA_REDUX ),
            'default'  => 'Devamını oku',
        ],
    ],
]);

// Style
Redux::setSection( $opt_name, [
    'title'  => __( 'Styling', ARINA_REDUX ),
    'id'     => 'styling',
    'icon'   => 'el el-brush',
    'fields' => [
        [
            'id' => 'top_primary_color',
            'type' => 'color',
            'title' => __('Top header rengi', ARINA_REDUX),
            'default' => '',
        ],
        [
            'id' => 'global_primary_color',
            'type' => 'color',
            'title' => __('Genel site rengi', ARINA_REDUX),
            'default' => '',
        ]
    ]
]);
