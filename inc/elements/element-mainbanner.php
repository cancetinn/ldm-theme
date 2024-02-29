<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Mainbanner extends Widget_Base
{
    public function get_name()
    {
        return 'mainbanner';
    }

    public function get_title()
    {
        return 'Main Banner';
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
            'banner_image',
            [
                'label' => 'Banner Image',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'big_text', [
                'label' => 'Big Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "THE ULTIMATE",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'second_big_text', [
                'label' => 'SecondBig Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "ESPORTS PLATFORM",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'banner_content', [
                'label' => 'Banner Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Join the community of gamers and compete in the most popular games for amazing prizes and glory.</p>',
            ]
        );

        $this->add_control(
            'lidoma_button',
            [
                'label' => __('Lidoma Button', ARINA_TEXT),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Discover More',
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
        <section class="mainBanner">
            <div class="container banner">
                <div class="bannerArea">
                    <div class="textArea">
                        <h1 class="title"><?php echo $settings['big_text']?></h1>
                        <h2 class="title"><?php echo $settings['second_big_text']?></h2>
                        <?php echo $settings['banner_content']?>
                    </div>
                    <div class="imgArea lazyload lazyloaded">
                        <?php echo getImage( $settings['banner_image']['id']  ); ?>
                    </div>
                </div>
                <div class="buttonArea">
                    <img class="lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/white_lidoma_logo.png" alt="Lidoma">
                    <?php if ( $button_url ): ?>
                        <a href="<?php echo $button_url ?>"<?php echo $button_target ?> class="buttonLidoma"><?php echo $settings['lidoma_button'] ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php
    }
}
