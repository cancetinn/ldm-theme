<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Abouttitle extends Widget_Base
{
    public function get_name()
    {
        return 'abouttitle';
    }

    public function get_title()
    {
        return 'About us Title';
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
            'big_text', [
                'label' => 'Banner Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "About Lidoma",
                'label_block' => true,
            ]
        );


        $this->add_control(
            'banner_content', [
                'label' => 'Banner Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat nulla suspendisse tortor aenean dis placerat. Scelerisque imperdiet vitae dolor non aliquam. Malesuada.</p>',
            ]
        );

        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="aboutTitle">
            <div class="container">
                <div class="atArea">
                    <div class="textArea">
                        <h1 class="title"><?php echo $settings['big_text']?></h1>
                        <?php echo $settings['banner_content']?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
