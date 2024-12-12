<?php
$general_partners = get_field('icoda_gb_partners', 'option');
if (!empty($general_partners['partners_list'])) :
    $title = !empty($general_partners['title']) ? $general_partners['title'] : block_value('title');
    $number_label = !empty($general_partners['number_label']) ? $general_partners['number_label'] : block_value('number_label');
    $description = !empty($general_partners['description']) ? $general_partners['description'] : block_value('description');
?>
    <section class="section section-partners">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="vert-box">
                        <p class="h3"><?php echo $title; ?></p>
                        <div class="text">
                            <p class="num h3"><?php echo $number_label; ?></p>

                            <?php $description = explode("\n", $description); ?>
                            <p class="sub-text">
                                <?php
                                echo implode(' <span class="br"></span>', $description);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="list-logo">

                        <?php if (block_rows('partners_list')) : ?>

                            <?php while (block_rows('partners_list')) :
                                block_row('partners_list'); ?>

                                <div class="list-logo-item">
                                    <img src="<?php block_sub_field('partner_logo'); ?>" alt="img-logo">
                                </div>

                            <?php endwhile;
                            reset_block_rows('partners_list'); ?>

                        <?php elseif (!empty($general_partners['partners_list'])) : ?>

                            <?php foreach ($general_partners['partners_list'] as $partners_list_item) : ?>
                                <div class="list-logo-item">
                                    <img src="<?php echo $partners_list_item['partner_logo']; ?>" alt="img-logo">
                                </div>
                            <?php endforeach; ?>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>