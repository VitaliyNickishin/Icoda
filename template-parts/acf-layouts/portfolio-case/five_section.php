<?php
$items = get_sub_field('items');
?>
<?php if (!empty($items)) : ?>
    <section class="section-six section-half-bg-large bg-grey">
        <div class="container">

            <?php $group_index = 0; ?>
            <?php foreach ($items as $item_data) : ?>
                <?php if ($group_index == 0) : ?>
                    <div class="row mt-5 mb-5 py-lg-5 mb-lg-4">
                    <?php endif; ?>
                    <?php $group_index++; ?>

                    <?php if ($group_index == 1) : ?>
                        <div class="col-12 col-lg-6 pt-lg-4">
                            <h2 class="h4 mb-2 mb-lg-4"><?php echo $item_data['title']; ?></h2>
                            <div class="description mr-lg-5 pr-lg-5">
                                <?php echo $item_data['text']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($group_index == 2) : ?>
                        <div class="col-12 col-lg-6 pt-5 pt-lg-4">
                            <h2 class="h4 mb-2 mb-lg-4"><?php echo $item_data['title']; ?></h2>
                            <div class="description mb-lg-4">
                                <?php echo $item_data['text']; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($group_index >= 2) : ?>
                        <?php $group_index = 0; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>