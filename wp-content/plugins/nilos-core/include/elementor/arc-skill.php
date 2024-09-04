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
class Arc_Skill extends Widget_Base
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
        return 'arc-skill';
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
        return __('Arc Skills', 'arc-core');
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



        // Section
        $this->start_controls_section(
            'left_content',
            [
                'label' => esc_html__('Left Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Our Working Skills With Experience', 'arc-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'arc-core' ),
                'rows' => '5'
			]
		);
        $this->add_control(
			'desc',
			[
				'label' => esc_html__( 'Description', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 6,
				'default' => esc_html__( 'It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point of using lorem Ipsum less normal distribution of letters.', 'arc-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'arc-core' ),
			]
		);
        $this->add_control(
			'progress_fields',
			[
				'label' => esc_html__( 'Repeater List', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'progress_title',
						'label' => esc_html__( 'Progress Title', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Custom Design' , 'arc-core' ),
						'label_block' => true,
					],
                    [
                        'name'  => 'progress_bar',
                        'label' => __('Progress Percentage', 'text-domain'),
                        'type'  => \Elementor\Controls_Manager::NUMBER,
                        'default' => '50'
                    ]
                    

				],
				'default' => [
					[
						'progress_title' => esc_html__( 'Architecture', 'arc-core' ),
						'progress_bar' => esc_html__( '50', 'arc-core' ),
					],
				],
				'title_field' => '{{{ progress_title }}}',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'right_content',
            [
                'label' => esc_html__('Right Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'circle_center',
            [
                'label' => esc_html__('Circle Center Letter', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('A', 'arc-core'),
                'placeholder' => esc_html__('Type your letter here', 'arc-core'),
            ]
        );
        $this->add_control(
			'link',
			[
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
		);
        $this->add_control(
            'circle_text',
            [
                'label' => esc_html__('Circle Text', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('with best quality working skills', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'rows' => '5'
            ]
        );
        $this->add_control(
			'back_img',
			[
				'label' => esc_html__( 'Choose Back Image', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
			'front_img',
			[
				'label' => esc_html__( 'Choose Front Image', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
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
        $settings = $this->get_settings_for_display(); ?>



        <!--Skill One Start-->
        <section class="skill-one">
            <div class="skill-one__shape-1 img-bounce">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/skill-one-shape-1.png' ?>" alt="<?php bloginfo('name'); ?>">
            </div>
            <div class="skill-one__shape-2 float-bob-y">
              <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/skill-one-shape-2.png' ?>" alt="<?php bloginfo('name'); ?>">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-5">
                        <div class="skill-one__left">
                            <h3 class="skill-one__title"><?php echo esc_html( $settings['title']); ?></h3>
                            <p class="skill-one__text"><?php echo esc_html( $settings['desc']); ?></p>
                            <div class="skill-one__progress">
                                <div class="progress-levels">
                                    <?php foreach($settings['progress_fields'] as $item) : ?>
                                    <!--Skill Box-->
                                    <div class="progress-box">
                                        <div class="inner count-box">
                                            <div class="text"><?php echo esc_html($item['progress_title']); ?></div>
                                            <div class="bar">
                                                <div class="bar-innner">
                                                    <div class="skill-percent">
                                                        <span class="count-text" data-speed="3000"
                                                            data-stop="<?php echo esc_attr($item['progress_bar']); ?>">0</span>
                                                        <span class="percent">%</span>
                                                    </div>
                                                    <div class="bar-fill" data-percent="<?php echo esc_attr($item['progress_bar']); ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="skill-one__right">
                            <div class="skill-one__img-box">
                                <div class="skill-one__img">
                                    <img src="<?php echo esc_attr($settings['back_img']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                                <div class="skill-one__img-2">
                                    <img src="<?php echo esc_attr($settings['front_img']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                    <div class="skill-one__curved-circle">
                                        <div class="curved-circle-3">
                                            <?php echo esc_html($settings['circle_text']); ?>
                                        </div><!-- /.curved-circle -->
                                        <div class="skill-one__video-link">
                                            <a href="<?php esc_url($settings['link']['url']); ?>">
                                                <div class="skill-one__video-icon">
                                                    <span><?php echo $settings['circle_center']; ?></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div><!-- /.curved-circle -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Skill One End-->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                if ($('.curved-circle-3').length) {
                $('.curved-circle-3').circleType({
                    position: 'relative',
                    dir: 1,
                    radius: 80,
                    forceHeight: true,
                    forceWidth: true
                });
                }

            })(jQuery);
        </script>
        <?php
        endif;
    }
}

$widgets_manager->register(new Arc_Skill());
