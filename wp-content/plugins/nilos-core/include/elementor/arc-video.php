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
class Arc_Videos extends Widget_Base
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
        return 'arc-video';
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
        return __('Arc Video', 'arc-core');
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
            '_video',
            [
                'label' => esc_html__('Video Section', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_video_style',
            [
                'label' => esc_html__('Video Style', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'video-1',
                'options' => [
                    'video-1' => esc_html__('Video 1', 'arc-core'),
                    'video-2' => esc_html__('Video 2', 'arc-core'),
                ]
            ]
        );
        $this->add_control(
			'bg_image',
			[
				'label' => esc_html__( 'Background Image', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
            'video_url',
            [
                'label' => esc_html__('Add Video Url', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("https://www.youtube.com/watch?v=Get7rqXYrbQ", 'arc-core'),
                'placeholder' => esc_html__('Type your video url here', 'arc-core'),
            ]
        );
         


        $this->end_controls_section();

        $this->start_controls_section(
            '_video_content',
            [
                'label' => esc_html__('Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_video_style'   => 'video-2'
                ],
            ]
        );
        $this->add_control(
            'circle_text',
            [
                'label' => esc_html__('Circle Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('our intro video - our intro video -', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'rows' => '3'
            ]
        );
        $this->add_control(
            'text_1',
            [
                'label' => esc_html__('Text 1', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Make it Simple', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                
            ]
        );
        $this->add_control(
            'text_2',
            [
                'label' => esc_html__('Text 2', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__(' But Significant', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
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
        <?php if ($settings['_video_style'] == 'video-1') : ?>
        <section class="video-one">
            <div class="video-one__bg" style="background-image: url(<?php echo esc_url($settings['bg_image']['url']); ?>"></div>
            <div class="container">
                <div class="video-one__inner">
                    <div class="video-one__video-link">
                        <a href="<?php echo $settings['video_url']; ?>" class="video-popup">
                            <div class="video-one__video-icon">
                                <span class="fa fa-play"></span>
                                <i class="ripple"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <?php elseif ($settings['_video_style'] == 'video-2') : ?>
        <!--Banner One Start -->
        <section class="make-it-simple">
            <div class="make-it-simple__bg"
                style="background-image: url(<?php echo esc_url($settings['bg_image']['url']);?>);">
            </div>
            <div class="container">
                <div class="make-it-simple__inner">
                    <h3 class="make-it-simple__text-1 wow slideInLeft" data-wow-delay="100ms"
                        data-wow-duration="2500ms">
                        <?php echo esc_html( $settings['text_1']); ?>
                    </h3>
                    <div class="make-it-simple__curved-circle">
                        <div class="curved-circle-2 rotate-me">
                            <?php echo $settings['circle_text']; ?>
                        </div><!-- /.curved-circle -->
                        <div class="make-it-simple__video-link">
                            <a href="<?php echo esc_attr($settings['video_url']); ?>" class="video-popup">
                                <div class="make-it-simple__video-icon">
                                    <span class="icon-play-button"></span>
                                </div>
                            </a>
                        </div>
                    </div><!-- /.curved-circle -->
                    <h3 class="make-it-simple__text-1 make-it-simple__text-2 wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <?php echo esc_html($settings['text_1']); ?></h3>
                </div>
            </div>
        </section>
        <!--Banner One End -->

    <?php
        endif;
    }
}

$widgets_manager->register(new Arc_Videos());
