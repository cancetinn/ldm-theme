<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

$copyright      = getRedux('footer_copyright');
$disclamer      = getRedux('footer_disclamer');
$disclamerUrl   = getRedux('footer_disclamer_url');
$privacy        = getRedux('footer_privacy');
$privacyUrl     = getRedux('footer_privacy_url');
$mail           = getRedux('social_mail');

//global
$global_instagram        = getRedux('global_social_instagram');
$global_x                = getRedux('global_social_x');
$global_youtube          = getRedux('global_social_youtube');

//latam test
$latam_instagram        = getRedux('latam_social_instagram');
$latam_x                = getRedux('latam_social_x');
$latam_youtube          = getRedux('latam_social_youtube'); 

//turkey
$turkey_instagram        = getRedux('turkey_social_instagram');
$turkey_x                = getRedux('turkey_social_x');
$turkey_youtube          = getRedux('turkey_social_youtube');

//asia
$asia_instagram        = getRedux('asia_social_instagram');
$asia_x                = getRedux('asia_social_x');
$asia_youtube          = getRedux('asia_social_youtube');


?>
<footer class="footer">
    <div class="container footer">
        <div class="footerLogo flex">
            Lidoma Vision Esports
        </div>
        <div class="social">
            <div class="socialMedia">
                <div>
                    <span>GLOBAL</span>
                    <ul>
                        <li>
                            <a href="<?php echo $global_instagram; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/instagram.png" alt="Instragram">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $global_x; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/twitter.png" alt="Twitter">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $global_youtube; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/youtube.png" alt="Youtube">
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <span>LATAM</span>
                    <ul>
                        <li>
                            <a href="<?php echo $latam_instagram; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/instagram.png" alt="Instragram">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $latam_x; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/twitter.png" alt="Twitter">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $latam_youtube; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/youtube.png" alt="Youtube">
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <span>TURKEY</span>
                    <ul>
                        <li>
                            <a href="<?php echo $turkey_instagram; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/instagram.png" alt="Instragram">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $turkey_x; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/twitter.png" alt="Twitter">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $turkey_youtube; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/youtube.png" alt="Youtube">
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <span>ASIA</span>
                    <ul>
                        <li>
                            <a href="<?php echo $asia_instagram; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/instagram.png" alt="Instragram">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $asia_x; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/twitter.png" alt="Twitter">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $asia_youtube; ?>" target="_blank">
                                <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/youtube.png" alt="Youtube">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footerBottom">
            <ul>
                <li>
                    <a target="_blank" href="<?php echo $disclamerUrl; ?>"><?php echo $disclamer; ?></a>
                </li>
                <li>
                    <a target="_blank" href="<?php echo $privacyUrl; ?>"><?php echo $privacy; ?></a>
                </li>
            </ul>

            <div class="copyright">
                <?php echo $copyright; ?>
            </div>
        </div>
    </div>

    <div data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>"></div>
</footer>
<?php wp_footer(); ?>
<script src="//code.jivosite.com/widget/oP0FQ4nqpH" async></script>
</body>
</html>
