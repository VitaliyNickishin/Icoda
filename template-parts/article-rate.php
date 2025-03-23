<?php if (function_exists("kk_star_ratings")) : ?>
    <div class="article-rate">
        <p class="title">
            <?php _e('Rate the article', 'icoda'); ?>
        </p>
        <div class="sub-text">
            <?php echo kk_star_ratings(get_the_ID()); ?>
        </div>
    </div>
<?php endif; ?>