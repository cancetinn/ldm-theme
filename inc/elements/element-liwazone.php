<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Liwazone extends Widget_Base
{
    public function get_name()
    {
        return 'liwazone';
    }

    public function get_title()
    {
        return 'Liwa Zone Area';
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
            'liwa_repeater',
            [
                'label' => esc_html__( 'Case Study Repeater', ARINA_TEXT ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'liwa_image',
                        'label' => __('Case Study Image', ARINA_TEXT),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'liwa_text',
                        'label' => esc_html__( 'Heading Case Study Slider', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'liwa_content',
                        'label' => esc_html__( 'Content Case Study Slider', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::WYSIWYG,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'lidoma_button',
                        'label' => __('Lidoma Button', ARINA_TEXT),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'View Content',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'lidoma_button_url',
                        'label' => esc_html__('Lidoma Button url', ARINA_TEXT),
                        'type' => \Elementor\Controls_Manager::URL,
                        'default' => [
                            'url' => '#',
                            'is_external' => false,
                            'nofollow' => false,
                        ],
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

        <section class="liwaZone">
            <div class="container zone">
                <div class="swiper zoneSlider">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($settings['liwa_repeater'] as $item) {
                            $image_url = $item['image']['url'] ?? '';
                            $button_url = $item['lidoma_button_url']['url'] ?? false;
                            $button_target = $item['lidoma_button_url']['is_external'] ? ' target="_blank"' :  '';
                            ?>
                        <div class="swiper-slide">
                            <div class="lzArea">
                                <div class="lzText">
                                    <h2 class="title">
                                        <?php echo $item['liwa_text'] ?>
                                    </h2>
                                    <?php echo $item['liwa_content']?>
                                    <div class="lzButton">
                                        <?php if ( $button_url ): ?>
                                            <a href="<?php echo $button_url ?>"<?php echo $button_target ?> class="buttonLidoma"><?php echo $item['lidoma_button'] ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="lzImgArea">
                                    <?php echo getImage( $item['liwa_image']['id']  ); ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
        <?php
    }
}
