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
class Arc_Price extends Widget_Base {

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
        return 'arc-price';
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
        return __( 'Arc Price', 'arc-core' );
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
            'image_content',
            [
                'label' => esc_html__('Image Content', 'arc-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Subtitle', 'arc-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Best Pricing', 'arc-core'),
                'placeholder' => esc_html__('Type your subtitle hear', 'arc-core'),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'arc-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Pricing Tables', 'arc-core'),
                'placeholder' => esc_html__('Type your title hear', 'arc-core'),
            ]
        );

        $this->add_control(
            'pack_list',
            [
                'label' => esc_html__( 'Add Price List', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
						'name' => 'pack_name',
						'label' => esc_html__('Pack Name', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Basic' , 'arc-core' ),
						'label_block' => true,
					],
                    [
						'name' => 'pack_price',
						'label' => esc_html__('Pack Price', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( '$99' , 'arc-core' ),
						'label_block' => true,
					],
                    [
						'name' => 'pack_desc',
						'label' => esc_html__('Pack Description', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => wp_kses_post( 'Lorem ipsum dolor sit amet consectetur <br> vestibulum viverra eget felis' , 'arc-core' ),
						'label_block' => true,
					],
                    [
                        'name'  => 'pack_icon',
                        'label' => esc_html__( 'Icon', 'arc-core' ),
                        'type'  => \Elementor\Controls_Manager::ICONS
                    ],
                    [
                        'name' => 'animation_delay',
                        'label' => esc_html__('Animation Delay', 'arc-core'),
                        'type'  => \Elementor\Controls_Manager::NUMBER,
                        'default'   => 100,
                        'placeholder'   => esc_html__('e.g 100ms', 'arc-core')
                    ],
                    [
						'name' => 'list_1',
						'label' => esc_html__('Pack List 1', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => wp_kses_post( 'Floor & Celling Plan' , 'arc-core' ),
						'label_block' => true,
                        'rows' => 3
					],
                    [
						'name' => 'list_2',
						'label' => esc_html__('Pack List 2', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => wp_kses_post( 'Room Design Included' , 'arc-core' ),
						'label_block' => true,
                        'rows' => 3
					],
                    [
						'name' => 'list_3',
						'label' => esc_html__('Pack List 3', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => wp_kses_post( 'Up To 8 Rooms' , 'arc-core' ),
						'label_block' => true,
                        'rows' => 3
					],
                    [
						'name' => 'list_4',
						'label' => esc_html__('Pack List 4', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => wp_kses_post( 'Modern Architecture' , 'arc-core' ),
						'label_block' => true,
                        'rows' => 3
					],
                    [
						'name' => 'list_5',
						'label' => esc_html__('Pack List 5', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => wp_kses_post( 'Winning Mertric for Your Startup' , 'arc-core' ),
						'label_block' => true,
                        'rows' => 3
					],
                    [
						'name' => 'button_name',
						'label' => esc_html__('Button Name', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => wp_kses_post( 'Choose Plan' , 'arc-core' ),
						'label_block' => true,
                        'rows' => 3
					],
                    [
                        'name' => 'button_link',
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


                ],
                'default' => [
                    [
						'pack_name' => esc_html__( 'Basic', 'arc-core' )
					],
                ],
                'title_field' => '{{{ pack_name }}}',
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
        <!--Pricing One Start-->
        <section class="pricing-one">
            <div class="container">
                <div class="section-title-two text-center">
                    <span class="section-title-two__tagline"><?php echo esc_html($settings['sub_title']); ?></span>
                    <h2 class="section-title-two__title"><?php echo esc_html( $settings['title']); ?></h2>
                </div>
                <div class="row">
                    <?php foreach($settings['pack_list'] as $pack) : ?>
                    <!--Pricing One Single Start-->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="<?php echo esc_attr($pack['animation_delay']); ?>ms">
                        <div class="pricing-one__single">
                            <div class="pricing-one__single-inner">
                                <div class="pricing-one__icon">
                                    <span><?php \Elementor\Icons_Manager::render_icon( $pack['pack_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                </div>
                                <div class="pricing-one__top">
                                    <h4 class="pricing-one__pack-name"><?php echo esc_html($pack['pack_name']); ?></h4>
                                    <h2 class="pricing-one__pack-price"><?php echo esc_html($pack['pack_price']); ?> <span> <?php _e('/Per Month', 'arc-core'); ?></span></h2>
                                    <p class="pricing-one__text"><?php echo wp_kses_post( $pack['pack_desc']); ?></p>
                                </div>
                                <ul class="list-unstyled pricing-one__list">
                                   <li>
                                        <div class="icon">
                                            <span class="icon-tick"></span>
                                        </div>
                                        <div class="text">
                                           <?php echo esc_html($pack['list_1']);?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-tick"></span>
                                        </div>
                                        <div class="text">
                                            <?php echo esc_html($pack['list_2']);?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-tick"></span>
                                        </div>
                                        <div class="text">
                                            <?php echo esc_html($pack['list_3']);?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-tick"></span>
                                        </div>
                                        <div class="text">
                                            <?php echo esc_html($pack['list_4']);?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-tick"></span>
                                        </div>
                                        <div class="text">
                                            <?php echo esc_html($pack['list_5']);?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="pricing-one__btn-box">
                                <a href="<?php echo esc_url($pack['button_link']['url']); ?>" class="button-style-2"><?php echo esc_html($pack['button_name']);?></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <!--Pricing One Single End-->
                </div>
            </div>
        </section>
        <!--Pricing One End-->
        <?php
    }
}

$widgets_manager->register( new Arc_Price() );
