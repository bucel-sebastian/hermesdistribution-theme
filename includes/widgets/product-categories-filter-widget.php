<?php

class Product_Categories_Filter_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'product_categories_filter',
            'Categorie',
            [
                'description' => 'Filtreaza dupa categorie.'
            ]
        );
    }

    public function widget($args, $instance)
    {

        $current_category_id = 0;
        if (is_product_category()) {
            $current_category = get_queried_object();
            $current_category_id = $current_category->term_id;
        }

        $categories = get_terms(array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'parent'     => $current_category_id ? $current_category_id : 0,
        ));

        if (empty($categories)) return;

        echo '<div class="shop-filter-widget-container">';

        echo '<h3 class="filter-widget-title">Categorie</h3>';

        echo '<ul class="filter-widget-list">';
        foreach ($categories as $category) {
            echo '<li class="filter-widget-list-item"><a href="' . get_term_link($category) . '">' . $category->name . '</a></li>';
        }
        echo '</ul>';

        echo '</div>';
    }

    public function form($instance)
    {
        $title = ! empty($instance['title']) ? $instance['title'] : __('Categorie', 'textdomain');
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
