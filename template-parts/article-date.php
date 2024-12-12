<?php

if (has_category('services') || has_category('services-es') || has_category('services-zh-hans') || has_category('services-ru')) {
    return;
}

$custom_published_date  = get_field('custom_published_date');
$custom_published_date = empty($custom_published_date) ? get_the_date('c', get_the_ID()) : $custom_published_date;
$custom_published_date = date_i18n('F j, Y', strtotime($custom_published_date));

$post_v3 = get_field('post_v3');
?>

<?php if (!empty($_GET['postv2']) || !empty($post_v3)) : ?>
    <div class="article-date"><?php echo $custom_published_date; ?></div>
<?php else : ?>

    <section class="section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p><?php echo $custom_published_date; ?></p>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>