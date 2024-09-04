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
class Arc_Contact extends Widget_Base
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
        return 'arc-contact';
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
        return __('Arc Contact', 'arc-core');
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


        // Content 
        $this->start_controls_section(
            'contact-one',
            [
                'label' => esc_html__('Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_contact_style',
            [
                'label' => esc_html__('skill Style', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'contact-1',
                'options' => [
                    'contact-1' => esc_html__('contact 1', 'arc-core'),
                    'contact-2' => esc_html__('contact 2', 'arc-core'),
                ]
            ]
        );


        $this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'OFFICE BRANCH', 'arc-core' ),
				'placeholder' => esc_html__( 'Type your tagline here', 'arc-core' ),
			]
		);

        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Let’s discuss', 'arc-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'arc-core' ),
				'rows' => 4,
			]
		);


        $this->end_controls_section();

        $this->start_controls_section(
            'contact__left',
            [
                'label' => esc_html__('Content Left', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'map_link',
			[
				'label' => esc_html__( 'Map Url', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'contact_right',
            [
                'label' => esc_html__('Content Right', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]

            
        );
        $this->add_control(
			'form_link',
			[
				'label' => esc_html__( 'Form Script', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '[contact-form-7 id="8af6495" title="Contact form 1"]',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
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
        <?php if ($settings['_contact_style'] == 'contact-1') : ?>
        <!--Contact One Start-->
        <section class="contact-one">
            <div class="contact-one__shape-1 float-bob-y">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/contact-one-shape-1.png'?>" alt="<?php bloginfo('name'); ?>">
            </div>
            <div class="contact-one__wrap">
                <div class="contact-one__left">
                    <div class="contact-one__map">
                        <iframe
                            src="<?php echo esc_attr($settings['map_link']['url']); ?>"
                            class="google-map__two" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="contact-one__right">
                    <div class="contact-one__content-box">
                        <div class="section-title-two text-left">
                            <span class="section-title-two__tagline"><?php echo esc_html($settings['subtitle']); ?></span>
                            <h2 class="section-title-two__title"><?php echo esc_html($settings['title']); ?></h2>
                        </div>
                        <?php echo do_shortcode($settings['form_link']['url']); ?>
                        <div class="result"></div>
                    </div>
                </div>
            </div>
        </section>
        <!--Contact One End-->
        <?php elseif ($settings['_contact_style'] == 'contact-2') : ?>
        <!--Contact Two Start-->
            <section class="contact-two">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6">
                            <div class="contact-two__left">
                                <div class="section-title-four text-left">
                                    <div class="section-title-four__tagline-box">
                                        <span class="section-title-four__tagline"><?php echo esc_html($settings['contact_tagline']); ?></span>
                                    </div>
                                    <h2 class="section-title-four__title"> <?php echo wp_kses_post($settings['section_title']);?> 
                                </div>
                                <div class="contact-two__contact-box">
                                    <div class="contact-two__contact-left">
                                        <p class="contact-two__tag"><?php echo $settings['contact_tag']; ?></p>
                                        <ul class="contact-two__list list-unstyled">
                                            <?php foreach($settings['contact_info_left'] as $item) : ?>
                                            <li>
                                                <div class="icon">
                                                    <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </div>
                                                <div class="text">
                                                    <p><a href="#"><?php echo esc_html($item['text']); ?></a></p>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="contact-two__contact-right">
                                        <p class="contact-two__tag contact-two__tag-2"><?php echo esc_html($settings['contact_tag_right']); ?></p>
                                        <ul class="contact-two__list list-unstyled">
                                            <?php foreach($settings['contact_info_right'] as $item) : ?>
                                            <li>
                                                <div class="icon">
                                                    <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </div>
                                                <div class="text">
                                                    <p><a href="#"><?php echo esc_html($item['text']); ?></a></p>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6">
                            <div class="contact-two__right">
                                <div class="contact-two__form-box">
                                    <div class="contact-two__form contact-form-validated" novalidate="novalidate">
                                        <?php echo do_shortcode($settings['form_shortcout']) ?>
                                    </div>
                                    <div class="result"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!--Contact Two End-->
        <?php
        endif;
    }
}

$widgets_manager->register(new Arc_Contact());
