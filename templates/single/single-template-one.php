<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

$banner = get_field('banner');

?>

<!-- <div class="spacex" style="--spacer:150px"></div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="top">
            <div class="banner">
                <img class="lazyload lazyloaded" src="<?php echo esc_url($banner['url']) ?>" alt="">
            </div>
            <div class="titleArea">
                <p><?php echo the_content(); ?></p>

                <div class="pbButton">
                    <a href="https://lidoma.com/wp-content/uploads/2024/03/JA-GAME-FEST_compressed.pdf" target="_blank" class="buttonLidoma">PLAYBOOK</a>
                </div>

                <div class="reqArea">
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/date.png"" alt="">
                        <h3 class="title">START DATE</h3>
                        <ul>
                            <li>March 11</li>
                        </ul>
                    </div>
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/date.png"" alt="">
                        <h3 class="title">ENDING DATE</h3>
                        <ul>
                            <li>March 31</li>
                        </ul>
                    </div>
                </div>

                <div class="reqArea">
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/gamepad.png"" alt="">
                        <h3 class="title">GAMES</h3>
                        <ul>
                            <li>FC24</li>
                            <li>PUBG MOBILE</li>
                            <li>CS2</li>
                        </ul>
                    </div>
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/format.png"" alt="">
                        <h3 class="title">FORMAT</h3>
                        <ul>
                            <li>Community</li>
                        </ul>
                    </div>
                </div>

                <div class="reqArea">
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/prize.png"" alt="">
                        <h3 class="title">PRIZE POOL</h3>
                        <ul>
                            <li>FC24: <b>$5,000</b></li>
                            <li>PUBG MOBILE: <b>$5,000</b></li>
                            <li>CS2: <b>$5,000</b></li>
                        </ul>
                    </div>
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/extra.png"" alt="">
                        <h3 class="title">EXTRA</h3>
                        <ul>
                            <li>Admission is free<br> for JA residents.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="contentWrap">
            <div class="content">

                <div class="spacex" style="--spacer:100px"></div>

                <div class="formArea">
                    <form action="" method="post" name="post<?php the_ID(); ?>" id="post<?php the_ID(); ?>">
                        <div class="formFlex">
                            <div class="flexArea">
                                <div class="form">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email">
                                </div>
                                <div class="spacex" style="--spacer:50px"></div>
                                <div class="form">
                                    <label>Duo Name <span class="optional-text">(optional)</span></label>
                                    <input type="text" id="name2" name="name2">
                                    <label>Duo Email <span class="optional-text">(optional)</span></label>
                                    <input type="email" id="email2" name="email2">
                                </div>
                                <div class="termArea">
                                    <input type="checkbox" id="term" name="term" value="term" required/>
                                    <label for="term">I have read and accept the <a href="https://lidoma.com/Lidoma%20User%20Agreement%20Terms%20of%20Use.pdf" target="_blank"> Terms and Conditions</a> and the <a href="https://lidoma.com/LIDOMA%20PRIVACY%20POLICY.pdf" target="_blank">Privacy Policy.</a></label>
                                </div>
                                <div class="termArea">
                                    <input type="checkbox" id="rulebook" name="rulebook" value="rulebook" required/>
                                    <label for="rulebook">I have read and accept the <a href="https://lidoma.com/wp-content/uploads/2024/03/JA-GAME-FESTIVAL-RULEBOOK.pdf" target="_blank"> Pointing System</a></label>
                                </div>
                                <button class="tButton" type="submit">REGISTER</button>
                            </div>
                            <div class="flexCheck">
                                <label>Pick your Games</label>
                                <input type="checkbox" id="pubg" name="pubg" value="PUBG Mobile"/>
                                <label for="pubg"><img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/pbg.png" /></label>
                                <input type="checkbox" id="cs2" name="cs2" value="CS2" />
                                <label for="cs2"><img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/cs2reg.png" /></label>
                                <input type="checkbox" id="fc24" name="fc24" value="FC 24" />
                                <label for="fc24"><img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/fifareg.png" /></label>
                            </div>
                        </div>
                        <div class="tournamentNonce" data-nonce="<?php echo wp_create_nonce('tournament_form_nonce'); ?>"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="spacex" style="--spacer:250px"></div>
</article> -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const getForm = selector("#post<?php the_ID(); ?>")
        const dataNonce = getDataset(".tournamentNonce", "nonce")
        const ajax = new AjaxForm()

        getForm.addEventListener('submit', e => {
            e.preventDefault()
            const formData = new FormData(getForm)

            formData.append('action', 'tournaments_form')
            formData.append('security', document.querySelector('.tournamentNonce').getAttribute('data-nonce'));

            ajax.fetchForm(formData, getForm)
        })

        // Custom validation message
        checkValidationMessage('#cfcheck')
    })
</script> -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('post<?php the_ID(); ?>');
        var ajaxForm = new AjaxForm();

        form.addEventListener('submit', function (e) {
            var pubgCheckbox = document.getElementById('pubg');
            var cs2Checkbox = document.getElementById('cs2');
            var fc24Checkbox = document.getElementById('fc24');


            if (!pubgCheckbox.checked && !cs2Checkbox.checked && !fc24Checkbox.checked) {
                e.preventDefault(); // Form gönderimini durdur
                //alert("Please select at least one game."); // Kullanıcıyı uyar
                return;
            }

            e.preventDefault();
            const formData = new FormData(form);
            formData.append('action', 'tournaments_form');
            formData.append('security', document.querySelector('.tournamentNonce').getAttribute('data-nonce'));

            ajaxForm.fetchForm(formData, form);
        });
    });
</script> -->
