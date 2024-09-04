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
class Arc_Counter extends Widget_Base {

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
        return 'arc-counter';
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
        return __( 'Arc Counter', 'arc-core' );
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
            '_counter_section',
            [
                'label' => esc_html__('Counter', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'counter_list',
            [
                'label' => esc_html__( 'Counter List', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
						'name' => 'counter',
						'label' => esc_html__('Counter Number', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( '30' , 'arc-core' ),
						'label_block' => true,
                    ],
                    [
						'name' => 'text',
						'label' => esc_html__('Text', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Years of Experience' , 'arc-core' ),
						'label_block' => true,
					]

                ],
                'default' => [
                    [
						'text' => esc_html__( 'Years of Experience', 'arc-core' )
					],
                ],
                'title_field' => '{{{ text }}}',
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
        <section class="counter-two">
            <div class="container">
              <ul class="list-unstyled counter-two__list">
                <?php foreach($settings['counter_list'] as $count): ?>
                <li>
                    <div class="counter-two__single">
                        <div class="counter-two__count">
                            <h3 class="odometer" data-count="<?php echo esc_attr($count['counter']);?>">00</h3>
                            <span class="counter-two__count-plus">+</span>
                        </div>
                        <h4 class="counter-two__text"><?php echo esc_html($count['text']);?></h4>
                    </div>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
        </section>
        <?php if(\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
        <script>
            ;(function($){
                "use strict";
                if ($(".odometer").length) {
                var odo = $(".odometer");
                odo.each(function () {
                    $(this).appear(function () {
                    var countNumber = $(this).attr("data-count");
                    $(this).html(countNumber);
                    });
                });
                }
            })(jQuery);
        </script>
        
        <?php
        endif;
    }
}

$widgets_manager->register( new Arc_Counter() );
