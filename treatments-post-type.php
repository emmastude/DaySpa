
<?php 
/* register the new post type: treatment */
function treatments_register_post_type() {
    add_theme_support('post-thumbnails');

    $labels = array(
        'name' => 'Treatments',
        'singular_name' => 'Treatment',
        'add_new' => 'New treatment',
        'add_new_item'=> 'Add new treatment',
        'edit_item' => 'Edit treatment',
        'new_item' => 'New treatment',
        'view_item' => 'View treatment',
        'search_item' => 'Search treatments',
        'not found' => 'No treatments found',
        'not_found_in_trash' => 'No treatments were found in the trash'
    );

    $args = array (
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical'=> false,
        'supports' => array (
            'title',
            'editor',
            'thumbnail',
            'custom-fields'
        ),
        'rewrite' => array('slug' => 'tuote'),
        'show_in_rest' => true
    );
    register_post_type('spatreatments', $args);
}
add_action('init', 'treatments_register_post_type');

/* Adding price box */
function treatments_add_custom_box() {
    add_meta_box (
        't_price_id', 
        'Price',
        't_price_box_html', 
        't_product'

    );
}
add_action('add_meta_boxes', 'treatments_add_custom_box');

function t_price_box_html($post) {
    $value = get_post_meta($post->ID, 't_meta_price', true);
   ?>
   <label for="t_price">Price</label>
   <input type="text" name="t_price" id="t_price" value="<?php echo $value; ?>">

   <?php

}

/* Save post meta */
function t_save_postdata ($post_id) {
    if(array_key_exists('t_price', $_POST )):
        update_post_meta(
            $post_id,
            't_meta_price',
           sanitize_text_field($_POST['t_price'])
        );

    endif;
}
add_action('save_post', 't_save_postdata');

/* Register new taxonomy: treatment category */
function treatments_register_taxonomy() {
    $labels = array (
        'name' => 'Categories of treatments',
        'singular_name' => 'Category of treatment',
        'search_items' => 'Search treatment categories',
        'all_items' => 'All treatment categories',
        'edit_item' => 'Edit treatment category ',
        'update_item' => 'Update treatment category',
        'add_new_item' => 'Add treatment category',
        'new_item_name' => 'The name of the new treatment category',
        'menu_name' => 'Categories of treatments'

    );
    $args = array(
        'labels' => $labels,
        'hierarchial' => true,
        'sort' => true,
        'orderby' => array('orderby'=> 'term_order'),
        'rewrite' => array('slug' => 'treatment-category'),
        'show_admin_column' => true,
        'show_in_rest' => true

    );
    register_taxonomy('treatments_category', array('spatreatments'), $args);
    
}

add_action('init', 'treatments_register_taxonomy');
?>