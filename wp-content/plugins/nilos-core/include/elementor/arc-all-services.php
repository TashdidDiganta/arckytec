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
class Arc_All_Services extends Widget_Base
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
        return 'arc-all-services';
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
        return __('Arc All Services', 'arc-core');
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
			'content_section',
			[
				'label' => esc_html__( 'Content', 'arc-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            '_post_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'arc-core'),
                'type'  => \Elementor\Controls_Manager::NUMBER,
                'placeholder'   => esc_html__('Number of posts', 'arc-core'),
                'default'   => 6
            ]
        );

		$this->arc_switcher_ctrl('show_pagination', 'Show Pagination');

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
        <!--Services Page Start-->
        <section class="services-page">
            <div class="container">
                <div class="row">
                    <?php 
                    $query = new WP_Query(array(
                        'post_type'     => 'services',
                        'post_status'   => 'publish',
                        'posts_per_page'=> $settings['_post_per_page'],
                        'paged'         => get_query_var('paged') ? get_query_var('paged') : 1
                    ));
                    
                    if($query->have_posts()):
                    while($query->have_posts()): $query->the_post();
                    ?>
                    <!--Services Three Single Start-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-three__single">
                            <div class="services-three__icon">
                                <span class="<?php echo esc_html(get_post_meta(get_the_ID(), '_iconfield', true)); ?>"></span>
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
                            <p class="services-three__text"><?php echo get_the_excerpt(); ?></p>
                            <div class="services-three__view-more">
                                <a href="<?php the_permalink(); ?>"><?php _e('View More', 'arc-core');?><span class="icon-right-arrow-3"></span></a>
                            </div>
                        </div>
                    </div>
                    <!--Services Three Single End-->
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <?php if($settings['_show_pagination'] == 'yes'): ?>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="blog-page__pagination">
                            <?php arckytech_pagination( '<span class="icon-left-arrow"></span>', '<span class="icon-right-arrow"></span>', '', ['class' => 'pg-pagination list-unstyled'] );?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <!--Services Page End-->
        <?php 
    }
}

$widgets_manager->register(new Arc_All_Services());
