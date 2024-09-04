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
class Arc_All_Projects extends Widget_Base
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
        return 'arc-all-project';
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
        return __('Arc All Projects', 'arc-core');
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


        <!--Project Page Start-->
        <section class="project-page">
            <div class="container">
                <div class="row">
                <?php 
                    $query = new WP_Query(array(
                        'post_type'     => 'project',
                        'post_status'   => 'publish',
                        'posts_per_page'    => -1,

                    ));
                    
                    if($query->have_posts()):
                    while($query->have_posts()): $query->the_post();
                    ?>
                    <!--Project One Single Start-->
                    <div class="col-xl-6 col-lg-6 col-md-6">
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
                    <?php
                    endwhile;
                    endif;?>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="blog-page__pagination">
                        <?php arckytech_pagination( '<span class="icon-left-arrow"></span>', '<span class="icon-right-arrow"></span>', '', ['class' => 'pg-pagination list-unstyled'] );?>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--Project Page End-->
        <script>
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
        <?php 
    }
}

$widgets_manager->register(new Arc_All_Projects());
