<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-5 pr-0">
            <div class="text-box">
                <div class="text">
                    <h3 class="section-title"><?php the_field('section_3_title_block-new-en', $args['post_id']); ?></h3>
                    <p class="sub-text"><?php the_field('section_3_text_block-en', $args['post_id']); ?></p>
                </div>
                <div class="label-list-desktop">
                    <div class="label-list">
                        <?php foreach (get_field('section_3_repeater_block-en', $args['post_id']) as $item) : ?>
                            <div class="label-list-item"><?= $item['t']; ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="label-list-mobile">
                    <div class="label-list label-slider custom-slider">
                        <?php foreach (get_field('section_3_repeater_block-en', $args['post_id']) as $item) : ?>
                            <div class="label-list-item"><?= $item['t']; ?></div>
                        <?php endforeach; ?>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-md-12 col-lg-7 col-custom">
            <div class="img-block">
                <img src="/wp-content/uploads/2023/11/for-whom-do-we-work.webp" alt="for-whom-do-we-work" width="965" height="650">
            </div>
        </div>
    </div>
</div>