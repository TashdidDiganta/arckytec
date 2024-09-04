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
class Arc_Contact_Box extends Widget_Base {

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
		return 'contact-box';
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
		return __( 'Contact Box', 'arc-core' );
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


    protected static function get_profile_names()
    {
        return [
            'apple' => esc_html__('Apple', 'arc-core'),
            'behance' => esc_html__('Behance', 'arc-core'),
            'bitbucket' => esc_html__('BitBucket', 'arc-core'),
            'codepen' => esc_html__('CodePen', 'arc-core'),
            'delicious' => esc_html__('Delicious', 'arc-core'),
            'deviantart' => esc_html__('DeviantArt', 'arc-core'),
            'digg' => esc_html__('Digg', 'arc-core'),
            'dribbble' => esc_html__('Dribbble', 'arc-core'),
            'email' => esc_html__('Email', 'arc-core'),
            'facebook' => esc_html__('Facebook', 'arc-core'),
            'flickr' => esc_html__('Flicker', 'arc-core'),
            'foursquare' => esc_html__('FourSquare', 'arc-core'),
            'github' => esc_html__('Github', 'arc-core'),
            'houzz' => esc_html__('Houzz', 'arc-core'),
            'instagram' => esc_html__('Instagram', 'arc-core'),
            'jsfiddle' => esc_html__('JS Fiddle', 'arc-core'),
            'linkedin' => esc_html__('LinkedIn', 'arc-core'),
            'medium' => esc_html__('Medium', 'arc-core'),
            'pinterest' => esc_html__('Pinterest', 'arc-core'),
            'product-hunt' => esc_html__('Product Hunt', 'arc-core'),
            'reddit' => esc_html__('Reddit', 'arc-core'),
            'slideshare' => esc_html__('Slide Share', 'arc-core'),
            'snapchat' => esc_html__('Snapchat', 'arc-core'),
            'soundcloud' => esc_html__('SoundCloud', 'arc-core'),
            'spotify' => esc_html__('Spotify', 'arc-core'),
            'stack-overflow' => esc_html__('StackOverflow', 'arc-core'),
            'tripadvisor' => esc_html__('TripAdvisor', 'arc-core'),
            'tumblr' => esc_html__('Tumblr', 'arc-core'),
            'twitch' => esc_html__('Twitch', 'arc-core'),
            'twitter' => esc_html__('Twitter', 'arc-core'),
            'vimeo' => esc_html__('Vimeo', 'arc-core'),
            'vk' => esc_html__('VK', 'arc-core'),
            'website' => esc_html__('Website', 'arc-core'),
            'whatsapp' => esc_html__('WhatsApp', 'arc-core'),
            'wordpress' => esc_html__('WordPress', 'arc-core'),
            'xing' => esc_html__('Xing', 'arc-core'),
            'yelp' => esc_html__('Yelp', 'arc-core'),
            'youtube' => esc_html__('YouTube', 'arc-core'),
        ];
    }

    public function get_nilos_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $nilos_cfa         = array();
        $nilos_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $nilos_forms       = get_posts( $nilos_cf_args );
        $nilos_cfa         = ['0' => esc_html__( 'Select Form', 'arc-core' ) ];
        if( $nilos_forms ){
            foreach ( $nilos_forms as $nilos_form ){
                $nilos_cfa[$nilos_form->ID] = $nilos_form->post_title;
            }
        }else{
            $nilos_cfa[ esc_html__( 'No contact form found', 'arc-core' ) ] = 0;
        }
        return $nilos_cfa;
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
            'nilos_contact',
            [
                'label' => esc_html__('Contact Form', 'arc-core'),
            ]
        );

        $this->add_control(
            'arc_contact_form_subtitle',
            [
                'label'       => esc_html__( 'Contact Subtitle', 'arc-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Contact Us', 'arc-core' ),
                'placeholder' => esc_html__( 'Your Subtitle', 'arc-core' ),
            ]
        );

        $this->add_control(
            'arc_contact_form_title',
            [
                'label'       => esc_html__( 'Contact Title', 'arc-core' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Get in Touch', 'arc-core' ),
                'placeholder' => esc_html__( 'Your Text', 'arc-core' ),
            ]
        );

        $this->add_control(
            'arc_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'arc-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_nilos_contact_form(),
            ]
        );

        $this->end_controls_section();

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->nilos_section_style_controls('comint_section', 'Section - Style', '.nilos-el-section');
        $this->nilos_basic_style_controls('about_subtitle', 'Section - Subtitle', '.nilos-el-subtitle');
        $this->nilos_basic_style_controls('about_title', 'Section - Title', '.nilos-el-title');
        $this->nilos_basic_style_controls('about_description', 'Section - Description', '.nilos-el-content p');

        $this->nilos_section_style_controls('coming_box', 'Contact - Box', '.nilos-el-contact-box');
        $this->nilos_basic_style_controls('coming_title', 'Contact - Title', '.nilos-el-box-title');
        $this->nilos_basic_style_controls('coming_subtitle', 'Contact - Description', '.nilos-el-box-desc p');
        $this->nilos_input_controls_style('coming_input', 'Form - Input', '.nilos-el-box-input input', '.nilos-el-box-input textarea');
        $this->nilos_link_controls_style('coming_input_btn', 'Form - Button', '.nilos-el-box-input button');
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
        <!--Contact Two Start-->
        <section class="contact-two">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="contact-two__right">
                            <div class="section-title-two text-left">
                                <span class="section-title-two__tagline"> <?php echo wp_kses_post($settings['arc_contact_form_subtitle']); ?></span>
                                <h2 class="section-title-two__title">  <?php echo wp_kses_post($settings['arc_contact_form_title']); ?></h2>
                            </div>
                            <?php if( !empty($settings['arc_select_contact_form']) ) : ?>
                                <?php echo do_shortcode( '[contact-form-7  id="'.$settings['arc_select_contact_form'].'"]' ); ?>
                            <?php else : ?>
                                <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'arc-core' ). '</p></div>'; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Contact Two End-->
        <?php
	}
}

$widgets_manager->register( new Arc_Contact_Box() );
