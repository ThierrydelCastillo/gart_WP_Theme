<?php

function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
    add_image_size('post-thumbnail', 350, 215, true);
    remove_image_size('medium');
    add_image_size('medium', 500, 500);
}

function montheme_register_assets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css');
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

function montheme_title_separator()
{
    return '|';
}

function montheme_document_title_parts($title)
{
    $title['demo'] = 'Salut';
    return $title;
}

function montheme_menu_class(array $classes): array
{
    $classes[] = 'nav-item';
    return $classes;
}

function montheme_menu_link_class($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function montheme_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages === null) {
        return;
    }
    echo '<nav aria-label="Pagination" class="my-4">';
    echo '<ul class="pagination">';
    foreach ($pages as $page) {
        $active = strpos($page, 'current') !== false;
        $class = 'page-item';
        if ($active) {
            $class .= ' active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

function montheme_init()
{
    register_taxonomy('sport', 'post', [
        'labels' => [
            'name' => 'Sport',
            'singular_name' => 'Sport',
            'plural_name' => 'Sports',
            'search_items' => 'Rechercher des sports',
            'all_items' => 'Tous les sports',
            'edit_item' => 'Editer le sport',
            'update_item' => 'Modifier le sport',
            'add_new_item' => 'Ajouter un nouveau sport',
            'new_item_name' => 'Ajouter un nouveau sport',
            'Menu_name' => 'Sport',
        ],
        'show_in_rest' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
    ]);
    register_post_type('bien', [
        'label' => "Biens",
        'public' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'has_archive' => true,

    ]);
}

add_action('init', 'montheme_init');
add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_assets');
add_filter('document_title_separator', 'montheme_title_separator');
add_filter('nav_menu_css_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');

require_once('metaboxes/Sponso.php');
SponsoMetaBox::register();
