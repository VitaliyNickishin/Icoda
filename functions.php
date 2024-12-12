<?php
/**
 * icoda functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package icoda
 */

//  add_action('template_redirect', function () {
//     if( ! empty( $_GET['test-olga']) ) {
//         update_option('bitrix_add_periodical_users', false);
//         var_dump( get_option( 'bitrix_add_periodical_users' ) );
//     }
//  });

add_filter( 'login_display_language_dropdown', '__return_false' );

function theme_setup(){
    add_theme_support( 'post-thumbnails' );

    add_image_size( 'cases-list', 540, 293 );
    add_image_size( 'cases-block', 490, 200 );
    add_image_size( 'blog', 350, 170 );
}
add_action('after_setup_theme','theme_setup');

register_nav_menus(array(
    'lang-menu' => esc_html__('Language', 'icoda'),
    'lang-menu-inner' => esc_html__('Language Inner Page', 'icoda'),
    'main-menu' => esc_html__('Main', 'icoda'),
    'main-menu-de' => esc_html__('Main de', 'icoda'),
    'main-menu-fr' => esc_html__('Main fr', 'icoda'),
    'main-menu-it' => esc_html__('Main it', 'icoda'),
    'main-menu-ru' => esc_html__('Main ru', 'icoda'),
    'main-menu-es' => esc_html__('Main es', 'icoda'),
    'main-menu-inner' => esc_html__('Main-Inner-Page', 'icoda'),
    'main-mobile-menu' => esc_html__('Main Mobile', 'icoda'),
    'footer-left' => esc_html__('Footer left', 'icoda'),
    'footer-center' => esc_html__('Footer center', 'icoda'),
    'footer-center-down' => esc_html__('Footer center down', 'icoda'),
    'footer-right-up' => esc_html__('Footer right up', 'icoda'),
    'footer-right-down' => esc_html__('Footer right down', 'icoda'),
    'footer-right-down-2' => esc_html__('Footer right down 2', 'icoda'),

    'header-one' => esc_html__('Header one', 'icoda'),
    'header-two' => esc_html__('Header two', 'icoda'),
    'header-three-one' => esc_html__('Header three one', 'icoda'),
    'header-three-two' => esc_html__('Header three two', 'icoda'),
    'header-three-three' => esc_html__('Header three three', 'icoda'),
    'header-four' => esc_html__('Header four', 'icoda'),
    'header-five' => esc_html__('Header five', 'icoda'),
));

define("VIEWS_DIR", get_template_directory() . '/template-parts/');

