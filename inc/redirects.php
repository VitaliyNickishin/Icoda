<?php

add_action('template_redirect', function () {
    if (is_singular('post')) {
        global $post;

        // Redirect for https://icoda.io/services/casino-seo/
        $original_post_id = 71163;
        $redirect_url = get_the_permalink(177814);

        // Get all translations of the post
        $translations = apply_filters('wpml_get_element_translations', null, apply_filters('wpml_element_trid', null, $original_post_id, 'post_post'));

        foreach ($translations as $translation) {
            if ($post->ID == $translation->element_id) {
                wp_redirect($redirect_url, 301);
                exit;
            }
        }
    }
});
