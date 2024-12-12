<?php
$items = get_sub_field('items');
?>
<?php if (!empty($items)) : ?>
    <section class="section-fourth bg-grey py-5">
        <div class="container">
            <?php $group_index = 0; ?>
            <?php foreach ($items as $item_data) : ?>
                <?php if ($group_index == 0) : ?>
                    <div class="row pt-lg-4 my-lg-5">
                    <?php endif; ?>
                    <?php $group_index++; ?>

                    <?php if ($group_index == 1) : ?>
                        <div class="col-12 offset-lg-1 col-lg-5">
                            <div class="img-wrap">
                                <img src="<?php echo $item_data['image']; ?>" alt="">
                            </div>
                            <div class="content pt-5 mt-lg-5 pr-lg-5 mr-lg-5">
                                <h2 class="h4 mb-2 mb-lg-4"><?php echo $item_data['title']; ?></h2>
                                <div class="description mb-4 mb-lg-0">
                                    <?php echo $item_data['content']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($group_index == 2) : ?>
                        <div class="col-12 col-lg-5 d-flex flex-lg-column flex-column-reverse">
                            <div class="content pb-lg-5 mb-lg-4 pt-5 pt-lg-0 pr-lg-5 mr-lg-5">
                                <h2 class="h4 mb-2 mb-lg-4"><?php echo $item_data['title']; ?></h2>
                                <div class="description">
                                    <?php echo $item_data['content']; ?>
                                </div>
                            </div>
                            <div class="img-wrap mt-4 mt-lg-0">
                                <img src="<?php echo $item_data['image']; ?>" alt="">
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