add_action('init', 'theme_init', 10);
function theme_init()
{
    function the_view($view_name, $args = [])
    {
        try {
            if ($view_name == "") {
                throw new Exception("View name empty.");
            }
            $view_name = str_replace("__", "/", $view_name);

            $file_name = VIEWS_DIR . $view_name;
            if (!file_exists($file_name . ".php")) {
                throw new Exception("The file {$file_name}.php not exists");
            }
            global $themeAR;
            include "{$file_name}.php";

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
add_action( 'init', 'utm_save' );
function utm_save() {
    $keys = array( 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term' );
    foreach ( $keys as $row ) {
        if ( ! empty( $_GET[ $row] ) ) {
            $value = strval( $_GET[ $row ] );
            $value = stripslashes( $value );
            $value = htmlspecialchars_decode( $value, ENT_QUOTES );
            $value = strip_tags( $value );
            $value = htmlspecialchars( $value, ENT_QUOTES );
            setcookie( 'utm-' . $row, $value, 0, '/' );
        }
    }
}

add_action( 'icoda_body_open', 'utm_save_head' );
function utm_save_head() {
    $keys = array( 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term' );
    foreach ( $keys as $row ) {
        if ( ! empty( $_GET[ $row] ) ) {
            $value = strval( $_GET[ $row ] );
            $value = stripslashes( $value );
            $value = htmlspecialchars_decode( $value, ENT_QUOTES );
            $value = strip_tags( $value );
            $value = htmlspecialchars( $value, ENT_QUOTES );
            setcookie( 'utm-' . $row, $value, 0, '/' );
            echo '<input type="hidden" value="'.$value.'" name="head-utm-'.$row.'" />';
        }
    }
}

// add_action( 'init', 'ip_user_country_save' );
add_action( 'icoda_body_open', 'ip_user_country_save_head' );

function ip_user_country_save() {
    $client  = @$_SERVER["HTTP_CF_CONNECTING_IP"];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $a = @$_SERVER['HTTP_X_FORWARDED'];
    $b = @$_SERVER['HTTP_FORWARDED_FOR'];
    $c = @$_SERVER['HTTP_FORWARDED'];
	$d = @$_SERVER['HTTP_CLIENT_IP'];
    $remote  = @$_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)){
       $ip = $client;
    }
	elseif(filter_var($forward, FILTER_VALIDATE_IP)){
       $ip = $forward;
    }
	elseif(filter_var($a, FILTER_VALIDATE_IP)){
       $ip = $a;
    }
	elseif(filter_var($b, FILTER_VALIDATE_IP)){
       $ip = $b;
    }
	elseif(filter_var($c, FILTER_VALIDATE_IP)){
       $ip = $c;
    }
	elseif(filter_var($remote, FILTER_VALIDATE_IP)){
       $ip = $remote;
    }
	else {
        $ip = '';
	}

	if(!empty($ip)) {
        $geoData = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
        if (!empty($geoData['geoplugin_request']) && !empty($geoData['geoplugin_countryName'])) {
            $country = $geoData['geoplugin_countryName'];
            setcookie( 'user_country_ip_detected', $country, 0, '/' );
        }

		// $ip_data = @json_decode(wp_remote_retrieve_body(wp_remote_get( "http://ip-api.com/json/".$ip)));
        // $user_data = !empty( $ip_data ) ? $ip_data->country : '';
        // if( ! empty( $user_data ) ) {
        //     setcookie( 'user_country_ip_detected', $user_data, 0, '/' );
        // }
	}
}

function ip_user_country_save_head() {
    $client  = @$_SERVER["HTTP_CF_CONNECTING_IP"];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $a = @$_SERVER['HTTP_X_FORWARDED'];
    $b = @$_SERVER['HTTP_FORWARDED_FOR'];
    $c = @$_SERVER['HTTP_FORWARDED'];
	$d = @$_SERVER['HTTP_CLIENT_IP'];
    $remote  = @$_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)){
       $ip = $client;
    }
	elseif(filter_var($forward, FILTER_VALIDATE_IP)){
       $ip = $forward;
    }
	elseif(filter_var($a, FILTER_VALIDATE_IP)){
       $ip = $a;
    }
	elseif(filter_var($b, FILTER_VALIDATE_IP)){
       $ip = $b;
    }
	elseif(filter_var($c, FILTER_VALIDATE_IP)){
       $ip = $c;
    }
	elseif(filter_var($remote, FILTER_VALIDATE_IP)){
       $ip = $remote;
    }
	else {
        $ip = '';
	}

	if(!empty($ip)) {
        $geoData = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
        if (!empty($geoData['geoplugin_request']) && !empty($geoData['geoplugin_countryName'])) {
            $country = $geoData['geoplugin_countryName'];
            echo '<input type="hidden" value="'.$country.'" name="head_user_country_ip_detected" />';
        }

		// $ip_data = @json_decode(wp_remote_retrieve_body(wp_remote_get( "http://ip-api.com/json/".$ip)));
		// $user_data = !empty( $ip_data ) ? $ip_data->country : '';
		// echo '<input type="hidden" value="'.$user_data.'" name="head_user_country_ip_detected" />';
	}
}


function the_breadcrumbs()
{
    global $post;
    $res = '<nav aria-label="breadcrumb">';
    $res .= '<ol class="breadcrumb">';
    $res .= '<li class="breadcrumb-item"><a href="' . get_home_url() . '" rel="nofollow">'. __('Main', 'icoda') .'</a></li>';
    if( is_post_type_archive('portfolio-case') || is_singular('portfolio-case') ) {
        if( is_post_type_archive('portfolio-case') ) {
            $res .= '<li class="breadcrumb-item" aria-current="page">' . __('Portfolio', 'icoda') . '</li>';
        } elseif ( is_singular('portfolio-case') ) {
            $res .= '<li class="breadcrumb-item"><a href="' . get_post_type_archive_link('portfolio-case') . '">' . __('Portfolio', 'icoda') . '</a></li>';
            $res .= '<li class="breadcrumb-item" aria-current="page">' . get_the_title() . '</li>';
        }
    } elseif( is_post_type_archive('post_faq') || is_singular('post_faq') ) {
        if( is_post_type_archive('post_faq') ) {
            $res .= '<li class="breadcrumb-item" aria-current="page">' . __('FAQ', 'icoda') . '</li>';
        } elseif ( is_singular('post_faq') ) {
            $res .= '<li class="breadcrumb-item"><a href="' . get_post_type_archive_link('post_faq') . '">' . __('FAQ', 'icoda') . '</a></li>';
            $res .= '<li class="breadcrumb-item" aria-current="page">' . get_the_title() . '</li>';
        }
    } elseif( is_home( ) ) {
            $blog_page_id = get_option('page_for_posts');
            $res .= '<li class="breadcrumb-item" aria-current="page">' . get_the_title( $blog_page_id ) . '</li>';
    } elseif (is_category() || is_single()) {
        $cats = get_the_category();
        $cat = ! empty( $cats ) ? $cats[0] : false;
        // if (!is_single('about-us')) {
            if( empty( $cat ) ) {
                $cat = get_queried_object(  );
            }
            $res .= '<li class="breadcrumb-item"><a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a></li>';
        // }
        if (is_single()) {
            $res .= '<li class="breadcrumb-item" aria-current="page">' . get_the_title() . '</li>';
        }
    } elseif (is_page()) {
        if ($post->post_parent == 3823) {
            $res .= '<li class="breadcrumb-item" aria-current="page"><a href="' . get_category_link('35') . '">'. __('Services', 'icoda') . '</a></li>';
            $res .= '<li class="breadcrumb-item" aria-current="page">' . get_the_title() . '</li>';
        } elseif ($post->post_parent == 8397) {
            $res .= '<li class="breadcrumb-item" aria-current="page"><a href="' . get_category_link('72') . '">'. get_cat_name(72) . '</a></li>';
            $res .= '<li class="breadcrumb-item" aria-current="page">' . get_the_title() . '</li>';
        } elseif ($post->post_parent == 9154) {
            $res .= '<li class="breadcrumb-item" aria-current="page"><a href="' . get_category_link('79') . '">'. get_cat_name(79) . '</a></li>';
            $res .= '<li class="breadcrumb-item" aria-current="page">' . get_the_title() . '</li>';
        } elseif ($post->post_parent == 5720) {
            $res .= '<li class="breadcrumb-item" aria-current="page"><a href="' . get_category_link('65') . '">'. get_cat_name(65) . '</a></li>';
            $res .= '<li class="breadcrumb-item" aria-current="page">' . get_the_title() . '</li>';
        } elseif ($post->post_parent == 22068) {
            $res .= '<li class="breadcrumb-item" aria-current="page"><a href="' . get_category_link('151') . '">'. get_cat_name(151) . '</a></li>';
            $res .= '<li class="breadcrumb-item" aria-current="page">' . get_the_title() . '</li>';
        } else {
            $res .= '<li class="breadcrumb-item" aria-current="page">' . get_the_title() . '</li>';
        }
    } elseif (is_search()) {
        $res .= '"<em>';
        $res .= '<li class="breadcrumb-item" aria-current="page">' . get_search_query() . '</li>';
        $res .= '</em>"';
    } elseif (is_author()) {
        $res .= '<li class="breadcrumb-item" aria-current="page"><a href="' . get_category_link('38') . '">'. __('Article', 'icoda') . '</a></li>';
        $res .= '<li class="breadcrumb-item" aria-current="page">'. __('Author', 'icoda') . '</li>';
    }
    $res .= '</ol>';
    $res .= '</nav>';

    echo $res;
}

function replace_space_2_symbol( $str, $sym = '_' ) {
    return str_replace( ' ', $sym, mb_strtolower($str) );
}

function get_class_wrap($class = '')
{
    $res = [];

    if (!empty($class)) {
        array_push($res, $class);
    }

    if (is_home() || is_front_page() || is_page(9354) || is_page(8063) || is_page(5718) || is_page(17) || is_page(8720) || is_page(13552) ) {
        array_push($res, 'home-page');
    } elseif (is_single() && get_field( 'load_new_styles' ) !== true ) {
        array_push($res, 'article-page');
        if (in_array(33,  array_column(get_the_category(), 'term_id'))) {
            array_push($res,'case-page');
        }
    } elseif (is_page_template('template-parts/tpl-contact.php')){
        array_push($res,'contact-page');
    } elseif (is_page_template('template-parts/tpl-careers.php')){
        array_push($res,'careers-page');
    } elseif (is_page_template('template-parts/tpl-download.php') || is_page([2912,'download','Download'])){
        array_push($res,'download-page');
    } elseif (is_page_template('template-parts/tpl-events.php')){
        array_push($res,'events-page');
    }
    if( (is_single() || is_page()) && get_field( 'load_new_styles' ) === true ) {
        array_push($res,'fin-promotion-page');
    }
    if( ! empty( get_field('custom_class') ) ) {
		array_push($res,get_field('custom_class'));
	}

    echo implode(' ', $res);
}


/**
 * Enqueue scripts and styles.
 */
function icoda_styles()
{
    global $wp_query;
    $stylesheet_directory = get_stylesheet_directory();

    $assets_uri = get_stylesheet_directory_uri() . '/assets';
    $scripts_version = '0000003';

    wp_enqueue_style('icoda-fontawesome', $assets_uri . '/sources/fontawesome-all.min.css');
    wp_enqueue_style('icoda-style-main', $assets_uri . '/css/main.css');

    wp_enqueue_script(
        'paginate',
        $assets_uri.'/sources/paginator/jquery.paginate.js',
        array('jquery'), $scripts_version, true
    );

    wp_enqueue_script(
        'lazyloadxt.bg',
        $assets_uri.'/js/jquery.lazyloadxt.bg.js',
        array('jquery-lazyloadxt-extend'), $scripts_version, true
    );

    wp_enqueue_script(
        'popper.min',
        $assets_uri.'/js/popper.min.js',
        array('jquery'), $scripts_version, true
    );
    wp_enqueue_script(
        'bootstrap.min',
        $assets_uri.'/js/bootstrap.min.js',
        array('jquery'), $scripts_version, true
    );
    wp_enqueue_script(
        'masonry.pkgd.min',
        $assets_uri . '/js/masonry.pkgd.min.js',
        array(), '', true
    );
    wp_enqueue_script(
        'slick.min',
        $assets_uri.'/js/slick.min.js',
        array('jquery'), $scripts_version, true
    );
    wp_enqueue_script(
        'jquery.validate.min',
        $assets_uri . '/js/jquery.validate.min.js',
        array('jquery'), '1.19.1', true
    );
    wp_enqueue_script(
        'sine-waves.min',
        $assets_uri . '/js/sine-waves.min.js',
        array('jquery'), '0.3.0', true
    );

    wp_enqueue_script(
        'styckykit',
        $assets_uri . '/js/stickykit.js',
        array('jquery'), '1.1.2', true
    );
    wp_enqueue_script(
        'additional-methods.min',
        $assets_uri . '/js/additional-methods.min.js',
        array('jquery'), '', true
    );
    wp_enqueue_script(
        'jquery.parallax.min',
        $assets_uri . '/js/jquery.parallax.min.js',
        array('jquery'), '', true
    );

    wp_enqueue_script(
        'fontfaceobserver',
        $assets_uri . '/js/fontfaceobserver.js',
        array('jquery'), '', true
    );

    wp_register_script('main', $assets_uri.'/js/main.js', array('jquery', 'jquery.parallax.min'), $scripts_version, true);
    wp_localize_script( 'main', 'icoda_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
        'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages,
        'current_language' => apply_filters( 'wpml_current_language', NULL ),
        'menu_open_label' => __('Menu', 'icoda'),
        'menu_close_label' => __('Close', 'icoda'),
        'btn_text' => strtoupper(__('Load more', 'icoda')),
        'btn_text_loading' => __('Loading...', 'icoda'),
    ) );
    wp_enqueue_script('main');

    if( is_singular('post') ) {
        wp_register_script('article-share', $assets_uri.'/js/share.js', array('jquery'), $scripts_version, true);
        wp_localize_script( 'article-share', 'icoda_share_params', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ) );
        wp_enqueue_script('article-share');
    }

    if( is_post_type_archive('post_faq') ) {
        wp_enqueue_script(
            'icoda-faq',
            $assets_uri . '/js/faq.js',
            array('jquery'), '', true
        );
    }


    if( is_page_template( 'template-pages/template-feedback.php' ) ) {
        wp_enqueue_script(
            'icoda-feedback',
            $assets_uri . '/js/feedback.js',
            array('jquery'), '', true
        );
        wp_localize_script('icoda-feedback', 'IcodaFeedback',  array(
            'nonce' => wp_create_nonce('wp_rest'),
            'rest_root' => esc_url_raw(get_rest_url(null, 'icoda/v1/feedback')),
            'sending' => __('Sending...', 'icoda'),
            'error' => __('Something went wrong. Try again later', 'icoda'),
        ));
    }
}

add_action('wp_enqueue_scripts', 'icoda_styles');

