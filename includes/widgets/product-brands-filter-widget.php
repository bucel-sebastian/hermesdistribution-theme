<?php

class Product_Brands_Filter_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'brand_filter',
            __('Brand', 'textdomain'),
            array('description' => __('Filtreaza dupa brand.', 'textdomain'))
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (! empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        $brands = get_terms(array(
            'taxonomy'   => 'brand',
            'hide_empty' => true,
        ));

        if (! empty($brands)) {
            echo '<ul>';
            foreach ($brands as $brand) {
                echo '<li><a href="' . get_term_link($brand) . '">' . $brand->name . '</a></li>';
            }
            echo '</ul>';
        }

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = ! empty($instance['title']) ? $instance['title'] : 'Brand';
?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = ! empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}
