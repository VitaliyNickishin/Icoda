<?php
$pbanalis_items = get_field('pbanalis_items');
?>
<section class="section-analysis indent">
    <div class="container">
        <div class="content-title">
            <div class="row">
                <div class="col-12 col-20">
                    <p class="title"><?php the_field('pbanalis_title'); ?></p>
                </div>
                <div class="col-12 col-80">
                    <div class="description pl-lg-2">
                        <?php the_field('pbanalis_description'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="analysis-box-wrap">

                    <?php foreach ($pbanalis_items as $pbanalis_item) : ?>
                        <div class="analysis-box">
                            <p><?php echo $pbanalis_item['item_value']; ?></p>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </div>
</section>