function icoda_loadmore_ajax_handler(){

    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['post_type'] = 'post';
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';

    $term_blog_slug = 'blog';
    $term_blog = get_term_by('slug', $term_blog_slug, 'category');
    if( ! empty( $term_blog ) && ! empty( $_POST['lang'] ) ){
        $translated_object_id = apply_filters( 'wpml_object_id', $term_blog->term_id, 'category', true, $_POST['lang'] );
        $term_blog = get_term_by('id', $translated_object_id, 'category');
        if( ! empty( $term_blog ) ) {
            $term_blog_slug = $term_blog->slug;
        }
    }

    if( empty( $args['category_name'] ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $term_blog_slug
            )
        );
    }

    if(!empty($args['is_home_request']) && $args['is_home_request'] == 'yes') {
        unset($args['cat']);
        unset($args['category_name']);
    }
    if( ! empty($args['tag_id']) ) {
        unset($args['tag_id']);
    }

    // it is always better to use WP_Query but not here
    query_posts( $args );
    global $post;
    global $wp_query;
    $index = 1;
    if( have_posts() ) :
        // run the loop
        while( have_posts() ): the_post();
            ?>
            <?php
                $author_id = get_the_author_meta('ID');
                $lg_class = 'col-lg-4';

                $title = get_the_title( get_the_ID() );
                $excerpt = get_the_excerpt(get_the_ID());

                if( $index == 1 || $index == 2 || $index == 6 || $index == 7 ) {
                    $lg_class = 'col-lg-6 has-big-card';
                    $title = mb_strimwidth($title, 0, 90, "...");
                } else {
                    $title = mb_strimwidth($title, 0, 45, "...");
                }
                $excerpt = mb_strimwidth($excerpt, 0, 100, "...");
            ?>
                <div class="col-12 col-md-6 mb-lg-5 mb-3 <?php echo $lg_class; ?>">
                    <a href="<?php the_permalink(); ?>" class="service-card cases-card hot">

                        <?php if ( has_post_thumbnail()) : ?>
                            <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                            <?php
                            $alt_text = '';
                            if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) {
                                $alt_text = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
                            } else {
                                $alt_text = get_the_title(get_the_ID());
                            }
                            ?>
                            <div class="blog-img">
                                <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $alt_text; ?>">
                            </div>

                        <?php endif; ?>


                        <?php if($args['category_name'] == 'blog' || $args['category_name'] == 'blog-zh-hans') : ?>
                            <div class="blog-card-content">

                                <div class="blog-card-body">
                                    <span class="h6"><?php echo $title; ?></span>
                                    <div class="sub-text">
                                        <p><?php echo $excerpt; ?></p>
                                    </div>

                                </div>
                                <div class="blog-card-footer">
                                    <div class="author-meta">
                                        <span class="author-name">
                                            <?php
                                            echo apply_filters(
                                                'wpml_translate_single_string',
                                                get_the_author_meta('display_name', $author_id),
                                                'Authors',
                                                'display_name_' . $author_id ,
                                                ICL_LANGUAGE_CODE
                                            );
                                            ?>
                                        </span>
                                        ·
                                        <span class="date-publish"><?php echo get_the_date('F j, Y', get_the_ID()); ?></span>
                                    </div>
                                    <?php get_template_part('template-parts/article-card-meta-info'); ?>
                                </div>

                            </div>
                        <?php elseif(!empty($args['is_home_request'])) : ?>
                            <div class="blog-card-content">

                                <div class="blog-card-body">
                                    <span class="h6"><?php echo $title; ?></span>
                                    <div class="sub-text">
                                        <p><?php echo $excerpt; ?></p>
                                    </div>
                                </div>

                                <div class="blog-card-footer">
                                    <div class="author-meta">
                                        <span class="author-name">
                                            <?php
                                            echo !in_array($author_id, [21, 22, 8, 9, 10, 6, 24]) ? 'ICODA' : apply_filters(
                                                'wpml_translate_single_string',
                                                get_the_author_meta('display_name', $author_id),
                                                'Authors',
                                                'display_name_' . $author_id,
                                                ICL_LANGUAGE_CODE
                                            );
                                            ?>
                                        </span>
                                        ·
                                        <span class="date-publish"><?php echo get_the_date('F j, Y', get_the_ID()); ?></span>
                                    </div>
                                    <?php get_template_part('template-parts/article-card-meta-info'); ?>
                                </div>

                            </div>
                        <?php else : ?>
                                <div class="blog-card-content">
                                    <span class="h6"><?php echo $title; ?></span>
                                    <div class="sub-text">
                                        <p><?php echo $excerpt; ?></p>
                                    </div>
                                    <?php get_template_part('template-parts/article-card-meta-info'); ?>
                                </div>
                        <?php endif; ?>

                    </a>
                </div>
            <?php
        $index++;
        endwhile;

    endif;

    if( ( $_POST['page'] + 1 ) === 7 || $wp_query->max_num_pages <= ( $_POST['page'] + 1 ) ) {
        $add_service_id = 5770;
        if( ! empty( $_POST['lang'] ) ){
            $add_service_id = apply_filters( 'wpml_object_id', $add_service_id, 'post', true, $_POST['lang'] );
        }
        $lg_class = 'col-lg-4';

        $title = get_the_title( $add_service_id );
        $excerpt = get_the_excerpt($add_service_id);
        if( $index == 1 || $index == 2 || $index == 6 || $index == 7 || $index == 11 || $index == 12  ) {
            $lg_class = 'col-lg-12 has-big-card';
            $title = mb_strimwidth($title, 0, 90, "...");
        } else {
            $title = mb_strimwidth($title, 0, 45, "...");
        }
        $excerpt = mb_strimwidth($excerpt, 0, 100, "...");
        ?>
            <div class="col-12 col-md-12 mb-lg-5 mb-3 <?php echo $lg_class; ?>">
                <a href="<?php echo get_the_permalink($add_service_id); ?>" class="service-card cases-card hot">

                    <?php if ( has_post_thumbnail($add_service_id)) : ?>
                        <?php $featured_img_url = get_the_post_thumbnail_url($add_service_id, 'full'); ?>
                        <?php
                        $alt_text = '';
                        if ( get_post_meta( get_post_thumbnail_id( $add_service_id ), '_wp_attachment_image_alt', true ) ) {
                            $alt_text = get_post_meta( get_post_thumbnail_id($add_service_id), '_wp_attachment_image_alt', true );
                        } else {
                            $alt_text = get_the_title($add_service_id);
                        }
                        ?>
                        <div class="blog-img">
                            <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $alt_text; ?>">
                        </div>

                    <?php endif; ?>

                    <div class="blog-card-content">
                        <span class="h6"><?php echo $title; ?></span>
                        <div class="sub-text">
                            <p><?php echo $excerpt; ?></p>
                        </div>
                        <?php get_template_part('template-parts/article-card-meta-info'); ?>
                    </div>
                </a>
            </div>
        <?php
        $index++;
    }

    if( ( $_POST['page'] + 1 ) === 15 || $wp_query->max_num_pages <= ( $_POST['page'] + 1 ) ) {
        $add_service_id = 5764;
        if( ! empty( $_POST['lang'] ) ){
            $add_service_id = apply_filters( 'wpml_object_id', $add_service_id, 'post', true, $_POST['lang'] );
        }

        $lg_class = 'col-lg-4';
        $title = get_the_title( $add_service_id );
        $excerpt = get_the_excerpt($add_service_id);
        if( $index == 1 || $index == 2 || $index == 6 || $index == 7 || $index == 11 || $index == 12  ) {
            $lg_class = 'col-lg-12 has-big-card';
            $title = mb_strimwidth($title, 0, 90, "...");
        } else {
            $title = mb_strimwidth($title, 0, 45, "...");
        }
        $excerpt = mb_strimwidth($excerpt, 0, 100, "...");
        ?>
            <div class="col-12 col-md-12 mb-lg-5 mb-3 <?php echo $lg_class; ?>">
                <a href="<?php echo get_the_permalink($add_service_id); ?>" class="service-card cases-card hot">

                    <?php if ( has_post_thumbnail($add_service_id)) : ?>
                        <?php $featured_img_url = get_the_post_thumbnail_url($add_service_id, 'full'); ?>
                        <?php
                        $alt_text = '';
                        if ( get_post_meta( get_post_thumbnail_id( $add_service_id ), '_wp_attachment_image_alt', true ) ) {
                            $alt_text = get_post_meta( get_post_thumbnail_id($add_service_id), '_wp_attachment_image_alt', true );
                        } else {
                            $alt_text = get_the_title($add_service_id);
                        }
                        ?>
                        <div class="blog-img">
                            <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $alt_text; ?>">
                        </div>

                    <?php endif; ?>

                    <div class="blog-card-content">
                        <span class="h6"><?php echo $title; ?></span>
                        <div class="sub-text">
                            <p><?php echo $excerpt; ?></p>
                        </div>
                        <?php get_template_part('template-parts/article-card-meta-info'); ?>
                    </div>

                </a>
            </div>
        <?php
        $index++;
    }

    die; // here we exit the script and even no wp_reset_query() required!
}

add_action( 'wp_ajax_loadmore', 'icoda_loadmore_ajax_handler' ); // wp_ajax_{action}
add_action( 'wp_ajax_nopriv_loadmore', 'icoda_loadmore_ajax_handler' ); // wp_ajax_nopriv_{action}


