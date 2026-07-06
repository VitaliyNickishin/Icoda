<?php
    $author_id = get_the_author_meta('ID');
    $lg_class = 'col-lg-4';
    $tags = get_the_terms(get_the_ID(), 'post_tag');
    $title = get_the_title(get_the_ID());
    $excerpt = get_the_excerpt(get_the_ID());
    $title = mb_strimwidth($title, 0, 45, "...");
    $excerpt = mb_strimwidth($excerpt, 0, 100, "...");
    
    $display_name = get_the_author_meta('display_name');
    $acf_display_name_user_id = 'acf-display_name--user_' . $author_id;
    do_action('wpml_register_single_string', 'Authors', $acf_display_name_user_id, $display_name);
    $display_name = apply_filters('wpml_translate_single_string', $display_name, 'Authors', $acf_display_name_user_id);
?>
<div class="col-12 col-md-6 mb-lg-5 mb-3 <?php echo $lg_class; ?>">
    
    <div class="article-card">
        <?php if (has_post_thumbnail()) : ?>
            <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>
            <?php
            $alt_text = '';
            if (get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) {
                $alt_text = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
            } else {
                $alt_text = get_the_title(get_the_ID());
            }
            ?>
            <div class="article-card-img">
                <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $alt_text; ?>">
            </div>

        <?php endif; ?>

    
        <div class="article-card-body d-flex justify-content-between flex-column" style="min-height:unset">
            <div class="blog-card-body">
                <?php if (!empty($tags)): ?>
                    <div class="tags">
                        <ul class="d-flex">
                            <?php foreach ($tags as $tag_term): ?>
                                <li class="">
                                    <a href="<?php echo get_term_link($tag_term, 'post_tag'); ?>">
                                        <?php echo $tag_term->name; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="title">
                    <a href="<?php echo get_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </div>
                <div class="excerpt"><?php echo $excerpt; ?></div>
            </div>
            <div class="date">
                <p><?php echo $display_name; ?> <span class="dote"></span> <?php echo get_the_date('d F, Y', get_the_ID()); ?></p>
            </div>
        </div>
    </div>
</div>