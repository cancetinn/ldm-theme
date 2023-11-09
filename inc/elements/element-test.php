<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Test extends Widget_Base
{
    public function get_name()
    {
        return 'test';
    }

    public function get_title()
    {
        return 'Test';
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
            'content', [
                'label' => 'Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lorem</p>',
            ]
        );

        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <form id="application-form" action="<?php echo admin_url('admin-post.php'); ?>" method="post">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required>

            <label for="team_name">Takım Adı:</label>
            <input type="text" id="team_name" name="team_name" required>

            <label for="message">Mesaj:</label>
            <textarea id="message" name="message" required></textarea>

            <input type="hidden" name="action" value="submit_application_form">
            <?php wp_nonce_field('application_nonce', 'application_nonce_field'); ?>

            <input type="submit" value="Başvuru Gönder">
        </form>


        <form id="contact-form" action="" method="post">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required>

            <label for="team_name">Takım Adı:</label>
            <input type="text" id="team_name" name="team_name" required>

            <label for="message">Mesaj:</label>
            <textarea id="message" name="message" required></textarea>

            <input type="submit" value="Başvuru Gönder">
        </form>

        <?php
    }
}
