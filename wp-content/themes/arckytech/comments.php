<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */
?>
<?php
// If the current post is protected by a password and the visitor has not yet 
// entered the password we will return early without loading the comments.
// ----------------------------------------------------------------------------------------
if ( post_password_required() ) {
    return;
}
?>

<?php if ( have_comments() || comments_open()) : ?>
<div id="comments" class="blog-post-comment arc-postbox-details-comment-wrapper comment-one__box">

    <?php if ( get_comments_number() >= 1 ): ?>
    <div class="news-details__comment">
        <div class="comment-one">
            <?php
                $comment_no = number_format_i18n( get_comments_number() );
                $comment_text = ( !empty( $comment_no ) AND ( $comment_no > 1 ) ) ? esc_html__( ' Comments', 'arckytec' ) : esc_html__( ' Comment ', 'arckytec' );
                $comment_no = ( !empty( $comment_no ) AND ( $comment_no > 0 ) ) ? '<h3 class="comment-one__title">' . esc_html( $comment_text ) . '<span> ('.$comment_no.')</span></h3>' : ' ';
                print sprintf( "%s", $comment_no );
            ?>

            <div class="arc-postbox-details-comment-inner latest-comments comment-one__single">
                <ul>
                    <?php
                        wp_list_comments( [
                            'style'       => 'ul',
                            'callback'    => 'arckytech_comment',
                            'avatar_size' => 90,
                            'short_ping'  => true,
                        ] );
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif;?>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
        <div class="comment-pagination mb-50 d-none">
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'arckytec' );?></h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="nav-previous "><?php previous_comments_link( esc_html__( '&larr; Older ', 'arckytec' ) );?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="nav-next "><?php next_comments_link( esc_html__( 'Newer &rarr;', 'arckytec' ) );?></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </nav><!-- #comment-nav-below -->
        </div>
    <?php endif; // check for comment navigation ?>


    <?php
    $post_id = '';
    if ( null === $post_id ){
        $post_id = get_the_ID();
    }else{
        $id   = $post_id;
    }

    $commenter       = wp_get_current_commenter();
    $user            = wp_get_current_user();
    $user_identity   = $user->exists() ? $user->display_name : '';


    $req         = get_option( 'require_name_email' );
    $aria_req    = ( $req ? " aria-required='true'" : '' );

    $fields = array(
        'author' => '<div class="row"><div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12"><div class="comment-form__input-box contact-one__input-box"><input placeholder="'.  esc_attr__('Name', 'arckytec').'" id="author" class="arc-form-control" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" size="30"' . $aria_req . ' /></div></div>',
        'email'  => '<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12"><div class="comment-form__input-box contact-one__input-box"><input placeholder="'.  esc_attr__('Email', 'arckytec').'" id="email" name="email" class="arc-form-control" type="email" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" size="30"' . $aria_req . ' /></div></div>',
        'url'    => '<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12"><div class="comment-form__input-box contact-one__input-box"><input placeholder="'.  esc_attr__('Website', 'arckytec').'" id="url" name="url" class="arc-form-control" type="url" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '"  size="30" /></div></div></div>'
    );

    if ( is_user_logged_in() ) {
        $cl = 'loginformuser';
    } else {
        $cl = '';
    }
    $defaults = [
        'fields'             => $fields,
        'comment_field'      => '
            <div class="row">
                <div class="col-md-12 ' . $cl . '">
                    <div class="comment-form__input-box contact-one__input-box text-message-box"><textarea class="arc-form-control msg-box" placeholder="'.  esc_attr__(' Comment', 'arckytec').'" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                </div></div>
                <div class="clearfix"></div>
            </div>
        ',
        'submit_button'    => '<div class="col-xl-12 contact-one__btn-box"><button class="contact-page__btn button-style-1" type="submit">' . esc_html__( 'Submit Request', 'arckytec' ) . '<span></span></button></div>',
        /** This filter is documented in wp-includes/link-template.php */
        'must_log_in'        => '
            <p class="must-log-in">
            '.esc_html__('You must be','arckytec').' <a href="'.esc_url(wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )).'">'.esc_html__('logged in','arckytec').'</a> '.esc_html__('to post a comment.','arckytec').'
            </p>',
        /** This filter is documented in wp-includes/link-template.php */
        'logged_in_as'       => '
            <p class="logged-in-as">
            '.esc_html__('Logged in as','arckytec').' <a href="'.esc_url(get_edit_user_link()).'">'.esc_html($user_identity).'</a>. <a href="'.esc_url(wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )).'" title="'.esc_attr__('Log out of this account','arckytec').'">'.esc_html__('Log out?','arckytec').'</a>
            </p>',
        'id_form'            => 'commentform',
        'id_submit'          => 'submit',
        'class_submit'       => 'contact-page__btn',
        'title_reply'        => esc_html__( 'Leave A Comment', 'arckytec' ),
        'title_reply_before' => '<div class="comment-form__title-box"><h3 class="comment-form__title">',
        'title_reply_after'  => '</h3></div>',
        'title_reply_to'     => esc_html__( 'Leave a Reply to %s', 'arckytec' ),
        'cancel_reply_link'  => esc_html__( 'Cancel reply', 'arckytec' ),
        'label_submit'       => esc_html__( 'Submit Comment', 'arckytec' ),
        'format'             => 'xhtml',
    ];

    comment_form( $defaults );
    ?>

</div><!-- #comments -->
<?php endif;