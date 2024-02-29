<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Tournaments extends Widget_Base
{
    public function get_name()
    {
        return 'tournaments';
    }

    public function get_title()
    {
        return 'Tournaments';
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
                'label' => 'Title',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "Upcoming <br>Tournaments",
            ]
        );

        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $args = [
            'post_type' => 'tournaments',
            'post_status' => 'publish',
        ];

        $query_post = new \WP_Query( $args );

        ?>
            <section class="Tournaments" id="tournaments">
                <div class="container tournaments">
                    <div class="titleArea">
                        <h1 class="title">
                            <?php echo $settings['title']?>
                        </h1>
                    </div>
                </div>

                <div class="container tournaments">
                    <div class="tournamentArea">
                        <?php
                        if ( $query_post->have_posts() ) :
                            while ( $query_post->have_posts() ) : $query_post->the_post();
                                $platform = get_field('platform');
                                $capacity = get_field('team_capacity');
                                $price = get_field('price');
                                $prize = get_field('prize_pool');
                                $thumbnail = get_the_post_thumbnail( get_the_ID(), 'portfolio_thumb', ['alt' => strip_tags(get_the_title()) ] );
                                ?>

                                <div class="tournamentBadge">
                                    <div class="tournamentImg">
                                        <?php echo $thumbnail; ?>
                                    </div>
                                    <div class="tournamentTitle">
                                        <h4 class="title"><?php the_title(); ?></h4>
                                    </div>
                                    <div class="tournamentDesc">
                                        <p><?php echo esc_html(get_the_excerpt()); ?> <a href="<?php echo the_permalink(); ?>" class="readMore">Read More</a></p>
                                    </div>
                                    <div class="tournamentReq">
                                    <?php if (!empty($platform)): ?>
                                        <div class="platform">
                                            <?php echo $platform ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($capacity)): ?>
                                        <div class="capacity">
                                            <?php echo $capacity ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($price)): ?>
                                        <div class="price">
                                            <?php echo $price ?>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                    <div class="tJoinArea">
                                        <?php if (!empty($prize)): ?>
                                        <div class="prizeArea">
                                            <p>Prize Pool</p>
                                            <p class="prizeAmount">
                                                <?php echo $prize ?>
                                            </p>
                                        </div>
                                        <?php endif; ?>
                                        <div class="tJoinButton">
                                            <a href="<?php echo the_permalink(); ?>">Join</a>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            endwhile;
                        endif;
                        ?>
                    </div>
                    <!--<div class="discoverMore">
                        <div class="arrowArea">

                        </div>
                        <a href="#" class="discoverButton">
                            <svg width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M29.8582 3.14656L0.0836182 32.9212L2.20494 35.0425L31.98 5.26747L31.98 33.002L34.98 33.002L34.98 1.64656L34.98 0.146557L33.48 0.146557L2.1245 0.146557L2.1245 3.14656L29.8582 3.14656Z" fill="white"/>
                            </svg><br>
                            Discover More</a>
                    </div>-->
                </div>
            </section>
        <?php
    }
}