function icoda_share_count_ajax_handler() {
    if(!empty($_POST['id'])){
        $post_id = absint($_POST['id']);
        $post_type = get_post_type( $post_id );
        if( $post_type === 'post' ) {
            $current_shares = get_post_meta($post_id, 'shares_count', true);
            if( empty($current_shares) ) {
                $current_shares = 1;
            } else {
                $current_shares++;
            }
            $updated = update_post_meta($post_id, 'shares_count', $current_shares);
        }
    }
    wp_send_json_success();
}
add_action( 'wp_ajax_share_count', 'icoda_share_count_ajax_handler' ); // wp_ajax_{action}
add_action( 'wp_ajax_nopriv_share_count', 'icoda_share_count_ajax_handler' ); // wp_ajax_nopriv_{action}

function icoda_count_views() {
    $post_id = get_the_ID();
    $current_views = get_post_meta($post_id, 'views_count', true);
    if( empty($current_views) ) {
        $current_views = 1;
    } else {
        $current_views++;
    }
    update_post_meta($post_id, 'views_count', $current_views);
}

add_filter('wp_footer', function () {
    ?>

    <script type="text/javascript">
        const StolzlMediumObserver = new FontFaceObserver('Stolzl-Medium');

        Promise.all([
            StolzlMediumObserver.load()
        ]).then(function () {
            document.documentElement.className += " fonts-loaded";
        });
    </script>
    <?php
}, 100);


/**
 * ACF
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/api-for-amocrm.php';
require get_template_directory() . '/inc/api-for-clone.php';
include_once get_template_directory() . '/inc/portfolio/portfolio.php';
include_once get_template_directory() . '/inc/faq/faq.php';
include_once get_template_directory() . '/inc/export-strings.php';
include_once get_template_directory() . '/inc/bitrix/bitrix.php';
include_once get_template_directory() . '/inc/api-v1.php';


add_action('admin_menu', 'icoda_spam_request_settings', 1);
function icoda_spam_request_settings()
{
    add_menu_page(
        'Icoda Spam Settings',
        'Spam Settings',
        'manage_options',
        'icoda-spam-settings',
        'icoda_spam_request_settings_output',
        '',
        1
    );

    add_action('admin_init', 'icoda_spam_request_settings_register');
}

function icoda_spam_request_settings_register()
{
    register_setting('icoda_spam_request_settings-group', 'icoda_spam_request_block_ips');
}

function icoda_spam_request_settings_output()
    {
?>

        <div class="wrap">
            <h1>Spam Settings</h1>

            <form method="post" action="options.php">
                <?php settings_fields('icoda_spam_request_settings-group'); ?>
                <?php do_settings_sections('icoda_spam_request_settings-group'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Block IPs</th>
                        <td>
                            <textarea style="width:100%;" rows="20" name="icoda_spam_request_block_ips"><?php echo esc_attr(get_option('icoda_spam_request_block_ips')); ?></textarea>
                            <p>If you want to block several IPs enter every IP from new line</p>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>

<?php
    }

// ДОБАВЛЯЕМ ACF ПОЛЯ В АДМИНКУ
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Главные настройки темы',
        'menu_title' => 'Социальные',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'position' => false,
        // 'redirect'		=> false
    ));

    acf_add_options_page(array(
        'page_title' => 'Главные настройки футера',
        'menu_title' => 'Подвал сайта',
        'menu_slug' => 'theme-general-footer',
        'capability' => 'edit_posts',
        'position' => false,
        // 'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Настройка блока:',
        'menu_title' => 'Link Telegram',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Настройка футера:',
        'menu_title' => 'Menu Footer',
        'parent_slug' => 'theme-general-footer',
    ));

    acf_add_options_sub_page(array(
        'page_title'      => 'Portfolio Archive Settings',
        'parent_slug'     => 'edit.php?post_type=portfolio-case',
        'capability' => 'manage_options'
    ));
}


// ПЕРЕЛИНКОВКА
function true_301_redirect()
{
    /* в массиве указываем все старые=>новые ссылки  */
    $rules = array(
        array('old' => '/de/inner-page/de/', 'new' => '/inner-page/de/'), // страница
        array('old' => '/es/inner-page/es/', 'new' => '/inner-page/es/'), // страница
        array('old' => '/fr/inner-page/fr/', 'new' => '/inner-page/fr/'), // страница
        array('old' => '/ru/inner-page/ru/', 'new' => '/inner-page/ru/'), // страница

        array('old' => '/es/services/es/services/tokens-listing-on-the-coingecko/', 'new' => '/es/services/tokens-listing-on-the-coingecko/'), // страница
        array('old' => '/es/services/es/services/listing-on-the-coingecko-exchange/', 'new' => '/es/services/listing-on-the-coingecko-exchange/'), // страница
        array('old' => '/es/services/es/services/listing-on-coinmarketcap-exchange/', 'new' => '/es/services/listing-on-coinmarketcap-exchange/'), // страница
        array('old' => '/es/services/es/services/crypto-pr/', 'new' => '/es/services/crypto-pr/'), // страница



    );
    foreach ($rules as $rule) :
        // если URL совпадает с одним из указанных в массиве, то редиректим
        if (urldecode($_SERVER['REQUEST_URI']) == $rule['old']) :
            wp_redirect(site_url($rule['new']), 301);
            exit();
        endif;
    endforeach;

    if ( is_single( 6949 ) ) {
        $redirect_url = get_permalink( 28804 );
        if( ! empty( $redirect_url ) ) {
            wp_redirect( $redirect_url );
            exit();
        }
    }
}

add_action('template_redirect', 'true_301_redirect');


// numbered pagination

function pagination($pages = '', $range = 4)

{

    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged)) $paged = 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class=\"pagination\"><span>Page " . $paged . " of " . $pages . "</span>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link(1) . "'>&laquo; First</a>";
        if ($paged > 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo; Previous</a>";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<a href=\"" . get_pagenum_link($paged + 1) . "\">Next &rsaquo;</a>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) echo "<a href='" . get_pagenum_link($pages) . "'>Last &raquo;</a>";
        echo "</div>\n";
    }
}


//add_filter( 'the_content', 'removeSymbwols' );
function removeSymbwols( $content ) {
    $search = "— wp:";
    // Check if we're inside the main loop in a single post page.
    if ( is_single() ) {
        return str_replace($search, '', $content);
    }

    return $content;
}



function cyr_2_lat( $str, $replaceSpaceWith = '' ) {

    $cyr = [
        'а',
        'б',
        'в',
        'г',
        'д',
        'е',
        'ё',
        'ж',
        'з',
        'и',
        'й',
        'к',
        'л',
        'м',
        'н',
        'о',
        'п',
        'р',
        'с',
        'т',
        'у',
        'ф',
        'х',
        'ц',
        'ч',
        'ш',
        'щ',
        'ъ',
        'ы',
        'ь',
        'э',
        'ю',
        'я',
        'А',
        'Б',
        'В',
        'Г',
        'Д',
        'Е',
        'Ё',
        'Ж',
        'З',
        'И',
        'Й',
        'К',
        'Л',
        'М',
        'Н',
        'О',
        'П',
        'Р',
        'С',
        'Т',
        'У',
        'Ф',
        'Х',
        'Ц',
        'Ч',
        'Ш',
        'Щ',
        'Ъ',
        'Ы',
        'Ь',
        'Э',
        'Ю',
        'Я'
    ];
    $lat = [
        'a',
        'b',
        'v',
        'g',
        'd',
        'e',
        'io',
        'zh',
        'z',
        'i',
        'y',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'r',
        's',
        't',
        'u',
        'f',
        'h',
        'ts',
        'ch',
        'sh',
        'sht',
        'a',
        'i',
        'y',
        'e',
        'yu',
        'ya',
        'A',
        'B',
        'V',
        'G',
        'D',
        'E',
        'Io',
        'Zh',
        'Z',
        'I',
        'Y',
        'K',
        'L',
        'M',
        'N',
        'O',
        'P',
        'R',
        'S',
        'T',
        'U',
        'F',
        'H',
        'Ts',
        'Ch',
        'Sh',
        'Sht',
        'A',
        'I',
        'Y',
        'e',
        'Yu',
        'Ya'
    ];

    $str = str_replace( $cyr, $lat, $str );

    if ( ! empty( $replaceSpaceWith ) ) {
        $str = replace_space_2_symbol( $str, $replaceSpaceWith );
    }

    return $str;
}


function pr($data) {
    ?>

    <div class="ddebug_" style="display: none;"><?php print_r($data); ?></div>

    <?php
}

function vd($data) {
    ?>

    <div class="ddebug_"  style="display: none;"><?php var_dump($data); ?></div>

    <?php
}

//w3c validator
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('wp_head', 'rest_output_link_wp_head', 10);

remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

