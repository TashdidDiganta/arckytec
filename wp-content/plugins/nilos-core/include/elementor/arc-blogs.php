<?php

namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use NilosCore\Elementor\Controls\Group_Control_NILOSBGGradient;
use NilosCore\Elementor\Controls\Group_Control_NILOSGradient;
use WP_Query;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class ARC_blogs extends Widget_Base
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
        return 'blogs';
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
        return __('Arc Blogs', 'arc-core');
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
            '_blogs',
            [
                'label' => esc_html__('Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_blogs_style',
            [
                'label' => esc_html__('Blogs Style', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'blog-1',
                'options' => [
                    'blog-1' => esc_html__('Blog 1', 'arc-core'),
                    'blog-2' => esc_html__('Blog 2', 'arc-core'),
                    'blog-3' => esc_html__('Blog 3', 'arc-core'),
                    'blog-4' => esc_html__('Blog 4', 'arc-core'),
                ]
            ]
        );
        $this->add_control(
			'layout_img',
			[
				'label' => esc_html__( 'Layout BG', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    '_blogs_style'   => 'blog-3'
                ]
			]
		);
        $this->add_control(
            'bg_text',
            [
                'label' => esc_html__('BG Text', 'arc-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Blogs',
                'placeholder' => esc_html__('Type bg Text', 'arc-core'),
                'condition' => [
                    '_blogs_style'   => 'blog-3'
                ]
            ],
        );
        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("Our Blog", 'arc-core'),
                'placeholder' => esc_html__('Type your tag here', 'arc-core'),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("Our Latest News", 'arc-core'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
            ]
        );
        $this->add_control(
            'btn_name',
            [
                'label' => esc_html__('Button Name', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("View All News", 'arc-core'),
                'placeholder' => esc_html__('Type your button name here', 'arc-core'),
                'condition' => [
                    '_blogs_style' => ['blog-1', 'blog-2',]
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
                    '_blogs_style' => ['blog-1', 'blog-2',]
                ],
				'label_block' => true,
			]
		);

        $this->add_control(
            '_animation',
            [
                'label' => esc_html__('Add Animation', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'author_name',
                        'label' => esc_html__(' Name', 'arc-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__('Francisco', 'arc-core')
                    ],


                ],
                'default' => [
                    [
						'author_name' => esc_html__( 'Francisco', 'arc-core' )
					],
                ],
                'title_field' => '{{{ author_name }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_blogs_content',
            [
                'label' => esc_html__('Blogs', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_blogs_style'   => ['blog-1','blog-2','blog-3', 'blog-4']
                ]
            ]
        );

        $this->add_control(
            'blog_list',
            [
                'label' => esc_html__('Blog List', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'blog',
                        'label' => esc_html__('Select A Blog', 'arc-core'),
                        'type'  => \Elementor\Controls_Manager::SELECT2,
                        'options'   => $this->get_all_blogs(),
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
    }


    // style_tab_content
    protected function style_tab_content()
    {
    }

    protected function get_all_blogs(){
        $services = new WP_Query(array(
            'post_type'     => 'post',
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
        <?php  ?>
        <?php if ($settings['_blogs_style'] == 'blog-1') : ?>
      
        <!--Blog One Start -->
        <section class="blog-one">
            <div class="container">
                <div class="blog-one__top">
                    <div class="blog-one__top-left">
                        <div class="section-title text-left">
                            <span class="section-title__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                            <h2 class="section-title__title"><?php echo esc_html($settings['title']); ?></h2>
                        </div>
                    </div>
                    <div class="blog-one__btn-box">
                        <a href=" <?php echo esc_url($settings['btn_url']['url']); ?>" class="button-style-1"><?php echo esc_html($settings['btn_name']); ?> <span class="icon-right"></span>
                        </a>
                    </div>
                </div>
                <div class="blog-one__bottom">
                    <div class="row">
                        <?php 
                        foreach($settings['blog_list'] as $item): 
                        $all_post = new WP_Query(array(
                        'post_type'     => 'post',
                        'post_status'   => 'publish',
                        'posts_per_page'    => 1,
                        'p'             => $item['blog']
                        ));
                        
                        if($all_post->have_posts()):
                        while($all_post->have_posts()) : $all_post->the_post();
                        ?>
                        <?php $category = get_the_category(); ?>
                        <!--Blog One Single Start -->
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                            <div class="blog-one__single">
                                <?php if(has_post_thumbnail()) : ?>
                                    <div class="blog-one__img">
                                        <?php the_post_thumbnail(); ?>
                                        <div class="blog-one__tag">
                                            <a href="<?php echo get_category_link($category[0]->term_id); ?>"><?php echo $category[0]->name; ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="blog-one__content">
                                    <h4 class="blog-one__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <div class="blog-one__user-and-date">
                                        <p class="blog-one__user"><a href="<?php the_permalink(); ?>"><?php _e('By ', 'arc-core'); ?><?php echo ucwords(get_the_author()); ?></a></p>
                                        <p class="blog-one__date"><?php  echo get_the_date('M, d, Y'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Blog One Single End -->
                        <?php endwhile; ?>
                        <?php endif; endforeach;?>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog One Start -->
        <?php elseif ($settings['_blogs_style'] == 'blog-2') : ?>
        <!--Blog Two Start-->
        <section class="blog-two">
            <div class="container">
                <div class="blog-two__top">
                    <div class="blog-two__top-left">
                        <div class="section-title-two text-left">
                            <span class="section-title-two__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                            <h2 class="section-title-two__title"><?php echo esc_html($settings['title']); ?></h2>
                        </div>
                    </div>
                    <div class="blog-two__btn-box">
                        <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="button-style-1"><?php echo $settings['btn_name']; ?><span class="icon-right"></span>
                        </a>
                    </div>
                </div>
                <div class="row">
                     <?php   
                        foreach($settings['blog_list'] as $item): 
                        $all_post = new WP_Query(array(
                        'post_type'     => 'post',
                        'post_status'   => 'publish',
                        'posts_per_page'    => 1,
                        'p'             => $item['blog']
                        ));
                        
                        if($all_post->have_posts()):
                        while($all_post->have_posts()) : $all_post->the_post();
                      ?>
                         <?php $category = get_the_category();?>
                        <!--Blog Two Single Start-->
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                            <div class="blog-two__single">
                            <?php if(has_post_thumbnail()) : ?>
                                <div class="blog-two__img">
                                <?php the_post_thumbnail(); ?> 
                                </div>
                                <?php endif; ?>
                                <div class="blog-two__content">
                                    <div class="blog-two__tag-and-date">
                                        <a href="<?php echo get_category_link($category[0]->term_id); ?>"><?php echo $category[0]->name; ?></a>
                                        <p class="blog-one__date"><?php  echo get_the_date('M, d, Y'); ?></p>
                                    </div>
                                    <h3 class="blog-two__title"><a href="<?php echo  get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <a href="<?php echo  get_the_permalink(); ?>" class="blog-two__btn-two"><?php _e('View More', 'arc-core'); ?></a>
                                </div>
                            </div>
                        </div>
                        <!--Blog Two Single End-->
                    <?php endwhile; endif; endforeach;?>
                </div>
            </div>
        </section>
        <!--Blog Two End-->
        <?php elseif ($settings['_blogs_style'] == 'blog-3') : ?>
        <!--Blog Three Start-->
        <section class="blog-three dark-body">
            <div class="blog-three__bg" style="background-image: url(<?php echo esc_url($settings['layout_img']['url']); ?>);">
            </div>
            <p class="section__section-text"><?php echo $settings['bg_text']; ?></p>
            <div class="container">
                <div class="section-title-three text-center">
                    <span class="section-title-three__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                    <h2 class="section-title-three__title"><?php echo esc_html($settings['title']); ?></h2>
                </div>
                <div class="row">
                    <?php     
                        foreach($settings['blog_list'] as $item): 
                        $all_post = new WP_Query(array(
                        'post_type'     => 'post',
                        'post_status'   => 'publish',
                        'posts_per_page'    => 1,
                        'p'             => $item['blog']
                        ));
                        
                        if($all_post->have_posts()):
                        while($all_post->have_posts()) : $all_post->the_post();
                    ?>
                    <?php $category = get_the_category();?>
                    <!--Blog Three Single Start-->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                        <div class="blog-three__single">
                            <div class="blog-three__img-box">
                                <?php if( has_post_thumbnail()) : ?>
                                <div class="blog-three__img">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <?php endif; ?>
                                <div class="blog-three__date">
                                    <p><?php  echo get_the_date('d'); ?>
                                        <br> <?php  echo get_the_date('M,Y'); ?></p>
                                </div>
                            </div>
                            <div class="blog-three__content">
                                <div class="blog-three__client-info">
                                    <p><a href="<?php the_permalink(); ?>"><?php _e('By ', 'arc-core'); ?><?php echo ucwords(get_the_author()); ?></a></p>
                                    <p><a href="<?php echo get_category_link($category[0]->term_id); ?>"><?php echo $category[0]->name; ?></a></p>
                                </div>
                                <h3 class="blog-three__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="blog-three__btn-box">
                                    <a href="<?php the_permalink(); ?>" class="button-style-2"><?php _e('View More', 'arc-core') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Blog Three Single End-->
                    <?php endwhile;  endif; endforeach; ?>
                </div>
            </div>
        </section>
        <!--Blog Three End-->
        <?php  elseif ($settings['_blogs_style'] == 'blog-4') :  ?>
        <!--Blog Four Start -->
        <section class="blog-four">
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
                <div class="blog-one__bottom">
                    <div class="row">
                      <?php   
                            foreach($settings['blog_list'] as $item): 
                            $all_post = new WP_Query(array(
                            'post_type'     => 'post',
                            'post_status'   => 'publish',
                            'posts_per_page'    => 1,
                            'p'             => $item['blog']
                        ));
                        if($all_post->have_posts()):
                        while($all_post->have_posts()) : $all_post->the_post();
                        
                      ?>
                        <?php $category = get_the_category();?>
                        <!--Blog One Single Start -->
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                            <div class="blog-one__single">
                                <?php if(has_post_thumbnail()) : ?>
                                    <div class="blog-one__img">
                                        <?php the_post_thumbnail(); ?>
                                        <div class="blog-one__tag">
                                        <a href="<?php echo get_category_link($category[0]->term_id); ?>"><?php echo $category[0]->name; ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="blog-one__content">
                                    <h4 class="blog-one__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <div class="blog-one__user-and-date">
                                        <p class="blog-one__user"><a href="<?php the_permalink(); ?>"><?php _e('By ', 'arc-core'); ?><?php echo ucwords(get_the_author()); ?></a></p>
                                        <p class="blog-one__date"><?php  echo get_the_date('M, d, Y'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Blog One Single End -->
                        <?php endwhile; endif; endforeach ?>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog Four Start -->
        <?php endif; ?>
<?php
    }
}

$widgets_manager->register(new ARC_blogs());
