<?php
add_filter( 'tp_meta_boxes', 'themepure_metabox' );
function themepure_metabox( $meta_boxes ) {
    $meta_boxes[] = array(
        'metabox_id'       => '_team_custom_meta_id',
        'title'    => esc_html__( 'Skills & Socials', 'arc-core' ),
        'post_type'=> 'team', // page, custom post type name
        'context'  => 'normal',
        'priority' => 'core',
        'fields'   => array(
            array(
                'label'     => esc_html__('Progress Item', 'arc-core'),
                'id'        => "_team_custom_meta_id",
                'type'      => 'repeater', // specify the type "repeater" (case sensitive)
                'conditional'   => array(),
                'default'       => array(),
                'fields'        => array(
                    array(
                        'label' => 'Progress Title',
                        'id'    => "_progress_title",
                        'type'  => 'text', // specify the type field
                        'placeholder' => 'Type Your Title',
                        'default' => 'Architecture', // do not remove default key
                    ),
                    array(
                        'label' => 'Progress Number',
                        'id'    => "_progress_value",
                        'type'  => 'text', // specify the type field
                        'placeholder' => 'Type Your progress Number',
                        'default' => '90', // do not remove default key
                    ),
                )
            ),
            array(
                'label'     => esc_html__('Social', 'arc-core'),
                'id'        => "_team_social_meta_id",
                'type'      => 'repeater', // specify the type "repeater" (case sensitive)
                'conditional'   => array(),
                'default'       => array(),
                'fields'        => array(
                    array(
                        'label'           => esc_html__('Select a social media', 'arc-core'),
                        'id'              => "_team_social_id",
                        'type'            => 'select',
                        'options'         => array(
                            'icon-facebook' => 'Facebook',
                            'icon-twitter'  => 'Twitter ',
                            'icon-linkedin' => 'Linkedin in',
                            'icon-instagram'=> 'Instagram',
                        ),
                        'placeholder'     => 'Select an item'
                    ),
                    array(
                        'label' => 'Social url',
                        'id'    => "_url_value",
                        'type'  => 'text', // specify the type field
                        'placeholder' => 'Type Your Social Url',
                        'default' => 'http//facebook.com', // do not remove default key
                    ),
                )
            )

        ),
    );

    return $meta_boxes;
}

?>




