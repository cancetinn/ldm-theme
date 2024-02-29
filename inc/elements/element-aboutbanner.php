<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Aboutbanner extends Widget_Base
{
    public function get_name()
    {
        return 'aboutbanner';
    }

    public function get_title()
    {
        return 'About Banner';
    }

    public function get_icon()
    {
        return 'eicon-parallax';
    }

    public function get_categories()
    {
        return ['arina'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Options',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // CONTROLS
        $this->add_control(
            'banner_image',
            [
                'label' => 'Banner Image',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'big_text', [
                'label' => 'Banner Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "ABOUT US",
                'label_block' => true,
            ]
        );


        $this->add_control(
            'banner_content', [
                'label' => 'Banner Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lidoma Vision Esports, a UAE-based International Gaming & Esports Solutions Company established in 2020, is on a mission to revolutionize the global gaming community and ecosystem. Driven by a dedicated and passionate team of gaming aficionados, we traverse the dynamic terrains of the global gaming realm. Lidoma embodies a simple yet profound mantra: Inspire the World to Play, Earn, and Enjoy. Through our efforts, we bring together communities, conduct top-tier tournaments and leagues, and air both online and offline events, all while presenting an all-encompassing platform filled with rich services for our esteemed partners and community.</p>',
            ]
        );

        $this->add_control(
            'list_text', [
                'label' => 'List Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "Our Stellar Services Include",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'about_list',
            [
                'label' => esc_html__( 'About List Items', ARINA_TEXT ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'Lorem Ipsum',
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    [
                        'title' => 'Lorem Ipsum',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );



        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="aboutBanner">
            <div class="container banner">
                <div class="abArea">
                    <div class="textArea">
                        <h1 class="title"><?php echo $settings['big_text']?></h1>
                        <?php echo $settings['banner_content']?>
                        <div class="abList">
                            <h4 class="title"><?php echo $settings['list_text']?></h4>
                            <ul>
                            <?php
                            foreach ($settings['about_list'] as $item) :
                                ?>
                                <li><?php echo $item['title']; ?></li>
                            <?php

                            endforeach;

                            ?>
                            </ul>
                        </div>
                    </div>
                    <div class="imgArea lazyload lazyloaded">
                        <?php echo getImage( $settings['banner_image']['id']  ); ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }
}
