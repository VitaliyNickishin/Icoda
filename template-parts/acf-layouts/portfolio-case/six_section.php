<?php
$image = get_sub_field('image');
$columns = get_sub_field('columns');
?>
<section class="section-seven pb-5 mb-lg-5">
    <div class="container">
        <?php if (!empty($image)) : ?>
            <div class="row pb-lg-4">
                <div class="col-12">
                    <div class="img-wrap">
                        <img src="<?php echo $image; ?>" alt="">
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($columns)) : ?>
            <?php $group_index = 0; ?>
            <?php foreach ($columns as $column_data) : ?>
                <?php if ($group_index == 0) : ?>
                    <div class="row mt-5 pt-lg-5">
                    <?php endif; ?>
                    <?php $group_index++; ?>
                    <?php if ($group_index == 1) : ?>
                        <div class="col-12 col-lg-6">
                            <h2 class="h4 mb-2 mb-lg-4"><?php echo $column_data['title']; ?></h2>
                            <div class="description mr-lg-5 pr-lg-5">
                                <?php echo $column_data['content']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($group_index == 2) : ?>
                        <div class="col-12 col-lg-6 pt-5 pt-lg-0">
                            <h2 class="h4 mb-2 mb-lg-4"><?php echo $column_data['title']; ?></h2>
                            <div class="description mb-lg-4">
                                <?php echo $column_data['content']; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($group_index >= 2) : ?>
                        <?php $group_index = 0; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>