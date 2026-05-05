<?php
$author_id = $args['author_id'] ?? get_the_author_meta('ID');
$allowed_authors = [6, 8, 31, 35, 44, 46];
?>
<div class="author-meta">
    <span class="author-name">
        <?php
        echo !in_array($author_id, $allowed_authors) ? 'ICODA' : apply_filters(
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