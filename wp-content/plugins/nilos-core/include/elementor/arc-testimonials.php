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
class Arc_Testimonial extends Widget_Base
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
        return 'arc-testimonial';
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
        return __('Arc Testimonial', 'arc-core');
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
            '_arc_accordion',
            [
                'label' => esc_html__('Testimonial ', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_testimonial_style',
            [
                'label' => esc_html__('Testimonial Style', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'testimonial-1',
                'options' => [
                    'testimonial-1' => esc_html__('Testimonial 1', 'arc-core'),
                    'testimonial-2' => esc_html__('Testimonial 2', 'arc-core'),
                    'testimonial-3' => esc_html__('Testimonial 3', 'arc-core'),
                    'testimonial-4' => esc_html__('Testimonial 4', 'arc-core'),
                ]
            ]
        );
        $this->add_control(
			'subtitle_bg',
			[
				'label' => esc_html__( 'Subtitle BG', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Testimonals', 'arc-core' ),
				'placeholder' => esc_html__( 'Type your subtitle bg here', 'arc-core' ),
                'condition' => [
                    '_testimonial_style'   => 'testimonial-3'
                ]
			]
		);
        $this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Testimonals', 'arc-core' ),
				'placeholder' => esc_html__( 'Type your subtitle here', 'arc-core' ),
			]
		);
        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => wp_kses_post( 'What Our Clients Say', 'arc-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'arc-core' ),
                'rows' => 4
			]
		);
        $this->add_control(
			'bg_img',
            [
                'label' => esc_html__('BG Image', 'arc-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'   => \Elementor\Utils::get_placeholder_image_src()
                ],
                'condition' => [
                    '_testimonial_style'  => ['testimonial-1']
                ]
            ]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            '_testimonial',
            [
                'label' => esc_html__('Testimonials', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_testimonials',
            [
                'label' => esc_html__('Testimonial List', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'author_image',
                        'label' => esc_html__(' Image', 'arc-core'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default'   => [
                            'url'   => \Elementor\Utils::get_placeholder_image_src()
                        ]
                    ],
                    [
                        'name' => 'author_name',
                        'label' => esc_html__(' Name', 'arc-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__('Francisco', 'arc-core')
                    ],
                    [
                        'name' => 'author_designation',
                        'label' => esc_html__(' Designation', 'arc-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__('Web Designer', 'arc-core')
                    ],
                    [
                        'name' => 'text',
                        'label' => esc_html__('Description', 'arc-core'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default'   => 'Lorem ipsum dolor sit amet consectetur adipiscing elit maecenas quis the is cursus lorem aenean aliquet maximus nisi isut porttitor lectusscelerisque id nunc sed mi non tortor tincidunt rhoncus duis non felis.'
                    ],
                    [
                        'name' => 'rating',
                        'label' => esc_html__('Rating', 'arc-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__('4', 'arc-core')
                    ],

                ],
                'default' => [
                    [
						'author_name' => esc_html__( 'Francisco', 'arc-core' )
					],
                ],
                'title_field' => '{{{ author_name }}}',
                'condition' => [
                    '_testimonial_style'  => ['testimonial-1','testimonial-2', 'testimonial-3', 'testimonial-4']
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
        $settings = $this->get_settings_for_display();
?>
        <?php if ($settings['_testimonial_style'] == 'testimonial-1') : ?>
        <section class="testimonial-one">
            <div class="testimonial-one__bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%"
                style="background-image: url(<?php echo esc_attr($settings['bg_img']['url']); ?>);"></div>
            <div class="container">
                <div class="section-title text-left">
                    <span class="section-title__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title__title"><?php echo wp_kses_post($settings['title']); ?></h2>
                </div>
                <div class="testimonial-slider-1 swiper-container testimonial-one__carousel">
                    <div class="swiper-wrapper">
                        <?php foreach($settings['_testimonials'] as $item): ?>
                            <!--Testimonial One Single Start -->
                            <div class="swiper-slide">
                                <div class="testimonial-one__single">
                                    <div class="testimonial-one__shape-1">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/testimonial-one-shape-1.png'?>" alt='<?php bloginfo('name'); ?>'>
                                    </div>
                                    <div class="testimonial-one__client-info">
                                        <div class="testimonial-one__client-img">
                                        <img src="<?php echo esc_url($item['author_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                        </div>
                                        <div class="testimonial-one__client-content">
                                            <h4 class="testimonial-one__client-name"><?php echo esc_html($item['author_name']); ?></h4>
                                            <p class="testimonial-one__client-sub-title"><?php echo esc_html($item['author_designation']); ?></p>
                                            <div class="testimonial-one__client-rating">
                                                <?php for($i = 1; $i <= 5; $i++) { ?>
                                                   <?php $icon = ($i <= $item['rating'])? 'icon-star-1' : 'icon-star-1 clr-gray' ?>
                                                    <i class="<?php echo $icon ?>"></i>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="testimonial-one__text"><?php echo wp_kses_post($item['text']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-pagination" id="testimonial-one-pagination"></div>
            </div>
        </section>
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";

              var swiper1 = new Swiper(".testimonial-slider-1", {
                spaceBetween: 30,
                slidesPerView: 2,
                loop: true,
                pagination: {
                    el: "#testimonial-one-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#testimonial-one__swiper-button-next",
                    prevEl: "#testimonial-one__swiper-button-prev"
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

            })(jQuery);
        </script>
        <?php endif; ?>
        <?php elseif ($settings['_testimonial_style'] == 'testimonial-2') : ?>
        <!--Testimonial Two Start-->
        <section class="testimonial-two">
            <div class="testimonial-two__shape-1 float-bob-x">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/testimonial-two-shape-1.png' ?>" alt="<?php bloginfo('name'); ?>">
            </div>
            <div class="testimonial-two__shape-2 img-bounce">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/testimonial-two-shape-2.png' ?>" alt="<?php bloginfo('name'); ?>">
            </div>
            <div class="testimonial-two__shape-3 float-bob-y">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/testimonial-two-shape-3.png' ?>" alt="<?php bloginfo('name'); ?>">
            </div>
            <div class="container">
                <div class="section-title-two text-left">
                    <span class="section-title-two__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title-two__title"><?php echo wp_kses_post($settings['title']); ?></h2>
                </div>
                <div class="testimonial-slider-2 testimonial-two__carousel swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach($settings['_testimonials'] as $item): ?>
                        <!--Testimonial Two Single Start-->
                        <div class="swiper-slide">
                            <div class="testimonial-two__single">
                                <div class="testimonial-two__client-info">
                                    <div class="testimonial-two__client-img">
                                        <img src="<?php echo esc_url($item['author_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                    <div class="testimonial-two__client-content">
                                        <h4 class="testimonial-two__client-name"><?php echo esc_html($item['author_name']); ?></h4>
                                        <p class="testimonial-two__client-sub-title"><?php echo esc_html($item['author_designation']); ?></p>
                                        <div class="testimonial-two__rating">
                                            <?php for($i = 1; $i <= 5; $i++) { ?>
                                                   <?php $icon = ($i <= $item['rating'])? 'icon-star-1' : 'icon-star-1 clr-gray' ?>
                                                   <span class="<?php echo $icon ?>"></span>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <p class="testimonial-two__text"><?php echo wp_kses_post($item['text']); ?></p>
                            </div>
                        </div>
                        <!--Testimonial Two Single End-->
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-pagination" id="testimonial-two-pagination"></div>
                <!-- If we need navigation buttons -->
                <div class="testimonial-two__nav">
                    <div class="swiper-button-prev" id="testimonial-two__swiper-button-next">
                        <i class="icon-left-arrow-1"></i>
                    </div>
                    <div class="swiper-button-next" id="testimonial-two__swiper-button-prev">
                        <i class="icon-right-arrow-1"></i>
                    </div>
                </div>
            </div>
        </section>
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";

                var swiper4 = new Swiper(".testimonial-slider-2", {
                spaceBetween: 30,
                slidesPerView: 2,
                loop: true,
                pagination: {
                    el: "#testimonial-two-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#testimonial-two__swiper-button-next",
                    prevEl: "#testimonial-two__swiper-button-prev"
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
                    slidesPerView: 3,
                  }
                },
              });

            })(jQuery);
        </script>
        <?php endif; ?>
        <!--Testimonial Two End-->
        <?php elseif ($settings['_testimonial_style'] == 'testimonial-3') : ?>
        <!--Testimonial Three Start-->
        <section class="testimonial-three dark-body">
        <div class="home-three-site-border"></div>
            <div class="home-three-site-border home-three-site-border-two"></div>
            <div class="home-three-site-border home-three-site-border-three"></div>
            <div class="home-three-site-border home-three-site-border-four"></div>
            <div class="home-three-site-border home-three-site-border-five"></div>
            <div class="home-three-site-border home-three-site-border-six"></div>
            <p class="section__section-text"><?php echo esc_html($settings['subtitle_bg']); ?></p>
            <div class="container">
                <div class="section-title-three text-center">
                    <span class="section-title-three__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title-three__title"><?php echo esc_html($settings['title']); ?></h2>
                </div>
                <div class="testimonial-three__bottom">
                    <div class="testimonial-slider-3 testimonial-three__carousel swiper-container">
                        <div class="swiper-wrapper">
                        <?php foreach($settings['_testimonials'] as $item): ?>
                            <!--Testimonial Three Single Start-->
                            <div class="swiper-slide">
                                <div class="testimonial-three__single">
                                    <div class="testimonial-three__img">
                                       <img src="<?php echo esc_url($item['author_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                    <h4 class="testimonial-three__client-name">Micheal Robert</h4>
                                    <p class="testimonial-three__sub-title">CEO, FigTheme</p>
                                    <div class="testimonial-three__ratting">
                                      <?php for($i = 1; $i <= 5; $i++) { ?>
                                            <?php $icon = ($i <= $item['rating'])? 'icon-star-1' : 'icon-star-1 clr-gray' ?>
                                            <span class="<?php echo $icon ?>"></span>
                                       <?php }?>
                                    </div>
                                    <p class="testimonial-three__text"><?php echo wp_kses_post($item['text']); ?></p>
                                </div>
                            </div>
                            <!--Testimonial Three Single End-->
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="swiper-pagination" id="testimonial-three-pagination"></div>
                    <!-- If we need navigation buttons -->
                    <div class="testimonial-three__nav">
                        <div class="swiper-button-prev" id="testimonial-three__swiper-button-next">
                            <i class="icon-right-arrow-2"></i>
                        </div>
                        <div class="swiper-button-next" id="testimonial-three__swiper-button-prev">
                            <i class="icon-right-arrow-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";

                var swiper4 = new Swiper(".testimonial-slider-3", {
                spaceBetween: 30,
                slidesPerView: 2,
                loop: true,
                pagination: {
                    el: "#testimonial-three-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#testimonial-three__swiper-button-next",
                    prevEl: "#testimonial-three__swiper-button-prev"
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
        <!--Testimonial Three End-->
        <?php elseif ($settings['_testimonial_style'] == 'testimonial-4') : ?>
        <!--Testimonial Four Start -->
        <section class="testimonial-four">
            <div class="testimonial-four__shape-3 img-bounce">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/testimonial-four-shape-3.png' ?>" alt="<?php bloginfo('name'); ?>">
            </div>
            <div class="testimonial-four__shape-4 float-bob-y">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/testimonial-four-shape-4.png' ?>" alt="<?php bloginfo('name'); ?>">
            </div>
            <div class="container">
                <div class="section-title-four text-center">
                    <span class="section-title-four__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title-four__title"><?php echo esc_html($settings['title']); ?></h2>
                </div>
                <div class="testimonial-slider-4 testimonial-four__carousel swiper-container">
                    <div class="swiper-wrapper">
                    <?php foreach($settings['_testimonials'] as $item): ?>
                        <!--Testimonial Four Single Start -->
                        <div class="swiper-slide">
                            <div class="testimonial-four__single">
                                <div class="testimonial-four__client-img">
                                   <img src="<?php echo esc_url($item['author_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                                <div class="testimonial-four__single-inner">
                                    <div class="testimonial-four__shape-1">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/testimonial-four-shape-1.png'?>" alt='<?php bloginfo('name'); ?>'>
                                    </div>
                                    <div class="testimonial-four__shape-2">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/testimonial-four-shape-2.png'?>" alt='<?php bloginfo('name'); ?>'>
                                    </div>
                                    <div class="testimonial-four__client-info">
                                        <h4 class="testimonial-four__client-name"><?php echo esc_html($item['author_name']); ?></h4>
                                        <p class="testimonial-four__client-sub-title"><?php echo esc_html($item['author_designation']); ?></p>
                                        <div class="testimonial-four__client-rating">
                                          <?php for($i = 1; $i <= 5; $i++) { ?>
                                                   <?php $icon = ($i <= $item['rating'])? 'icon-star-1' : 'icon-star-1 clr-gray' ?>
                                                    <i class="<?php echo $icon ?>"></i>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <p class="testimonial-four__text"><?php echo wp_kses_post($item['text']); ?></p>
                                </div>
                            </div>
                        </div>
                        <!--Testimonial Four Single End -->
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-pagination" id="testimonial-four-pagination"></div>
            </div>
        </section>
        <!--Testimonial Four End -->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                var swiper4 = new Swiper(".testimonial-slider-4", {
                spaceBetween: 30,
                slidesPerView: 2,
                loop: true,
                pagination: {
                    el: "#testimonial-four-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#testimonial-four__swiper-button-next",
                    prevEl: "#testimonial-four__swiper-button-prev"
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

            })(jQuery);
        </script>
     <?php endif; endif;
    }
}

$widgets_manager->register(new Arc_Testimonial());
