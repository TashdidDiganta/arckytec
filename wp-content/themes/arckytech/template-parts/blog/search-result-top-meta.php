<?php
    $author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
    $author_name = get_the_author_meta( 'arckytech_write_by');
    $facebook_url = get_the_author_meta( 'arckytech_facebook' );
    $twitter_url = get_the_author_meta( 'arckytech_twitter' );
    $linkedin_url = get_the_author_meta( 'arckytech_linkedin' );
    $instagram_url = get_the_author_meta( 'arckytech_instagram' );
    $arckytech_url = get_the_author_meta( 'arckytech_youtube' );
    $arckytech_write_by = get_the_author_meta( 'arckytech_write_by' );
    $author_bio_avatar_size = 180;


    $categories = get_the_terms( $post->ID, 'category' );
    $arckytech_blog_date = get_theme_mod( 'arckytech_blog_date', true );
    $arckytech_blog_comments = get_theme_mod( 'arckytech_blog_comments', true );
    $arckytech_blog_author = get_theme_mod( 'arckytech_blog_author', true );
    $arckytech_blog_cat = get_theme_mod( 'arckytech_blog_cat', false );
    $arckytech_blog_view = get_theme_mod( 'arckytech_blog_view', false );
?>

    <div class="search__blog-meta-wrapper d-flex flex-wrap align-items-center">

        <?php if ( !empty( $categories[0]->name ) ): ?>  
        <div class="search__blog-tag mr-15">
            <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
        </div>
        <?php endif;?>

        <?php if ( !empty($arckytech_blog_date) ): ?>
        <div class="search__blog-meta">
            <span>
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.5 14C11.0899 14 14 11.0899 14 7.5C14 3.91015 11.0899 1 7.5 1C3.91015 1 1 3.91015 1 7.5C1 11.0899 3.91015 14 7.5 14Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M7.5 3.59961V7.49961L10.1 8.79961" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg> 
                <?php the_time( get_option('date_format') ); ?> 
            </span>
        </div>
        <?php endif;?>
    </div>


