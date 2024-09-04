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
class Arc_All_Blogs extends Widget_Base
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
        return 'arc-all-blog';
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
        return __('Arc All Blogs', 'arc-core');
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

        <!--Blog Page Start-->
        <section class="blog-page">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="blog-page__left">
                            <?php 
                                $query = new WP_Query(array(
                                    'post_type'     => 'post',
                                    'post_status'   => 'publish',
                                    'posts_per_page'    => -1,

                                ));
                                
                                if($query->have_posts()):
                                while($query->have_posts()): $query->the_post();
                            ?>
                            <?php $category = get_the_category();?>
                                <!--Blog Page Single Start-->
                                <div class="blog-page__single">
                                    <div class="blog-page__img">
                                    <?php if(has_post_thumbnail()) : ?>
                                      <?php the_post_thumbnail(); ?>
                                    <?php endif; ?>
                                        <div class="blog-page__date">
                                            <p><?php  echo get_the_date('d'); ?>
                                            <br> <?php  echo get_the_date('M,Y'); ?></p>
                                        </div>
                                    </div>
                                    <div class="blog-page__content">
                                        <div class="blog-page__client-info">
                                            <p><?php _e('By ', 'arc-core'); ?> <a href="<?php the_permalink(); ?>"><?php echo ucwords(get_the_author()); ?></a></p>
                                            <p><a href="<?php echo get_category_link($category[0]->term_id); ?>"><?php echo $category[0]->name; ?></a></p>
                                        </div>
                                        <h3 class="blog-page__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="blog-page__btn-box">
                                            <a href="<?php the_permalink(); ?>" class="button-style-2"><?php _e('View More', 'arc-core') ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; endif;?>
                        </div>
                        <div class="blog-page__pagination">
                           <?php arckytech_pagination( '<span class="icon-left-arrow"></span>', '<span class="icon-right-arrow"></span>', '', ['class' => 'pg-pagination list-unstyled'] );?>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="sidebar">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog Page End-->
        <?php 
    }
}

$widgets_manager->register(new Arc_All_Blogs());
