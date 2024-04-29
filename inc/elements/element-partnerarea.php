<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Partnerarea extends Widget_Base
{
    public function get_name()
    {
        return 'partnerarea';
    }

    public function get_title()
    {
        return 'Partner Area';
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
            'padding-left',
            [
                'label' => esc_attr__('Slider Padding', ARINA_TEXT),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 200,
            ]
        );

        $this->add_control(
            'partner_repeater',
            [
                'label' => esc_html__( 'Partner Area Logos', ARINA_TEXT ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image',
                        'label' => __('Image', ARINA_TEXT),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ]
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
        <section class="partnerArea">
            <div class="logoCarousel" style="padding-left:<?php echo $settings['padding-left']; ?>px;">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($settings['partner_repeater'] as $item) {
                        $image_url = $item['image']['url'] ?? '';
                        ?>
                    <div class="swiper-slide">
                        <img class="lazyload" src="<?php echo esc_url($image_url); ?>" alt="Partner Logos">
                    </div>
                        <?php } ?>
                </div>
            </div>
        </section>
        <?php
    }
}