function create_service_taxonomy(){

    // список параметров: wp-kama.ru/function/get_taxonomy_labels
    register_taxonomy( 'taxonomy', [ 'services' ], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => [
            'name'              => 'Categories',
            'singular_name'     => 'Category',
            'search_items'      => 'Search',
            'all_items'         => 'All',
            'view_item '        => 'View',
            'parent_item'       => 'Parent',
            'parent_item_colon' => 'Parent:',
            'edit_item'         => 'Edit',
            'update_item'       => 'Update',
            'add_new_item'      => 'Add New',
            'new_item_name'     => 'New Name',
            'menu_name'         => 'Categories',
        ],
        'description'           => '', // описание таксономии
        'public'                => true,
        'hierarchical'          => true,
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
        'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
        'show_in_rest'          => null, // добавить в REST API
        'rest_base'             => null, // $taxonomy
    ] );
}
// add_action( 'init', 'create_service_taxonomy' );


function icoda_services(){

    $labels = array(
        'name'               => __( 'Services',  'icoda' ),
        'singular_name'      => __( 'Service', 'icoda' ),
        'menu_name'          => __( 'Services', 'icoda' ),
        'name_admin_bar'     => __( 'Services', 'icoda' ),
        'add_new'            => __( 'Add New', 'icoda' ),
        'add_new_item'       => __( 'Add New', 'icoda' ),
        'new_item'           => __( 'New', 'icoda' ),
        'edit_item'          => __( 'Edit', 'icoda' ),
        'view_item'          => __( 'View', 'icoda' ),
        'all_items'          => __( 'All', 'icoda' ),
        'search_items'       => __( 'Search', 'icoda' ),
        'parent_item_colon'  => __( 'Parent:', 'icoda' ),
        'not_found'          => __( 'Not found.', 'icoda' ),
        'not_found_in_trash' => __( 'Not found in Trash.', 'icoda' )
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-admin-generic',
        'taxonomies'         => array('service_category'),
        'supports'           => array('title','editor', 'author', 'excerpt', 'revisions')
    );

    register_post_type( 'services', $args );
}

// add_action( 'init', 'icoda_services' );


add_shortcode( 'icoda_list_of_exchanges', 'icoda_list_of_exchanges_callback' );

function icoda_list_of_exchanges_callback() {
	ob_start();
	get_template_part( 'template-parts/shortcodes/icoda-list-of-exchanges' );
	return ob_get_clean();
}

add_shortcode( 'contact-form-new', 'contact_form_new_callback' );

function contact_form_new_callback() {
	ob_start();
	get_template_part( 'template-parts/shortcodes/contact-form', 'new' );
	return ob_get_clean();
}


add_shortcode( 'perelinks', 'perelinks_callback' );

function perelinks_callback($attrs, $content = '') {
	ob_start();
	get_template_part( 'template-parts/shortcodes/perelinks', '', ['attrs' => $attrs, 'content' => $content] );
	return ob_get_clean();
}

function icodaRemoveEmptyParagraphs($content) {
    $content = force_balance_tags( $content );
    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
    return $content;
}

