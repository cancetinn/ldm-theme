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
$linkedin       = getRedux('social_linkedin');
$instagram      = getRedux('social_instagram');
$youtube        = getRedux('social_youtube');

?>
<a target="_blank" href="https://wa.me/message/XDJFQXK6TKARM1" class="dd-m-whatsapp">
    <span class="icon"></span>
</a>
<footer class="footer">
    <div class="container footer">
        <div class="footerLogo flex">
            Lidoma Vision Esports
        </div>
        <div class="social">
            <div class="socialMedia">
                <span><a href="<?php removeSpace($instagram); ?>" target="_blank">Instagram</a></span>
                <span><a href="<?php removeSpace($linkedin); ?>" target="_blank">LinkedIn</a></span>
                <span><a href="<?php removeSpace($youtube); ?>" target="_blank">Youtube</a></span>
                <span><a href="mailto:<?php removeSpace($mail); ?>" target="_blank">Contact</a></span>
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

</body>
</html>
