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

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Arc_call_action extends Widget_Base
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
        return 'arc-call-to-action';
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
        return __('Arc Call To Action', 'arc-core');
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
        // layout Panel
        $this->start_controls_section(
            'arc_layout',
            [
                'label' => esc_html__('Background Image', 'arc-core'),
            ]
        );
        $this->add_control(
            'left_img',
            [
                'label' => esc_html__('Choose Image', 'arc-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'call_to_action_layout',
            [
                'label' => esc_html__('Content', 'arc-core'),
            ]
        );
        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("Get a Quote", 'arc-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'arc-core'),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("Call to Action", 'arc-core'),
                'placeholder' => esc_html__('Type your title here', 'arc-core'),
            ]
        );

        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("It is a logn long established fact that a reader will be distracted the readable content of a page when looking at layout the point of using lorem Ipsum.", 'arc-core'),
                'placeholder' => esc_html__('Type your description here', 'arc-core'),
            ]
        );
        $this->add_control(
			'form_link',
			[
				'label' => esc_html__( 'Email Form Link', 'textdomain' ),
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


        $this->end_controls_section();
    }

    // style_tab_content
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
        <!--CTA One Start-->
        <section class="cta-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5">
                        <div class="cta-one__left">
                            <div class="cta-one__img">
                                <img src="<?php echo esc_attr($settings['left_img']['url']);?>" alt="<?php bloginfo('name'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7">
                        <div class="cta-one__right">
                            <div class="section-title-three text-left">
                                <span class="section-title-three__tagline"><?php echo esc_html( $settings['subtitle']); ?> </span>
                                <h2 class="section-title-three__title"><?php echo esc_html($settings['title']); ?></h2>
                            </div>
                            <p class="cta-one__text"><?php echo esc_html($settings['desc']); ?> </p>
                            <form class="cta-one__email-box">
                                <?php echo do_shortcode($settings['form_link']['url']); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--CTA One End-->
        <!-- CTA One End -->
<?php
    }
}

$widgets_manager->register(new Arc_call_action());
