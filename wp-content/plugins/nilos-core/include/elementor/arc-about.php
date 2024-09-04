<?php

namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class ARC_About extends Widget_Base
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
        return 'arc-about';
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
        return __('Arc About', 'arc-core');
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
            'arc_layout',
            [
                'label' => esc_html__('Choose Layout', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_about_style',
            [
                'label' => esc_html__('About Style', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'about-1',
                'options' => [
                    'about-1' => esc_html__('About 1', 'arc-core'),
                    'about-2' => esc_html__('About 2', 'arc-core'),
                    'about-3' => esc_html__('About 3', 'arc-core'),
                    'about-4' => esc_html__('About 4', 'arc-core'),
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_bg_shape',
            [
                'label' => esc_html__('Section Background Image', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_about_style' => ['about-1']
                ]
            ]
        );
        $this->add_control(
            'about_bg',
            [
                'label' => esc_html__('Choose Image', 'arc-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        //about 3
        $this->start_controls_section(
            '_process_content',
            [
                'label' => esc_html__('Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_about_style' => ['about-3']
                ]

            ]
        );
        
        $this->add_control(
            '_process_list',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'arc-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Design Process', 'arc-core' ),
                        'placeholder' => esc_html__( 'Type your title here', 'arc-core' ),
                    ],
            
                    [
                        'name' => 'title_url',
                        'label' => esc_html__( 'Page Url', 'arc-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'http//about.html', 'arc-core' ),
                        'placeholder' => esc_html__( 'Type your title here', 'arc-core' ),
                    ],
            
                    [
                        'name' => 'desc',
                        'label' => esc_html__( 'Description', 'arc-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur the is adipisci elit. Integer feugiat tortor non there are many other nullam.', 'arc-core' ),
                        'placeholder' => esc_html__( 'Type your description here', 'arc-core' ),
                    ],
                ],
                'default' => [
                    [
                        'title'         => esc_html__('Design Process', 'arc-core'),
                        'desc'          => esc_html__('', 'arc-core'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        

        $this->end_controls_section();

        //about
        $this->start_controls_section(
            '_about_left',
            [
                'label' => esc_html__('Left Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_about_style' => ['about-1', 'about-2',]
                ]

            ]
        );
        $this->add_control(
            'about_image',
            [
                'label' => esc_html__('Back Image', 'arc-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    '_about_style'   => ['about-1', 'about-2', 'about-4']
               ]
            ],
        );
        $this->add_control(
            'about_image_2',
            [
                'label' => esc_html__('Front Image', 'arc-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    '_about_style'   => ['about-1', 'about-2']
                ]
            ]
        );
        $this->add_control(
            'bg_text',
            [
                'label' => esc_html__('Add BG Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("Arckytec", 'arc-core'),
                'placeholder' => esc_html__('Type your bg text here', 'arc-core'),
                'condition' => [
                    '_about_style'   =>  'about-2'
                ]
            ],
        );
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
                'condition' => [
                    '_about_style' => 'about-1'
                ]
			],

		);
        $this->add_control(
            'left_image',
            [
                'label' => esc_html__('Image', 'arc-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    '_about_style'   => 'about-4',
                ]
            ]
        );
        $this->add_control(
            'animation_delay',
            [
                'label' => esc_html__('Animation Delay', 'arc-core'),
                'type'  => \Elementor\Controls_Manager::NUMBER,
                'default'   => 100,
                'placeholder'   => esc_html__('e.g 100ms', 'arc-core')
            ],
        );
        $this->add_control(
            'count_number',
            [
                'label' => esc_html__('Project Number', 'arc-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => esc_html__("300", 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'condition' => [
                    '_about_style'   => ['about-1', 'about-2'], 
                ]
            ]
        );
        $this->add_control(
            'count_text',
            [
                'label' => esc_html__('Project Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Success Project", 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'condition' => [
                    '_about_style' => ['about-1', 'about-2',]
                ],
                'rows' => 4
            ]
        );

        $this->end_controls_section();

        //about 4
        $this->start_controls_section(
            '_about_four_left',
            [
                'label' => esc_html__('Left Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_about_style' => 'about-4'
                ]

            ]
        );
        $this->add_control(
            'about_image_four',
            [
                'label' => esc_html__('Back Image', 'arc-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );
        $this->add_control(
            'about_four_animation',
            [
                'label' => esc_html__('Animation Delay', 'arc-core'),
                'type'  => \Elementor\Controls_Manager::NUMBER,
                'default'   => 100,
                'placeholder'   => esc_html__('e.g 100ms', 'arc-core')
            ],
        );

        $this->end_controls_section();

        // right section
        $this->start_controls_section(
            '_about_right',
            [
                'label' => esc_html__('Right Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_about_style' => ['about-1', 'about-2',]
                ]

            ]
        );
        $this->add_control(
            'content_subtitle',
            [
                'label' => esc_html__('Content Subtitle', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("About", 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'condition' => [
                    '_about_style'   => ['about-1', 'about-2']
                ]
            ]
        );
        $this->add_control(
            'content_title',
            [
                'label' => esc_html__('Title', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => wp_kses_post('Artfully Crafted Exquisite Interiors.', 'arc-core'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
                'rows' => '3' 
            ]
        );
        $this->add_control(
            'content_desc',
            [
                'label' => esc_html__('Description', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => wp_kses_post('It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point of using lorem Ipsum less normal distribution of letters.', 'arc-core'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
            ]
        );
        $this->add_control(
            'about_left_point',
            [
                'label' => esc_html__( 'About Point Left', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'icon',
                        'label' => esc_html__( 'Icon', 'textdomain' ),
                        'type'  => \Elementor\Controls_Manager::ICONS
                    ],
                    [
						'name' => 'text',
						'label' => esc_html__('Text', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Design Mistakes to Avoid' , 'arc-core' ),
						'label_block' => true,
					]

                ],
                'condition' => [
                    '_about_style' => 'about-1',
                ],
                'default' => [
                    [
						'text' => esc_html__( 'Design Mistakes to Avoid', 'arc-core' )
					],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );
        $this->add_control(
            'about_right_point',
            [
                'label' => esc_html__( 'About Point Right', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'icon',
                        'label' => esc_html__( 'Icon', 'textdomain' ),
                        'type'  => \Elementor\Controls_Manager::ICONS
                    ],
                    [
                        'name' => 'text',
                        'label' => esc_html__('Text', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Design Mistakes to Avoid' , 'arc-core' ),
                        'label_block' => true,
                    ]

                ],
                'default' => [
                    [
                        'text' => esc_html__( 'Design Mistakes to Avoid', 'arc-core' )
                    ],
                ],
                'title_field' => '{{{ text }}}',
                'condition' => [
                    '_about_style' => 'about-1',
                ]
            ]
        );
        $this->add_control(
			'progress_bar',
			[
				'label' => esc_html__( 'Progrss Bar', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'progress_title',
						'label' => esc_html__( 'Title', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'List Title' , 'arc-core' ),
						'label_block' => true,
					],
					[
						'name' => 'progress_number',
						'label' => esc_html__( 'Progress Number', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'default' => '50'
					],
				],
                'condition' => [
                    '_about_style'   => 'about-2'
                ],
				'default' => [
					[
						'progress_title' => esc_html__( 'Architecture', 'arc-core' ),
					],
				],
				'title_field' => '{{{ progress_title }}}',
			]
		);


        $this->add_control(
            'about_btn',
            [
                'label' => esc_html__('Button Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__(' Explore More', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
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

        // right section
        $this->start_controls_section(
            '_about_four_right',
            [
                'label' => esc_html__('Right Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_about_style' => ['about-4']
                ]

            ]
        );

        $this->add_control(
            'about_four_title',
            [
                'label' => esc_html__('Title', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => wp_kses_post('Artfully Crafted Exquisite Interiors.', 'arc-core'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
                'rows' => '3' 
            ]
        );
        $this->add_control(
            'about_four_desc',
            [
                'label' => esc_html__('Description', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => wp_kses_post('It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point of using lorem Ipsum less normal distribution of letters.', 'arc-core'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
            ]
        );
        $this->add_control(
            'about_four_point',
            [
                'label' => esc_html__( 'About Point', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'icon',
                        'label' => esc_html__( 'Icon', 'textdomain' ),
                        'type'  => \Elementor\Controls_Manager::ICONS
                    ],
                    [
                        'name' => 'text',
                        'label' => esc_html__('Text', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Project Planning' , 'arc-core' ),
                        'label_block' => true,
                    ]

                ],
                'default' => [
                    [
                        'text' => esc_html__( 'Project Planning', 'arc-core' )
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );
        $this->add_control(
            'about_four_btn',
            [
                'label' => esc_html__('Button Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__(' Explore More', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
            ]
        );
        $this->add_control(
            'about_four_link',
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
        $settings = $this->get_settings_for_display();
        ?>
        <?php if ($settings['_about_style'] == 'about-1') : ?>
        <!--About One Start -->
        <section class="about-one">
            <div class="about-one__icon float-bob-y">
                <img src="<?php echo esc_attr($settings['about_bg']['url']); ?>" alt="<?php bloginfo('name'); ?>">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="about-one__left">
                            <div class="about-one__img-box wow fadeInLeft" data-wow-delay="<?php echo esc_attr($settings['animation_delay']); ?>ms"
                                data-wow-duration="2500ms">
                                <div class="about-one__img-one">
                                    <img src="<?php echo esc_attr( $settings['about_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                                <div class="about-one__img-two">
                                    <img src="<?php echo $settings['about_image_2']['url']; ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                                <div class="about-one__success-project">
                                    <div class="about-one__success-project-icon">
                                        <span><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                    </div>
                                    <div class="about-one__success-project-content">
                                        <h5><?php echo esc_html($settings['count_text']); ?></h5>
                                        <div class="about-one__success-project-count">
                                            <h3 class="odometer" data-count="<?php echo esc_attr($settings['count_number']); ?>">00</h3>
                                            <span class="about-one__success-project-count-plus">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="about-one__dot float-bob-y">
                                    <img src="<?php echo get_template_directory_uri() .'/assets/img/shape/about-one-dot.png' ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="about-one__right">
                            <div class="section-title text-left">
                                <span class="section-title__tagline"><?php echo esc_html($settings['content_subtitle']); ?></span>
                                <h2 class="section-title__title"> <?php echo wp_kses_post($settings['content_title']); ?></h2>
                            </div>
                            <p class="about-one__text"><?php echo wp_kses_post($settings['content_desc']); ?></p>
                            <div class="about-one__points-box">
                                <ul class="list-unstyled about-one__points">
                                    <?php foreach($settings['about_left_point'] as $item): ?>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-check"></span>
                                            <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                        <div class="text">
                                            <p><?php echo esc_html($item['text']); ?></p>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <ul class="list-unstyled about-one__points about-one__points--two">
                                    <?php foreach($settings['about_right_point'] as $item): ?>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-check"></span>
                                                <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                            <div class="text">
                                                <p><?php echo esc_html($item['text']); ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="btn-box">
                                <a href="<?php echo esc_attr($settings['btn_link']['url']); ?>" class="button-style-1 btn-bg-white"> <?php echo esc_html($settings['about_btn']); ?><span class="icon-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--About One Start -->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                if ($(".odometer").length) {
                var odo = $(".odometer");
                odo.each(function () {
                    $(this).appear(function () {
                    var countNumber = $(this).attr("data-count");
                    $(this).html(countNumber);
                    });
                });
                }
            })(jQuery);
        </script>
        <?php endif; ?>
        <?php elseif ($settings['_about_style'] == 'about-2') : ?>
        <!--About Two Start-->
        <section class="about-two">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="about-two__left">
                            <div class="about-two__img-box wow fadeInLeft" data-wow-delay="<?php echo esc_attr($settings['animation_delay']); ?>ms"
                                data-wow-duration="2500ms">
                                <div class="about-two__img">
                                    <img src="<?php echo esc_attr($settings['about_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                                <div class="about-two__img-two">
                                    <img src="<?php echo esc_attr($settings['about_image_2']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                                <div class="about-two__experience">
                                    <div class="about-two__experience-count">
                                        <h3 class="odometer" data-count="<?php echo esc_attr($settings['count_number']); ?>">00</h3>
                                        <span class="about-two__experience-count-plus">+</span>
                                    </div>
                                    <h5 class="about-two__experience-text"><?php echo esc_html( $settings['count_text']); ?></h5>
                                </div>
                                <div class="about-two__big-text"><?php echo esc_html($settings['bg_text']); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="about-two__right">
                            <div class="section-title-two text-left">
                                <span class="section-title-two__tagline"><?php echo esc_html( $settings['content_subtitle']); ?></span>
                                <h2 class="section-title-two__title"><?php echo esc_html($settings['content_title']); ?></h2>
                            </div>
                            <p class="about-two__text"><?php echo esc_html($settings['content_desc']); ?></p>
                            <div class="about-two__progress">
                                <div class="progress-levels">
                                <?php foreach($settings['progress_bar'] as $progress) : ?>
                                    <!--Skill Box-->
                                    <div class="progress-box">
                                        <div class="inner count-box">
                                            <div class="text"><?php echo esc_html($progress['progress_title']); ?></div>
                                            <div class="bar">
                                                <div class="bar-innner">
                                                    <div class="skill-percent">
                                                        <span class="count-text" data-speed="3000"
                                                            data-stop="<?php echo esc_attr($progress['progress_number']);?>">0</span>
                                                        <span class="percent">%</span>
                                                    </div>
                                                    <div class="bar-fill" data-percent="<?php echo esc_attr($progress['progress_number']); ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Skill Box-->
                                <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="about-two__btn-box">
                                <a href="<?php echo esc_attr($settings['btn_link']['url']); ?>" class="button-style-1">
                                    <?php echo $settings['about_btn']; ?>
                                    <span class="icon-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--About Two End-->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                if ($(".odometer").length) {
                var odo = $(".odometer");
                odo.each(function () {
                    $(this).appear(function () {
                    var countNumber = $(this).attr("data-count");
                    $(this).html(countNumber);
                    });
                });
                }
                if ($(".progress-levels .progress-box .bar-fill").length) {
                $(".progress-box .bar-fill").each(
                    function () {
                    $(".progress-box .bar-fill").appear(function () {
                        var progressWidth = $(this).attr("data-percent");
                        $(this).css("width", progressWidth + "%");
                    });
                    }, {
                    accY: 0
                    }
                );
                }
            })(jQuery);
        </script>
        <?php endif; ?>
        <?php elseif ($settings['_about_style'] == 'about-3') : ?>
            <section class="process-one">
            <div class="container">
                <div class="row">                        
                    <?php foreach($settings['_process_list'] as $index => $item ) : ?>
                        <?php  if( $index > 1 ){ ?>
                        <!--Process One Single Start-->
                        <div class="col-xl-4 col-lg-4">
                            <div class="process-one__single">
                                <div class="process-one__shape-1">   
                                </div>
                                <div class="process-one__count-box">
                                    <div class="process-one__count"></div>
                                </div>
                                <h4 class="process-one__title"><a href="<?php echo esc_attr($item['title_url']); ?>"><?php echo esc_html($item['title']); ?></a></h4>
                                <p class="process-one__text"><?php echo esc_html($item['desc']); ?></p>
                            </div>
                        </div>
                        <!--Process One Single End-->
                    <?php }else{ ?>
                        <!--Process One Single Start-->
                        <div class="col-xl-4 col-lg-4">
                            <div class="process-one__single">
                                <div class="process-one__shape-1">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/process-one-shape-1.png' ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                                <div class="process-one__count-box">
                                    <div class="process-one__count"></div>
                                </div>
                                <h4 class="process-one__title"><a href="<?php echo esc_attr($item['title_url']); ?>"><?php echo esc_html($item['title']); ?></a></h4>
                                <p class="process-one__text"><?php echo esc_html($item['desc']); ?></p>
                            </div>
                        </div>
                        <!--Process One Single End-->
                    <?php } ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!--About Three End -->
        <?php if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ): ?>
        <script>
            ;(function($){
                if ($(".odometer").length) {
                    var odo = $(".odometer");
                    odo.each(function () {
                    $(this).appear(function () {
                        var countNumber = $(this).attr("data-count");
                        $(this).html(countNumber);
                    });
                    });
                }
            })(jQuery)
        </script>
        <?php endif; ?>
        <?php elseif ($settings['_about_style'] == 'about-4') : ?>
        <!--About Three Start -->
        <section class="about-three">
            <div class="home-four-site-border"></div>
            <div class="home-four-site-border home-four-site-border-two"></div>
            <div class="home-four-site-border home-four-site-border-three"></div>
            <div class="home-four-site-border home-four-site-border-four"></div>
            <div class="home-four-site-border home-four-site-border-five"></div>
            <div class="home-four-site-border home-four-site-border-six"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-5">
                        <div class="about-three__left">
                            <div class="about-three__img wow fadeInLeft" data-wow-delay="<?php echo esc_attr($settings['about_four_animation']); ?>ms"
                                data-wow-duration="2500ms">
                                <img src="<?php echo esc_attr($settings['about_image_four']['url']); ?>" alt="<?php echo bloginfo('name'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">
                        <div class="about-three__right">
                            <h3 class="about-three__title"> <?php echo wp_kses_post($settings['about_four_title']); ?> </h3>
                            <p class="about-three__text"><?php echo wp_kses_post($settings['about_four_desc']); ?></p>
                            <ul class="about-three__points list-unstyled">
                                <?php foreach($settings['about_four_point'] as $point) : ?>
                                    <li>
                                        <div class="icon">
                                            <span>
                                                <?php \Elementor\Icons_Manager::render_icon( $point['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </span>
                                        </div>
                                        <h3><?php echo esc_html($point['text']); ?> </h3>
                                    </li>
                                <?php endforeach;?>

                            </ul>
                            <div class="about-three__btn-box">
                                <a href="<?php echo esc_attr($settings['about_four_link']['url']); ?>" class="button-style-1">
                                <?php echo esc_html($settings['about_four_btn']); ?>
                                    <span class="icon-right"></span> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--About Three End -->
        <?php
        endif;
    }
}

$widgets_manager->register(new ARC_About());
