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
class Arc_Process extends Widget_Base {

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
        return 'arc-process';
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
        return __( 'Arc Process', 'arc-core' );
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
            '_process_content',
            [
                'label' => esc_html__('Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            '_process_list',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'arc-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Design Process', 'arc-core' ),
                        'placeholder' => esc_html__( 'Type your title here', 'arc-core' ),
                    ],
            
                    [
                        'name' => 'title_url',
                        'label' => esc_html__( 'Page Url', 'arc-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'http//about.html', 'arc-core' ),
                        'placeholder' => esc_html__( 'Type your title here', 'arc-core' ),
                    ],
            
                    [
                        'name' => 'desc',
                        'label' => esc_html__( 'Description', 'arc-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur the is adipisci elit.
                        Integer feugiat tortor non there are many other nullam.', 'arc-core' ),
                        'placeholder' => esc_html__( 'Type your description here', 'arc-core' ),
                    ],
                ],
                'default' => [
                    [
                        'title'         => esc_html__('Design Process', 'arc-core'),
                        'desc'          => esc_html__('', 'arc-core'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
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
        <!--Process One Start -->
        <section class="process-one">
            <div class="container">
                <div class="row">                        
                    <?php foreach($settings['_process_list'] as $item) : ?>
                        <?php if($item['_id'] == '0bf30a3'){ ?>
                    <!--Process One Single Start-->
                    <div class="col-xl-4 col-lg-4">
                        <div class="process-one__single">
                            <div class="process-one__shape-1">
                               
                            </div>
                            <div class="process-one__count-box">
                                <div class="process-one__count"></div>
                            </div>
                            <h4 class="process-one__title"><a href="<?php echo esc_attr($item['title_url']); ?>"><?php echo esc_html($item['title']); ?></a></h4>
                            <p class="process-one__text"><?php echo esc_html($item['desc']); ?></p>
                        </div>
                    </div>
                    <!--Process One Single End-->
                    <?php }else{ ?>
                        <!--Process One Single Start-->
                        <div class="col-xl-4 col-lg-4">
                            <div class="process-one__single">
                                <div class="process-one__shape-1">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/process-one-shape-1.png' ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                                <div class="process-one__count-box">
                                    <div class="process-one__count"></div>
                                </div>
                                <h4 class="process-one__title"><a href="<?php echo esc_attr($item['title_url']); ?>"><?php echo esc_html($item['title']); ?></a></h4>
                                <p class="process-one__text"><?php echo esc_html($item['desc']); ?></p>
                            </div>
                        </div>
                        <!--Process One Single End-->
                    <?php } ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!--Process One End -->


        <?php
    }
}

$widgets_manager->register( new Arc_Process() );
