<?php
/*
 * Functions and definitions
 */

function my_excerpt_length( $length ) {
    return 15; // Указываем количество слов
}
add_filter( 'excerpt_length', 'my_excerpt_length' );

function new_excerpt_more($more) {
    global $post;
 return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//

function rybins_sidebars() {

    // Primary Sidebar
    register_sidebar(array(
        'name' => __('Right Sidebar', 'rybins'),
        'id' => 'right_sidebar',
        'description' => __('Right Sidebar', 'rybins'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    // Footerbox Sidebar
    register_sidebar(array(
        'name' => __('Footerbox Sidebar', 'rybins'),
        'id' => 'footerbox_sidebar',
        'description' => __('Footerbox Sidebar #1', 'rybns'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
}
add_action( 'widgets_init', 'rybins_sidebars' );