<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Focusarea extends Widget_Base
{
    public function get_name()
    {
        return 'focusarea';
    }

    public function get_title()
    {
        return 'Focus Area';
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
                'default' => "Our <span>Solutions</span> & <span>Focus Area</span>",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'banner_content', [
                'label' => 'Banner Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Cras a tincidunt nulla. In eget nibh quis ligula blandit accumsan sed et felis. Fusce ac dignissim sapien, id molestie nunc. Ut ante turpis, auctor vel leo a, lacinia gravida quam. Curabitur laoreet massa v</p>',
            ]
        );

        $this->add_control(
            'focus_repeater',
            [
                'label' => esc_html__( 'Focus Box Repeater', ARINA_TEXT ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Text', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'image',
                        'label' => __('Icon', ARINA_TEXT),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'lidoma_button_url',
                        'label' => esc_html__('Services URL', ARINA_TEXT),
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
        <section class="focusArea">
            <div class="container">
                <div class="faWrap">
                    <div class="focusText">
                        <h2 class="title"><?php echo $settings['big_title']?></h2>
                        <?php echo $settings['banner_content']?>
                    </div>
                    <?php
                    foreach ($settings['focus_repeater'] as $item) {
                    $image_url = $item['image']['url'] ?? '';
                        $button_url = $item['lidoma_button_url']['url'] ?? false;
                        $button_target = $item['lidoma_button_url']['is_external'] ? ' target="_blank"' :  '';
                    ?>
                    <a href="<?php echo $button_url ?>"<?php echo $button_target ?>>
                        <div class="faBoxArea">
                                <div class="faBoxItem">
                                    <img class="lazyload" src="<?php echo esc_url($image_url); ?>" alt="Partner Logos">
                                    <h4><?php echo $item['title']; ?></h4>
                                    <div class="rightArrow">
                                        <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/icons/right-arrow.svg" alt="Right Arrow">
                                    </div>
                                </div>
                            </div>
                     </a>
                    <?php } ?>
                </div>
            </div>
        </section>

        <?php
    }
}
