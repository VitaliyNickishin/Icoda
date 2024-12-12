<?php
/*
Template Name: FAQ
*/
?>
<?php get_header(); ?>

<main class="faq">

    <div class="container">
        <div class="row">
            <div class="col-12 mb-2 mb-md-3">
                <?php the_breadcrumbs(); ?>
            </div>
        </div>
    </div>

    <section class="faq-section overflow-hidden position-realative">
        <div class="container">
            <div class="row pb-lg-5 pb-4">
                <div class="col-12 col-lg-6">
                    <div class="mt-4">
                        <h1 class="text-uppercase mb-4"><?php _e('Icoda FAQ', 'icoda-faq'); ?></h1>
                    </div>
                    <div class="faq-form">
                        <p class="mb-2"><?php _e('How can we help you?', 'icoda-faq'); ?></p>
                        <form class="form-search" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="post-date-filter">
                            <div class="form-search-inner position-relative">
                                <input type="search" class="form-control" placeholder="<?php _e('Type keywords to find answers...', 'icoda-faq'); ?>" id="faq-search-field">
                                <button class="search-btn position-absolute r-0 t-0 h-100 pt-2 px-3">
                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="8.33333" cy="8.33333" r="7.83333" stroke="#524F64" />
                                        <line x1="14.3536" y1="13.6464" x2="22.3536" y2="21.6464" stroke="#524F64" />
                                    </svg>
                                </button>
                            </div>
                            <ul class="codyshop-ajax-search"></ul>
                            <p id="passwordHelpBlock" class="text-muted form-advice mt-3 pt-1"><?php _e('You can also browse the topics below to find what you are looking for.', 'icoda-faq'); ?></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-main pb-5 mb-5">
            <div class="container">
                <div class="row pt-lg-5 pt-4">
                    <div class="col-12">
        
                        <?php $terms = get_terms(array('taxonomy' => 'faq_cat')); ?>
        
                        <?php foreach ($terms as $term) { ?>
        
                            <?php
                            $posts = get_posts(
                                array(
                                    'posts_per_page' => -1,
                                    'post_type' => 'post_faq',
                                    'meta_query' => array(array('key' => 'is_frequently_asked_questions', 'value' => 1)),
                                    'tax_query' => array('relation' => 'AND', array('taxonomy' => 'faq_cat', 'terms' => $term->term_id, 'field' => 'id', 'operator' => 'IN'))
                                )
                            );
                            ?>
        
                            <div class="faq-block mb-lg-5 pb-2">
                                <h2 class="title mb-3 mb-lg-5 pb-3 has-square-list"><?php echo $term->name; ?><h2>
                                <div class="ml-lg-5 pl-lg-5 accordion">
        
                                    <?php foreach ($posts as $post) { ?>
        
                                        <?php
                                        $item_id = substr(wp_generate_uuid4(), 0, 8);
                                        ?>
                                            

                                            <div data-item class="accordion-item">
                                                <h3 class="headline">
                                                    <?php echo $post->post_title; ?>
                                                </h3>   

                                                <div data-content class="accordion-content">
                                                    <?php echo apply_filters('the_content', $post->post_content); ?>
                                                </div>
                                            </div>
                                    <?php } ?>
        
                                </div>
                            </div>
        
                        <?php } ?>
        
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php get_template_part('template-parts/sections/contact-us', '', ['need_post_id' => get_option('page_on_front')]); ?>

</main>


<?php get_footer(); ?>