function disalow_index_ru_and_es_pages($robots_string) {
    global $post;
    $exclude_posts = array(
        8493,
        8503,
        8497,
        8500,
        8489,
    );

    $current_queried_object = ( function_exists('get_queried_object') ) ? get_queried_object() : false;
    $exclede_terms = array(
        42,
        71,
        69,
        41,
        70,
    );

    if( ICL_LANGUAGE_CODE == 'de' ) {
        // $robots_string = 'noindex,nofollow';
    }


    if( ICL_LANGUAGE_CODE == 'ru' ) {
        // $robots_string = 'index, nofollow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    }

    if( ! empty( $post ) && ! empty( $post->ID ) && in_array($post->ID, $exclude_posts) ) {
        $robots_string = 'noindex,nofollow';
    }

    if( ! empty( $current_queried_object ) && ! empty( $current_queried_object->term_id ) && in_array($current_queried_object->term_id, $exclede_terms) ) {
        $robots_string = 'noindex,nofollow';
    }

    $include_posts = array(
        8481,
        9241,
        9252,
        9219,
        9210,
        8506,
        9230,
        9487,
    );
    if( ! empty( $post ) && ! empty( $post->ID ) && in_array($post->ID, $include_posts) ) {
        $robots_string = 'index,follow';
    }
    $include_terms = array(
        81,
        78,
    );
    if( ! empty( $current_queried_object ) && ! empty( $current_queried_object->term_id ) && in_array($current_queried_object->term_id, $include_terms) ) {
        $robots_string = 'index,follow';
    }

    return $robots_string;
}

add_filter( 'wpseo_robots', 'disalow_index_ru_and_es_pages', 90 );

function add_translate_user_meta_fields( $user_meta_fields ) {
    $user_meta_fields[] = 'position';

    return $user_meta_fields;
}
add_filter( 'wpml_translatable_user_meta_fields', 'add_translate_user_meta_fields' );

function add_translate_snippet_title_field( $value ) {
    global $post;
    // && ICL_LANGUAGE_CODE == 'en'
    if( ! empty( $post ) && ! empty( $post->ID ) ) {
        $snippet_id = 'snippet-title-'.$post->ID;
        do_action( 'wpml_register_single_string', 'Snippets', $snippet_id, $value );
        $value = apply_filters( 'wpml_translate_single_string', $value, 'Snippets', $snippet_id );
    }
    return $value;
}
// add_filter( 'wpseo_opengraph_title', 'add_translate_snippet_title_field' );
function add_translate_snippet_desc_field( $value ) {
    global $post;
    if( ! empty( $post ) && ! empty( $post->ID ) ) {
        $snippet_id = 'snippet-desc-'.$post->ID;
        do_action( 'wpml_register_single_string', 'Snippets', $snippet_id, $value );
        $value = apply_filters( 'wpml_translate_single_string', $value, 'Snippets', $snippet_id );
    }
    return $value;
}
// add_filter( 'wpseo_opengraph_desc', 'add_translate_snippet_desc_field' );

function icoda_add_rate_schema( $graph, $context ) {
    $_kksr_casts = get_post_meta(get_the_ID(), "_kksr_casts", true);
    $_kksr_avg = get_post_meta(get_the_ID(), "_kksr_avg", true);
    if($_kksr_casts && $_kksr_avg) {
        foreach( $graph as $key => $graph_item ) {
            // if( $graph_item['@type'] == 'Article' ) {
            //     $graph[$key]["aggregateRating"] = [
            //         "@type" => "AggregateRating",
            //         "ratingValue" => $_kksr_avg,
            //         "ratingCount" =>  $_kksr_casts,
            //         "bestRating" => "5",
            //         "reviewAspect" => $graph_item['headline'],
            //         "itemReviewed" => [
            //             "@type" => "LocalBusiness",
            //             "name" => $graph_item['headline']
            //         ]
            //     ];
            // }

            // if( $graph_item['@type'] == 'Organization' ) {
            //     $graph[$key]["aggregateRating"] = [
            //         "@type" => "AggregateRating",
            //         "ratingValue" => $_kksr_avg,
            //         "ratingCount" =>  $_kksr_casts,
            //         "bestRating" => "5",
            //     ];
            // }


        }
    }

    if( is_singular( 'post' ) && ( has_term( 'services', 'category', get_the_ID() ) || has_term( 'services-zh-hans', 'category', get_the_ID() ) ) ) {
        foreach( $graph as $key => $graph_item ) {
            if( $graph_item['@type'] == 'Article' ) {
                $graph[$key] = [
                    "@context" => "https://schema.org",
                    "@type" => "Product",
                    "aggregateRating" => [
                        "@type" => "AggregateRating",
                        "ratingValue" => 5,
                        "ratingCount" =>  rand(10, 100),
                        "bestRating" => "5",
                    ],
                    "description" => get_the_excerpt( get_the_ID() ),
                    "name" => get_the_title(),
                ];
            }
        }
    }


    return $graph;
}
add_filter( 'wpseo_schema_graph', 'icoda_add_rate_schema', 100, 2 );



add_filter( 'body_class','icoda_body_class_filter' );
function icoda_body_class_filter( $classes ) {
	if( defined('ICL_LANGUAGE_CODE') ) {
		$classes[] = 'lang-' . ICL_LANGUAGE_CODE;
    }
    if(is_home(  )) {
        $classes[] = 'archive';
    }
	return $classes;
}

add_filter( 'wpml_head_langs', function( $languages ) {
    if( is_author() ) {

        $queried_object = get_queried_object();
        $domain = 'https://icoda.io/';
        $languages = [
            [ 'url' => $domain . 'de/author/' . $queried_object->user_nicename . '/', 'code' => 'de' ],
            [ 'url' => $domain . 'ru/author/' . $queried_object->user_nicename . '/', 'code' => 'ru' ],
            [ 'url' => $domain . 'es/author/' . $queried_object->user_nicename . '/', 'code' => 'es' ],
            [ 'url' => $domain . 'author/' . $queried_object->user_nicename . '/', 'code' => 'en' ],
            [ 'url' => $domain . 'zh-hans/author/' . $queried_object->user_nicename . '/', 'code' => 'zh-hans' ],
        ];

        $hreflang_items = array();
        foreach ( $languages as $lang ) {
            $alternate_hreflang = apply_filters( 'wpml_alternate_hreflang', $lang['url'], $lang['code'] );
            $hreflang_code = $lang['code'];
            if ( $hreflang_code ) {
                $hreflang_items[ $hreflang_code ] = str_replace( '&amp;', '&', $alternate_hreflang );
            }
        }
        $hreflang_items = apply_filters( 'wpml_hreflangs', $hreflang_items );

        $hreflang = '';
        if ( is_array( $hreflang_items ) ) {
            foreach ( $hreflang_items as $hreflang_code => $hreflang_url ) {
                if( $hreflang_code == 'en' ) {
                    $hreflang .= '<link rel="alternate" hreflang="' . esc_attr( $hreflang_code ) . '" href="' . esc_url( $hreflang_url ) . '" />' . PHP_EOL;
                    $hreflang .= '<link rel="alternate" hreflang="x-default" href="' . esc_url( $hreflang_url ) . '" />' . PHP_EOL;

                } else {
                    $hreflang .= '<link rel="alternate" hreflang="' . esc_attr( $hreflang_code ) . '" href="' . esc_url( $hreflang_url ) . '" />' . PHP_EOL;
                }
            }
            echo apply_filters( 'wpml_hreflangs_html', $hreflang );
        }

    }

    return $languages;
} );

global $separated_langs;
$separated_langs = '';

add_filter( 'wpml_head_langs', function( $languages ) {
    global $separated_langs;
        $separated_langs = $languages;


    return $languages;
}, 100 );

add_filter( 'wpml_hreflangs_html', function( $hreflang ) {
    if( is_category( 69 ) || is_category( 70 ) || is_category( 41 ) || is_category( 1 ) ) {
        return '';
    }

    global $separated_langs;
    if( ! empty( $separated_langs ) ) {
        $hreflang = '';
        $hreflang_x_default = '';
        $lang_countries = [
            'en' => [
                ['usa', 'US'],
                ['ind', 'IN'],
                ['gbr', 'GB'],
                ['bra', 'BR'],
                ['kor', 'KR'],
                ['vnm', 'VN'],
                ['idn', 'ID'],
                ['twn', 'TW'],
                ['phl', 'PH'],
                ['tur', 'TR'],
               [ 'mys', 'MY'],
                ['nld', 'NL'],
                ['can', 'CA'],
                ['tha', 'TH'],
                ['fra', 'FR'],
                ['pol', 'PL'],
                ['pak', 'PK'],
                ['pse', 'PS'],
                ['jpn', 'JP'],
            ],
            'es' => [
                ['bra', 'BR'],
                ['esp', 'ES'],
                ['arg', 'AR'],
                ['col', 'CO'],
               [ 'mex', 'MX'],
            ],
            'ru' => [
                ['RUS', 'RU'],
                ['ukr', 'UA'],
            ],
            'zh-hans' => [
                ['twn', 'TW'],
                ['kor', 'KR'],
            ],
            'de' => [
                ['deu', 'DE'],
            ],
        ];
        foreach( $separated_langs as $lang ) {

            foreach( $lang_countries[$lang['code']] as $lang_country_postfix ) {
                $hreflang .= '<link rel="alternate" hreflang="' . esc_attr( $lang['code'] . '-' . strtoupper($lang_country_postfix[1]) ) . '" href="' . esc_url( $lang['url'] ) . '" />' . PHP_EOL;
            }

            if('en' == $lang['code']) {
                $hreflang_x_default = '<link rel="alternate" hreflang="x-default" href="' . esc_url( $lang['url'] ) . '" />' . PHP_EOL;
            }

        }
        if( ! empty( $hreflang_x_default ) ) {
            $hreflang .= $hreflang_x_default;
        }

    }
    return $hreflang;
} );

function icoda_get_custom_canonical() {
    $icoda_custom_canonical = '';
    $icoda_queried_object = get_queried_object();

    if( ! empty( $icoda_queried_object ) ) {
        if( get_class($icoda_queried_object) == 'WP_Term' ) {
            switch( $icoda_queried_object->term_id ) {
                case 70:
                    $icoda_custom_canonical = 'https://icoda.io/de/unkategorisiert/';
                    break;
                case 71:
                    $icoda_custom_canonical = 'https://icoda.io/ru/без-категории/';
                    break;
                case 84:
                    $icoda_custom_canonical = 'https://icoda.io/ru/about/';
                    break;
                case 82:
                    $icoda_custom_canonical = 'https://icoda.io/ru/academy/';
                    break;
                case 86:
                    $icoda_custom_canonical = 'https://icoda.io/ru/blog/';
                    break;
                case 85:
                    $icoda_custom_canonical = 'https://icoda.io/ru/cases/';
                    break;
                case 81:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/academy-zh-hans/';
                    break;
                case 66:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/blog-zh-hans/';
                    break;
                case 42:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/careers-zh-hans/';
                    break;
                case 65:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/services-zh-hans/';
                    break;
                case 78:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/cases-zh-hans/';
                    break;
            }
        }

        if( get_class($icoda_queried_object) == 'WP_User' ) {
            switch( $icoda_queried_object->ID ) {
                case 1:
                    // $icoda_custom_canonical = 'https://icoda.io/zh-hans/author/aidcmon4k/';
                    break;
                case 12:
                    // $icoda_custom_canonical = 'https://icoda.io/zh-hans/author/maxim_dev/';
                    break;
            }
        }

        if( get_class($icoda_queried_object) == 'WP_Post' ) {
            switch( $icoda_queried_object->ID ) {
                case 9165:
                    $icoda_custom_canonical = 'https://icoda.io/es/services/content-production/';
                    break;
                case 9127:
                        $icoda_custom_canonical = 'https://icoda.io/es/services/blockchain-development/';
                        break;
                case 8531:
                    $icoda_custom_canonical = 'https://icoda.io/es/services/listing-on-coinmarketcap-exchange/';
                    break;
                case 8474:
                    $icoda_custom_canonical = 'https://icoda.io/es/services/listing-on-the-coingecko-exchange/';
                    break;
                case 9149:
                    $icoda_custom_canonical = 'https://icoda.io/es/services/listing-on-top-price-tracking-websites/';
                    break;
                case 9170:
                    $icoda_custom_canonical = 'https://icoda.io/es/services/marketing-services/';
                    break;
                case 8510:
                    $icoda_custom_canonical = 'https://icoda.io/es/services/tokens-listing-on-the-coingecko/';
                    break;
                case 8513:
                    $icoda_custom_canonical = 'https://icoda.io/es/services/tokens-listing-on-the-coinmarketcap/';
                    break;
                case 9175:
                    $icoda_custom_canonical = 'https://icoda.io/es/services/video-production/';
                    break;
                case 9701:
                    $icoda_custom_canonical = 'https://icoda.io/ru/';
                    break;
                case 9260:
                    $icoda_custom_canonical = 'https://icoda.io/ru/about-us/';
                    break;
                case 10193:
                    $icoda_custom_canonical = 'https://icoda.io/ru/blog/dag-vs-blockchain/';
                    break;
                case 10182:
                    $icoda_custom_canonical = 'https://icoda.io/ru/blog/smart-contract-development/';
                    break;
                case 10188:
                    $icoda_custom_canonical = 'https://icoda.io/ru/blog/why-cryptocurrency-startup-needs-crypto-pr-agency/';
                    break;
                case 8717:
                    $icoda_custom_canonical = 'https://icoda.io/ru/careers/';
                    break;
                case 9712:
                    $icoda_custom_canonical = 'https://icoda.io/ru/careers/internet-marketer/';
                    break;
                case 9714:
                    $icoda_custom_canonical = 'https://icoda.io/ru/careers/local-sales-manager/';
                    break;
                case 10710:
                    $icoda_custom_canonical = 'https://icoda.io/ru/cases/abcc/';
                    break;
                case 10716:
                    $icoda_custom_canonical = 'https://icoda.io/ru/cases/crypto-exchange/';
                    break;
                case 9493:
                    $icoda_custom_canonical = 'https://icoda.io/ru/cases/infinito/';
                    break;
                case 9545:
                    $icoda_custom_canonical = 'https://icoda.io/ru/cases/mobile-crypto-wallet/';
                    break;
                case 10713:
                    $icoda_custom_canonical = 'https://icoda.io/ru/cases/newscrypto/';
                    break;
                case 8718:
                    $icoda_custom_canonical = 'https://icoda.io/ru/contact-us/';
                    break;
                case 9231:
                    $icoda_custom_canonical = 'https://icoda.io/ru/crypto-advertising-networks/';
                    break;
                case 9243:
                    $icoda_custom_canonical = 'https://icoda.io/ru/cryptocurrency-wallets/';
                    break;
                case 8719:
                    $icoda_custom_canonical = 'https://icoda.io/ru/events/';
                    break;
                case 9211:
                    $icoda_custom_canonical = 'https://icoda.io/ru/list-of-all-crypto-exchanges/';
                    break;
                case 9154:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/';
                    break;
                case 9124:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/content-production/';
                    break;
                case 8677:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/analytical-review/';
                    break;
                case 8724:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/blockchain-development/';
                    break;
                case 8697:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/chinese-marketing/';
                    break;
                case 8703:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/crypto-pr/';
                    break;
                case 8680:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/custom-blockchain-development/';
                    break;
                case 8704:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/decentralized-finance-promotion/';
                    break;
                case 8695:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/ieo-on-exchange/';
                    break;
                case 8647:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/korean-marketing/';
                    break;
                case 8671:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/listing-on-coinmarketcap-exchange/';
                    break;
                case 8651:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/listing-on-the-coingecko-exchange/';
                    break;
                case 8726:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/listing-on-top-price-tracking-websites/';
                    break;
                case 8682:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/market-making-for-exchanges/';
                    break;
                case 8684:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/market-making-service/';
                    break;
                case 8722:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/marketing-services/';
                    break;
                case 8694:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/promo-video-creation/';
                    break;
                case 8686:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/smart-contract-development/';
                    break;
                case 8668:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/tokens-listing-on-the-coingecko/';
                    break;
                case 8670:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/tokens-listing-on-the-coinmarketcap/';
                    break;
                case 8727:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/video-production/';
                    break;
                case 8692:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/website-creation/';
                    break;
                case 8672:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/white-paper-development/';
                    break;
                case 10610:
                    $icoda_custom_canonical = 'https://icoda.io/ru/services/youtube-influencers/';
                    break;
                case 9220:
                    $icoda_custom_canonical = 'https://icoda.io/ru/top-crypto-margin-exchanges/';
                    break;
                case 9253:
                    $icoda_custom_canonical = 'https://icoda.io/ru/top-cryptocurrency-media/';
                    break;
                case 6640:
                    $icoda_custom_canonical = 'https://icoda.io/services/content-production/';
                    break;
                case 6642:
                    $icoda_custom_canonical = 'https://icoda.io/services/blockchain-development/';
                    break;
                case 7808:
                    $icoda_custom_canonical = 'https://icoda.io/services/listing-on-coinmarketcap-exchange/';
                    break;
                case 7833:
                    $icoda_custom_canonical = 'https://icoda.io/services/listing-on-the-coingecko-exchange/';
                    break;
                case 7803:
                    $icoda_custom_canonical = 'https://icoda.io/services/listing-on-top-price-tracking-websites/';
                    break;
                case 6598:
                    $icoda_custom_canonical = 'https://icoda.io/services/marketing-services/';
                    break;
                case 7832:
                    $icoda_custom_canonical = 'https://icoda.io/services/tokens-listing-on-the-coingecko/';
                    break;
                case 7816:
                    $icoda_custom_canonical = 'https://icoda.io/services/tokens-listing-on-the-coinmarketcap/';
                    break;
                case 7020:
                    $icoda_custom_canonical = 'https://icoda.io/services/video-production/';
                    break;
                case 9230:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/academy-zh-hans/crypto-advertising-networks/';
                    break;
                case 9241:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/academy-zh-hans/cryptocurrency-wallets/';
                    break;
                case 9210:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/academy-zh-hans/list-of-all-crypto-exchanges/';
                    break;
                case 9219:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/academy-zh-hans/top-crypto-margin-exchanges/';
                    break;
                case 9252:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/academy-zh-hans/top-cryptocurrency-media/';
                    break;
                case 9551:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/bez-rubriki-zh-hans/exchanges-listing-on-the-coingecko/';
                    break;
                case 8481:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/bez-rubriki-zh-hans/infinito/';
                    break;
                case 9560:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/bez-rubriki-zh-hans/listing-on-the-coinmarketcap/';
                    break;
                case 9487:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/bez-rubriki-zh-hans/pr-new/';
                    break;
                case 9557:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/bez-rubriki-zh-hans/tokens-listing-on-the-coinmarketcap-2/';
                    break;
                case 9559:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/bez-rubriki-zh-hans/tokens-listing-on-the-coinmarketcap/';
                    break;
                case 8506:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/cases-zh-hans/mobile-crypto-wallet/';
                    break;
                case 9164:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/services/blockchain-development-service-new/';
                    break;
                case 9129:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/services/content-production-new/';
                    break;
                case 9147:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/services/content-production/';
                    break;
                case 9148:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/services/marketing-department-new/';
                    break;
                case 9150:
                    $icoda_custom_canonical = 'https://icoda.io/zh-hans/services/video-production/';
                    break;
            }
        }
    }

    return $icoda_custom_canonical;
}


add_action('pre_get_posts', 'icoda_pre_get_posts');
function icoda_pre_get_posts($query)
{
	if (!is_admin() && $query->is_main_query() && ( is_category('37') || is_category('78') || is_category('85') || is_category('75') ) ) {
        $query->set( 'post_type', [ 'post', 'portfolio-case' ] );
        $portfolio_visible_cat_id = apply_filters( 'wpml_object_id', 142, 'category', true, ICL_LANGUAGE_CODE );
        $portfolio_case_term = get_term( $portfolio_visible_cat_id, 'portfolio_cat' );
        $tax_query = $query->get('tax_query');
        $tax_query = [];
        $tax_query['relation'] = 'OR';
        $tax_query[] = [
            'taxonomy' => 'portfolio_cat',
            'field'    => 'slug',
            'terms'    => $portfolio_case_term->slug
        ];
        $tax_query[] = [
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $query->get('category_name')
        ];
        $query->set('tax_query', $tax_query);

		$query->set('posts_per_page', -1);
	}
    if (!is_admin() && $query->is_main_query() && ( is_category('148') ) ) {
		$query->set('posts_per_page', -1);
	}

    if (!is_admin() && $query->is_main_query() && is_home() ) {
        $tax_query = $query->get('tax_query');
        $tax_query = [
            'relation' => 'AND'
        ];
        $categories = [
            [
                'id' => 38,
            ],
            [
                'id' => 113,
            ],
            [
                'id' => 36,
            ],
        ];
        $real_cats = [];
        foreach ($categories as $cat_data) {
            $real_cats[] = apply_filters('wpml_object_id', $cat_data['id'], 'category', true, ICL_LANGUAGE_CODE);
        }
        $tax_query[] = [
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $real_cats,
            'operator' => 'IN',
        ];
        if( !empty($_GET['tags']) ) {
            $tax_query[] = [
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => explode(',', $_GET['tags']),
                'operator' => 'IN',
            ];
        }
        $query->set('tax_query', $tax_query);
		$query->set('posts_per_page', 10);
		$query->set('orderby', 'date');
		$query->set('order', 'DESC');
		$query->set('is_home_request', 'yes');

	}

    if (!is_admin() && $query->is_main_query() && (is_category( 'blog') || is_category( 'blog-zh-hans') || is_category( 'top') || is_category( 'top-zh-hans')|| is_category( 'top-es')|| is_category( 'academy') || is_category( 'academy-zh-hans')|| is_category( 'academy-es')) ) {
        if( !empty($_GET['tags']) ) {
            $tax_query = $query->get('tax_query');
            if( !is_array($tax_query) ) {
                $tax_query = [];
            }
            $tax_query[] = [
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => explode(',', $_GET['tags']),
                'operator' => 'IN',
            ];
            $query->set('tax_query', $tax_query);
        }
		$query->set('posts_per_page', 10);
	}
}


add_shortcode('icoda_lang_code', 'icoda_lang_code_func');
function icoda_lang_code_func() {
    $languages = icl_get_languages('skip_missing=1&orderby=code');
    if(!empty($languages)){
            $content = '<div class="icoda-lang-switcher">';
            $content .= '<select>';
            foreach($languages as $l){
                if($l['language_code']){
                    if($l['active']) {
                        $content .= '<option selected="selected"><a href="'.$l['url'].'">'.$l['language_code'].'</a></option>';
                    }
                }
            }
            foreach($languages as $l){
                if($l['language_code']){
                    if(!$l['active']) {
                        $content .= '<option><a href="'.$l['url'].'">'.$l['language_code'].'</a></option>';
                    }
                }
            }
        $content .= '</select>';
        $content .= '</div>';
    }
    return $content;
}

add_filter('wp_nav_menu_items','add_lang_switcher_to_menu', 10, 2);

function icoda_acf_set_language() {
    return acf_get_setting('default_language');
}

function icoda_get_global_option($name) {
    add_filter('acf/settings/current_language', 'icoda_acf_set_language', 100);
    $option = get_field($name, 'option');
    remove_filter('acf/settings/current_language', 'icoda_acf_set_language', 100);
    return $option;
}



add_filter( 'img_caption_shortcode', function( $output, $attr, $content ) {
    $atts = shortcode_atts(
		array(
			'id'         => '',
			'caption_id' => '',
			'align'      => 'alignnone',
			'width'      => '',
			'caption'    => '',
			'class'      => '',
		),
		$attr,
		'caption'
	);

	$atts['width'] = (int) $atts['width'];

	if ( $atts['width'] < 1 || empty( $atts['caption'] ) ) {
		return $content;
	}

    if( empty( $atts['caption'] ) || ( strpos( $atts['caption'], 'tag:h3' ) === false && strpos( $atts['caption'], 'tag:h4' ) === false ) ) {
        return $output;
    }

	$id          = '';
	$caption_id  = '';
	$describedby = '';

	if ( $atts['id'] ) {
		$atts['id'] = sanitize_html_class( $atts['id'] );
		$id         = 'id="' . esc_attr( $atts['id'] ) . '" ';
	}

	if ( $atts['caption_id'] ) {
		$atts['caption_id'] = sanitize_html_class( $atts['caption_id'] );
	} elseif ( $atts['id'] ) {
		$atts['caption_id'] = 'caption-' . str_replace( '_', '-', $atts['id'] );
	}

	if ( $atts['caption_id'] ) {
		$caption_id  = 'id="' . esc_attr( $atts['caption_id'] ) . '" ';
		$describedby = 'aria-describedby="' . esc_attr( $atts['caption_id'] ) . '" ';
	}

	$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

	$html5 = current_theme_supports( 'html5', 'caption' );
	// HTML5 captions never added the extra 10px to the image width.
	$width = $html5 ? $atts['width'] : ( 10 + $atts['width'] );

	/**
	 * Filters the width of an image's caption.
	 *
	 * By default, the caption is 10 pixels greater than the width of the image,
	 * to prevent post content from running up against a floated image.
	 *
	 * @since 3.7.0
	 *
	 * @see img_caption_shortcode()
	 *
	 * @param int    $width    Width of the caption in pixels. To remove this inline style,
	 *                         return zero.
	 * @param array  $atts     Attributes of the caption shortcode.
	 * @param string $content  The image element, possibly wrapped in a hyperlink.
	 */
	$caption_width = apply_filters( 'img_caption_shortcode_width', $width, $atts, $content );

	$style = '';

	if ( $caption_width ) {
		$style = 'style="width: ' . (int) $caption_width . 'px; max-width:100%;" ';
	}

	if ( $html5 ) {
		$html = sprintf(
			'<figure %s%s%sclass="%s">%s%s</figure>',
			$id,
			$describedby,
			$style,
			esc_attr( $class ),
			do_shortcode( $content ),
			sprintf(
				'<figcaption %sclass="wp-caption-text">%s</figcaption>',
				$caption_id,
				$atts['caption']
			)
		);
	} else {

        $regular_sprintf = '<p %sclass="wp-caption-text">%s</p>';
        $caption_val = $atts['caption'];

        if( strpos( $atts['caption'], 'tag:h3' ) !== false ) {
            $regular_sprintf = '<h3 %sclass="wp-caption-text">%s</h3>';
            $caption_val = str_replace('tag:h3', '', $atts['caption']);
        } elseif( strpos( $atts['caption'], 'tag:h4' ) !== false ) {
            $regular_sprintf = '<h4 %sclass="wp-caption-text">%s</h4>';
            $caption_val = str_replace('tag:h4', '', $atts['caption']);
        }

		$html = sprintf(
			'<div %s%sclass="%s">%s%s</div>',
			$id,
			$style,
			esc_attr( $class ),
			str_replace( '<img ', '<img ' . $describedby, do_shortcode( $content ) ),
			sprintf(
				$regular_sprintf,
				$caption_id,
				$caption_val
			)
		);
	}

    $output = $html;

    return $output;
}, 2, 3 );

add_filter( 'img_caption_shortcode', function ($output, $attr, $content) {
    $atts = shortcode_atts(
		array(
			'id'         => '',
			'caption_id' => '',
			'align'      => 'alignnone',
			'width'      => '',
			'caption'    => '',
			'class'      => '',
		),
		$attr,
		'caption'
	);

	$atts['width'] = (int) $atts['width'];

	if ( $atts['width'] < 1 || empty( $atts['caption'] ) ) {
		return $content;
	}

	$id          = '';
	$caption_id  = '';
	$describedby = '';

	if ( $atts['id'] ) {
		$atts['id'] = sanitize_html_class( $atts['id'] );
		$id         = 'id="' . esc_attr( $atts['id'] ) . '" ';
	}

	if ( $atts['caption_id'] ) {
		$atts['caption_id'] = sanitize_html_class( $atts['caption_id'] );
	} elseif ( $atts['id'] ) {
		$atts['caption_id'] = 'caption-' . str_replace( '_', '-', $atts['id'] );
	}

	if ( $atts['caption_id'] ) {
		$caption_id  = 'id="' . esc_attr( $atts['caption_id'] ) . '" ';
		$describedby = 'aria-describedby="' . esc_attr( $atts['caption_id'] ) . '" ';
	}

	$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

	$html5 = current_theme_supports( 'html5', 'caption' );
	// HTML5 captions never added the extra 10px to the image width.
	$width = $html5 ? $atts['width'] : ( 10 + $atts['width'] );

	/**
	 * Filters the width of an image's caption.
	 *
	 * By default, the caption is 10 pixels greater than the width of the image,
	 * to prevent post content from running up against a floated image.
	 *
	 * @since 3.7.0
	 *
	 * @see img_caption_shortcode()
	 *
	 * @param int    $width    Width of the caption in pixels. To remove this inline style,
	 *                         return zero.
	 * @param array  $atts     Attributes of the caption shortcode.
	 * @param string $content  The image element, possibly wrapped in a hyperlink.
	 */
	$caption_width = apply_filters( 'img_caption_shortcode_width', $width, $atts, $content );

	$style = '';

	if ( $caption_width ) {
		$style = 'style="width: ' . (int) $caption_width . 'px; max-width:100%;" ';
	}

	if ( $html5 ) {
		$html = sprintf(
			'<figure %s%s%sclass="%s">%s%s</figure>',
			$id,
			$describedby,
			$style,
			esc_attr( $class ),
			do_shortcode( $content ),
			sprintf(
				'<figcaption %sclass="wp-caption-text">%s</figcaption>',
				$caption_id,
				$atts['caption']
			)
		);
	} else {
		$html = sprintf(
			'<div %s%sclass="%s">%s%s</div>',
			$id,
			$style,
			esc_attr( $class ),
			str_replace( '<img ', '<img ' . $describedby, do_shortcode( $content ) ),
			sprintf(
				'<p %sclass="wp-caption-text">%s</p>',
				$caption_id,
				$atts['caption']
			)
		);
	}

    return $html;
}, 1, 3);


// add_filter( 'img_caption_shortcode_width', "__return_empty_string", 999);


// function icoda_404_pages() {
//     if ( is_single( 6949 ) ) {
//         global $wp_query;
//         $wp_query->set_404();
//         status_header( 404 );
//         nocache_headers();
//         include( get_query_template( '404' ) );
//         die();
//     }
// }

// add_action( 'wp', 'icoda_404_pages' );


add_action( 'template_redirect', function () {
    if( is_page_template( 'template-pages/template-feedback.php' ) && ( empty( $_GET['ik'] ) || $_GET['ik'] !== 'e4a6b' ) ) {
        wp_redirect( get_home_url() );
        exit();
    }

    if(!empty($_GET['test__mail'])){
        $headers = array(
            'From: Icoda <post@icoda.io>',
            'content-type: text/html',
        );

        $send = wp_mail( 'test-tmnw2vz2t@srv1.mail-tester.com', 'Email from Icoda', 'Email from Icoda', $headers );
        var_dump( $send );
    }

    if(!empty($_GET['test__phpmail'])){
        require_once get_stylesheet_directory(  ) . '/PHPMailer/PHPMailerAutoload.php';
        $mail_to_user = new PHPMailer( true );
        try{
            // $mail_to_user->DKIM_private = '/root/dkim/icoda.io.private';
            // $mail_to_user->DKIM_selector = 'mail';
            // $mail_to_user->CharSet = 'utf-8';
            $mail_to_user->isHTML(true);
            $email_body_to_user = file_get_contents( get_stylesheet_directory() . '/template-parts/emails/confirmation.php' );
            $mail_to_user->setFrom('post@icoda.io');
            $mail_to_user->FromName = 'ICODA';
            $email_user = 'gena.test.dev@gmail.com';
            $mail_to_user->addAddress($email_user);
            $mail_to_user->Subject = 'ICODA';
            $mail_to_user->Body    = $email_body_to_user;
            $mail_to_user->send();
            $res_mail_to_user_send = true;
        } catch (Exception $e) {
            $res_mail_to_user_send = $mail_to_user->ErrorInfo;
        }
        var_dump( $res_mail_to_user_send );
    }

} );



add_action('template_redirect', function () {
    if( ! empty( $_GET['remove_tags_before_sync'] ) ) {
        global $sitepress;
        $sitepress->switch_lang('ru');
        $args = array(
            'posts_per_page' => '-1',
            'post_status' => 'all',
            'post_type' => 'post',
            'order' => 'DESC',
        );
            
        // query the DB
        $result = new WP_Query($args);
        $post_ids = [];
        foreach($result->posts as $post_obj) {
            $post_ids[] = $post_obj->ID;            
        }
        var_dump(count($post_ids));
        var_export(implode(',',$post_ids));
        var_export($post_ids);
        die;
    }
}, 200);