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
class Arc_All_Team_Member extends Widget_Base
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
        return 'arc-all-team-member';
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
        return __('Arc All Team Member', 'arc-core');
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

        <!--Team Page Start-->
        <section class="team-page">
            <div class="container">
                <div class="row">
                <?php 
                    $query = new WP_Query(array(
                        'post_type'     => 'team',
                        'post_status'   => 'publish',
                        'posts_per_page'    => -1,

                    ));
                    
                    if($query->have_posts()):
                    while($query->have_posts()): $query->the_post();
                    ?>
                    <!--Team One Single Start -->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="team-one__single">
                            <div class="team-one__img">
                            <?php if(has_post_thumbnail()): ?>
                                <?php the_post_thumbnail(); ?>
                            <?php endif; ?>
                                <ul class="list-unstyled team-one__social">
                                <?php
                                    $social_repeater = function_exists('tpmeta_field') ? tpmeta_field('_team_social_meta_id') : ''; 
                                    foreach($social_repeater as $row) :?>
                                        <?php foreach($row['_team_social_id'] as $icon ) :?>
                                            <li> <a href="<?php echo $row['_url_value']; ?>"><i class="icon-<?php echo strtolower($icon)?>"></i></a></li>
                                        <?php endforeach?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="team-one__content">
                                <h4 class="team-one__name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p class="team-one__sub-title"><?php echo get_field('member_designation'); ?></p>
                                <ul class="list-unstyled team-one__social-two">
                                    <li><span><i class="icon-share"></i></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Team One Single End -->
                    <?php
                     endwhile;
                     endif;        
                     ?>
                </div>
            </div>
        </section>
        <!--Team Page End-->
        <?php 
    }
}

$widgets_manager->register(new Arc_All_Team_Member());
