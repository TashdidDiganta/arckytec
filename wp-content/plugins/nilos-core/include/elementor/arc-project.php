<?php

namespace NilosCore\Widgets;

use Arc\Widgets\ArcElementorTraits;
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
class ARC_Project extends Widget_Base
{

    use \NilosCore\Widgets\NilosCoreElementFunctions;
    use ArcElementorTraits;

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
        return 'arc-project';
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
        return __('Arc Project', 'arc-core');
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
            '_project',
            [
                'label' => esc_html__('Project Section', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_project_style',
            [
                'label' => esc_html__('Project Style', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'project-1',
                'options' => [
                    'project-1' => esc_html__('Project 1', 'arc-core'),
                    'project-2' => esc_html__('Project 2', 'arc-core'),
                    'project-3' => esc_html__('Project 3', 'arc-core'),
                    'project-4' => esc_html__('Project 4', 'arc-core'),
                ]
            ]
        );
        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Our Project', 'arc-core'),
                'placeholder' => esc_html__('Type your tag here', 'arc-core'),
            ]
        );
        $this->add_control(
            'project_title',
            [
                'label' => esc_html__('Title', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Our Resent Client Project Information', 'arc-core'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
                'rows' => 4
            ]
        );
        $this->add_control(
            'btn_name',
            [
                'label' => esc_html__('Button Name', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("View All Project", 'arc-core'),
                'placeholder' => esc_html__('Type your button name here', 'arc-core'),
                'condition' => [
                    '_project_style' => ['project-3']
                ]
            ],
        );
        $this->add_control(
			'btn_url',
			[
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
                'condition' => [
                    '_project_style' => ['project-3']
                ],
				'label_block' => true,
			]
		);

        $this->add_control(
			'bg_image',
			[
				'label' => esc_html__( 'Background Image', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    '_project_style'   => 'project-3'
                ]
			],
		);
        $this->end_controls_section();


        $this->start_controls_section(
            '_left_content',
            [
                'label' => esc_html__('Left Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_project_style' => ['project-1']
                ]
            ]
        );
        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => wp_kses_post('It is a long established fact that a reader will be distracted the readable  content of a page when looking at layout the point of using lorem Ipsum less normal distribution of letters.', 'arc-core'),
                'placeholder' => esc_html__('Type your description here', 'arc-core'),
            ]
        );
        $this->add_control(
			'project_list_1',
			[
				'label' => esc_html__( 'Project List 1', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'list_title',
						'label' => esc_html__( 'Title', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Duration:' , 'arc-core' ),
						'label_block' => true,
					],
                    [
						'name' => 'list_desc',
						'label' => esc_html__( 'Description', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( '7 Month' , 'arc-core' ),
						'label_block' => true,
					],

				],
                'default'   => [
                    [
                        'Project_title' => esc_html__('Duration:', 'arc-core'),
                        'Project_title' => esc_html__('7 Month', 'arc-core'),
                    ]
                ],
			]
		);
        $this->add_control(
			'info_list',
			[
				'label' => esc_html__( 'Info Details', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'list_title',
						'label' => esc_html__( 'Title', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Client:' , 'arc-core' ),
						'label_block' => true,
					],
                    [
						'name' => 'list_desc',
						'label' => esc_html__( 'Description', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Robert Fox' , 'arc-core' ),
						'label_block' => true,
					],

				],
                'default'   => [
                    [
                        'Project_title' => esc_html__('Client:', 'arc-core'),
                        'Project_title' => esc_html__('Robert Fox', 'arc-core'),
                    ]
                ],
			]
		);
        $this->add_control(
            'project_btn',
            [
                'label' => esc_html__('Button', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View project', 'arc-core'),
                'placeholder' => esc_html__('Type your button name here', 'arc-core'),
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button link', 'arc-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_project_content',
            [
                'label' => esc_html__('Projects', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_project_style'   => ['project-2', 'project-4']
                ]
            ]
        );

        $this->add_control(
            'project_list',
            [
                'label' => esc_html__('Project List', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'project',
                        'label' => esc_html__('Select A Project', 'arc-core'),
                        'type'  => \Elementor\Controls_Manager::SELECT2,
                        'options'   => $this->get_all_project(),
                    ],
                ],
                'default'   => [
                    [
                        'name'  => esc_html__('Creative Architecture', 'arc-core'),

                    ],
                ],
            ]


        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ly_three_project_content',
            [
                'label' => esc_html__('Projects', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_project_style'   => 'project-3'
                ]
            ]
        );

        $this->add_control(
            'ly_three_project_list',
            [
                'label' => esc_html__('Project List', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'ly_three_project',
                        'label' => esc_html__('Select A Project', 'arc-core'),
                        'type'  => \Elementor\Controls_Manager::SELECT2,
                        'options'   => $this->get_all_project(),
                    ],
                    [
                        'name'  => 'single_img',
                        'label' => esc_html__( 'Hover Image', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ]
                    ],
                ],
                'default'   => [
                    [
                        'name'  => esc_html__('Creative Architecture', 'arc-core'),

                    ],
                ],
            ]


        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_right_content',
            [
                'label' => esc_html__('Right Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_project_style' => ['project-1']
                ]
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'arc-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_Project_more',
            [
                'label' => esc_html__('More Button', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_project_style'    => ['Project-3']
                ]
            ]
        );

        $this->end_controls_section();
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
        <?php if ($settings['_project_style'] == 'project-1') : ?>
        <!--Project One Start -->
        <section class="project-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="project-one__left">
                            <div class="section-title text-left">
                                <span class="section-title__tagline"> <?php echo esc_html($settings['subtitle']); ?></span>
                                <h2 class="section-title__title"> <?php echo esc_html( $settings['project_title']); ?></h2>
                            </div>
                            <p class="project-one__text"> <?php echo wp_kses_post($settings['desc']); ?></p>
                            <div class="project-one__project-list-box">
                                <ul class="list-unstyled project-one__project-list">
                                    <?php foreach($settings['project_list_1'] as $item) : ?>
                                    <li>
                                        <div class="project-one__project-single">
                                            <p><?php echo esc_html($item['list_title']); ?></p>
                                            <h4><?php echo esc_html($item['list_desc']); ?></h4>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <ul class="list-unstyled project-one__project-list project-one__project-list-two">
                                    <?php foreach($settings['info_list'] as $item) : ?>
                                        <li>
                                            <div class="project-one__project-single">
                                                <p><?php echo esc_html($item['list_title']); ?></p>
                                                <h4><?php echo esc_html($item['list_desc']); ?></h4>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="btn-box">
                                <a href="<?php esc_attr($settings['btn_link']['url']); ?>" class="button-style-1 btn-bg-white">
                                   <?php echo esc_html($settings['project_btn']); ?>
                                    <span class="icon-right"></span> 
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="project-one__right">
                            <div class="project-one__img">
                                <img src="<?php echo esc_attr($settings['image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Project One Start -->
        <?php elseif ($settings['_project_style'] == 'project-2') : ?>
        <!--Project One Start-->
        <section class="project-two">
            <div class="container">
                <div class="section-title-two text-left">
                    <span class="section-title-two__tagline"> <?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title-two__title"> <?php echo esc_html($settings['project_title']); ?></h2>
                </div>
                <div class="project-slider-1 swiper-container project-two__carousel">
                    <div class="swiper-wrapper">
                        <?php
                              $query = new WP_Query(array(
                                'post_type' => 'project',
                                'post_status'   => 'publish',
                                'posts_per_page' => -1,
                              ));
                              if($query->have_posts()):
                                while($query->have_posts()): $query->the_post();
                            ?>
                            <!--Project One Single Start-->
                            <div class="swiper-slide">
                            <div class="project-two__single">
                                <div class="project-two__img">
                                    <?php if(has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail(); ?>
                                    <?php endif; ?>
                                    <div class="project-two__title-box">
                                        <h4 class="project-two__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    </div>
                                 
                                    <div class="project-two__arrow">
                                        <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="img-popup"><span
                                         class="icon-up-right-arrow"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--Project One Single End-->
                        <?php endwhile; ?>
                        <?php endif; ?>                        
                    </div>
                </div>
                <!-- If we need navigation buttons -->
                <div class="project-two__nav">
                    <div class="swiper-button-prev" id="project-two__swiper-button-next">
                        <i class="icon-left-arrow-1"></i>
                    </div>
                    <div class="swiper-button-next" id="project-two__swiper-button-prev">
                        <i class="icon-right-arrow-1"></i>
                    </div>
                </div>
            </div>
        </section>
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
              var swiper3 = new Swiper(".project-slider-1", {
                spaceBetween: 30,
                slidesPerView: 2,
                loop: true,
                pagination: {
                    el: "#project-two-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#project-two__swiper-button-next",
                    prevEl: "#project-two__swiper-button-prev"
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
                    slidesPerView: 2,
                  },
                  1199: {
                    slidesPerView: 2,
                  }
                },
              });
              if ($(".img-popup").length) {
                var groups = {};
                $(".img-popup").each(function () {
                var id = parseInt($(this).attr("data-group"), 10);

                if (!groups[id]) {
                    groups[id] = [];
                }

                groups[id].push(this);
                });

                $.each(groups, function () {
                $(this).magnificPopup({
                    type: "image",
                    closeOnContentClick: true,
                    closeBtnInside: false,
                    gallery: {
                    enabled: true
                    }
                });
                });
            }
        </script>
        <?php endif; ?>
        <!--Project One End-->
        <?php elseif ($settings['_project_style'] == 'project-3') : ?>
        <!--Project Three Start -->
            <section class="project-three">
                <div class="project-three__bg"
                    style="background-image: url(<?php echo esc_attr($settings['bg_image']['url']); ?>"></div>
                <div class="container">
                    <div class="project-three__top">
                        <div class="project-three__top-left">
                            <div class="section-title-three text-left">
                                <span class="section-title-three__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                                <h2 class="section-title-three__title"><?php echo esc_html($settings['project_title']); ?></h2>
                            </div>
                        </div>
                        <div class="project-three__btn-box">
                            <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="button-style-1 btn-bg-white"> <?php echo esc_html($settings['btn_name']); ?><span
                                    class="icon-right"></span> </a>
                        </div>
                    </div>
                    <div class="project-three__bottom">
                        <ul class="project-three__project-list list-unstyled">
                            <?php
                             foreach($settings['ly_three_project_list'] as $item): 
                                $query = new WP_Query(array(
                                    'post_type' => 'project',
                                    'post_status'   => 'publish',
                                    'posts_per_page'    => 1,
                                    'p'             => $item['ly_three_project']
                                ));

                                if($query->have_posts()):
                                while($query->have_posts()): $query->the_post();

                            ?>
                             <?php $category = get_the_terms(get_the_ID(), 'project-cat'); ?>
                            <li class="cs-hover_tab-2">
                                <div class="project-three__title-box">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php if($category): ?>
                                     <p><?php echo $category[0]->name; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="project-three__img-and-btn">
                                    <?php if(has_post_thumbnail()): ?>
                                    <div class="project-three__img">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="project-three__read-more">
                                        <a href="<?php the_permalink(); ?>"><span class="icon-up-right-arrow-1"></span> <?php _e('Read More', 'arc-core'); ?> </a>
                                    </div>
                                </div>
                                <div class="project-three__single-img-box clearfix">
                                    <div class="project-three__single-img-box__bg"
                                        data-src="<?php echo $item['single_img']['url']; ?>"></div>
                                </div>
                            </li>
                            <?php endwhile;endif; endforeach;?>
                        </ul>
                    </div>
                </div>
            </section>
        <!--Project Three End -->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                $('.project-three__project-list .cs-hover_tab-2').hover(function() {
                $(this).addClass('active');
                }, function() {
                $(this).removeClass('active');
                });
                $('[data-src]').each(function () {
                var src = $(this).attr('data-src');
                $(this).css({
                    'background-image': 'url(' + src + ')',
                });
                });


            })(jQuery);
        </script>
        <?php endif; ?>
        <?php elseif ($settings['_project_style'] == 'project-4') : ?>
        <!--Project Four Start -->
        <section class="project-four">
            <div class="home-four-site-border"></div>
            <div class="home-four-site-border home-four-site-border-two"></div>
            <div class="home-four-site-border home-four-site-border-three"></div>
            <div class="home-four-site-border home-four-site-border-four"></div>
            <div class="home-four-site-border home-four-site-border-five"></div>
            <div class="home-four-site-border home-four-site-border-six"></div>
            <div class="container">
                <div class="section-title-four text-left">
                    <span class="section-title-four__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title-four__title"><?php echo esc_html($settings['project_title']); ?></h2>
                </div>

                <div class="project-four__main">
                    <div class="project-four__title-box">
                        <ul class="clearfix list-unstyled">
                            <?php
                            foreach($settings['project_list'] as $item): 
                              $query = new WP_Query(array(
                                'post_type' => 'project',
                                'post_status'   => 'publish',
                                'posts_per_page'    => 1,
                                'p'             => $item['project']
                              ));
                              if($query->have_posts()):
                                while($query->have_posts()): $query->the_post();

                            ?>
                             <?php $category = get_the_terms(get_the_ID(), 'project-cat'); ?>
                            <li class="cs-hover_tab active">
                                <div class="project-four__title-box-inner">
                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <?php if($category): ?>
                                     <p><?php echo $category[0]->name; ?></p>
                                    <?php endif; ?>
                                    <div class="project-four__arrow">
                                        <a href="#"><span class="icon-right-arrow-2"></span></a>
                                    </div>
                                </div>
                                <div class="project-four__single-img-box clearfix">
                                    <div class="project-four__single-img-box__bg" data-src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"></div>
                                </div>
                            </li>
                            <?php endwhile; endif; endforeach?>
                        </ul>
                    </div>

                </div>
            </div>
        </section>
        <!--Project Four Start -->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                $('.project-four__title-box ul li').hover(function () {
                $(this)
                    .addClass('active')
                    .siblings()
                    .removeClass('active');
                });
                $('.project-three__project-list .cs-hover_tab-2').hover(function() {
                $(this).addClass('active');
                }, function() {
                $(this).removeClass('active');
                });
                $('[data-src]').each(function () {
                var src = $(this).attr('data-src');
                $(this).css({
                    'background-image': 'url(' + src + ')',
                });
                });


            })(jQuery);
        </script>
        <?php endif; endif;
    }
}

$widgets_manager->register(new ARC_Project());
