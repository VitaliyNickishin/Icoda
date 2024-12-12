<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package icoda
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function icoda_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'icoda_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function icoda_pingback_header()
{
	if (is_singular() && pings_open()) {
		echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
	}
}
add_action('wp_head', 'icoda_pingback_header');

function icoda_captcha()
{
	if (get_the_ID() == '6598' || get_the_ID() == '6636' || get_the_ID() == '6640' || get_the_ID() == '6642' || get_field('load_new_styles') === true) {
		echo '<script src="https://www.google.com/recaptcha/api.js?onload=onloadReCaptchaInvisible&render=explicit" async defer></script>';
	}
}
add_action('wp_footer', 'icoda_captcha');




add_action('wp_loaded', 'convert_creds_to_coupons');

function convert_creds_to_coupons()
{
	if (is_admin() && !empty($_GET['get_csv_with_date_posts']) && $_GET['get_csv_with_date_posts'] == 'yes') {
		set_time_limit(0);

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			'post_status' => 'any'
		);

		$posts_query = new WP_Query($args);

		$data = [];

		while ($posts_query->have_posts()) {

			$posts_query->the_post();

			$cur_post_id = get_the_ID();

			$data[] = [
				$cur_post_id,
				get_the_title($cur_post_id),
				get_the_date('Y-m-d H:i:s', $cur_post_id),
				get_the_permalink($cur_post_id),
				get_post_status($cur_post_id)
			];
		}

		$fileName = ICL_LANGUAGE_CODE . '-posts-with-date-' . date('Y-m-d_H-i-s');

		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename="' . $fileName . '.csv";');

		ob_end_clean();

		$handle = fopen('php://output', 'w');
		fputcsv($handle, ['ID', 'Title', 'Publish date', 'Permalink', 'Status'], ',');


		foreach ($data as $value) {
			fputcsv($handle, $value, ',');
		}

		fclose($handle);
		ob_flush();
		exit();
	}
}

function icoda_get_items_tree_menu($location)
{
    if (has_nav_menu($location)) {

        $locations = get_nav_menu_locations();
        $m_items = array();

        if (isset($locations[$location])) {
            $menu = wp_get_nav_menu_object($locations[$location]); // получаем ID
            $menu_items = wp_get_nav_menu_items($menu); // получаем элементы меню

            _wp_menu_item_classes_by_context($menu_items);

            $m_items['title_menu'] = $menu->name;

            foreach ((array)$menu_items as $key => $menu_item) {
                // if (!empty($_GET['test_dump']) && !is_object($menu_item)) {
                //     var_dump($menu_item);
                // }
                $parent = $menu_item->menu_item_parent;
                // if (!empty($_GET['test_dump'])) {
                //     var_dump($parent);
                // }
                if (!$parent) {
                    $parent = 0;
                }
                if( empty( $m_items[$parent] ) ) {
                    $m_items[$parent] = new stdClass();
                }
                $m_items[$parent]->childs[$menu_item->ID]["ID"] = $menu_item->ID;
                $m_items[$parent]->childs[$menu_item->ID]["url"] = $menu_item->url;
                $m_items[$parent]->childs[$menu_item->ID]["title"] = $menu_item->title;
                $m_items[$parent]->childs[$menu_item->ID]["active"] = (array_search("current-menu-item", $menu_item->classes) !== false);
                $m_items[$parent]->childs[$menu_item->ID]["classes"] = $menu_item->classes;
                $m_items[$parent]->childs[$menu_item->ID]["parent"] = (empty($menu_item->menu_item_parent)) ? '' : $menu_item->menu_item_parent;
            }

            return $m_items;
        }
    }
    return array();
}