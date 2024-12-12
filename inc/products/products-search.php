<?php


class Finarm_Products_Search {
	public function __construct(  ) {
		add_action( 'wp_ajax_nopriv_products_search', array( $this, 'search' ) );
		add_action( 'wp_ajax_products_search', array( $this, 'search' ) );
	}

	public function search(  ) {
		$data = $_GET;

		$page = (!empty($data['paged'])) ? intval($data['paged']) : 1;
		$term = (!empty($data['term'])) ? intval($data['term']) : 0;

		set_query_var( 'paged', $page );
		set_query_var( 'child_term_id', $term );

		ob_start();

		get_template_part( 'template-parts/products-tab' );

		wp_send_json_success(ob_get_clean());
	}
}

new Finarm_Products_Search();