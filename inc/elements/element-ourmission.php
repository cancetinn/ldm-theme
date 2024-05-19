<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Ourmission extends Widget_Base
{
    public function get_name()
    {
        return 'ourmission';
    }

    public function get_title()
    {
        return 'Our Mission';
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
            'mission_title', [
                'label' => 'Mission Title',
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

        $this->add_control(
            'story_list',
            [
                'label' => esc_html__( 'Story Services Items', ARINA_TEXT ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title_services',
                        'label' => esc_html__( 'Title Services', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'Our Steallar Services Include:',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'content',
                        'label' => esc_html__( 'Content', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::WYSIWYG,
                        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed mattis vivamus at mattis bibendum congue cras id interdum. Risus leo et.',
                        'label_block' => true,
                    ],

                ],
                'default' => [
                    [
                        'title' => 'Announcement',
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
        <section class="focusArea">
            <div class="container">
                <div class="faWrap">
                    <div class="focusText">
                        <h2 class="title"><?php echo $settings['big_title']?></h2>
                        <?php echo $settings['banner_content']?>
                    </div>
                    <?php
                    foreach ($settings['focus_repeater'] as $item) {
                        $image_url = $item['image']['url'] ?? '';
                        ?>
                        <div class="faBoxArea">
                            <div class="faBoxItem">
                                <img class="lazyload" src="<?php echo esc_url($image_url); ?>" alt="Partner Logos">
                                <h4><?php echo $item['title']; ?></h4>
                                <div class="rightArrow">
                                    <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/icons/right-arrow.svg" alt="Right Arrow">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <?php
    }
}
