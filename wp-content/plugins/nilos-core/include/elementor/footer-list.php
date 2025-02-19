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
class NILOS_Footer_List extends Widget_Base {

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
        return 'nilos-footer-list';
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
        return __( 'Footer List', 'arc-core' );
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
        return 'nilos-icon';
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
            'nilos_sec',
            [
                'label' => esc_html__('Footer List', 'arc-core'),
            ]
        );

        $this->add_control(
            'nilos_footer_list_title',
            [
                'label'       => esc_html__( 'Widget Title', 'arc-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'My Widget List', 'arc-core' ),
                'placeholder' => esc_html__( 'Your Text', 'arc-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'nilos_footer_link_switcher',
            [
                'label' => esc_html__( 'Add Footer link', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'arc-core' ),
                'label_off' => esc_html__( 'No', 'arc-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'nilos_footer_btn_text',
            [
                'label' => esc_html__('Link Text', 'arc-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Link Text', 'arc-core'),
                'title' => esc_html__('Enter link text', 'arc-core'),
                'label_block' => true,
                'condition' => [
                    'nilos_footer_link_switcher' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'nilos_footer_link_type',
            [
                'label' => esc_html__( 'Footer Link Type', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'nilos_footer_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'nilos_footer_link',
            [
                'label' => esc_html__( 'Footer Link link', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'htniloss://your-link.com', 'arc-core' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'nilos_footer_link_type' => '1',
                    'nilos_footer_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'nilos_footer_page_link',
            [
                'label' => esc_html__( 'Select Footer Link Page', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => nilos_get_all_pages(),
                'condition' => [
                    'nilos_footer_link_type' => '2',
                    'nilos_footer_link_switcher' => 'yes',
                ]
            ]
        );


        $this->add_responsive_control(
            'nilos_align',
            [
                'label' => esc_html__('Alignment', 'arc-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'arc-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'arc-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'arc-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'nilos_footer_list',
            [
                'label' => esc_html__('Footer - List', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'nilos_footer_btn_text' => esc_html__('Business Stratagy', 'arc-core'),
                    ],
                    [
                        'nilos_footer_btn_text' => esc_html__('Website Development', 'arc-core')
                    ],
                    [
                        'nilos_footer_btn_text' => esc_html__('Marketing & Reporting', 'arc-core')
                    ]
                ],
                'title_field' => '{{{ nilos_footer_btn_text }}}',
            ]
        );
        $this->end_controls_section();

    }


    protected function style_tab_content(){
        $this->nilos_basic_style_controls('footer_subtitle', 'Title', '.nilos-el-title');
        $this->nilos_link_controls_style('footer_description', 'List - Style', '.nilos-el-box-btn');
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

        <div class="nilos-footer-widget">
            <?php if(!empty($settings['nilos_footer_list_title'])) : ?>
            <h4 class="nilos-footer-widget-title nilos-el-title"><?php echo esc_html($settings['nilos_footer_list_title']); ?></h4>
            <?php endif; ?>

            <div class="nilos-footer-widget-content">
                <ul>
                    <?php foreach ($settings['nilos_footer_list'] as $key => $item) :
                        if ('2' == $item['nilos_footer_link_type']) {
                            $link = get_permalink($item['nilos_footer_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['nilos_footer_link']['url']) ? $item['nilos_footer_link']['url'] : '';
                            $target = !empty($item['nilos_footer_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['nilos_footer_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                    <li>
                        <a class="nilos-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" ><?php echo nilos_kses($item['nilos_footer_btn_text']); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

        <?php
    }
}

$widgets_manager->register( new NILOS_Footer_List() );
