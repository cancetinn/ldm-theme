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
            'liwa_image',
            [
                'label' => 'Liwa Zone Image',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'liwa_text', [
                'label' => 'Heading Liwa Zone',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "LIWA <b>PUBG<br> MOBILE</b> ZONE",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'liwa_content', [
                'label' => 'Liwa Zone Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>The thrilling energy of esports at LIWA PUBG Mobile Zone last month!</p>'
            ]
        );

        $this->add_control(
            'lidoma_button',
            [
                'label' => __('Lidoma Button', ARINA_TEXT),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'View Content',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'lidoma_button_url',
            [
                'label' => esc_html__('Lidoma Button url', ARINA_TEXT),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $button_url = $settings['lidoma_button_url']['url'] ?? false;
        $button_target = $settings['lidoma_button_url']['is_external'] ? ' target="_blank"' :  '';

        ?>

        <section class="liwaZone">
            <div class="container zone">
                <div class="lzArea">
                    <div class="lzText">
                        <h2 class="title">
                            <?php echo $settings['liwa_text'] ?>
                        </h2>
                        <?php echo $settings['liwa_content']?>
                        <div class="lzButton">
                            <?php if ( $button_url ): ?>
                                <a href="<?php echo $button_url ?>"<?php echo $button_target ?> class="buttonLidoma"><?php echo $settings['lidoma_button'] ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="lzImgArea">
                        <?php echo getImage( $settings['liwa_image']['id']  ); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
