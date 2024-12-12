<?php if (!empty(block_value('title')) || !empty(block_value('content'))) : ?>
    <section class="section section-seo">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="h3"><?php block_field('title'); ?></p>
                </div>
                <div class="col-12 col-lg-6">
                    <?php block_field('content'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>