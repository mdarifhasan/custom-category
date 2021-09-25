<?php
/**
 * When building a category widget in wordpress we get into a problem 
 * the problem is the structure of the category widget is not same as out html template
 * we can use filter hook to customize wordprpess default category widget
 */
add_filter( 'widget_title','widget_title_base',10,3);

function widget_title_base( $title, $instance, $id_base ){
    // Target the categories base
    if( 'categories' === $id_base ) // Just make sure the base is correct, I'm not sure here
        add_filter( 'wp_list_categories', [$this,'jobgrids_list_category'], 11, 2 );
        /**
         * to modify dropdown categories we have to use wp_dropdown_categories
         */
        
    return $title;
}
function jobgrids_list_category( $output, $args ){
    // Only run the filter once
    remove_filter( current_filter(), __FUNCTION__ );

    // Get all the categories
    $categories = get_categories( $args );


    $output = '';

    $output .= '<div class="widget categories-widget"><ul class="custom">';
    foreach ( $categories as $category ) {
        
        $output .= '<li><a href="'.get_category_link($category->cat_ID).'">'.$category->name;

        $output .= '<span>'.$category->count.'</span></a></li>';
        
    }
    $output .= '</ul></div>';

    return $output;
}