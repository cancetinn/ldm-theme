<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

$banner = get_field('banner');

?>

<div class="spacex" style="--spacer:150px"></div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="top">
            <div class="banner">
                <img class="lazyload lazyloaded" src="<?php echo esc_url($banner['url']) ?>" alt="">
            </div>
            <div class="titleArea">
                <!--<h1 class="title"><?php /*echo the_title(); */?></h1>-->
                <div class="reqArea">
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/date.png"" alt="">
                        <h3 class="title">START DATE</h3>
                            <p>June 5th</p>
                    </div>
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/date.png"" alt="">
                        <h3 class="title">ENDING DATE</h3>
                            <p>June 16th</p>
                    </div>
                </div>

                <div class="reqArea">
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/gamepad.png"" alt="">
                        <h3 class="title">GAME</h3>
                            <p>HONOR OF KINGS</p>
                    </div>
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/format.png"" alt="">
                        <h3 class="title">FORMAT</h3>
                            <p>Community</p>
                    </div>
                </div>

                <div class="reqArea">
                    <div class="dateArea">
                        <img class="lazyloaded lazyload" src="<?php echo ARINA_ASSETS_URI; ?>/img/prize.png"" alt="">
                        <h3 class="title">PRIZE POOL</h3>
                            <p><b>$10000</b></li></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="contentWrap">
            <div class="content">

                <div class="spacex" style="--spacer:100px"></div>

                <div class="newformArea">
                    <form action="" method="post" name="post<?php the_ID(); ?>" id="post<?php the_ID(); ?>">
                        <div class="teamForm">
                            <div class="teaminfo">
                                <div>
                                    <label>Team Name</label>
                                    <input type="text" id="teamname" name="teamname" required>
                                </div>
                                <div>
                                    <label>Team Country</label>
                                    <select id="teamcountry" name="teamcountry" required>
                                        <option value="">Team Country</option>
                                        <option value="turkey">Turkey</option>
                                        <option value="azerbaijan">Azerbaijan</option>
                                        <option value="saudi_arabia">Saudi Arabia</option>
                                        <option value="uae">United Arab Emirates</option>
                                        <option value="egypt">Egypt</option>
                                        <option value="iraq">Iraq</option>
                                        <option value="morocco">Morocco</option>
                                        <option value="algeria">Algeria</option>
                                        <option value="tunisia">Tunisia</option>
                                        <option value="qatar">Qatar</option>
                                        <option value="libya">Libya</option>
                                        <option value="oman">Oman</option>
                                        <option value="jordan">Jordan</option>
                                        <option value="lebanon">Lebanon</option>
                                        <option value="kuwait">Kuwait</option>
                                        <option value="bahrain">Bahrain</option>
                                        <option value="palestine">Palestine</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Leader Phone</label>
                                    <input type="tel" id="leaderphone" name="leaderphone" required>
                                </div>
                                <div>
                                    <label>Team Logo</label>
                                    <input type="file" id="teamlogo" name="teamlogo" accept="image/*" required>
                                </div>
                            </div>
                            <div class="playersArea">
                                <div class="playerForm">
                                    <label>Players 1 (Captain) IGN</label>
                                    <input type="text" id="player1ign" name="player1ign" required>
                                    <label>Players 1 UID</label>
                                    <input type="text" id="player1uid" name="player1uid" required>
                                    <label>Players 1 Discord</label>
                                    <input type="text" id="player1dc" name="player1dc" required>
                                    <label>Players 1 Email</label>
                                    <input type="text" id="player1email" name="player1email" required>
                                </div>

                                <div class="playerForm">
                                    <label>Players 2 IGN</label>
                                    <input type="text" id="player2ign" name="player2ign" required>
                                    <label>Players 2 UID</label>
                                    <input type="text" id="player2uid" name="player2uid" required>
                                    <label>Players 2 Discord</label>
                                    <input type="text" id="player2dc" name="player2dc" required>
                                    <label>Players 2 Email</label>
                                    <input type="text" id="player2email" name="player2email" required>
                                </div>

                                <div class="playerForm">
                                    <label>Players 3 IGN</label>
                                    <input type="text" id="player3ign" name="player3ign" required>
                                    <label>Players 3 UID</label>
                                    <input type="text" id="player3uid" name="player3uid" required>
                                    <label>Players 3 Discord</label>
                                    <input type="text" id="player3dc" name="player3dc" required>
                                    <label>Players 3 Email</label>
                                    <input type="text" id="player3email" name="player3email" required>
                                </div>

                                <div class="playerForm">
                                    <label>Players 4 IGN</label>
                                    <input type="text" id="player4ign" name="player4ign" required>
                                    <label>Players 4 UID</label>
                                    <input type="text" id="player4uid" name="player4uid" required>
                                    <label>Players 4 Discord</label>
                                    <input type="text" id="player4dc" name="player4dc" required>
                                    <label>Players 4 Email</label>
                                    <input type="text" id="player4email" name="player4email" required>
                                </div>

                                <div class="playerForm">
                                    <label>Players 5 IGN</label>
                                    <input type="text" id="player5ign" name="player5ign" required>
                                    <label>Players 5 UID</label>
                                    <input type="text" id="player5uid" name="player5uid" required>
                                    <label>Players 5 Discord</label>
                                    <input type="text" id="player5dc" name="player5dc" required>
                                    <label>Players 5 Email</label>
                                    <input type="text" id="player5email" name="player5email" required>
                                </div>
                            </div>

                            <!-- Hidden Substitute Player Forms -->
                            <div class="subsForms">
                                <div class="playerForm substituteForm" id="substituteForm1" style="display: none;">
                                    <label>Substitute Player 1 IGN</label>
                                    <input type="text" name="substitute1_ign">
                                    <label>Substitute Player 1 UID</label>
                                    <input type="text" name="substitute1_uid">
                                    <label>Substitute Player 1 Discord</label>
                                    <input type="text" name="substitute1_discord">
                                    <label>Substitute Player 1 Email</label>
                                    <input type="text" name="substitute1_email">
                                </div>
                                <div class="playerForm substituteForm" id="substituteForm2" style="display: none;">
                                    <label>Substitute Player 2 IGN</label>
                                    <input type="text" name="substitute2_ign">
                                    <label>Substitute Player 2 UID</label>
                                    <input type="text" name="substitute2_uid">
                                    <label>Substitute Player 2 Discord</label>
                                    <input type="text" name="substitute2_discord">
                                    <label>Substitute Player 2 Email</label>
                                    <input type="text" name="substitute2_email">
                                </div>
                            </div>
                        </div>
                        <div class="buttonArea">
                            <button type="button" id="addSubstituteButton" class="tButton">Add Substitute Player</button>
                            <button class="tButton" type="submit">Register</button>
                        </div>
                        <div class="tournamentNonce" data-nonce="<?php echo wp_create_nonce('tournament_form_nonce'); ?>"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="spacex" style="--spacer:250px"></div>
</article>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.getElementById('addSubstituteButton');
        const substituteForm1 = document.getElementById('substituteForm1');
        const substituteForm2 = document.getElementById('substituteForm2');
        let formCount = 0;

        addButton.addEventListener('click', function () {
            if (formCount === 0) {
                substituteForm1.style.display = 'flex';
                substituteForm1.classList.add('fade-in');
                formCount++;
            } else if (formCount === 1) {
                substituteForm2.style.display = 'flex';
                substituteForm2.classList.add('fade-in');
                formCount++;
            } else {
                alert("Only two substitute players can be added.");
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const getForm = document.querySelector("#post<?php the_ID(); ?>");
        const dataNonce = document.querySelector(".tournamentNonce").getAttribute("data-nonce");
        const ajax = new AjaxForm();

        getForm.addEventListener('submit', e => {
            e.preventDefault();
            const formData = new FormData(getForm);

            formData.append('action', 'tournaments_form');
            formData.append('security', dataNonce);

            ajax.fetchForm(formData, getForm);
        });

        // Custom validation message
        checkValidationMessage('#cfcheck');
    });
</script>
