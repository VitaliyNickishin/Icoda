<?php

function create_block_for_categories_post_type() {
    $labels = array(
            'name'              => _x('Module for categories', 'icoda'),
            'singular_name'     => _x('Module for category', 'icoda'),
            'search_items'      =>  __('Find category module', 'icoda'),
            'all_items'         => __('All module categories', 'icoda'),
            'parent_item'       => __('Parent category module', 'icoda'),
            'parent_item_colon' => __('Parent category module:', 'icoda'),
            'edit_item'         => __('Edit category module', 'icoda'),
            'update_item'       => __('Update category module', 'icoda'),
            'add_new_item'      => __('Add new module category', 'icoda'),
            'new_item_name'     => __('New name Category', 'icoda'),
            'menu_name'         => __('Block for category', 'icoda'),
    );

    $args = array(
        'labels' => $labels,
        'public' => false, // Не показывать в интерфейсе
        'publicly_queryable' => false, // Не доступен через URL
        'show_ui' => true, // Показывать ли в админке
        'show_in_menu' => true, // Показывать ли в меню админки
        'query_var' => false,
        'rewrite' => false, // Отключить ли ЧПУ
        'capability_type' => 'post',
        'has_archive' => false, // Есть ли архив
        'hierarchical' => true, // Иерархическая структура как у категорий
        'menu_position' => 20,
        'menu_icon' => 'dashicons-category',
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest' => true, // Виден ли в REST API
        'exclude_from_search' => true, // Исключить из поиска
    );

    register_post_type('service_category', $args);
}
add_action('init', 'create_block_for_categories_post_type');