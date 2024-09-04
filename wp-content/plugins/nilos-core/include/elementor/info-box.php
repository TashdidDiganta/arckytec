<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class NILOS_Info_Box extends Widget_Base {

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
		return 'nilos-info-box';
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
		return __( 'Info Box', 'arc-core' );
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

     protected static function get_profile_names()
     {
         return [
             '500px' => esc_html__('500px', 'arc-core'),
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }  

    protected function register_controls_section(){
        // layout Panel
        $this->start_controls_section(
            'nilos_layout',
            [
                'label' => esc_html__('Design Layout', 'arc-core'),
            ]
        );
        $this->add_control(
            'nilos_design_style',
            [
                'label' => esc_html__('Select Layout', 'arc-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'arc-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->nilos_section_title_render_controls('info', 'Section Title');

        $this->start_controls_section(
         'nilos_info_sec',
             [
               'label' => esc_html__( 'Info List', 'arc-core' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        
        $this->add_control(
         'nilos_info_bottom_quote',
            [
                'label'       => esc_html__( 'Bottom Quote Text', 'arc-core' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__( 'So start browsing today and find the perfect ', 'arc-core' ),
                'placeholder' => esc_html__( 'Your Text', 'arc-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'arc-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'arc-core' ),
                    'style_2' => __( 'Style 2', 'arc-core' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'nilos_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'arc-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'arc-core'),
                    'icon' => esc_html__('Icon', 'arc-core'),
                    'svg' => esc_html__('SVG', 'arc-core'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );
        $repeater->add_control(
            'nilos_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'arc-core'),
                'condition' => [
                    'nilos_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'nilos_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'arc-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'nilos_box_icon_type' => 'image',
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        if (nilos_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'nilos_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'nilos_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'nilos_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'nilos_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        }


        $repeater->add_control(
            'nilos_info_title', [
                'label' => esc_html__('Title', 'arc-core'),
                'description' => nilos_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Info Title', 'arc-core'),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'nilos_info_link_switcher',
            [
                'label' => esc_html__( 'Add Info link', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'arc-core' ),
                'label_off' => esc_html__( 'No', 'arc-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'nilos_info_link_type',
            [
                'label' => esc_html__( 'Info Link Type', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'nilos_info_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'nilos_info_link',
            [
                'label' => esc_html__( 'Info Link', 'arc-core' ),
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
                    'nilos_info_link_type' => '1',
                    'nilos_info_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'nilos_info_page_link',
            [
                'label' => esc_html__( 'Select Info Link Page', 'arc-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => nilos_get_all_pages(),
                'condition' => [
                    'nilos_info_link_type' => '2',
                    'nilos_info_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'nilos_info_list',
            [
                'label' => esc_html__('Info - List', 'arc-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'nilos_info_title' => esc_html__('Business Stratagy', 'arc-core'),
                    ],
                    [
                        'nilos_info_title' => esc_html__('Website Development', 'arc-core')
                    ],
                    [
                        'nilos_info_title' => esc_html__('Marketing & Reporting', 'arc-core')
                    ]
                ],
                'title_field' => '{{{ nilos_info_title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
            ]
        );

        
        $this->end_controls_section();

        // colum controls
        $this->nilos_columns('col');
    
    }

    protected function style_tab_content(){
        $this->nilos_section_style_controls('history_section', 'Section - Style', '.nilos-el-section');
        $this->nilos_basic_style_controls('history_subtitle', 'Section - Subtitle', '.nilos-el-subtitle');
        $this->nilos_basic_style_controls('history_title', 'Section - Title', '.nilos-el-title');
        $this->nilos_basic_style_controls('history_description', 'Section - Description', '.nilos-el-content p');

        $this->nilos_link_controls_style('portfolio_description', 'Box - Button', '.nilos-el-box-btn');
        $this->nilos_link_controls_style('slider_social_link', 'Social - Link', '.nilos-el-social-link');
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

		<?php if ( $settings['nilos_design_style']  == 'layout-2' ): 
            
        ?>

		<?php else: 
              $this->add_render_attribute('title_args', 'class', 'nilos-work-section-title nilos-el-title');
		?>	

         <!-- work area start -->
         <section class="nilos-work-area pt-115 pb-95">
            <div class="container">
            <?php if ( !empty($settings['nilos_info_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xl-6">
                     <div class="nilos-work-section-title-wrapper text-center mb-60">

                        <?php if(!empty($settings['nilos_info_sub_title' ])): ?>
                        <span class="nilos-work-section-subtitle nilos-el-subtitle"><?php echo nilos_kses( $settings['nilos_info_sub_title' ] ) ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['nilos_info_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['nilos_info_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    nilos_kses( $settings['nilos_info_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['nilos_info_description']) ) : ?>
                            <p><?php echo nilos_kses( $settings['nilos_info_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
               <?php endif; ?>

               <div class="row">
               <?php foreach ($settings['nilos_info_list'] as $key => $item) :

                    // Link
                    if ('2' == $item['nilos_info_link_type']) {
                        $link = get_permalink($item['nilos_info_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['nilos_info_link']['url']) ? $item['nilos_info_link']['url'] : '';
                        $target = !empty($item['nilos_info_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['nilos_info_link']['nofollow']) ? 'nofollow' : '';
                    }
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['nilos_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['nilos_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['nilos_col_for_tablet']); ?> col-<?php echo esc_attr($settings['nilos_col_for_mobile']); ?>">
                     <div class="nilos-work-item mb-35 text-center">
                        <div class="nilos-work-icon d-flex align-items-end justify-content-center">
                            <?php if($item['nilos_box_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['nilos_box_icon']) || !empty($item['nilos_box_selected_icon']['value'])) : ?>
                                        <span><?php nilos_render_icon($item, 'nilos_box_icon', 'nilos_box_selected_icon'); ?></span>
                                <?php endif; ?>
                            <?php elseif( $item['nilos_box_icon_type'] == 'image' ) : ?>
                                <span>
                                    <?php if (!empty($item['nilos_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $item['nilos_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['nilos_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                </span>
                            <?php else : ?>
                                <span>
                                    <?php if (!empty($item['nilos_box_icon_svg'])): ?>
                                    <?php echo $item['nilos_box_icon_svg']; ?>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="nilos-work-content">
                            <?php if (!empty($item['nilos_info_title' ])): ?>
                            <h4 class="nilos-work-title nilos-el-box-title">
                                <?php if ($item['nilos_info_link_switcher'] == 'yes') : ?>
                                <a href="<?php echo esc_url($link); ?>"><?php echo nilos_kses($item['nilos_info_title' ]); ?></a>
                                <?php else : ?>
                                    <?php echo nilos_kses($item['nilos_info_title' ]); ?>
                                <?php endif; ?>
                            </h4>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
               <?php if (!empty($settings['nilos_info_bottom_quote'])): ?>
               <div class="row justify-content-center">
                  <div class="col-xl-4">
                     <div class="nilos-work-quote text-center">
                        <p><?php echo nilos_kses($settings['nilos_info_bottom_quote']); ?></p>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </section>
         <!-- work area end -->

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new NILOS_Info_Box() );