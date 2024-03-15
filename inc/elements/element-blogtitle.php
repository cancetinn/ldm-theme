<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Blogtitle extends Widget_Base
{
    public function get_name()
    {
        return 'blogtitle';
    }

    public function get_title()
    {
        return 'Blog Main Title';
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
            'big_title', [
                'label' => 'Big Title',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "All news about esports<br> and games is here",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'banner_content', [
                'label' => 'Banner Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled. Lorem ipsum dolor sit amet is template copy text you can edit.</p>',
            ]
        );


        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="blogTitle">
            <div class="container">
                <div class="titleArea">
                    <h1 class="title"><?php echo $settings['big_title']?></h1>
                    <?php echo $settings['banner_content']?>
                    <?php /*get_search_form(); */?>
                </div>
            </div>
        </section>

        <?php
    }
}
