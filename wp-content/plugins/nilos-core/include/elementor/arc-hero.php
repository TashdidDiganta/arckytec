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
 * ARC Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Arc_Hero extends Widget_Base
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
        return 'arc-hero';
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
        return __('Arc Hero', 'arc-core');
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
        // Content 
        $this->start_controls_section(
            '_hero',
            [
                'label' => esc_html__('Section Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_hero_style',
            [
                'label' => esc_html__('Hero Style', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'hero-1',
                'options' => [
                    'hero-1' => esc_html__('Hero 1', 'arc-core'),
                    'hero-2' => esc_html__('Hero 2', 'arc-core'),
                    'hero-3' => esc_html__('Hero 3', 'arc-core'),
                    'hero-4' => esc_html__('Hero 4', 'arc-core'),
                ]
            ]
        );
        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Inspiring Innovation Ahead', 'arc-core'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
                'condition' => [
                    '_hero_style'   => ['hero-1']
                ]
            ]
        );
        $this->add_control(
            'widget_title',
            [
                'label' => esc_html__('Title', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => wp_kses_post('We Will Make <br> Your Dream True'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
                'rows' => 4,
                'condition' => [
                    '_hero_style'   => 'hero-1'
                ]
            ]
        );
        $this->add_control(
            'widget_desc',
            [
                'label' => esc_html__('Description', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => wp_kses_post('Nullam interdum orci nibh ut pretium nisl maximus vitae integer tempus turpis quis <br> sapien pulvinar sed semper enim ltricies duis pellentesque neque vel nisl faucibus <br> eget commodo massa dictum pellentesque et odio.', 'arc-core'),
                'placeholder' => esc_html__('Type your description here', 'arc-core'),
                'condition' => [
                    '_hero_style'   => 'hero-1'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_hero_social',
            [
                'label' => esc_html__('Social Media', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_hero_style'   => ['hero-2', 'hero-4', 'hero-3']
                ]
            ]
        );
        $this->add_control(
			'hero_2_socials',
			[
				'label' => esc_html__( 'Social Media List', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [

                    [
                        'name' => 'social_name',
                        'label' => esc_html__( 'Social Name', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Facebook', 'arc-core' ),
                        'placeholder' => esc_html__( 'Social Media Name', 'arc-core' ),
                    ],
                    [
                        'name' => 'social_url',
                        'label' => esc_html__( 'Social Url', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'options' => [ 'url', 'is_external', 'nofollow' ],
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                            // 'custom_attributes' => '',
                        ],
                        'label_block' => true,
                    ]


                ],
                'default' => [
					[
						'social_name' => esc_html__( 'Facebook', 'arc-core' ),
					],
				],
				'title_field' => '{{{ social_name }}}',
                'condition' => [
                    '_hero_style'   => ['hero-2','hero-3']
                ]
			]
		);
        $this->add_control(
			'hero_4_social',
			[
				'label' => esc_html__( 'Add Social Media', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
                    [
                        'name' => 'social_media',
                        'label' => esc_html__( 'Socials', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'facebook',
                        'options' => [
                            'facebook'  => esc_html__( 'Facebook', 'arc-core' ),
                            'twitter' => esc_html__( 'Twitter', 'arc-core' ),
                            'instagram' => esc_html__( 'Instagram', 'arc-core' ),
                            'linkedin' => esc_html__( 'Linkdin In', 'arc-core' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .your-class' => 'border-style: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'social_link',
                        'label' => esc_html__( 'Link', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'options' => [ 'url', 'is_external', 'nofollow' ],
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                            // 'custom_attributes' => '',
                        ],
                        'label_block' => true,
                    ]
                ],
                'default'   => [
                    [
                        'hero_2_title'  => esc_html__('Creative Architecture', 'arc-core'),

                    ],
                ],
                'condition' => [
                    '_hero_style'   => 'hero-4'
                ]
			]
		);
        $this->end_controls_section();


        $this->start_controls_section(
            '_hero_content',
            [
                'label' => esc_html__('Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_hero_style'   => ['hero-2', 'hero-3', 'hero-4']
                ]
            ]
        );
        $this->add_control(
			'hero_2_slider',
			[
				'label' => esc_html__( 'Hero Slider Item', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
                    [
                        'name' => 'hero_2_bg',
                        'label' => esc_html__( 'Hero bg', 'textdomain' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'hero_2_title',
                        'label' => esc_html__( 'Hero title', 'arccore' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__( 'Creative Architecture', 'arc-core' ),
                        'rows' => 4,
                        'placeholder' => esc_html__( 'Type your title', 'arc-core' ),
                    ],
                    [
                        'name' => 'hero_2_desc',
                        'label' => esc_html__( 'Hero descprition', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__( '', 'arc-core' ),
                        'placeholder' => esc_html__( 'Type your descprition', 'arc-core' ),
                    ],
                    [
                        'name' => 'hero_2_button',
                        'label' => esc_html__( 'Button name', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Explore More', 'arc-core' ),
                        'placeholder' => esc_html__( 'Button name', 'arc-core' ),
                    ],
                    [
                        'name' => 'cta_text',
                        'label' => esc_html__( 'Cta Text', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Need Help', 'arc-core' ),
                        'placeholder' => esc_html__( 'Type cta', 'arc-core' ),
                    ],
                    [
                        'name' => 'cta_number',
                        'label' => esc_html__( 'Cta Number', 'arc-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( '+9(406)555-0120', 'arc-core' ),
                        'placeholder' => esc_html__( 'Type Cta Number', 'arc-core' ),
                    ],

                ],
                'default'   => [
                    [
                        'hero_2_bg' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src()
                        ],
                        'hero_2_title'  => esc_html__('Creative Architecture', 'textdomain'),
                        'hero_2_desc'   => wp_kses_post('Lorem ipsum dolor sit amet consectetur adipiscing elit proin sit amet neque ac ipsum <br> imperdiet mollis pellentesque mi mauris at auctor enim imperdiet eget.'),
                        'hero_2_button' => esc_html__( 'Explore More', 'nilos-core' )
                    ],
                    [
                        'hero_2_bg' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src()
                        ],
                        'hero_2_title'  => esc_html__('Creative Architecture', 'textdomain'),
                        'hero_2_desc'   => wp_kses_post('Lorem ipsum dolor sit amet consectetur adipiscing elit proin sit amet neque ac ipsum <br> imperdiet mollis pellentesque mi mauris at auctor enim imperdiet eget.'),
                        'hero_2_button' => esc_html__( 'Explore More', 'nilos-core' )
                    ]
                ],
                'condition' => [
                    '_hero_style'   => 'hero-2'
                ]
			]
		);
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => wp_kses_post( 'INTERIOR <span>DESIGN</span>'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
                'rows' => 4,
                'condition' => [
                    '_hero_style'   => ['hero-3', 'hero-4']
                ]
            ]
        );
        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => wp_kses_post('Lorem ipsum dolor sit amet consectetur adipiscing elit proin sit amet neque ac ipsum <br> imperdiet mollis pellentesque mi mauris at auctor enim imperdiet eget sed ipsum.', 'arc-core'),
                'placeholder' => esc_html__('Type your description', 'arc-core'),
                'condition' => [
                    '_hero_style'   => ['hero-3', 'hero-4']
                ]
            ]
        );
        $this->add_control(
            'bg_text',
            [
                'label' => esc_html__('BG Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Modern Design', 'arc-core'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
                'condition' => [
                    '_hero_style'   => 'hero-4'
                ]
            ]
        );
        $this->add_control(
			'hero_img',
			[
				'label' => esc_html__( 'Hero Image', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    '_hero_style'   => 'hero-4'
                ]
			]
		);
        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('  Get In Touch ', 'arc-core'),
                'placeholder' => esc_html__('Type your button name here', 'arc-core'),
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );
        $this->add_control(
            'hero_3_btn_link',
            [
                'label' => esc_html__('Button Link', 'arc-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );

        $this->add_control(
            'scroll_text',
            [
                'label' => esc_html__('Scroll Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Scroll', 'arc-core'),
                'placeholder' => esc_html__('Type your button name here', 'arc-core'),
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );
        $this->add_control(
            'scroll_link',
            [
                'label' => esc_html__('Scroll Btn ID', 'arc-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_hero_video',
            [
                'label' => esc_html__('Section Video', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );

        $this->add_control(
			'video_link',
			[
				'label' => esc_html__( 'Choose Video File', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => [ 'video' ],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            '_hero_bg',
            [
                'label' => esc_html__('Section Background and Shapes', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_hero_style'   => 'hero-1'
                ]
            ]
        );

        $this->add_control(
			'hero_bg',
			[
				'label' => esc_html__( 'Hero bg Image', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    '_hero_style'   => 'hero-1'
                ]
			]
		);
        $this->add_control(
			'hero_shape_1',
			[
				'label' => esc_html__( 'Hero Shape ', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    '_hero_style'   => 'hero-1'
                ]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            '_hero_buttons',
            [
                'label' => esc_html__('Section Buttons', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_hero_style'   => ['hero-1', 'hero-4']
                ]
            ]
        );
        $this->add_control(
            'hero_1_bottom_1',
            [
                'label' => esc_html__('Botton Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('About us', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'condition' => [
                    '_hero_style'   => ['hero-1','hero-4']
                ]
            ]
        );
        $this->add_control(
            'btn_link_1',
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
                'condition' => [
                    '_hero_style'   => ['hero-1','hero-4']
                ]
            ]
        );
        $this->add_control(
            'hero_1_bottom_2',
            [
                'label' => esc_html__('Bottom Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Contact us', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'condition' => [
                    '_hero_style'   => 'hero-1'
                ]
            ]
        );
        $this->add_control(
            'btn_link_2',
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
                'condition' => [
                    '_hero_style'   => 'hero-1'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_hero_cta',
            [
                'label' => esc_html__('Section CTA', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_hero_style'   => 'hero-1'
                ]
            ]
        );
        $this->add_control(
            'circle_text',
            [
                'label' => esc_html__('Circle Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Get In Touch - Get In Touch -', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'rows' => 3,
                'condition' => [
                    '_hero_style'   => 'hero-1'
                ]
            ]
        );
        $this->add_control(
            'circle_link',
            [
                'label' => esc_html__('Circle Link', 'arc-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    '_hero_style'   => 'hero-1'
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
        <?php if ($settings['_hero_style'] == 'hero-1') : ?>
        <!-- Banner One Start -->
            <section class="banner-one">
                <div class="banner-one__inner">
                    <div class="banner-one__img">
                        <img src="<?php echo esc_url($settings['hero_bg']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                    </div>
                    <div class="banner-one__shape-1 float-bob-y"></div>
                    <div class="banner-one__shape-2 float-bob-y">
                        <img src="<?php echo esc_url($settings['hero_shape_1']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                    </div>
                    <div class="banner-one__shape-3 float-bob-x">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/banner-one-shape-3.png' ?>" alt="<?php bloginfo('name'); ?>">
                    </div>
                    <div class="banner-one__shape-4 img-bounce">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/banner-one-shape-4.png' ?>" alt="<?php bloginfo('name'); ?>">
                    </div>
                    <div class="container">
                        <div class="banner-one__content">
                            <p class="banner-one__sub-title"> <?php echo wp_kses_post($settings['subtitle']); ?></p>
                            <h2 class="banner-one__title">  <?php echo wp_kses_post($settings['widget_title']); ?></h2>
                            <p class="banner-one__text">  <?php echo wp_kses_post($settings['widget_desc']); ?></p>
                            <div class="btn-box">
                                <a href="<?php echo esc_url($settings['btn_link_1']['url']); ?>" class="button-style-1">
                                     <?php echo wp_kses_post($settings['hero_1_bottom_1']); ?>
                                    <span class="icon-right"></span> 
                                </a>
                                <a href="<?php echo esc_url($settings['btn_link_2']['url']); ?>" class="button-style-2">
                                    <?php echo wp_kses_post($settings['hero_1_bottom_2']); ?>
                                    <span class="icon-right"></span> 
                                </a>
                            </div>
                            <div class="banner-one__curved-circle">
                                <div class="curved-circle">
                                    <?php echo  wp_kses_post($settings['circle_text']); ?>
                                </div><!-- /.curved-circle -->
                                <div class="banner-one__video-link">
                                    <a href="<?php echo esc_url($settings['circle_link']['url']); ?>">
                                        <div class="banner-one__video-icon">
                                            <span class="icon-up-right-arrow"></span>
                                        </div>
                                    </a>
                                </div>
                            </div><!-- /.curved-circle -->
                        </div>
                    </div>
                </div>
            </section>
        <!--Banner One End -->

        <?php elseif ($settings['_hero_style'] == 'hero-2') : ?>
        <!--Main Slider Start-->
            <section class="main-slider-two">
                <div class="main-slider-two__social">
                    <?php if($settings['hero_2_socials']) : ?>
                        <?php foreach($settings['hero_2_socials'] as $hero_2_social ) : ?>
                          <a href="<?php $hero_2_social['social_url']['url']; ?>"><?php echo $hero_2_social['social_name']; ?></a>
                        <?php endforeach; ?>
                    <?php endif;?>
                </div>
                <div class="swiper-container h2-banner-slider">
                    <div class="swiper-wrapper">
                    <?php if($settings['hero_2_slider']): ?>
                        <?php foreach($settings['hero_2_slider'] as $hero_content) : ?>
                            <div class="swiper-slide">
                                <div class="main-slider-two__bg" style="background-image: url(<?php echo esc_url($hero_content['hero_2_bg']['url']); ?>);">
                                </div><!-- /.slider-Two__bg -->
                                    <div class="container">
                                        <div class="main-slider-two__content">
                                            <h2 class="main-slider-two__title"> <?php echo $hero_content['hero_2_title']; ?></h2>
                                            <p class="main-slider-two__text"> <?php echo $hero_content['hero_2_desc'];?> </p>
                                            <div class="main-slider-two__btn-and-call">
                                                <a href="about.html" class="button-style-1 btn-bg-white">
                                                <?php echo $hero_content['hero_2_button'];?>  
                                                    <span class="icon-right"></span> 
                                                </a>
                                                <div class="main-slider-two__call">
                                                    <div class="main-slider-two__call-icon">
                                                        <span class="icon-phone1"></span>
                                                    </div>
                                                    <div class="main-slider-two__call-number">
                                                        <p><?php echo $hero_content['cta_text'];?></p>
                                                        <h5><a href="<?php echo $hero_content['cta_number'];?>"><?php echo $hero_content['cta_number'];?></a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
            </section>
        <!--Main Slider End-->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                new Swiper(".h2-banner-slider", {
                    slidesPerView: 1,
                    effect: 'fade',
                    loop: true,
                    pagination: {
                        el: "#main-slider-pagination",
                        type: "bullets",
                        clickable: true
                    },
                    navigation: {
                        nextEl: "#main-slider__swiper-button-next",
                        prevEl: "#main-slider__swiper-button-prev"
                    },
                    autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    }
                });
                $(".h2-banner-slider").hover(function() {
                (this).swiper.autoplay.stop();
                }, function() {
                    (this).swiper.autoplay.start();
                });
            })(jQuery);
        </script>
        <?php endif; ?>
        <?php elseif ($settings['_hero_style'] == 'hero-3') : ?>
        <!-- Start Banner Three -->
        <div class="banner-three full-height dark-body">
            <div class="banner-three__social">
                <?php if($settings['hero_2_socials']) : ?>
                    <?php foreach($settings['hero_2_socials'] as $hero_2_social ) : ?>
                        <a href="<?php $hero_2_social['social_url']['url']; ?>"><?php echo $hero_2_social['social_name']; ?></a>
                    <?php endforeach; ?>
                <?php endif;?>
            </div>
            <div class="banner-three__border-box"></div>
            <div class="main-slider-three__shape-1"
                style="background-image: url(<?php echo get_parent_theme_file_uri(); ?>/assets/img/shapes/main-slider-three-shape-1.png);"></div>
            <div class="video-banner-one">
                <div class="media-container" data-top-bottom="transform: translateY(300px);"
                    data-bottom-top="transform: translateY(-300px);">
                    <div class="video-holder-wrap fs-wrapper">
                        <div class="video-container">
                            <video autoplay playsinline loop muted class="bgvid">
                                <source src="<?php echo get_parent_theme_file_uri(); ?>/assets/video/1.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
                <div class="overlay"></div>
                <div class="video-banner-one__content">
                    <div class="video-banner-one__content-inner">
                        <h2><?php echo wp_kses_post($settings['title']); ?></h2>
                        <p><?php echo wp_kses_post($settings['desc']); ?></p>
                        <div class="banner-three__btn-box">
                            <a href="<?php echo $settings['hero_3_btn_link']['url']; ?>" class="button-style-1">
                                <?php echo $settings['btn_text'] ?>
                                <span class="icon-right"></span> 
                            </a>
                        </div>
                    </div>
                </div>
                <a href="<?php echo  esc_url($settings['scroll_link']['url'], 'arc-core'); ?> #project" class="hero-scroll-link custom-scroll-link"
                    data-top-bottom="transform: translateY(50px);" data-bottom-top="transform: translateY(-50px);">
                    <p><?php echo esc_html( $settings['scroll_text'] , 'arc-hero') ?></p>
                    <i class="icon-right-arrow-3"></i>
                </a>
            </div>
        </div>
        <!-- End Banner Three -->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                $('.full-height').css("height", $(window).height());
            })(jQuery);
        </script>
        <?php endif; ?>
        <?php elseif ($settings['_hero_style'] == 'hero-4') : ?>
        <!-- Banner Four Start -->
        <section class="banner-four">
            <div class="banner-four__social">
                <?php if($settings['hero_4_social']) : ?>
                    <?php foreach($settings['hero_4_social'] as $icon ) : ?>
                        <a href="<?php echo $icon['social_link']['url']; ?>"><span class="icon-<?php echo $icon['social_media']; ?>"></span></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="banner-four__inner">
                <div class="banner-four__shape-1 float-bob-y">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/banner-four-shape-1.png' ?>" alt="<?php bloginfo('name'); ?>">
                </div>
                <div class="banner-four__big-text img-bounce"><?php echo $settings['bg_text']; ?></div>
                <div class="banner-four__img float-bob-y">
                    <img src="<?php echo esc_url($settings['hero_img']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                </div>
                <div class="container">
                    <div class="banner-four__content">
                        <h2 class="banner-four__title"><?php echo wp_kses_post($settings['title']); ?> </h2>
                        <p class="banner-four__text"><?php echo wp_kses_post($settings['desc']); ?></p>
                        <div class="banner-four__btn-box">
                            <a href="<?php echo $settings['btn_link_1']; ?>" class="button-style-1">
                               <?php echo $settings['hero_1_bottom_1']; ?>
                                <span class="icon-right"></span> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Banner Four Start -->
        <?php
        endif;
    }
}

$widgets_manager->register(new Arc_Hero());
