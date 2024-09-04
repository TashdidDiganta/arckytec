<?php

namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use WP_Query;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Arc_Team extends Widget_Base
{

    use \NilosCore\Widgets\NilosCoreElementFunctions;

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'arc-team';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Arc Team', 'arc-core');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-elementor-circle';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['arc-core'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['arc-core'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */

    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }


    protected function register_controls_section()
    {
        $this->start_controls_section(
            '_team_title',
            [
                'label' => esc_html__('Section Layout', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_team_style',
            [
                'label' => esc_html__('Service Style', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'team-1',
                'options' => [
                    'team-1' => esc_html__('Team 1', 'arc-core'),
                    'team-2' => esc_html__('Team 2', 'arc-core'),
                    'team-3' => esc_html__('Team 3', 'arc-core'),
                    'team-4' => esc_html__('Team 4', 'arc-core'),
                ]
            ]
        );
        $this->add_control(
            'bg_text',
            [
                'label' => esc_html__('BG Text', 'arc-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Our Team',
                'placeholder' => esc_html__('Type bg Text', 'arc-core'),
                'condition' => [
                    '_team_style' => 'team-3'
                ]
            ]
        );
        $this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Our Expert', 'arc-core' ),
				'placeholder' => esc_html__( 'Type your subtitle here', 'arc-core' ),
               
			]
		);
        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => wp_kses_post( 'Architecture Solutions <br> by Our Experts' ),
                'rows' => 4,
				'placeholder' => esc_html__( 'Type your title here', 'arc-core' ),
			]
		);

        $this->end_controls_section();


        $this->start_controls_section(
            '_team_content',
            [
                'label' => esc_html__('Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'team_list',
            [
                'label' => esc_html__('Team List', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'team_options',
                        'label' => esc_html__('Select A Member', 'arc-core'),
                        'type'  => \Elementor\Controls_Manager::SELECT2,
                        'options'   => $this->get_all_member()
                    ],
                    [
                        'name'  => 'animation_delay',
                        'label' => esc_html__('Animation Delay', 'arc-core'),
                        'type'  => \Elementor\Controls_Manager::NUMBER,
                        'default'   => 100,
                        'placeholder'   => esc_html__('e.g 100ms', 'arc-core'),
                        'condition' => [
                            '_team_style' => ['team-1', 'team-4']
                        ]
                    ]
                    ],
                    'default'   => [
                        [
                            'name' => esc_html__('Client:', 'arc-core'),
                        ]
                    ],
            ]


        );
        $this->end_controls_section();

    }

    protected function get_all_member(){
        $teams = new WP_Query(array(
            'post_type'     => 'team',
            'post_status'   => 'publish',
            'posts_per_page'    => -1
        ));

        $data = array();

        if($teams->have_posts()){
            while($teams->have_posts()){
                $teams->the_post();
                $data[get_the_ID()] = get_the_title();
            }
        }

        return $data;
    }

    protected function style_tab_content()
    {
    }

    /**
     * Render the widget ounilosut on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display(); ?>
        <?php if ($settings['_team_style'] == 'team-1') : ?>
        <!--Team One Start -->
        <section class="team-one">
            <div class="container">
                <div class="section-title text-center">
                    <span class="section-title__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title__title"><?php echo wp_kses_post($settings['title']); ?></h2>
                </div>
                <?php if($settings['team_list']) : ?>
                <div class="row">
                    <?php foreach($settings['team_list']  as $index => $team) : 
                        $query = new WP_Query(array(
                            'post_type'     => 'team',
                            'post_status'   => 'publish',
                            'posts_per_page'    => 1,
                            'p'              => $team['team_options']
                        ));
                      
                        if($query->have_posts()):
                        while($query->have_posts()): $query->the_post();
                        ?>
                        <?php if ($index % 2 == 0){ ?>
                        <!--Team One Single Start -->
                        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($team['animation_delay']); ?>ms">
                            <div class="team-one__single">
                            <?php if(has_post_thumbnail()): ?>
                                <div class="team-one__img">
                                  <?php the_post_thumbnail(); ?>
                                    <ul class="list-unstyled team-one__social">
                                        <?php
                                            $social_repeater = function_exists('tpmeta_field') ? tpmeta_field('_team_social_meta_id') : ''; 
                                            foreach($social_repeater as $row) :?>
                                                <?php foreach($row['_team_social_id'] as $icon ) :?>
                                                   <li> <a href="<?php echo $row['_url_value']; ?>"><i class="icon-<?php echo strtolower($icon)?>"></i></a></li>
                                                <?php endforeach?>
                                            <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                                <div class="team-one__content">
                                    <h4 class="team-one__name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <p class="team-one__sub-title"><?php echo get_field('member_designation'); ?></p>
                                    <ul class="list-unstyled team-one__social-two">
                                        <li><span><i class="icon-share"></i></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Team One Single End -->
                        <?php }else{ ?>
                            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($team['animation_delay']); ?>ms">
                            <div class="team-one__single  mar-t-40">
                            <?php if(has_post_thumbnail()): ?>
                                <div class="team-one__img">
                                    <?php the_post_thumbnail(); ?>
                                    <ul class="list-unstyled team-one__social">
                                        <?php
                                            $social_repeater = function_exists('tpmeta_field') ? tpmeta_field('_team_social_meta_id') : ''; 
                                            foreach($social_repeater as $row) :?>
                                                <?php foreach($row['_team_social_id'] as $icon ) :?>
                                                   <li> <a href="<?php echo $row['_url_value']; ?>"><i class="icon-<?php echo strtolower($icon)?>"></i></a></li>
                                                <?php endforeach?>
                                            <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <div class="team-one__content">
                                    <h4 class="team-one__name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <p class="team-one__sub-title"><?php echo get_field('member_designation'); ?></p>
                                    <ul class="list-unstyled team-one__social-two">
                                        <li><span><i class="icon-share"></i></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Team One Single End -->
                        <?php }?>
                    <?php endwhile; endif; endforeach;endif; ?>
                </div>
            </div>
        </section>
        <!--Team One Start -->
        <?php elseif ($settings['_team_style'] == 'team-2') : ?>

        <?php elseif ($settings['_team_style'] == 'team-3') : ?>
        <!--Team Two Start -->
        <section class="team-two dark-body">
            <div class="home-three-site-border"></div>
            <div class="home-three-site-border home-three-site-border-two"></div>
            <div class="home-three-site-border home-three-site-border-three"></div>
            <div class="home-three-site-border home-three-site-border-four"></div>
            <div class="home-three-site-border home-three-site-border-five"></div>
            <div class="home-three-site-border home-three-site-border-six"></div>

            <p class="section__section-text"><?php echo esc_html($settings['bg_text']); ?> </p>
            <div class="container">
                <div class="section-title-three text-center">
                    <span class="section-title-three__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title-three__title"><?php echo esc_html($settings['subtitle']); ?></h2>
                </div>
                <div class="team-two__inner">
                    <div class="team-slider-1 team-two__carousel swiper-container">
                    <?php if($settings['team_list']) : ?>
                        <div class="swiper-wrapper">
                        <?php foreach($settings['team_list']  as $team) : 
                        $query = new WP_Query(array(
                            'post_type'     => 'team',
                            'post_status'   => 'publish',
                            'posts_per_page'    => 1,
                            'p'              => $team['team_options']
                        ));
                      
                        if($query->have_posts()):
                        while($query->have_posts()): $query->the_post();
                        ?>
                        <!--Team Two Single Start-->
                        <div class="swiper-slide">
                            <div class="team-two__single">
                                <div class="team-two__shape-1">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/team-two-shape-1.png' ?> " alt="">
                                </div>
                                <div class="team-two__content">
                                    <h3 class="team-two__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p class="team-two__sub-title"><?php echo get_field('member_designation'); ?></p>
                                    <p class="team-two__text"><?php echo get_the_excerpt(); ?></p>
                                    <div class="team-two__social">
                                        <?php $social_repeater = function_exists('tpmeta_field') ? tpmeta_field('_team_social_meta_id') : ''; 
                                            foreach($social_repeater as $row) :?>
                                            <?php foreach($row['_team_social_id'] as $icon ) :?>
                                                <a href="<?php echo $row['_url_value']; ?>"><span class="icon-<?php echo strtolower($icon)?>"></span></a>
                                            <?php endforeach?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php if(has_post_thumbnail()): ?>
                                <div class="team-two__img">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!--Team Two Single End-->
                        <?php
                        endwhile; endif; endforeach;?>
                       </div>
                    </div>
                     <?php endif; ?>
                      <div class="swiper-pagination" id="team-two-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <!--Team Two End -->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                var swiper5 = new Swiper(".team-slider-1", {
                spaceBetween: 30,
                slidesPerView: 2,
                effect: 'fade',
                loop: true,
                pagination: {
                    el: "#team-two-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#team-two__swiper-button-next",
                    prevEl: "#team-two__swiper-button-prev"
                },
                autoplay: {
                  delay: 5000,
                },
                breakpoints: {
                  0: {
                    slidesPerView: 1,
                  },
                  375: {
                    slidesPerView: 1,
                  },
                  575: {
                    slidesPerView: 1,
                  },
                  767: {
                    slidesPerView: 1,
                  },
                  991: {
                    slidesPerView: 1,
                  },
                  1199: {
                    slidesPerView: 1,
                  }
                },
              });
            })(jQuery);
        </script>
        <?php endif; ?>
        <?php elseif ($settings['_team_style'] == 'team-4') : ?>
        <!--Team Three Start -->
        <section class="team-three">
            <div class="home-four-site-border"></div>
            <div class="home-four-site-border home-four-site-border-two"></div>
            <div class="home-four-site-border home-four-site-border-three"></div>
            <div class="home-four-site-border home-four-site-border-four"></div>
            <div class="home-four-site-border home-four-site-border-five"></div>
            <div class="home-four-site-border home-four-site-border-six"></div>
            <div class="container">
                <div class="section-title-four text-center">
                    <span class="section-title-four__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title-four__title"><?php echo wp_kses_post($settings['title']); ?></h2>
                </div>
                <?php if($settings['team_list']) : ?>
                <div class="row">
                    <?php foreach($settings['team_list']  as $index => $team) : 
                        $query = new WP_Query(array(
                            'post_type'     => 'team',
                            'post_status'   => 'publish',
                            'posts_per_page'    => 1,
                            'p'              => $team['team_options']
                        ));
                      
                        if($query->have_posts()):
                        while($query->have_posts()): $query->the_post();
                    ?>
                    <?php if ($index % 2 == 0){ ?>
                    <!--Team Three Single Start -->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($team['animation_delay']); ?>ms">
                        <div class="team-three__single">
                            <div class="team-three__img">
                                <?php if(has_post_thumbnail()) : ?>
                                  <?php the_post_thumbnail(); ?>
                                 <?php endif; ?>
                                <div class="social-share-icon">
                                    <i class="icon-share"></i>
                                    <ul class="list-unstyled team-three__social left">
                                        <?php
                                        $social_repeater = function_exists('tpmeta_field') ? tpmeta_field('_team_social_meta_id') : ''; 
                                        foreach($social_repeater as $row) :?>
                                        <?php if(array_key_exists('icon-twitter', $row['_team_social_id']) || array_key_exists('icon-facebook', $row['_team_social_id']))  : ?>
                                            <?php foreach($row['_team_social_id'] as $key => $val ) :?>
                                                <li><a href="<?php echo $row['_url_value']; ?>"><i class="<?php echo esc_attr($key); ?>"></i></a></li>
                                            <?php endforeach?>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>

                                    <ul class="list-unstyled team-three__social right">
                                        <?php
                                        $social_repeater = function_exists('tpmeta_field') ? tpmeta_field('_team_social_meta_id') : ''; 
                                        foreach($social_repeater as $row) :?>
                                        <?php if(array_key_exists('icon-linkedin', $row['_team_social_id']) || array_key_exists('icon-instagram', $row['_team_social_id']))  : ?>
                                            <?php foreach($row['_team_social_id'] as $key => $val ) :?>
                                                <li><a href="<?php echo $row['_url_value']; ?>"><i class="<?php echo esc_attr($key); ?>"></i></a></li>
                                            <?php endforeach?>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-three__content">
                                <h4 class="team-three__name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p class="team-three__sub-title"><?php echo get_field('member_designation'); ?></p>
                            </div>
                        </div>
                    </div>
                    <!--Team Three Single End -->
                    <?php }else{ ?>
                    <!--Team Three Single Start -->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($team['animation_delay']); ?>ms">
                        <div class="team-three__single mar-t-60">
                            <div class="team-three__img">
                               <?php if(has_post_thumbnail()) : ?>
                                  <?php the_post_thumbnail(); ?>
                                 <?php endif; ?>
                                <div class="social-share-icon">
                                    <i class="icon-share"></i>
                                    <ul class="list-unstyled team-three__social left">
                                    <?php
                                        $social_repeater = function_exists('tpmeta_field') ? tpmeta_field('_team_social_meta_id') : ''; 
                                        foreach($social_repeater as $row) :?>
                                            <?php foreach($row['_team_social_id'] as $icon ) :?>
                                                <?php if($icon == 'Facebook' || $icon == 'Twitter')  : ?>
                                                    <li> <a href="<?php echo $row['_url_value']; ?>"><i class="icon-<?php echo strtolower($icon)?>"></i></a></li>
                                                <?php endif; ?>
                                            <?php endforeach?>
                                        <?php endforeach; ?>
                                    </ul>
                                    <ul class="list-unstyled team-three__social right">
                                    <?php
                                        $social_repeater = function_exists('tpmeta_field') ? tpmeta_field('_team_social_meta_id') : ''; 
                                        foreach($social_repeater as $row) :?>
                                            <?php foreach($row['_team_social_id'] as $icon ) :?>
                                                <?php if($icon == 'linkedin' || $icon == 'Instagram')  : ?>
                                                    <li> <a href="<?php echo $row['_url_value']; ?>"><i class="icon-<?php echo strtolower($icon)?>"></i></a></li>
                                                <?php endif; ?>
                                            <?php endforeach?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-three__content">
                                <h4 class="team-three__name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p class="team-three__sub-title"><?php echo get_field('member_designation'); ?></p>
                            </div>
                        </div>
                    </div>
                    <!--Team Three Single End -->
                    <?php }
                     endwhile; endif; endforeach;
                     ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <!--Team Three End -->
        <?php endif;
    }
}

$widgets_manager->register(new Arc_Team());
