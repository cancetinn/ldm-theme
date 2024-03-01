<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc\Elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Aboutbanner extends Widget_Base
{
    public function get_name()
    {
        return 'aboutbanner';
    }

    public function get_title()
    {
        return 'About Banner';
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
            'banner_image',
            [
                'label' => 'Banner Image',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'big_text', [
                'label' => 'Banner Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "ABOUT US",
                'label_block' => true,
            ]
        );


        $this->add_control(
            'banner_content', [
                'label' => 'Banner Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>Lidoma Vision Esports, a UAE-based International Gaming & Esports Solutions Company established in 2020, is on a mission to revolutionize the global gaming community and ecosystem. Driven by a dedicated and passionate team of gaming aficionados, we traverse the dynamic terrains of the global gaming realm. Lidoma embodies a simple yet profound mantra: Inspire the World to Play, Earn, and Enjoy. Through our efforts, we bring together communities, conduct top-tier tournaments and leagues, and air both online and offline events, all while presenting an all-encompassing platform filled with rich services for our esteemed partners and community.</p>',
            ]
        );

        $this->add_control(
            'list_text', [
                'label' => 'List Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "Our Stellar Services Include",
                'label_block' => true,
            ]
        );

        $this->add_control(
            'about_list',
            [
                'label' => esc_html__( 'About List Items', ARINA_TEXT ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', ARINA_TEXT ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'Lorem Ipsum',
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    [
                        'title' => 'Lorem Ipsum',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );



        // END CONTROLS
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="aboutBanner">
            <div class="container banner">
                <div class="abArea">
                    <div class="textArea">
                        <h1 class="title"><?php echo $settings['big_text']?></h1>
                        <?php echo $settings['banner_content']?>
                        <div class="abList">
                            <h4 class="title"><?php echo $settings['list_text']?></h4>
                            <ul>
                            <?php
/*                            foreach ($settings['about_list'] as $item) :
                                */?><!--
                                <li><?php /*echo $item['title']; */?></li>
                            --><?php
/*
                            endforeach;

                            */?>
                                <li>Game Design & Development: <a href="#" class="toggle-btn">Read More</a>
                                    <ul class="dropdown-content">
                                        <li><span>UI/UX Design:</span> Craft interactive and immersive user interfaces to enhance the gaming experience.</li>
                                        <li><span>Platform Development:</span> Tailored platforms for an optimized gaming experience.</li>
                                        <li><span>iOS/Android Game Development:</span> Seamless, engaging games for mobile users.</li>
                                        <li><span>Unity Game Development:</span> Advanced games utilizing Unity’s powerful engine.</li>
                                        <li><span>Virtual Reality Game Development:</span> Immersive VR games that transport players to otherworldly realms.</li>
                                    </ul>
                                </li>
                                <li>Gaming Solutions Agency: <a href="#" class="toggle-btn">Read More</a>
                                    <ul class="dropdown-content">
                                        <li><span>Localization:</span> Adapting games to resonate with diverse cultures and languages.</li>
                                        <li><span>User Acquisition:</span> Strategies to expand your game’s user base.</li>
                                        <li><span>Brand Strategy:</span> Crafting a resonant identity for your gaming brand.</li>
                                        <li><span>Event Planning & Execution:</span> Flawless orchestration of gaming events.</li>
                                        <li><span>Marketing Strategy:</span> Targeted campaigns to enhance visibility and user engagement.</li>
                                    </ul>
                                </li>
                                <li>Esports & Tournament Operations: <a href="#" class="toggle-btn">Read More</a>
                                    <ul class="dropdown-content">
                                        <li><span>Community Management:</span> Building and nurturing gaming communities.</li>
                                        <li><span>Esports Management:</span> Comprehensive management of esports operations.</li>
                                        <li><span>Event Management:</span> Seamless organization of both online and offline gaming events.</li>
                                    </ul>
                                </li>
                                <li>Broadcast & Production Services:: <a href="#" class="toggle-btn">Read More</a>
                                    <ul class="dropdown-content">
                                        <li><span>Broadcast Setup & Crew:</span> Full-fledged broadcasting solutions with professional crew members.</li>
                                        <li><span>Video Production:</span> High-quality video content tailored for gamers.</li>
                                        <li><span>Online & Offline Production:</span> Events broadcasted and produced for various platforms.</li>
                                        <li><span>Location Consultancy & Services:</span> Ideal location scouting for offline events.</li>
                                    </ul>
                                </li>
                                <li>Virtual Reality Services: <a href="#" class="toggle-btn">Read More</a>
                                    <ul class="dropdown-content">
                                        <li><span>VR Training Solutions:</span> Using VR for comprehensive training modules.</li>
                                        <li><span>Product Demonstration & Installation:</span> Showcasing products in an immersive VR environment.</li>
                                        <li><span>Marketing Strategies:</span> Innovative VR marketing campaigns.</li>
                                    </ul>
                                </li>
                                <li>Brand Lift Programs: <a href="#" class="toggle-btn">Read More</a>
                                    <ul class="dropdown-content">
                                        <li><span>Brand Collaboration:</span> Collaborative efforts to elevate brand visibility.</li>
                                        <li><span>Licensed 3rd Party Events:</span> Events in collaboration with notable third-party entities.</li>
                                        <li>Infused with innovation and unwavering passion, we stand at the forefront of the esports industry, spanning tournaments, influencer collaborations, content creation, marketing endeavors, and beyond. Lidoma Vision Esports is unwavering in its dedication to deliver unparalleled gaming experiences, pioneering untrodden paths in the vast expanse of the gaming universe. To tap into the vast reservoir of opportunities we offer and to embark on an unparalleled gaming journey, contact us at info@lidoma.com.</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="imgArea lazyload lazyloaded">
                        <?php echo getImage( $settings['banner_image']['id']  ); ?>
                    </div>
                </div>
            </div>
        </section>

        <div class="spacex" style="--spacer:250px"></div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var toggleButtons = document.querySelectorAll('.toggle-btn');

                toggleButtons.forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var dropdown = this.nextElementSibling;
                        if (dropdown.classList.contains('show')) {
                            dropdown.style.maxHeight = '0';
                            setTimeout(function() {
                                dropdown.classList.remove('show');
                            }, 10);
                            this.textContent = 'Read More';
                        } else {
                            dropdown.classList.add('show');
                            dropdown.style.maxHeight = dropdown.scrollHeight + "px";
                            this.textContent = 'Hide';
                        }
                    });
                });
            });
        </script>

        <?php
    }
}
