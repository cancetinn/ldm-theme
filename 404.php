<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

get_header();

?>
    <main>
        <section class="errorPage">
            <div class="container">
                <div class="ep-wrap">
                    <div class="e404">404</div>
                    <h1 class="title"><?php esc_html_e('Sayfa bulunamadı!', ARINA_TEXT); ?></h1>
                </div>
            </div>
        </section>
    </main>
<?php

get_footer();
