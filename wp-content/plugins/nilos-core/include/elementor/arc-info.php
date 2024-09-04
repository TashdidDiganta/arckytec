<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Arc_Info extends Widget_Base {

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
		return 'arc-info';
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
		return __( 'Arc Company Info', 'arc-core' );
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
	protected function register_controls() {

        // layout Panel
        $this->start_controls_section(
            'info',
            [
                'label' => esc_html__('Content', 'arc-core'),
            ]
        );
        $this->add_control(
			'info_list',
			[
				'label' => esc_html__( 'Progrss Bar', 'arc-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
                    [
                        'name'  => 'icon',
                        'label' => esc_html__( 'Icon', 'textdomain' ),
                        'type'  => \Elementor\Controls_Manager::ICONS,

                    ],
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Office Location' , 'arc-core' ),
						'label_block' => true,
					],
					[
						'name' => 'desc',
						'label' => esc_html__( 'Description', 'arc-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => '2464 Royal Ln. Mesa, New Jersey 45463.'
					],
				],
				'default' => [
					[
						'title' => esc_html__( 'Office Location', 'arc-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
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
        <!--Address One Start-->
        <section class="address-one">
            <!--Address One Single Start-->
            <div class="container">
                <div class="row">
                    <?php foreach($settings['info_list'] as $item) : ?>
                <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="address-one__single">
                            <div class="address-one__icon">
                                <span class=""><?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                            </div>
                            <h3 class="address-one__title"><?php echo esc_html($item['title']); ?></h3>
                            <p class="address-one__text"><?php echo esc_html($item['desc']); ?></p>
                        </div>
                    </div>
                    <!--Address One Single End-->
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!--Address One End-->
        <?php

	}

}

$widgets_manager->register( new Arc_Info() );
