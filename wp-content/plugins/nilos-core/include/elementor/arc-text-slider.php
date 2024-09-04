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
class Arc_Text_Slide extends Widget_Base {

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
        return 'arc-slider';
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
        return __( 'Arc Text Slider', 'arc-core' );
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
     * Retrieve the text of categories the widget belongs to.
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
     * Retrieve the text of scripts the widget depended on.
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
        
    }  


    protected function register_controls_section() {
        
        $this->start_controls_section(
            '_text_content',
            [
                'label' => esc_html__('Text Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'_text_style',
			[
				'label' => esc_html__( 'Text Slider', 'arc-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'text-1',
				'options' => [
					'text-1' => esc_html__( 'Slider 1', 'arc-core' ),
					'text-2' => esc_html__( 'Slider 2', 'arc-core' ),
				]
			]
		);
        $this->add_control(
            'slide_text_1',
            [
                'label' => esc_html__('Slide Text 1', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__(' We provide the best services', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'rows' => '4',
                'condition' => [
                    '_text_style' => ['text-2']
                ]
            ]
        );
        $this->add_control(
            'slide_text_2',
            [
                'label' => esc_html__('Slide Text 2', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__(' Architect & interior design services', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'rows' => '4',
                'condition' => [
                    '_text_style' => ['text-2']
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_slide_1',
            [
                'label' => esc_html__('Text Slide 1', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_text_style' => ['text-1']
                ]
            ]
        );
        $this->add_control(
            'text_1',
            [
                'label' => esc_html__('Slide Text 1', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We provide the best', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'rows' => '4'
            ]
        );
        $this->add_control(
            'text_2',
            [
                'label' => esc_html__('Slide Text 2', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Architect & interior design services', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'rows' => '4'
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_slide_2',
            [
                'label' => esc_html__('Text Slide 2', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_text_style' => ['text-1']
                ]
            ]
        );
        $this->add_control(
            'slide2_text_1',
            [
                'label' => esc_html__('Slide Text 1', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We provide the best', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'rows' => '4'
            ]
        );
        $this->add_control(
            'slide2_text_2',
            [
                'label' => esc_html__('Slide Text 2', 'arc-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Architect & interior design services', 'arc-core'),
                'placeholder' => esc_html__('Type your text here', 'arc-core'),
                'rows' => '4'
            ]
        );
        $this->end_controls_section();
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
        <?php if($settings['_text_style'] == 'text-1'): ?>
        <!--Sliding Text Start -->
        <section class="sliding-text">
            <div class="sliding-text__wrap">
                <ul class="sliding-text__list list-unstyled marquee_mode">
                    <li>
                        <a href="#"><?php echo esc_html( $settings['text_1']); ?></a>
                        <span>/</span>
                        <a href="#"><?php echo esc_html($settings['text_2']); ?></a>
                    </li>
                </ul>
            </div>
        </section>
        <!--Sliding Text Start -->

        <!--Sliding Text Start -->
        <section class="sliding-text sliding-text-two">
            <div class="sliding-text__wrap">
                <ul class="sliding-text__list list-unstyled marquee_mode-two">
                    <li>
                        <a href="#"><?php echo esc_html($settings['slide2_text_1']); ?></a>
                        <span>/</span>
                        <a href="#"><?php echo esc_html($settings['slide2_text_2']); ?></a>
                    </li>
                </ul>
            </div>
        </section>
        <!--Sliding Text Start -->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                
                if ($(".marquee_mode").length) {
                $('.marquee_mode').marquee({
                    speed: 35,
                    gap: 0,
                    delayBeforeStart: 0,
                    direction: 'left',
                    duplicated: true,
                    pauseOnHover: true,
                    startVisible:true,
                });
                }
                if ($(".marquee_mode-two").length) {
                $('.marquee_mode-two').marquee({
                    speed: 35,
                    gap: 0,
                    delayBeforeStart: 0,
                    direction: 'right',
                    duplicated: true,
                    pauseOnHover: true,
                    startVisible:true,
                });
                }
            })(jQuery);
        </script>
        <?php endif; ?>
        <?php elseif($settings['_text_style'] == 'text-2'): ?>
        <!--Sliding Text Two Start -->
        <section class="sliding-text-three">
            <div class="home-four-site-border"></div>
            <div class="home-four-site-border home-four-site-border-two"></div>
            <div class="home-four-site-border home-four-site-border-three"></div>
            <div class="home-four-site-border home-four-site-border-four"></div>
            <div class="home-four-site-border home-four-site-border-five"></div>
            <div class="home-four-site-border home-four-site-border-six"></div>
            <div class="sliding-text-three__wrap">
                <ul class="sliding-text-three__list list-unstyled marquee_mode">
                    <li>
                        <a data-hover="<?php echo esc_attr($settings['slide_text_1']); ?>" href="#"><?php echo esc_html($settings['slide_text_1']); ?></a>
                        <span>/</span>
                        <a data-hover="<?php echo esc_attr($settings['slide_text_2']); ?>" href="#">
                          <?php echo esc_html($settings['slide_text_2']); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
        <!--Sliding Text Two Start -->
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                
                if ($(".marquee_mode").length) {
                $('.marquee_mode').marquee({
                    speed: 35,
                    gap: 0,
                    delayBeforeStart: 0,
                    direction: 'left',
                    duplicated: true,
                    pauseOnHover: true,
                    startVisible:true,
                });
                }
            })(jQuery);
        </script>
        <?php endif; endif;
    }
}

$widgets_manager->register( new Arc_Text_Slide() );
