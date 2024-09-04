<?php
class Custom_Contact_Widget extends WP_Widget {

    // Constructor function
    public function __construct() {
        parent::__construct(
            'Custom_Contact_Widget',  // Widget ID
            'Arckytech Contact Widget',  // Widget name
            array(
                'description' => 'A custom widget to display categories in the sidebar.'
            )
        );
    }

  
    // Widget frontend
    public function widget($args, $instance) {
        echo $args['before_widget'];

        ?>
         <!-- Widget content -->
          <div class="footer-widget__contact">
            <div class="footer-widget__title-box">
                <h3 class="footer-widget__title"> <?php echo esc_html($instance['title']); ?></h3>
            </div>
             <p class="footer-widget__contact-text"> <?php echo esc_html($instance['info_1']); ?></p>

             <ul class="list-unstyled footer-widget__contact-list">
                <li>
                    <div class="icon">
                        <span class="icon-envelope"></span>
                    </div>
                    <div class="text">
                        <p><a href="#"><?php echo esc_html($instance['info_2']); ?></a></p>
                    </div>
                </li>
                <li>
                  <div class="icon">
                       <span class="icon-envelope"></span>
                    </div>
                    <div class="text">
                        <p><a href="#"><?php echo esc_html($instance['info_3']); ?></a></p>
                    </div>
                </li>
                <li>
                    <div class="icon">
                        <span class="icon-worldwide"></span>
                    </div>
                    <div class="text">
                        <p><a href="#"><?php echo esc_html($instance['info_4']); ?></a></p>
                    </div>
                </li>
             </ul>
          </div>
          <?php
        echo $args['after_widget'];
    }

    // Widget form
    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $info_1 = isset($instance['info_1']) ? esc_attr($instance['info_1']) : '';
        $info_2 = isset($instance['info_2']) ? esc_attr($instance['info_2']) : '';
        $info_3 = isset($instance['info_3']) ? esc_attr($instance['info_3']) : '';
        $info_4 = isset($instance['info_1']) ? esc_attr($instance['info_4']) : '';

        // Widget title field
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'arckytec'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
        </p>
        
        <!-- Widget content field -->
        <p>
            <label for="<?php echo $this->get_field_id('info_1'); ?>"><?php _e('Info 1:', 'arckytec'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('info_1'); ?>" name="<?php echo $this->get_field_name('info_1'); ?>" type="text" value="<?php echo $info_1; ?>">
        </p>

        <!-- Widget content field -->
        <p>
            <label for="<?php echo $this->get_field_id('info_2'); ?>"><?php _e('Info 2:', 'arckytec'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('info_2'); ?>" name="<?php echo $this->get_field_name('info_2'); ?>" type="text" value="<?php echo $info_2; ?>">
        </p>

        <!-- Widget content field -->
        <p>
            <label for="<?php echo $this->get_field_id('info_3'); ?>"><?php _e('Info 3:', 'arckytec'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('info_3'); ?>" name="<?php echo $this->get_field_name('info_3'); ?>" type="text" value="<?php echo $info_3; ?>">
        </p>

        <!-- Widget content field -->
        <p>
            <label for="<?php echo $this->get_field_id('info_4'); ?>"><?php _e('Info 4:', 'arckytec'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('info_4'); ?>" name="<?php echo $this->get_field_name('info_4'); ?>" type="text" value="<?php echo $info_4; ?>">
        </p>
        <?php
    }

    // Widget update
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['info_1'] = (!empty($new_instance['info_1'])) ? sanitize_text_field($new_instance['info_1']) : '';
        $instance['info_2'] = (!empty($new_instance['info_2'])) ? sanitize_text_field($new_instance['info_2']) : '';
        $instance['info_3'] = (!empty($new_instance['info_3'])) ? sanitize_text_field($new_instance['info_3']) : '';
        $instance['info_4'] = (!empty($new_instance['info_4'])) ? sanitize_text_field($new_instance['info_4']) : '';

        return $instance;
    }
}


add_action('widgets_init', function(){
	register_widget('Custom_Contact_Widget');
});
