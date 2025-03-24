<div class="article-author">
    <div class="box">
        <div class="d-flex align-items-center">
            <div class="avatar">
                <a href="<?php echo get_author_posts_url($post->post_author); ?>">
                    <?php echo get_avatar($post->post_author, '65'); ?>
                </a>
            </div>
            <div class="author-meta">
                <?php
                $fname = get_the_author_meta('first_name');
                $acf_fname_user_id = 'acf-fname--user_' . $post->post_author;
                do_action('wpml_register_single_string', 'Authors', $acf_fname_user_id, $fname);
                $fname = apply_filters('wpml_translate_single_string', $fname, 'Authors', $acf_fname_user_id);

                $lname = get_the_author_meta('last_name');
                $acf_lname_user_id = 'acf-lname--user_' . $post->post_author;
                do_action('wpml_register_single_string', 'Authors', $acf_lname_user_id, $lname);
                $lname = apply_filters('wpml_translate_single_string', $lname, 'Authors', $acf_lname_user_id);


                $position = get_the_author_meta('position');
                $acf_position_user_id = 'acf-position--user_' . $post->post_author;
                do_action('wpml_register_single_string', 'Authors', $acf_position_user_id, $position);
                $position = apply_filters('wpml_translate_single_string', $position, 'Authors', $acf_position_user_id);
                ?>
                <p class="name"><a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php echo $fname . ' ' . $lname; ?></a></p>
                <p class="position mt-1"><?php echo $position; ?></p>
            </div>
        </div>

        <?php
        $tags = get_the_terms($post, 'post_tag');
        if (!empty($tags)):
        ?>
            <div class="mt-3 pt-lg-1">
                <p class="fw-semibold mb-1 cases-category-title"><?php _e('Tags', 'icoda'); ?>:</p>
                <ul class="cases-category-list d-flex">
                    <?php foreach ($tags as $tag_term): ?>
                        <li class="cases-category-item">
                            <a href="<?php echo get_term_link($tag_term, 'post_tag'); ?>">
                                <?php echo $tag_term->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    </div>
</div>