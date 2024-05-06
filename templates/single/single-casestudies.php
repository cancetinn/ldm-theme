<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

$thumbnail = get_the_post_thumbnail( get_the_ID(), 'full', ['alt' => strip_tags(get_the_title()) ] );
$excerpt = get_field('excerpt');
$clients = get_field('clients');
$category = get_field('category');
$date = get_field('date');
$player = get_field('player');
$prize = get_field('prize_pool');
$imp = get_field('impression');
$visit = get_field('visitors');
$peaklive = get_field('peak_live_viewership');
$team = get_field('teams');
$tournament = get_field('tournament');
$sGallery = get_field('case_studies_gallery');

?>

<div class="spacex" style="--spacer:250px"></div>

<article class="single-casestudy" id="post-<?php the_ID(); ?>">
    <div class="container">
        <div class="casetitleArea">
            <h1 class="title"><?php echo the_title(); ?></h1>
            <p><?php echo $excerpt ?></p>
        </div>

        <div class="casebannerArea">
            <?php echo $thumbnail; ?>
        </div>

        <div class="caseContentArea">
            <?php echo the_content(); ?>
            <div class="categoryArea">

                <div class="clientL">
                    <p>Clients :<br><span><?php echo $clients ?></span></p>
                </div>
                <div class="categoryL">
                    <p>Category :<br><span><?php echo $category ?></span></p>
                </div>
                <div class="dateL">
                    <p>Date : <br><span><?php echo $date ?></span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="spacex" style="--spacer:150px"></div>

    <div class="metricsArea">
        <?php if (!empty($player)): ?>
        <div class="playerMetric">
            <p><?php echo $player ?><br><span>PLAYER</span></p>
        </div>
        <?php endif; ?>
        <?php if (!empty($prize)): ?>
        <div class="prizepoolMetric">
            <p><?php echo $prize ?><br><span>PRIZE POOL</span></p>
        </div>
        <?php endif; ?>
        <?php if (!empty($tournament)): ?>
        <div class="tournamentMetric">
            <p><?php echo $tournament ?><br><span>MATCHES</span></p>
        </div>
        <?php endif; ?>
        <?php if (!empty($imp)): ?>
            <div class="impMetric">
                <p><?php echo $imp ?><br><span>Impression</span></p>
            </div>
        <?php endif; ?>
        <?php if (!empty($visit)): ?>
            <div class="impMetric">
                <p><?php echo $visit ?><br><span>Visitors</span></p>
            </div>
        <?php endif; ?>
        <?php if (!empty($peaklive)): ?>
            <div class="impMetric">
                <p><?php echo $peaklive ?><br><span>Peak Live Viewership</span></p>
            </div>
        <?php endif; ?>
        <?php if (!empty($team)): ?>
            <div class="impMetric">
                <p><?php echo $team ?><br><span>Teams</span></p>
            </div>
        <?php endif; ?>
    </div>

    <?php if( $sGallery ): ?>
   <section class="slideGallery">
       <div class="introContainer">
           <div class="swiper-container caseSlider">
               <div class="swiper-wrapper">
                   <?php foreach( $sGallery as $image ): ?>
                   <div class="swiper-slide">
                       <div class="cards">
                           <div class="card ong">
                               <img class="lazyload" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                               <?php if (!empty($image['caption'])): ?>
                               <?php if (!empty($image['description'])): ?>
                               <div class="title-box">
                                   <h1><?php echo esc_html($image['caption']); ?></h1>
                                   <p><?php echo esc_html($image['description']); ?></p>
                                   <div class="seperator"></div>
                               </div>
                               <?php endif; ?>
                               <?php endif; ?>
                           </div>
                       </div>
                   </div>
                   <?php endforeach; ?>
               </div>

               <div class="swiper-pagination"></div>

               <!--<div class="swiper-arrows">
                   <div class="swiper-button-prev"><span></span></div>
                   <div class="swiper-button-next"><span></span></div>
               </div>-->
           </div>
       </div>
   </section>
    <?php endif; ?>

    <div class="spacex" style="--spacer:100px"></div>
</article>
