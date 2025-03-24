<?php

if (has_category('services') || has_category('services-es') || has_category('services-zh-hans') || has_category('services-ru')) {
    return;
}

if (has_category('cases') || has_category('cases-es') || has_category('cases-zh-hans') || has_category('cases-it')) {
    return;
}

$custom_published_date  = get_field('custom_published_date');

if (empty($custom_published_date)) {
    $custom_published_date = get_the_date('F j, Y', get_the_ID());
} else {
    $custom_published_date = date_i18n('F j, Y', strtotime($custom_published_date));
}


$post_v3 = get_field('post_v3');
?>
<?php
$updated_date = get_the_modified_date('F j, Y', get_the_ID());
?>
<?php if (is_page_template('template-posts/new-blog-post.php')) : ?>

    <?php if (strtotime($updated_date) > strtotime($custom_published_date)) : ?>
        <p class="published-article"><?php echo sprintf(__('Published: %s', 'icoda'), $custom_published_date); ?> <span class="separator">-</span> <span class="updated-article"<?php echo sprintf(__('Updated: %s', 'icoda'), $updated_date); ?></span></p>
    <?php else : ?>
        <p class="published-article"><?php echo sprintf(__('Published: %s', 'icoda'), $custom_published_date); ?></p>
    <?php endif; ?>

    <?php
    $time_to_read = icoda_get_time_to_read();
    ?>
    <p class="time-read"><?php echo sprintf(_nx('%s minute to read', '%s minutes to read', $time_to_read, 'icoda'), $time_to_read); ?></p>
<?php elseif (!empty($_GET['postv2']) || !empty($post_v3)) : ?>
    <div class="article-date">
        <?php if (strtotime($updated_date) > strtotime($custom_published_date)) : ?>
            <?php echo sprintf(__('Updated: %s', 'icoda'), $updated_date); ?>
            <br />
            <?php echo sprintf(__('Published: %s', 'icoda'), $custom_published_date); ?>
        <?php else : ?>
            <?php echo sprintf(__('Published: %s', 'icoda'), $custom_published_date); ?>
        <?php endif; ?>
    </div>
<?php else : ?>

    <section class="section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if (strtotime($updated_date) > strtotime($custom_published_date)) : ?>
                        <p><?php echo sprintf(__('Updated: %s', 'icoda'), $updated_date); ?></p>
                        <p><?php echo sprintf(__('Published: %s', 'icoda'), $custom_published_date); ?></p>
                    <?php else : ?>
                        <p><?php echo sprintf(__('Published: %s', 'icoda'), $custom_published_date); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>