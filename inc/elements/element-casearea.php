<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Casearea extends Widget_Base
{
    public function get_name()
    {
        return 'casearea';
    }

    public function get_title()
    {
        return 'Case Study Area';
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
            'limit',
            [
                'label' => 'Limit',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'step' => 1,
                'default' => 9,
            ]
        );

        $this->add_control(
            'post_orderby',
            [
                'label' => 'Order by',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'ID' => 'ID',
                    'title' => 'Title',
                    'name' => 'Slug',
                    'date' => 'Date',
                    'rand' => 'Random',
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => 'Order',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC',
                ],
            ]
        );

        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $page = get_query_var('page') ? get_query_var('page') : 1;
        $page = get_query_var('paged') ? get_query_var('paged') : $page;

        $args = [
            'post_type'      => 'casestudies',
            'post_status'    => 'publish',
            'orderby'        => $settings['post_orderby'],
            'order'          => $settings['order'],
            'posts_per_page' => $settings['limit'],
            'paged'          => $page,
        ];


        $query = new \WP_Query($args);

        ?>
        <section class="caseArea">
            <div class="container">
            <?php
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $thumbnail = get_the_post_thumbnail( get_the_ID(), 'portfolio_thumb', ['alt' => strip_tags(get_the_title()) ] );
                    ?>
                <a href="<?php echo the_permalink(); ?>">
                    <div class="caWrap">
                        <div class="caImage">
                            <?php echo $thumbnail; ?>
                        </div>
                        <div class="caTitle">
                           <h1 class="title">
                               <?php echo the_title(); ?>
                           </h1>
                            <button href="<?php echo the_permalink(); ?>" class="caseButton">View Details</button>
                        </div>
                    </div>
                </a>
                <?php
                endwhile;
            endif;
            ?>
            </div>
            <?php
            arina_pagination( $query );
            wp_reset_postdata();
            ?>
        </section>
        <?php
    }
}
