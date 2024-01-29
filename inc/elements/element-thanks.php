<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Thanks extends Widget_Base
{
    public function get_name()
    {
        return 'thanks';
    }

    public function get_title()
    {
        return 'Thanks';
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
            'content', [
                'label' => 'Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lorem</p>',
            ]
        );

        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="thanks">
            <div class="container">
                <div class="bannerImg" style="text-align: center">
                    <img src="https://lidoma.com/lidoma/assets/images/new-header-3.png" alt="" style="max-width: 250px;">
                </div>

                <div class="countdown" style="text-align: center">
                    <h1>Seu registro foi aprovado. <br>Você está sendo redirecionado para o servidor do Discord.</h1>
                </div>

            </div>
        </section>

        <script>
            var timeout = 5000; // 5000ms = 5 saniye

            var newURL = "https://discord.com/channels/1025062302677999770/1073244814864306187";

            setTimeout(function() {
                window.location.href = newURL;
            }, timeout);
        </script>
        <?php
    }
}
