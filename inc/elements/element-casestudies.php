<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Casestudies extends Widget_Base
{
    public function get_name()
    {
        return 'casestudies';
    }

    public function get_title()
    {
        return 'Marquee Case Studies Text';
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
            'marquee_repeater',
            [
                'label' => esc_html__( 'Case Studies Text', ARINA_TEXT ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [

                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Main Title', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],

                ],
                'default' => [
                    [
                        'title' => 'title',
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
        <div class="ellipse-18">
            <img src="<?php echo ARINA_ASSETS_URI; ?>/img/elipse-18.png" alt="Ellipse 18">
        </div>
       <section class="caseStudies">
           <ul class="csList" id="marqListCarousel">
               <?php
               foreach ($settings['marquee_repeater'] as $item) {
                   ?>
                   <li class="marquee">
                       <h2><?php echo $item['title'] ?></h2>
                   </li>
               <?php  } ?>
           </ul>
       </section>
        <?php
    }
}
