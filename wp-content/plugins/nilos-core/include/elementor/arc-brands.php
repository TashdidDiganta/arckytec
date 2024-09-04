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
class Arc_Brands extends Widget_Base
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
        return 'arc-brands';
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
        return __('Arc Brands', 'arc-core');
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
            '_arc_gallery',
            [
                'label' => esc_html__('Arc Gallery', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_brand_style',
            [
                'label' => esc_html__('Brand Style', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'brand-1',
                'options' => [
                    'brand-1' => esc_html__('Brand 1', 'arc-core'),
                    'brand-2' => esc_html__('Brand 2', 'arc-core'),
                ]
            ]
        );

        $this->add_control(
            '_gallery',
            [
                'label' => esc_html__('Image', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image',
                        'label' => esc_html__('Choose Default Image', 'arc-core'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default'   => [
                            'url'   => \Elementor\Utils::get_placeholder_image_src()
                        ]
                    ],
                    [
                        'name' => 'image_2',
                        'label' => esc_html__('Choose Hover Image', 'arc-core'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default'   => [
                            'url'   => \Elementor\Utils::get_placeholder_image_src()
                        ]
                    ],
                ],
                'default' => [
					[
						'image' => esc_html__( 'Title #1', 'arc-core' ),
					],
				],
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
    <?php if ($settings['_brand_style'] == 'brand-1') : ?>
        <!--Brand Two Start-->
        <section class="brand-two">
            <div class="brand-one__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="brand-one__inner">
                                <div class="brand-slider-1 swiper-container">
                                    <div class="swiper-wrapper">
                                    <?php if($settings['_gallery']): ?>
                                        <?php foreach($settings['_gallery'] as $item): ?>
                                        <div class="swiper-slide">
                                            <div class="swiper-slide-img">
                                               <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                            </div>
                                            <div class="swiper-slide-hover-img">
                                               <img src="<?php echo esc_url($item['image_2']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                            </div>
                                        </div><!-- /.swiper-slide -->
                                         <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Brand Two End-->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                var swiper4 = new Swiper(".brand-slider-1", {
                spaceBetween: 100,
                slidesPerView: 5,
                autoplay: {
                  delay: 5000,
                },
                breakpoints: {
                  0: {
                    slidesPerView: 2,
                  },
                  375: {
                    slidesPerView: 2,
                  },
                  575: {
                    slidesPerView: 3,
                  },
                  767: {
                    slidesPerView: 4,
                  },
                  991: {
                    slidesPerView: 5,
                  },
                  1199: {
                    slidesPerView: 5,
                  }
                },
              });
            })(jQuery);
        </script>
        <?php endif; ?>
    <?php elseif($settings['_brand_style'] == 'brand-2') : ?>
        <!--Brand One Start-->
        <section class="brand-one dark-body">
             <div class="home-three-site-border"></div>
            <div class="home-three-site-border home-three-site-border-two"></div>
            <div class="home-three-site-border home-three-site-border-three"></div>
            <div class="home-three-site-border home-three-site-border-four"></div>
            <div class="home-three-site-border home-three-site-border-five"></div>
            <div class="home-three-site-border home-three-site-border-six"></div>
            <div class="brand-one__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="brand-one__inner">
                                <div class="brand-slider-1 swiper-container">
                                    <div class="swiper-wrapper">

                                    <?php if($settings['_gallery']): ?>
                                        <?php foreach($settings['_gallery'] as $item): ?>
                                        <div class="swiper-slide">
                                            <div class="swiper-slide-img">
                                               <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                            </div>
                                            <div class="swiper-slide-hover-img">
                                               <img src="<?php echo esc_url($item['image_2']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                            </div>
                                        </div><!-- /.swiper-slide -->
                                         <?php endforeach; ?>
                                        <?php endif; ?>
                                      
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Brand One End-->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                var swiper4 = new Swiper(".brand-slider-1", {
                spaceBetween: 100,
                slidesPerView: 5,
                autoplay: {
                  delay: 5000,
                },
                breakpoints: {
                  0: {
                    slidesPerView: 2,
                  },
                  375: {
                    slidesPerView: 2,
                  },
                  575: {
                    slidesPerView: 3,
                  },
                  767: {
                    slidesPerView: 4,
                  },
                  991: {
                    slidesPerView: 5,
                  },
                  1199: {
                    slidesPerView: 5,
                  }
                },
              });
            })(jQuery);
        </script>

    <?php endif; endif; ?>
    <?php
    }
}

$widgets_manager->register(new Arc_Brands());
