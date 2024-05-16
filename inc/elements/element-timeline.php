<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Timeline extends Widget_Base
{
    public function get_name()
    {
        return 'timeline';
    }

    public function get_title()
    {
        return 'Timeline';
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
            'tl_text', [
                'label' => 'Timeline Title',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "Timeline",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tl_content', [
                'label' => 'Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.</p>',
            ]
        );

        $this->add_control(
            'timeline_list',
            [
                'label' => esc_html__( 'Timeline Items', ARINA_TEXT ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title_date',
                        'label' => esc_html__( 'Date', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => '2021',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'Announcement',
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
        <section class="timeLine">
            <div class="container">
                <div class="tlWrap">
                    <div class="tlAbout">
                        <h3 class="title">
                            <?php echo $settings['tl_text']?>
                        </h3>
                        <?php echo $settings['tl_content']?>
                    </div>
                    <div class="tlList">
                        <ul class="timeline">
                        <?php
                        foreach ($settings['timeline_list'] as $item) {
                            ?>
                            <li>
                                <p class="dateTitle"><?php echo $item['title_date'] ?></p>
                                <p class="title"><?php echo $item['title'] ?></p>
                                <?php echo $item['content']?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
