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
class ARC_Services extends Widget_Base
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
        return 'arc-services';
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
        return __('Arc Services', 'arc-core');
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
            '_services',
            [
                'label' => esc_html__('Service Section', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_service_style',
            [
                'label' => esc_html__('Service Style', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'service-1',
                'options' => [
                    'service-1' => esc_html__('Service 1', 'arc-core'),
                    'service-2' => esc_html__('Service 2', 'arc-core'),
                    'service-3' => esc_html__('Service 3', 'arc-core'),
                    'service-4' => esc_html__('Service 4', 'arc-core'),
                ]
            ]
        );
        
        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Our Services', 'arc-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'arc-core')
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Our Best Services', 'arc-core'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
                'rows' => '4'
            ]
        );
        $this->add_control(
            'service_btn',
            [
                'label' => esc_html__('Button Name', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View All Services', 'arc-core'),
                'placeholder' => esc_html__('Type your button name here', 'arc-core'),
                'condition' => [
                    '_service_style' => 'service-3'
                ],
                'rows' => '4',
                
            ]
        );
        $this->add_control(
			'service_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
                'condition' => [
                    '_service_style' => 'service-3'
                ],
			]
		);
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_services_three_list',
            [
                'label' => esc_html__('Services List', 'arc-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_service_style'   => 'service-3', 
                ],
            ]
        );
        $this->add_control(
            'ly_three_services_list',
            [
                'label' => esc_html__('Services List', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'service_three',
                        'label' => esc_html__('Select A Service', 'arc-core'),
                        'type'  => \Elementor\Controls_Manager::SELECT2,
                        'options'   => $this->layout_three_services(),
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

        $this->service_repeater();


    }

    protected function layout_three_services(){
        $services = new \WP_Query(array(
            'post_type'     => 'services',
            'post_status'   => 'publish',
            'posts_per_page'    => -1
        ));

        $data = array();

        if($services->have_posts()){
            while($services->have_posts()){
                $services->the_post();
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
        <?php if ($settings['_service_style'] == 'service-1') : ?>
            <!--Services One Start -->
            <section class="services-one">
                <div class="container">
                    <div class="section-title text-center">
                        <span class="section-title__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                        <h2 class="section-title__title"><?php echo esc_html($settings['title']); ?></h2>
                    </div>
                    <?php if($settings['services_list']): ?>
                    <div class="row">
                        <?php foreach($settings['services_list'] as $item): 
                                $query = new WP_Query(array(
                                    'post_type'     => 'services',
                                    'post_status'   => 'publish',
                                    'posts_per_page'    => 1,
                                    'p'             => $item['service']
                                ));    
                        if($query->have_posts()):
                        while($query->have_posts()): $query->the_post();
                        ?>
                        <!--Services One Single Start -->
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" >
                            <div class="services-one__single">
                                <?php if(has_post_thumbnail()): ?>
                                <div class="services-one__img">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <?php endif; ?>
                                <div class="services-one__content">
                                    <div class="services-one__icon">
                                        <span><?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                    </div>
                                    <h3 class="services-one__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p class="services-one__text"><?php echo get_the_excerpt(); ?></p>
                                    <div class="services-one__btn-box">
                                        <a href="<?php the_permalink(); ?>" class="button-style-2"><?php esc_html_e('View More', 'arc-core'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Services One Single End -->
                        <?php endwhile; ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <!--Services One Start -->
        <?php elseif ($settings['_service_style'] == 'service-2') : ?>

        <?php elseif ($settings['_service_style'] == 'service-3') : ?>
            <!--Services Two Start -->
            <section id="service11" class="services-two dark-body">
                <div class="home-three-site-border"></div>
                <div class="home-three-site-border home-three-site-border-two"></div>
                <div class="home-three-site-border home-three-site-border-three"></div>
                <div class="home-three-site-border home-three-site-border-four"></div>
                <div class="home-three-site-border home-three-site-border-five"></div>
                <div class="home-three-site-border home-three-site-border-six"></div>
                <div class="container">
                    <div class="services-two__top">
                        <div class="services-two__left">
                            <div class="section-title-three text-left">
                                <span class="section-title-three__tagline"> <?php echo esc_html($settings['subtitle']); ?></span>
                                <h2 class="section-title-three__title"><?php echo esc_html($settings['title']); ?></h2>
                            </div>
                        </div>
                        <div class="services-two__btn-box">
                            <a href="<?php echo esc_url($settings['service_btn_link']['url']); ?>" class="button-style-1 btn-bg-white">
                            <?php echo esc_html($settings['service_btn']); ?>
                                <span class="icon-right"></span> 
                            </a>
                        </div>
                    </div>
                    <div class="services-two__bottom">
                    <?php if($settings['ly_three_services_list']): ?>
                        <div class="row">
                        <?php foreach($settings['ly_three_services_list'] as $index => $item): 
                                $query = new WP_Query(array(
                                    'post_type'     => 'services',
                                    'post_status'   => 'publish',
                                    'posts_per_page'    => 1,
                                    'p'             => $item['service_three']
                                ));    
                        if($query->have_posts()):
                        while($query->have_posts()): $query->the_post();
                        ?>
                          <?php if ($index % 2 == 0){ ?>
                            <!--Services Two Single Start-->
                            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" >
                                <div class="services-two__single">
                                    <div class="services-two__img-box">
                                       <?php if(has_post_thumbnail()): ?>
                                            <div class="services-two__img">
                                                <?php the_post_thumbnail(); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="services-two__content">
                                            <h3 class="services-two__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                            <p class="services-two__text"><?php echo get_the_excerpt(); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Services Two Single End-->
                            <?php }else{ ?>
                            <!--Services Two Single Start-->
                            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" >
                                <div class="services-two__single services-two__single-2">
                                    <div class="services-two__img-box">
                                      <?php if(has_post_thumbnail()): ?>
                                        <div class="services-two__img">
                                           <?php echo the_post_thumbnail(); ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="services-two__content">
                                            <h3 class="services-two__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <p class="services-two__text"><?php echo get_the_excerpt(); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Services Two Single End-->
                            <?php }?>
                           <?php
                            endwhile;
                            endif;
                            endforeach; ?>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </section>
            <!--Services Two End -->
        <?php elseif ($settings['_service_style'] == 'service-4') : ?>
        <!--Services Three Start-->
        <section class="services-three  ">
            <div class="home-four-site-border"></div>
            <div class="home-four-site-border home-four-site-border-two"></div>
            <div class="home-four-site-border home-four-site-border-three"></div>
            <div class="home-four-site-border home-four-site-border-four"></div>
            <div class="home-four-site-border home-four-site-border-five"></div>
            <div class="home-four-site-border home-four-site-border-six"></div>
            <div class="container">
                <div class="section-title-four text-center">
                    <span class="section-title-four__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title-four__title"><?php echo esc_html($settings['title']); ?></h2>
                </div>
                <?php if($settings['services_list']): ?>
                <div class="row">
                <?php foreach($settings['services_list'] as $item): 
                            $query = new WP_Query(array(
                                'post_type'     => 'services',
                                'post_status'   => 'publish',
                                'posts_per_page'    => 1,
                                'p'             => $item['service']
                            ));    
                        if($query->have_posts()):
                        while($query->have_posts()): $query->the_post();
                        ?>
                        <!--Services Three Single Start-->
                        <div class="col-xl-4 col-lg-4 wow fadeInUp">
                            <div class="services-three__single">
                                <div class="services-three__icon">
                                <span><?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                </div>
                                <div class="services-three__title-box">
                                    <div class="services-three__shape-1">
                                        <img src="<?php echo get_template_directory_uri() .'/assets/img/shape/services-three-shape-1.png' ?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                    <div class="services-three__shape-2">
                                    <img src="<?php echo get_template_directory_uri() .'/assets/img/shape/services-three-shape-2.png' ?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                    <h3 class="services-three__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </div>
                                <p class="services-three__text"><?php echo get_the_excerpt();?></p>
                                <div class="services-three__view-more">
                                    <a href="<?php the_permalink(); ?>"><?php _e('View More', 'arc-core');?><span class="icon-right-arrow-3"></span></a>
                                </div>
                            </div>
                        </div>
                        <!--Services Three Single End-->
                    <?php endwhile; endif;  endforeach;?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <!--Services Three End-->
        <?php endif;
    }
}

$widgets_manager->register(new ARC_Services());
