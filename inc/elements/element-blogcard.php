<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Blogcard extends Widget_Base
{
    public function get_name()
    {
        return 'blogcard';
    }

    public function get_title()
    {
        return 'Blog Card';
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
                'default' => "Don’t miss anything, check our articles!",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'blog_content', [
                'label' => 'Blog Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Ortamda satmalık bilgiler, oyunlarla alakalı yardımcı içerikler<br> özenle hazırlanmış makaleler için aşağıya göz atabilirsin!</p>',
            ]
        );


        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="blogCard">
            <div class="container">
                <div class="titleArea">
                    <h1 class="title"><?php echo $settings['big_title']?></h1>
                    <?php echo $settings['blog_content']?>
                </div>
            </div>
        </section>

        <?php
    }
}
