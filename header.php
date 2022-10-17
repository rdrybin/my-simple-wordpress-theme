<?php
/*
 * Header Section
 */
?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo-section">
                <div class="site-title">
                    <a href="https://rybins.ru/" title="Rybins.ru | Тревел блог о самостоятельных путешествиях, недорогой отдых в России и зарубежом" rel="home">Rybins.ru</a>
                </div>
            </div>
            <nav class="main-nav">
                <input class="menu-btn" type="checkbox" id="menu-btn" />
                <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
                <?php
                wp_nav_menu(array(
                    'menu_class'        => 'menu', // класс элемента <ul>
                    'container'         => 'false', // тег контейнера или false, если контейнер не нужен
                    'fallback_cb'       => 'wp_page_menu', // колбэк функция, если меню не существует
                    'echo'              => true, // вывести или вернуть
                    'depth'             => 0, // количество уровней вложенности
                    'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'item_spacing'      => 'preserve',
                ));
                ?>
            </nav>
        </div>