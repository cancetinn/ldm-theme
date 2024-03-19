<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class homeblog extends Widget_Base
{
    public function get_name()
    {
        return 'homeblog';
    }

    public function get_title()
    {
        return 'Home Blog Area';
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
            'title', [
                'label' => 'Blog Title',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "Tournament News",
                'label_block' => true,
            ]
        );

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
            'category',
            [
                'label' => 'Select Category',
                'type' => Controls_Manager::SELECT2,
                'options' => getTaxonomy('category'),
                'label_block' => true,
                'multiple' => true,
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
        $settings = $this->get_settings();
        $category = $settings['category'] ?? [];

        $page = get_query_var('page') ? get_query_var('page') : 1;
        $page = get_query_var('paged') ? get_query_var('paged') : $page;

        $args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'orderby'        => $settings['post_orderby'],
            'order'          => $settings['order'],
            'posts_per_page' => $settings['limit'],
            'paged'          => $page,
        ];

            if (!empty($category)) {
                $args['tax_query'] = [
                    [
                        'taxonomy' => 'category',
                        'field'    => 'term_id',
                        'terms'    => $category,
                    ],
                ];
            }

        $query = new \WP_Query($args);

        ?>
        <section class="blogArea">
            <div class="container">
                <div class="titleArea" id="arina_ajax_pagination">
                    <h1 class="title"><?php echo $settings['title'] ?></h1>
                </div>
                <div class="baWrap">
                    <?php
                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            $thumbnail = get_the_post_thumbnail( get_the_ID(), 'portfolio_thumb', ['alt' => strip_tags(get_the_title()) ] );
                            $tag = get_field('tag');
                            $excerpt = get_field('excerpt_area');
                            ?>
                            <div class="baItem articlesNews">
                                <a href="<?php echo the_permalink(); ?>">
                                    <div class="baPostImg">
                                        <?php echo $thumbnail; ?>
                                    </div>
                                </a>
                                <div class="postAreaFlex">
                                    <div class="baPostDesc">
                                        <?php if (!empty($tag)): ?>
                                            <div class="baTag">
                                                <?php echo $tag ?>
                                            </div>
                                        <?php endif; ?>
                                        <a href="<?php echo the_permalink(); ?>">
                                            <div class="baPostTitle">
                                                <?php echo the_title(); ?>
                                            </div>
                                        </a>
                                        <div class="baPostExcerpt">
                                            <?php echo $excerpt ?>
                                        </div>
                                        <div class="post-time">
                                            <?php echo date("F j, Y,"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
