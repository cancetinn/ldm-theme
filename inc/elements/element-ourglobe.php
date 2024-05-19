<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Ourglobe extends Widget_Base
{
    public function get_name()
    {
        return 'ourglobe';
    }

    public function get_title()
    {
        return 'Our Globe Mission';
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
            'globe_image',
            [
                'label' => 'Globe Image',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'mission_title', [
                'label' => 'Our Mission Title',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "Our mission",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'mission_content', [
                'label' => 'Mission Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lidoma Vision Esports, a UAE-based International Gaming & Esports Solutions Company established in 2020, is on a mission to revolutionize the global gaming community and ecosystem. Driven by a dedicated and passionate team of gaming aficionados, we traverse the dynamic terrains of the global gaming realm. Lidoma embodies a simple yet profound mantra: Inspire the World to Play, Earn, and Enjoy. Through our efforts, we bring together communities, conduct top-tier tournaments and leagues, and air both online and offline events, all while presenting an all-encompassing platform filled with rich services for our esteemed partners and community.</p>',
            ]
        );

        $this->add_control(
            'story_title', [
                'label' => 'Story Title',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "Our story",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'story_content', [
                'label' => 'Story Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lidoma Vision Esports, a UAE-based International Gaming & Esports Solutions Company established in 2020, is on a mission to revolutionize the global gaming community and ecosystem  Our Stellar Services Include:</p>',
            ]
        );

        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="ourGlobe">
            <div class="container">
                <div class="ogArea">
                    <div class="ogMission">
                        <h3 class="title">
                            <?php echo $settings['mission_title'] ?>
                        </h3>
                        <?php echo $settings ['mission_content'] ?>
                        <div class="ogStory">
                            <h3 class="title">
                                <?php echo $settings['story_title'] ?>
                            </h3>
                            <?php echo $settings ['story_content'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="globePic">
                <div class="imgArea lazyload lazyloaded">
                    <?php echo getImage( $settings['globe_image']['id']  ); ?>
                </div>
            </div>
        </section>

        <?php
    }
}
