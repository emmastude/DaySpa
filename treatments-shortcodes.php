

<?php
function treatments_shortcode($treatments_attr) {
    $default = array (
        'category' => 'all'
    );
    $cat = shortcode_atts($default, $treatments_attr);

    if($cat['category'] == 'all'):
        $args = array(
            'post_type' => 'spatreatments',
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC'
        );

    else: 
        $args = array(
            'post_type' => 'spatreatments',
            'tax_query' => array (
                array (
                    'taxonomy' => 'treatments_category',
                    'field' => 'slug',
                    'terms' => $cat['category']
                )
                ),
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC'
        );

    endif;

    $text = '<div class="treatments">';
         $loop = new WP_Query($args);
         if ($loop->have_posts()):
            while($loop->have_posts()) : $loop->the_post();
                $price = get_post_meta(get_the_ID(), 't_meta_price', true);
                $text .= '<section class="treatment"><h3>' . get_the_title() . '<h3>';
                $text .= '<p>' . $price . '</p>';
                $text .= get_the_post_thumbnail();
                $text .= '<p>' . get_the_content(). '</p></section>';
         endwhile;
            
        else:
            $text .= '<p> No treatments found. </p>';

         endif;
            

    $text .= '</div>';

    return $text;

}

add_shortcode('treatments', 'treatments_shortcode');

?>