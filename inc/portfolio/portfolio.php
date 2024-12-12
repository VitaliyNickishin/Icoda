<?php

function icoda_portfolio_post_type()
{

	register_taxonomy('portfolio_cat', array('portfolio-case'), array(
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
		'rewrite' => array('slug' => 'portfolio-cat', 'with_front' => false),
	));

	$labels = array(
		'name'                => __('Portfolio Cases', 'icoda'),
		'singular_name'       => __('Portfolio Cases', 'icoda'),
		'menu_name'           => __('Portfolio Cases', 'icoda'),
		'parent_item_colon'   => __('Parent Portfolio Case', 'icoda'),
		'all_items'           => __('All Portfolio Cases', 'icoda'),
		'view_item'           => __('View Portfolio Case', 'icoda'),
		'add_new_item'        => __('Add New Portfolio Case', 'icoda'),
		'add_new'             => __('Add Portfolio Case', 'icoda'),
		'edit_item'           => __('Edit Portfolio Case', 'icoda'),
		'update_item'         => __('Update Portfolio Case', 'icoda'),
		'search_items'        => __('Search Portfolio Case', 'icoda'),
		'not_found'           => __('Not Found', 'icoda'),
		'not_found_in_trash'  => __('Not found in Trash', 'icoda'),
	);
	$args = array(
		'label'               => __('Portfolio Cases', 'icoda'),
		'rewrite'             => array('slug' => 'portfolio'),
		'description'         => __('', 'icoda'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
		'public'              => true,
		'menu_position'       => 5,
		'has_archive'         => true,
		'show_in_rest' 		  => true,
	);

	register_post_type('portfolio-case', $args);
}

add_action('init', 'icoda_portfolio_post_type', 0);
