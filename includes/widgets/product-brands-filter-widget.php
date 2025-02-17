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


        $current_category_id = 0;
        if (is_product_category()) {
            $current_category = get_queried_object();
            $current_category_id = $current_category->term_id;
        }

        if ($current_category_id) {

            $brands = get_terms(array(
                'taxonomy'   => 'brand',
                'hide_empty' => false,
                'meta_query' => array(
                    array(
                        'key'     => 'product_cat',
                        'value'   => $current_category_id,
                        'compare' => 'LIKE',
                    ),
                ),
            ));
        } else {
            // Get all brands
            $brands = get_terms(array(
                'taxonomy'   => 'brand',
                'hide_empty' => false,
            ));
        }

        if (empty($brands)) return;

        echo '<div class="shop-filter-widget-container">';

        echo '<h3 class="filter-widget-title">Brand</h3>';

        echo '<ul class="filter-widget-list">';
        foreach ($brands as $brand) {
            echo '<li class="filter-widget-list-item"><a href="' . get_term_link($brand) . '">' . $brand->name . '</a></li>';
        }
        echo '</ul>';


        echo '</div>';
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
