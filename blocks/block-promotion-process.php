<?php
if (!block_rows('steps')) {
    return;
}
?>
<section class="section section-steps">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="h3 text-center"><?php block_field('title'); ?></p>
            </div>
            <div class="col-12">
                <div class="wr-line-steps">

                    <?php while (block_rows('steps')) :
                        block_row('steps'); ?>
                        <?php $description = block_sub_value('description'); ?>
                        <?php $description = explode("\n", $description); ?>

                        <div class="step-item">
                            <div class="num-step"><?php block_sub_field('label'); ?></div>
                            <p class="des-step">
                                <?php
                                    echo implode(' <span class="br"></span>', $description);
                                ?>
                            </p>
                        </div>

                    <?php endwhile;
                    reset_block_rows('steps'); ?>

                </div>
            </div>
        </div>
    </div>
</section>