<?php

if (has_category('services') || has_category('services-es') || has_category('services-zh-hans') || has_category('services-ru')) {
    return;
}

?>

<?php if (function_exists("kk_star_ratings")) : ?>
    <section class="section post-rate mb-4 mb-lg-5 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="post-rate-inner d-flex align-items-center flex-column flex-md-row justify-content-center p-3">
                        <p class="pr-md-3 mb-md-0 mb-2"><?php _e('Rate the article', 'icoda'); ?></p>
                        <div class="sub-text">
                            <?php echo kk_star_ratings(get_the_ID()); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>