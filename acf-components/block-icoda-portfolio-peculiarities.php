<?php
$bottom_items = get_field('pbp_items_bottom');
?>
<section class="section-peculiarities bg-grey">
    <div class="container">
        <div class="content-title mb-3 mb-lg-5 pb-5">
            <div class="row">
                <div class="col-12 col-40">
                    <p class="title"><?php the_field('pbp_title'); ?></p>
                </div>
                <div class="col-12 col-60">
                     <div class="description pl-lg-1">
                         <?php the_field('pbp_description'); ?>
                     </div>
                </div>
            </div>
        </div>
        <div class="row pb-lg-4">
            <div class="col-12">
                <div class="content-title mb-4 mb-lg-5">
                    <p class="title"><?php the_field('pbp_title_2'); ?></p>
                    <?php the_field('pbp_description_2'); ?>
                </div>
            </div>
        </div>

        <div class="row pt-4 pt-lg-5">
            <?php foreach ($bottom_items as $bottom_item) : ?>
                <div class="col-12 col-lg-6 col-pair">
                    <div class="content">
                        <div class="bottom">
                            <?php echo $bottom_item['content']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>