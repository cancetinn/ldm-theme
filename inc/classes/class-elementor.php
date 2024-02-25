<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc;

use ARINA_THEME\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Elementor
{
    use Singleton;

    private static $elements = [
        // foldername => Classname
        'test'          => 'Test',
        'mainbanner'    => 'Mainbanner',
        'marqlidoma'    => 'Marqlidoma',
        'tournaments'   => 'Tournaments',
        'casestudies'   => 'Casestudies',
        'thanks'        => 'Thanks',
     ];

    protected function __construct()
    {
        // Load Elementor elements
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action('elementor/editor/before_enqueue_styles', [$this, 'elementor_enqueue_editor_styles']);
        //add_action('elementor/editor/before_enqueue_scripts', [$this, 'elementor_enqueue_editor_scripts']);
    }

    function elementor_enqueue_editor_styles()
    {
        wp_enqueue_style('elementor-editor-style', ARINA_THEME_URI . '/dev/admin/elementor.css', ['elementor-editor'], '1.0.0');
    }

    function elementor_enqueue_editor_scripts()
    {
        wp_enqueue_style('elementor-editor-scripts', ARINA_THEME_URI . '/dev/admin/editor.js', ['elementor-editor'], '1.0.0');
    }

    // Add Elementor category
    function add_elementor_widget_categories($elements_manager)
    {
        $elements_manager->add_category(
            'arina',
            [
                'title' => '[ARINA] ELEMENTS'
            ]
        );
    }

    // Load widgets files
    private function include_widgets_files()
    {
        foreach (self::$elements as $key => $element) :
            require_once(ARINA_INC_DIR . '/elements/element-' . esc_attr($key) . '.php');
        endforeach;
    }

    // Register widgets by classes
    public function register_widgets()
    {
        $this->include_widgets_files();
        foreach (self::$elements as $element) :
            $class = 'ARINA_THEME\\Inc\\Elements\\' . $element;
            \Elementor\Plugin::instance()->widgets_manager->register(new $class());
        endforeach;
    }
}
