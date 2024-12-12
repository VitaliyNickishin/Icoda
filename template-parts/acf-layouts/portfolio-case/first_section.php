<?php
$info_blocks = get_sub_field('info_blocks');
$right_content = get_sub_field('right_content');
?>
<section class="section-second section-half-bg bg-grey">
    <div class="container">
        <div class="row d-lg-none">
            <div class="col-12">
                <div class="description pt-4">
                    <?php echo $portfolio_case_content; ?>
                </div>
            </div>
        </div>
        <?php if (!empty($info_blocks)) : ?>
            <div class="row pb-lg-5 mt-5">
                <?php foreach ($info_blocks as $key => $info_block) : ?>
                    <?php
                    if ($key == 0) {
                        $add_class = 'col-12 offset-lg-1 col-lg-3';
                    } elseif ($key == 1) {
                        $add_class = 'col-12 col-lg-3';
                    } elseif ($key == 2) {
                        $add_class = 'col-12 offset-lg-1 col-lg-4';
                    }
                    ?>
                    <div class="<?php echo $add_class; ?>">
                        <div class="info-block pb-4">
                            <strong class="h5 mb-2 mb-lg-3 d-block"><?php echo $info_block['title']; ?></strong>
                            <p><?php echo $info_block['value']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($right_content['content'])) : ?>
            <div class="row mt-4 mb-5 py-lg-4">
                <div class="col-12 col-lg-6"></div>

                <div class="col-12 col-lg-6">
                    <?php if (!empty($right_content['title'])) : ?>
                        <h2 class="h4 mb-2 mb-lg-4"><?php echo $right_content['title']; ?></h2>
                    <?php endif; ?>
                    <div class="description mb-lg-4">
                        <?php echo $right_content['content']; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>