<?php

function icoda_faq_post_type()
{

    register_taxonomy('faq_cat', array('post_faq'), array(
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
        'query_var'     => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'faq-cat', 'with_front' => false),
    ));

    $labels = array(
        'name'                => __('FAQ', 'icoda'),
        'singular_name'       => __('FAQ', 'icoda'),
        'menu_name'           => __('FAQs', 'icoda'),
        'parent_item_colon'   => __('Parent FAQ', 'icoda'),
        'all_items'           => __('All FAQs', 'icoda'),
        'view_item'           => __('View FAQ', 'icoda'),
        'add_new_item'        => __('Add New FAQ', 'icoda'),
        'add_new'             => __('Add FAQ', 'icoda'),
        'edit_item'           => __('Edit FAQ', 'icoda'),
        'update_item'         => __('Update FAQ', 'icoda'),
        'search_items'        => __('Search FAQ', 'icoda'),
        'not_found'           => __('Not Found', 'icoda'),
        'not_found_in_trash'  => __('Not found in Trash', 'icoda'),
    );
    $args = array(
        'label'               => __('FAQs', 'icoda'),
        'rewrite'             => array('slug' => 'faq'),
        'description'         => __('', 'icoda'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'public'              => true,
        'menu_position'       => 5,
        'has_archive'         => true,
        'show_in_rest'           => true,
    );

    register_post_type('post_faq', $args);
}

add_action('init', 'icoda_faq_post_type', 0);


function faq_ajax_search()
{
    $args = array(
        'post_type'        => 'post_faq',
        'post_status'      => 'publish',
        'order'            => 'DESC',
        'orderby'          => 'date',
        's'                => $_POST['term'],
        'posts_per_page'   => 10
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) { ?>
        <p class="h4"><?php _e('Search Result:', 'icoda-faq'); ?></p>
        <div class="advantages-card">
            <div class="des">
                <ul class="list-link">
                    <?php while ($query->have_posts()) {
                        $query->the_post(); ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>


    <?php
    } else {
    ?>
        <p class="h4"><?php _e('Not found', 'icoda-faq'); ?></p>
        <p class="sub_field"><?php _e('But maybe the following answers will suit you:', 'icoda-faq'); ?></p>
        <div class="advantages-card">
            <div class="des">
                <ul class="list-link">
                    <?php $posts = get_posts(array('post_type' => 'post_faq', 'numberposts' => '10', 'orderby' => 'date')); ?>
                    <?php foreach ($posts as $post) { ?>
                        <li><a href="<?php the_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
<?php
    }

    exit;
}
add_action('wp_ajax_nopriv_faq_ajax_search', 'faq_ajax_search');
add_action('wp_ajax_faq_ajax_search', 'faq_ajax_search');
