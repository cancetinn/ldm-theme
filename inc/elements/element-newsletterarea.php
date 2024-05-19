<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Newsletterarea extends Widget_Base
{
    public function get_name()
    {
        return 'newsletterarea';
    }

    public function get_title()
    {
        return 'Newsletter Area';
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
            'na_text', [
                'label' => 'Subscribe Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "SUBSCRIBE OUR NEWSLETTER <br>TO FOLLOW THE NEWS",
                'label_block' => true,
            ]
        );

        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
            <section class="newsletterArea">
                <div class="container">
                    <div class="naText">
                        <h6 class="title"><?php echo $settings['na_text'] ?></h6>
                    </div>
                    <div class="naForm">
                        <form action="" name="newsletterForm" id="newsletterForm">
                            <input type="email" id="email" name="email" placeholder="Enter Email Address">
                            <button class="naButton" type="submit">SEND</button>
                        </form>
                    </div>
                </div>
            </section>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const getForm = selector("#newsletterForm")
                const ajax = new AjaxForm()

                getForm.addEventListener('submit', e => {
                    e.preventDefault()
                    const formData = new FormData(getForm)

                    formData.append('action', 'newsletterForm')

                    ajax.fetchForm(formData, getForm)
                })

                // Custom validation message
                checkValidationMessage('#cfcheck')
            })
        </script>
        <?php
    }
}
