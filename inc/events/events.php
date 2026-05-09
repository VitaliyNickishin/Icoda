<?php

function icoda_events_post_type()
{

    register_taxonomy('events_cat', array('event'), array(
        'hierarchical'  => false,
        'labels'        => array(
            'name'              => _x('Categories', 'icoda'),
            'singular_name'     => _x('Category', 'icoda'),
            'search_items'      =>  __('Find Category', 'icoda'),
            'all_items'         => __('All Categories', 'icoda'),
            'parent_item'       => __('Parent Category', 'icoda'),
            'parent_item_colon' => __('Parent Category:', 'icoda'),
            'edit_item'         => __('Edit Category', 'icoda'),
            'update_item'       => __('Update Category', 'icoda'),
            'add_new_item'      => __('Add new category', 'icoda'),
            'new_item_name'     => __('New name Category', 'icoda'),
            'menu_name'         => __('Category', 'icoda'),
        ),
        'public' => false,
        'show_ui'       => true,
        'show_in_rest'          => true,
        'query_var'     => false,
        'show_admin_column' => true,
    ));

    $labels = array(
        'name'                => __('Events', 'icoda'),
        'singular_name'       => __('Events', 'icoda'),
        'menu_name'           => __('Events', 'icoda'),
        'parent_item_colon'   => __('Parent Event', 'icoda'),
        'all_items'           => __('All Events', 'icoda'),
        'view_item'           => __('View Event', 'icoda'),
        'add_new_item'        => __('Add New Event', 'icoda'),
        'add_new'             => __('Add Event', 'icoda'),
        'edit_item'           => __('Edit Event', 'icoda'),
        'update_item'         => __('Update Event', 'icoda'),
        'search_items'        => __('Search Event', 'icoda'),
        'not_found'           => __('Not Found', 'icoda'),
        'not_found_in_trash'  => __('Not found in Trash', 'icoda'),
    );
    $args = array(
        'label'               => __('Events', 'icoda'),
        'rewrite'             => array('slug' => 'event'),
        'description'         => __('', 'icoda'),
        'labels'              => $labels,
        'supports'            => array('title', 'thumbnail', 'excerpt'),
        'public'              => true,
        'menu_position'       => 5,
        'has_archive'         => false,
        'show_in_rest'           => false,
    );

    register_post_type('event', $args);
}

add_action('init', 'icoda_events_post_type', 0);


add_action('rest_api_init', function () {
    register_rest_route('events/v1', '/filter', [
        'methods'  => 'POST',
        'callback' => 'icoda_filter_events',
        'permission_callback' => '__return_true',
    ]);
});

function icoda_filter_events(WP_REST_Request $request)
{
    ob_start();
    get_template_part('template-parts/_partials/events-overview-table', '', $request->get_params());
    return ob_get_clean();;
}

add_filter('manage_event_posts_columns', 'icoda_events_table_columns');
add_action('manage_event_posts_custom_column', 'icoda_events_column_value', 10, 2);

function icoda_events_table_columns($columns)
{
    $columns = array(
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'taxonomy-events_cat' => 'Categories',
        'date_start' => 'Date Start',
        'date_end' => 'Date End',
        'is_top' => 'Is Top',
        'date' => 'Date Create',
    );

    return $columns;
}

function icoda_events_column_value($column, $post_id)
{
    if ('date_start' === $column) {
        $date = get_field('date_start', $post_id);
        if (!empty($date) && $date != 'N/A') {
            $dateTmp = DateTime::createFromFormat('Ymd', $date);
            if (!empty($dateTmp)) {
                $date = $dateTmp->format('d/m/Y');
            }
        }
        $date = !empty($date) ? $date : 'N/A';
        echo $date;
    }
    if ('date_end' === $column) {
        $date = get_field('date_end', $post_id);
        if (!empty($date) && $date != 'N/A') {
            $dateTmp = DateTime::createFromFormat('Ymd', $date);
            if (!empty($dateTmp)) {
                $date = $dateTmp->format('d/m/Y');
            }
        }
        $date = !empty($date) ? $date : 'N/A';
        echo $date;
    }
    if ('is_top' === $column) {
        $is_top = get_field('is_top', $post_id);
        echo !empty($is_top) ? 'TOP' : '';
    }
}
