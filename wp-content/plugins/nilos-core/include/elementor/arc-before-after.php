<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Arc_Before_After extends Widget_Base {

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
    public function get_name() {
        return 'arc-before-after';
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
    public function get_title() {
        return __( 'Arc Before After', 'arc-core' );
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
    public function get_icon() {
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
    public function get_categories() {
        return [ 'arc-core' ];
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
    public function get_script_depends() {
        return [ 'arc-core' ];
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }  


    protected function register_controls_section() {
        $this->start_controls_section(
            '_image_layout',
            [
                'label' => esc_html__(' Before After Section', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
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
			]
		);

        $this->add_control(
            'bg_text',
            [
                'label' => esc_html__('BG Text', 'arc-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Before & After',
                'placeholder' => esc_html__('Type bg Text', 'arc-core'),
            ]
        );
        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'arc-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Before & After',
                'placeholder' => esc_html__('Type Heading Text', 'arc-core'),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Widget Title', 'arc-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'One of The Transformations<br> Within The Interior',
                'placeholder' => esc_html__('Type Heading Text', 'arc-core'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_image_control',
            [
                'label' => esc_html__(' Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'before_img',
			[
				'label' => esc_html__( 'Before Image', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
			'after_img',
			[
				'label' => esc_html__( 'After Image', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->end_controls_section();

    }

    protected function style_tab_content() {

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
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <!--Before After Start-->
        <section class="before-after-sec">
            <div class="before-after-sec__bg"
                style="background-image: url(<?php echo esc_url($settings['layout_img']['url']); ?>);"></div>
            <p class="section__section-text"><?php echo $settings['bg_text']; ?> </p>
            <div class="container">
                <div class="section-title-three text-center">
                    <span class="section-title-three__tagline"><?php echo $settings['subtitle']; ?></span>
                    <h2 class="section-title-three__title"><?php echo $settings['title']; ?></h2>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="before-after-content">
                            <div class="before-after">
                                <div class="before-after-twentytwenty" id="wrinkle-before-after">
                                    <img src="<?php echo esc_url($settings['before_img']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                    <img src="<?php echo esc_url($settings['after_img']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!--Before After End-->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                if ($(".before-after-twentytwenty").length) {
                $(".before-after-twentytwenty").each(function () {
                var Self = $(this);
                var objName = Self.attr("id");
                $("#" + objName).twentytwenty();

                // hack for bs tab
                $(document).on("shown.bs.tab", 'a[data-toggle="tab"]', function (e) {
                    var paneTarget = $(e.target).attr("data-target");
                    var $thePane = $(".tab-pane" + paneTarget);
                    var twentyTwentyContainer = "#" + objName;
                    var twentyTwentyHeight = $thePane.find(twentyTwentyContainer).height();
                    if (0 === twentyTwentyHeight) {
                    $thePane.find(twentyTwentyContainer).trigger("resize");
                    }
                });
                });
            }
            })(jQuery);
        </script>
        <?php
       endif;
    }
}

$widgets_manager->register( new Arc_Before_After() );
