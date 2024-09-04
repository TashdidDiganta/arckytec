<?php 
class NilosServicesPost 
{
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'init', array( $this, 'create_cat' ) );
		add_filter( 'template_include', array( $this, 'services_template_include' ) );
		// add_filter( 'pre_get_posts', array( $this, 'posts_per_page' ) );
		add_action( 'add_meta_boxes', array( $this, 'metafields') );
		add_action( 'admin_enqueue_scripts',  array( $this, 'service_icon_scripts') );
		add_action( 'save_post', [ $this, 'save_metafields' ] );
	}

	public function save_metafields( int $post_id ){
		if ( array_key_exists( '_iconfield', $_POST ) ) {
			update_post_meta(
				$post_id,
				'_iconfield',
				$_POST['_iconfield']
			);
		}
	}

	public function service_icon_scripts(){
		wp_register_script('arc-iconpicker', plugins_url( 'assets/js/icon-picker.js', __DIR__ ), false, '1.0');
		wp_register_style('arc-iconpicker', plugins_url( 'assets/css/icon-picker.css', __DIR__ ), false, '1.0');
		wp_register_style('arc-icon', get_parent_theme_file_uri() . '/assets/css/style.css', false, '1.0');
	}

	public function metafields(){
		$screens = [ 'services' ];
		foreach ( $screens as $screen ) {
			add_meta_box(
				'_service_icon',                 // Unique ID
				'Service Icon',      // Box title
				array( $this, 'service_icon_html'),  // Content callback, must be of type callable
				$screen,                      // Post type
				'side'
			);
		}
	}

	public function service_icon_html( $post ){
		wp_enqueue_style( 'arc-iconpicker');
		wp_enqueue_script('arc-iconpicker');
		wp_enqueue_style( 'arc-icon');
		$_iconfield  = get_post_meta( $post->ID, '_iconfield', true);
		?>
		<div class="service-icons">
			<div class="arc-field-iconfield description description-wide">
				<label for="_iconfield">
					<?php esc_html_e( 'Icon Field', 'arc-core'  ); ?><br />
					<input type="text" class="widefat code edit-menu-item-custom arcicon-picker" id="_iconfield" name="_iconfield" value="<?php echo esc_attr( $_iconfield ); ?>"/>

				</label>
				<div class="arc-iconsholder-wrapper">
					<div class="arc-iconsholder">
						<input type="text" class="iconsearch" placeholder="<?php esc_attr_e('Search icon...','arc-core'); ?>">
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public function posts_per_page( $query ){
		$query->query_vars['posts_per_page'] = 2;
		return $query;
	}
	
	public function services_template_include( $template ) {
		if ( is_singular( 'services' ) ) {
			return $this->get_template( 'single-services.php');
		}
		if ( is_archive( 'services' ) ) {
			return $this->get_template( 'archive-services.php');
		}
		return $template;
	}
	
	public function get_template( $template ) {
		if ( $theme_file = locate_template( array( $template ) ) ) {
			$file = $theme_file;
		} 
		else {
			$file = NILOS_ADDONS_DIR . '/include/template/'. $template;
		}
		return apply_filters( __FUNCTION__, $file, $template );
	}
	
	
	public function register_custom_post_type() {
		$nilos_serv_slug = get_theme_mod( 'nilos_serv_slug', __( 'services', 'arc-core' ) );
		$labels = array(
			'name'                  => esc_html_x( 'Services', 'Post Type General Name', 'arc-core' ),
			'singular_name'         => esc_html_x( 'Service', 'Post Type Singular Name', 'arc-core' ),
			'menu_name'             => esc_html__( 'Services', 'arc-core' ),
			'name_admin_bar'        => esc_html__( 'Service', 'arc-core' ),
			'archives'              => esc_html__( 'Item Archives', 'arc-core' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'arc-core' ),
			'all_items'             => esc_html__( 'All Items', 'arc-core' ),
			'add_new_item'          => esc_html__( 'Add New Service', 'arc-core' ),
			'add_new'               => esc_html__( 'Add New', 'arc-core' ),
			'new_item'              => esc_html__( 'New Item', 'arc-core' ),
			'edit_item'             => esc_html__( 'Edit Item', 'arc-core' ),
			'update_item'           => esc_html__( 'Update Item', 'arc-core' ),
			'view_item'             => esc_html__( 'View Item', 'arc-core' ),
			'search_items'          => esc_html__( 'Search Item', 'arc-core' ),
			'not_found'             => esc_html__( 'Not found', 'arc-core' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'arc-core' ),
			'featured_image'        => esc_html__( 'Featured Image', 'arc-core' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'arc-core' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'arc-core' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'arc-core' ),
			'inserbt_into_item'     => esc_html__( 'Insert into item', 'arc-core' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'arc-core' ),
			'items_list'            => esc_html__( 'Items list', 'arc-core' ),
			'items_list_navigation' => esc_html__( 'Items list navigation', 'arc-core' ),
			'filter_items_list'     => esc_html__( 'Filter items list', 'arc-core' ),
		);

		$args   = array(
			'label'                 => esc_html__( 'Service', 'arc-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-shield',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array(
				'slug' => $nilos_serv_slug,
				'with_front' => false
			),
		);

		register_post_type( 'services', $args );
	}
	
	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x( 'Service Categories', 'Taxonomy General Name', 'arc-core' ),
			'singular_name'              => esc_html_x( 'Service Categories', 'Taxonomy Singular Name', 'arc-core' ),
			'menu_name'                  => esc_html__( 'Service Categories', 'arc-core' ),
			'all_items'                  => esc_html__( 'All Service Category', 'arc-core' ),
			'parent_item'                => esc_html__( 'Parent Item', 'arc-core' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'arc-core' ),
			'new_item_name'              => esc_html__( 'New Service Category Name', 'arc-core' ),
			'add_new_item'               => esc_html__( 'Add New Service Category', 'arc-core' ),
			'edit_item'                  => esc_html__( 'Edit Service Category', 'arc-core' ),
			'update_item'                => esc_html__( 'Update Service Category', 'arc-core' ),
			'view_item'                  => esc_html__( 'View Service Category', 'arc-core' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'arc-core' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'arc-core' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'arc-core' ),
			'popular_items'              => esc_html__( 'Popular Service Category', 'arc-core' ),
			'search_items'               => esc_html__( 'Search Service Category', 'arc-core' ),
			'not_found'                  => esc_html__( 'Not Found', 'arc-core' ),
			'no_terms'                   => esc_html__( 'No Service Category', 'arc-core' ),
			'items_list'                 => esc_html__( 'Service Category list', 'arc-core' ),
			'items_list_navigation'      => esc_html__( 'Service Category list navigation', 'arc-core' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('services-cat','services', $args );
	}

}

new NilosServicesPost();