<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Servicestext extends Widget_Base
{
    public function get_name()
    {
        return 'servicestext';
    }

    public function get_title()
    {
        return 'Services Main Text';
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
                'default' => "SERVICES",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'banner_content', [
                'label' => 'Banner Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lorem Ipsum</p>',
            ]
        );


        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="servicesText">
            <div class="container">
                <div class="titleArea">
                    <h1 class="title"><?php echo $settings['big_title']?></h1>
                    <?php echo $settings['banner_content']?>
                </div>
            </div>
        </section>

        <?php
    }
}
