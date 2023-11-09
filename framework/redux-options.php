<?php
/**
 * Arina Digital
 *
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

// General
Redux::setSection( $opt_name, [
    'title'     => __( 'General', ARINA_TEXT ),
    'id'        => 'general',
    'icon'      => 'el el-wrench',
    'fields'    => [
        [
            'id' => 'social_mail',
            'title' => esc_html__( 'E-posta', ARINA_TEXT ),
            'type' => 'text',
            'default' => 'info@gtech.com.tr',
        ],
        [
            'id' => 'social_linkedin',
            'title' => esc_html__( 'linkedin URL', ARINA_TEXT ),
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_facebook',
            'title' => esc_html__( 'facebook URL', ARINA_TEXT ),
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_instagram',
            'title' => esc_html__( 'instagram URL', ARINA_TEXT ),
            'type' => 'text',
            'default' => '#',
        ],
        [
            'id' => 'social_youtube',
            'title' => esc_html__( 'youtube URL', ARINA_TEXT ),
            'type' => 'text',
            'default' => '#',
        ],
        /*[
            'id' => 'social_twitter',
            'title' => esc_html__( 'twitter URL', ARINA_TEXT ),
            'type' => 'text',
            'default' => '#',
        ],*/
    ]
]);

// Header
Redux::setSection( $opt_name, [
    'title'     => __( 'Header Ayarları', ARINA_TEXT ),
    'id'        => 'header-options',
    'icon'      => 'el el-wrench',
    'fields'    => [
        [
            'id'        => 'logo-upload',
            'type'      => 'media',
            'url'       => true,
            'title'     => __( 'Logo Yükle', ARINA_TEXT ),
            'default'   => [
                'url'   => '/img/logo-black.png'
            ]
        ],
    ]
]);

// Footer
Redux::setSection( $opt_name, [
    'title'  => __( 'Footer Ayarları', ARINA_TEXT ),
    'id'     => 'footer-options',
    'icon'   => 'el el-brush',
    'fields' => [
        [
            'id'    => 'footer_copyright',
            'type'  => 'text',
            'title' => esc_html__( 'Footer copyright', ARINA_TEXT ),
            'default' => '© Copyright Gtech 2023',
        ],
        [
            'id'    => 'footer_poweredby',
            'type'  => 'editor',
            'title' => esc_html__( 'Footer powered by', ARINA_TEXT ),
            'default' => 'Arina Digital tarafından geliştirildi.',
        ]
    ]
]);

// Single
Redux::setSection( $opt_name, [
    'title'     => __( 'İçerik Ayarları', ARINA_TEXT ),
    'id'        => 'single-options',
    'icon'      => 'el el-wrench',
]);

Redux::setSection( $opt_name, [
    'title'     => __( 'Pozisyon ayarları', ARINA_TEXT ),
    'subsection' => true,
    'id'        => 'single-options-positions',
    'fields'    => [
        [
            'id'       => 'blog_readmore',
            'type'     => 'text',
            'title'    => esc_html__( 'Devamını oku yazısı', ARINA_TEXT ),
            'default'  => 'Devamını oku',
        ],
        [
            'id'       => 'form_basligi',
            'type'     => 'text',
            'title'    => esc_html__( 'Form başlığı', ARINA_TEXT ),
            'default'  => 'Başvuru için formu doldurunuz!',
        ],
        [
            'id'       => 'breadcrumb_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Breadcrumb sayfa yazısı', ARINA_TEXT ),
            'default'  => 'Kariyer',
        ],
        [
            'id'       => 'breadcrumb_url',
            'type'     => 'text',
            'title'    => esc_html__( 'Breadcrumb sayfa linki', ARINA_TEXT ),
            'default'  => '/kariyer/#careerid',
        ],
    ],
]);

// Style
Redux::setSection( $opt_name, [
    'title'  => __( 'Styling', ARINA_TEXT ),
    'id'     => 'styling',
    'icon'   => 'el el-brush',
    'fields' => [
        [
            'id' => 'top_primary_color',
            'type' => 'color',
            'title' => __('Top header rengi', ARINA_TEXT),
            'default' => '',
        ],
        [
            'id' => 'global_primary_color',
            'type' => 'color',
            'title' => __('Genel site rengi', ARINA_TEXT),
            'default' => '',
        ]
    ]
]);
