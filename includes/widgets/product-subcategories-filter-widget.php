<?php

class Product_Subcategories_Filter_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'product_subcategories_filter',
            'Subcategorie',
            [
                'description' => 'Filtreaza dupa subcategorie.'
            ]
        );
    }

    public function widget($args, $instance)
    {
        if (! empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        $categories = get_terms(array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'parent'     => 0, // Only top-level categories
        ));

        if (! empty($categories)) {
            echo '<ul>';
            foreach ($categories as $category) {
                echo '<li><a href="' . get_term_link($category) . '">' . $category->name . '</a></li>';
            }
            echo '</ul>';
        }

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = ! empty($instance['title']) ? $instance['title'] : __('Subcategorie', 'textdomain');
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
