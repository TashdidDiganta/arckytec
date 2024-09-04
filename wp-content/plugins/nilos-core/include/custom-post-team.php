<?php 
class ArcTeamPost 
{
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'init', array( $this, 'create_cat' ) );
		add_filter( 'template_include', array( $this, 'team_template_include' ) );
		add_filter( 'progress_include', array( $this, 'repeter' ) );
	}
	
	public function team_template_include( $template ) {
		if ( is_singular( 'team' ) ) {
			return $this->get_template( 'single-team.php');
		}
		if ( is_archive( 'team' ) ) {
			return $this->get_template( 'archive-team.php');
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
		$nilos_serv_slug = get_theme_mod( 'nilos_serv_slug', __( 'team', 'arc-core' ) );
		$labels = array(
			'name'                  => esc_html_x( 'Teams', 'Post Type General Name', 'arc-core' ),
			'singular_name'         => esc_html_x( 'Team', 'Post Type Singular Name', 'arc-core' ),
			'menu_name'             => esc_html__( 'Teams', 'arc-core' ),
			'name_admin_bar'        => esc_html__( 'Service', 'arc-core' ),
			'archives'              => esc_html__( 'Item Archives', 'arc-core' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'arc-core' ),
			'all_items'             => esc_html__( 'All Items', 'arc-core' ),
			'add_new_item'          => esc_html__( 'Add New Member', 'arc-core' ),
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
			'label'                 => esc_html__( 'Team', 'arc-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title',  'post-formats', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-admin-users',
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



		register_post_type( 'team', $args, );
	}
	
	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x( 'Team Categories', 'Taxonomy General Name', 'arc-core' ),
			'singular_name'              => esc_html_x( 'Team Categories', 'Taxonomy Singular Name', 'arc-core' ),
			'menu_name'                  => esc_html__( 'Team Categories', 'arc-core' ),
			'all_items'                  => esc_html__( 'All Team Category', 'arc-core' ),
			'parent_item'                => esc_html__( 'Parent Item', 'arc-core' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'arc-core' ),
			'new_item_name'              => esc_html__( 'New Team Category Name', 'arc-core' ),
			'add_new_item'               => esc_html__( 'Add New Team Category', 'arc-core' ),
			'edit_item'                  => esc_html__( 'Edit Team Category', 'arc-core' ),
			'update_item'                => esc_html__( 'Update Team Category', 'arc-core' ),
			'view_item'                  => esc_html__( 'View Team Category', 'arc-core' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'arc-core' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'arc-core' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'arc-core' ),
			'popular_items'              => esc_html__( 'Popular Team Category', 'arc-core' ),
			'search_items'               => esc_html__( 'Search Team Category', 'arc-core' ),
			'not_found'                  => esc_html__( 'Not Found', 'arc-core' ),
			'no_terms'                   => esc_html__( 'No Team Category', 'arc-core' ),
			'items_list'                 => esc_html__( 'Team Category list', 'arc-core' ),
			'items_list_navigation'      => esc_html__( 'Team Category list navigation', 'arc-core' ),
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

		register_taxonomy('team-cat','teams', $args );
	}



}



new ArcTeamPost();