<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Wherelocate extends Widget_Base
{
    public function get_name()
    {
        return 'wherelocate';
    }

    public function get_title()
    {
        return 'Where is Located';
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
            'lc_text', [
                'label' => 'Banner Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "Where is <br>Lidoma located?",
                'label_block' => true,
            ]
        );


        $this->add_control(
            'lc_content', [
                'label' => 'Banner Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat nulla suspendisse tortor aene.</p>',
            ]
        );

        $this->add_control(
            'locate_list',
            [
                'label' => esc_html__( 'Locate List Items', ARINA_TEXT ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'locate_image',
                        'label' => __('Location Image', ARINA_TEXT),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'DUBAI',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'content',
                        'label' => esc_html__( 'Content', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::WYSIWYG,
                        'default' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et nibh urna in proin</p>',
                        'label_block' => true,
                    ],

                ],
                'default' => [
                    [
                        'title' => 'DUBAI',
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
        <section class="whereLocate">
            <div class="container">
                <div class="lcWrap">
                    <div class="lcArea">
                        <h2 class="title"><?php echo $settings['lc_text']?></h2>
                        <?php echo $settings['lc_content']?>
                    </div>
                </div>
                <div class="spacex" style="--spacer:50px"></div>
                <div class="lcAbout">
                    <div class="lcList">
                    <?php
                    foreach ($settings['locate_list'] as $item) {
                        $image_url = $item['image']['url'] ?? '';
                        ?>
                        <div class="lcItem">
                            <div class="lcAboutText">
                                <h4 class="title"><?php echo $item['title'] ?></h4>
                                <?php echo $item['content']?>
                            </div>
                            <div class="lcAboutImg">
                                <?php echo getImage( $item['locate_image']['id']  ); ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
