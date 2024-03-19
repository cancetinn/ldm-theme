<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Servicesrepeat extends Widget_Base
{
    public function get_name()
    {
        return 'servicesrepeat';
    }

    public function get_title()
    {
        return 'Services List Repeater';
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
            'services_repeater',
            [
                'label' => esc_html__( 'Services Repeater', ARINA_TEXT ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Text', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'editor',
                        'label' => __('editor', ARINA_TEXT),
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => '<p>lorem</p>',
                    ],
                    [
                        'name' => 'image',
                        'label' => __('Image', ARINA_TEXT),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'reverse',
                        'label' => __('Reverse', ARINA_TEXT),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => esc_html__('On', ARINA_TEXT),
                        'label_off' => esc_html__('Off', ARINA_TEXT),
                        'return_value' => 'yes',
                        'default' => 'no',
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
        <section class="servicesRepeat">
            <div class="ellipse-21">
                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/ellipse-21.png" alt="Ellipse 21">
            </div>
            <div class="container">
                <div class="srWrap">
                    <?php
                    foreach ($settings['services_repeater'] as $item) {
                    $image_url = $item['image']['url'] ?? '';
                    $reverse = $item['reverse'] === 'yes' ? ' reverse' : '';
                    ?>
                        <div class="srItem <?php echo $reverse ?>">
                            <div class="srTitle">
                                <h2 class="title"><?php echo $item['title']; ?></h2>
                                <?php echo $item['editor']; ?>
                            </div>
                            <div class="srImage">
                                <img class="lazyload" src="<?php echo esc_url($image_url); ?>" alt="Lidoma Play Services">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <?php
    }
}
