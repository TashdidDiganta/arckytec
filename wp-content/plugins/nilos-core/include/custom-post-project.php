<?php 
class NILOSProjectPost 
{
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'init', array( $this, 'create_cat' ) );
		add_action( 'init', array( $this, 'create_tag' ) );
		add_filter( 'template_include', array( $this, 'portfolio_template_include' ) );
		add_action( 'wp_ajax_load_portfolio', array( $this, 'load_ajax_portfolios' ) );
	}

	public function load_ajax_portfolios(){
		if(isset($_REQUEST['security']) && !wp_verify_nonce($_REQUEST['security'], 'project')){
			return;
		}
		$query = new WP_Query(array(
			'post_type'     => 'project',
			'post_status'   => 'publish',
			'posts_per_page'=> 2,
			'paged'			=> $_REQUEST['page']
		));
		if($query->have_posts()): 
		while($query->have_posts()): $query->the_post(); 
		$terms = array();
		foreach(get_the_terms(get_the_ID(), 'project-cat') as $term){
			$terms[]    = $term->slug;
		}?>
		<!--Project Page Single Start-->
		<div class="col-xl-6 col-lg-6 col-md-6 filter-item <?php echo esc_attr(implode(' ', $terms)); ?>">
			<div class="project-page__single">
				<div class="project-page__img">
					<?php
						if(has_post_thumbnail()){
							the_post_thumbnail();
						}
					?>
					<div class="project-page__content">
						<p class="project-page__sub-title"><?php echo esc_html(implode(',', $terms)); ?></p>
						<h4 class="project-page__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					</div>
				</div>
			</div>
		</div>
		<!--Project Page Single End-->
		<?php endwhile;
		wp_reset_postdata();
		endif; 
		die();
	}
	
	public function portfolio_template_include( $template ) {
		if ( is_singular( 'project' ) ) {
			return $this->get_template( 'single-project.php');
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
		$labels = array(
			'name'                  => esc_html_x( 'Projects', 'Post Type General Name', 'arc-core' ),
			'singular_name'         => esc_html_x( 'Project', 'Post Type Singular Name', 'arc-core' ),
			'menu_name'             => esc_html__( 'Projects', 'arc-core' ),
			'name_admin_bar'        => esc_html__( 'Project', 'arc-core' ),
			'archives'              => esc_html__( 'Item Archives', 'arc-core' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'arc-core' ),
			'all_items'             => esc_html__( 'All Items', 'arc-core' ),
			'add_new_item'          => esc_html__( 'Add New Project', 'arc-core' ),
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
			'label'                 => esc_html__( 'Project', 'arc-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-index-card',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array(
				'slug' => 'nilos-portfolios',
				'with_front' => false
			),
		);

		register_post_type( 'project', $args );
	}
	
	public function create_tag() {
		$labels = array(
			'name'                       => esc_html_x( 'Project Tags', 'Taxonomy General Name', 'arc-core' ),
			'singular_name'              => esc_html_x( 'Project Tags', 'Taxonomy Singular Name', 'arc-core' ),
			'menu_name'                  => esc_html__( 'Project Tags', 'arc-core' ),
			'all_items'                  => esc_html__( 'All Project Tag', 'arc-core' ),
			'parent_item'                => esc_html__( 'Parent Item', 'arc-core' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'arc-core' ),
			'new_item_name'              => esc_html__( 'New Project Tag Name', 'arc-core' ),
			'add_new_item'               => esc_html__( 'Add New Project Tag', 'arc-core' ),
			'edit_item'                  => esc_html__( 'Edit Project Tag', 'arc-core' ),
			'update_item'                => esc_html__( 'Update Project Tag', 'arc-core' ),
			'view_item'                  => esc_html__( 'View Project Tag', 'arc-core' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'arc-core' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'arc-core' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'arc-core' ),
			'popular_items'              => esc_html__( 'Popular Project Tag', 'arc-core' ),
			'search_items'               => esc_html__( 'Search Project Tag', 'arc-core' ),
			'not_found'                  => esc_html__( 'Not Found', 'arc-core' ),
			'no_terms'                   => esc_html__( 'No Project Tag', 'arc-core' ),
			'items_list'                 => esc_html__( 'Project Tag list', 'arc-core' ),
			'items_list_navigation'      => esc_html__( 'Project Tag list navigation', 'arc-core' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('project-tag','project', $args );
	}

	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x( 'Project Categories', 'Taxonomy General Name', 'arc-core' ),
			'singular_name'              => esc_html_x( 'Project Categories', 'Taxonomy Singular Name', 'arc-core' ),
			'menu_name'                  => esc_html__( 'Project Categories', 'arc-core' ),
			'all_items'                  => esc_html__( 'All Project Category', 'arc-core' ),
			'parent_item'                => esc_html__( 'Parent Item', 'arc-core' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'arc-core' ),
			'new_item_name'              => esc_html__( 'New Project Category Name', 'arc-core' ),
			'add_new_item'               => esc_html__( 'Add New Project Category', 'arc-core' ),
			'edit_item'                  => esc_html__( 'Edit Project Category', 'arc-core' ),
			'update_item'                => esc_html__( 'Update Project Category', 'arc-core' ),
			'view_item'                  => esc_html__( 'View Project Category', 'arc-core' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'arc-core' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'arc-core' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'arc-core' ),
			'popular_items'              => esc_html__( 'Popular Project Category', 'arc-core' ),
			'search_items'               => esc_html__( 'Search Project Category', 'arc-core' ),
			'not_found'                  => esc_html__( 'Not Found', 'arc-core' ),
			'no_terms'                   => esc_html__( 'No Project Category', 'arc-core' ),
			'items_list'                 => esc_html__( 'Project Category list', 'arc-core' ),
			'items_list_navigation'      => esc_html__( 'Project Category list navigation', 'arc-core' ),
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

		register_taxonomy('project-cat','project', $args );
	}

}

new NILOSProjectPost();