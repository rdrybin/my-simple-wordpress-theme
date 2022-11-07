<?php
/*
 * Functions and definitions
 */

add_theme_support('post-thumbnails');

function my_excerpt_length($length)
{
    return 15; // Указываем количество слов
}
add_filter('excerpt_length', 'my_excerpt_length');

function new_excerpt_more($more)
{
    global $post;
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//

function rybins_sidebars()
{

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
add_action('widgets_init', 'rybins_sidebars');

function the_breadcrumb()
{

    $get_cat        = get_the_category();
	$first_cat      = $get_cat[0];
	$category_name  = $first_cat->cat_name;
	$category_link  = get_category_link( $first_cat->cat_ID );
    
    echo '<ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';
    if (!is_front_page()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
        echo '<a itemprop="item" href="/">';
        echo '<span itemprop="name">Главная</span></a>';
        echo '<meta itemprop="position" content="1" />
        </li>';
        if (is_category() || is_single()) {
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
            echo '<a itemprop="item" href="'.$category_link.'">';
            echo '<span itemprop="name">'.$category_name.'</span></a>';
            echo '<meta itemprop="position" content="2" />
            </li>';
            if (is_single()) {
            }
        } else {
            echo 'Home';
        }
        echo "</ul>";
    }
    
}