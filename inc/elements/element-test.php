<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Test extends Widget_Base
{
    public function get_name()
    {
        return 'test';
    }

    public function get_title()
    {
        return 'Test';
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
            'content', [
                'label' => 'Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lorem</p>',
            ]
        );

        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
            <section class="formApp">
                <div class="container">
                    <div class="bannerImg" style="text-align: center">
                        <img src="https://lidoma.com/lidoma/assets/images/new-header-3.png" alt="<?php echo $settings['title'] ?>" style="max-width: 250px;">
                    </div>


        <form id="application-form" action="<?php echo admin_url('admin-post.php'); ?>" method="post">
            <div id="basic-info">
                <label for="team_name">Nome da Equipe:</label>
                <input type="text" id="team_name" name="team_name" required>

                <!--<label for="country">País:</label>-->
                <select id="country" name="country" hidden>
                    <!--<option value="">Select Country</option>-->
                    <option value="Brazil">Brazil</option>
                </select>
            </div>

            <div id="player-info">
                <!-- Oyuncu bilgileri için alanlar -->
                <fieldset>
                    <legend>Informação do jogador</legend>
                    <div id="players" class="players-container">
                        <!-- Player 1 -->

                        <div class="player" id="player1">
                            <legend>Player 1</legend>
                            <label for="player1_fullname">Nome Completo:</label>
                            <input type="text" id="player1_fullname" name="player1_fullname" required>

                            <label for="player1_ign">Nome em Jogo:</label>
                            <input type="text" id="player1_ign" name="player1_ign" required>

                            <label for="player1_uid">ID:</label>
                            <input type="text" id="player1_uid" name="player1_uid" required>

                            <label for="player1_email">Email:</label>
                            <input type="email" id="player1_email" name="player1_email" required>

                            <label for="player1_discord">Discord ID:</label>
                            <input type="text" id="player1_discord" name="player1_discord" required>
                        </div>
                        <!-- Player 2 -->
                        <div class="player" id="player2">
                            <legend>Player 2</legend>
                            <label for="player2_fullname">Nome Completo:</label>
                            <input type="text" id="player2_fullname" name="player2_fullname" required>

                            <label for="player2_ign">Nome em Jogo:</label>
                            <input type="text" id="player2_ign" name="player2_ign" required>

                            <label for="player2_uid">ID:</label>
                            <input type="text" id="player2_uid" name="player2_uid" required>

                            <label for="player2_email">Email:</label>
                            <input type="email" id="player2_email" name="player2_email" required>

                            <label for="player2_discord">Discord ID:</label>
                            <input type="text" id="player2_discord" name="player2_discord" required>
                        </div>
                        <!-- Player 3 -->
                        <div class="player" id="player3">
                            <legend>Player 3</legend>
                            <label for="player3_fullname">Nome Completo:</label>
                            <input type="text" id="player3_fullname" name="player3_fullname" required>

                            <label for="player3_ign">Nome em Jogo:</label>
                            <input type="text" id="player3_ign" name="player3_ign" required>

                            <label for="player3_uid">ID:</label>
                            <input type="text" id="player3_uid" name="player3_uid" required>

                            <label for="player3_email">Email:</label>
                            <input type="email" id="player3_email" name="player3_email" required>

                            <label for="player3_discord">Discord ID:</label>
                            <input type="text" id="player3_discord" name="player3_discord" required>
                        </div>
                        <!-- Player 4 -->
                        <div class="player" id="player4">
                            <legend>Player 4</legend>
                            <label for="player4_fullname">Nome Completo:</label>
                            <input type="text" id="player4_fullname" name="player4_fullname" required>

                            <label for="player4_ign">Nome em Jogo:</label>
                            <input type="text" id="player4_ign" name="player4_ign" required>

                            <label for="player4_uid">ID:</label>
                            <input type="text" id="player4_uid" name="player4_uid" required>

                            <label for="player4_email">Email:</label>
                            <input type="email" id="player4_email" name="player4_email" required>

                            <label for="player4_discord">Discord ID:</label>
                            <input type="text" id="player4_discord" name="player4_discord" required>
                        </div>
                    </div>
                    <div class="buttonl-area">
                        <button type="button" class="buttonl-coach" id="add-extra-players">Adicionar jogador ou treinador substituto (opcional)</button>
                    </div>
                </fieldset>
            </div>

            <div id="extra-players" style="display: none;">
                <fieldset>
                    <legend>Informações sobre Jogadores Reservas e Treinadores</legend>
                    <div id="reserve-players" class="players-container">
                        <div class="player" id="reserve-player1">
                            <legend>Substituto 1</legend>
                            <label for="reserve_player1_fullname">Nome Completo:</label>
                            <input type="text" id="reserve_player1_fullname" name="reserve_player1_fullname">

                            <label for="reserve_player1_ign">Nome em Jogo:</label>
                            <input type="text" id="reserve_player1_ign" name="reserve_player1_ign">

                            <label for="reserve_player1_uid">ID:</label>
                            <input type="text" id="reserve_player1_uid" name="reserve_player1_uid">

                            <label for="reserve_player1_email">Email:</label>
                            <input type="email" id="reserve_player1_email" name="reserve_player1_email">

                            <label for="reserve_player1_discord">Discord ID:</label>
                            <input type="text" id="reserve_player1_discord" name="reserve_player1_discord">
                        </div>

                        <div class="player" id="reserve-player2">
                            <legend>Substituto 2</legend>
                            <label for="reserve_player2_fullname">Nome Completo:</label>
                            <input type="text" id="reserve_player2_fullname" name="reserve_player2_fullname">

                            <label for="reserve_player2_ign">Nome em Jogo:</label>
                            <input type="text" id="reserve_player2_ign" name="reserve_player2_ign">

                            <label for="reserve_player2_uid">ID:</label>
                            <input type="text" id="reserve_player2_uid" name="reserve_player2_uid">

                            <label for="reserve_player2_email">Email:</label>
                            <input type="email" id="reserve_player2_email" name="reserve_player2_email">

                            <label for="reserve_player2_discord">Discord ID:</label>
                            <input type="text" id="reserve_player1_discord" name="reserve_player2_discord">
                        </div>

                        <div class="player" id="coach">
                            <legend>Treinador</legend>
                            <label for="coach_fullname">Nome Completo:</label>
                            <input type="text" id="coach_fullname" name="coach_fullname">

                            <label for="coach_email">Email:</label>
                            <input type="email" id="coach_email" name="coach_email">

                            <label for="coach_discord">Discord ID:</label>
                            <input type="text" id="coach_discord" name="coach_discord">
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="gdprArea">
                <input type="checkbox" id="gdpr" name="gdpr" value="gdpr" required>
                <label for="gdpr"> Eu li e aceito os <a class="gdpr" href="https://lidoma.com/Lidoma%20User%20Agreement%20Terms%20of%20Use.pdf" target="_blank"> Termos e Condições</a> e a <a class="gdpr" href="https://lidoma.com/privacy.php" target="_blank">Política de Privacidade.</a></label><br>
            </div>

            <input type="hidden" name="action" value="submit_application_form">
            <?php wp_nonce_field('application_nonce', 'application_nonce_field'); ?>
            <div class="buttonl-area">
                <input type="submit" class="buttonl" value="INSCREVA-SE" id="submit-application" style="display: none;">
            </div>
        </form>
                </div>
            </section>


        <?php
    }
}
