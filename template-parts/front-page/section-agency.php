<?php
$show = get_field('section_agency_show');
// $show = false;

// $show = !empty($_GET['show_new_blocks']);

?>
<?php if ($show) : ?>
    <?php
    $title = get_field('section_agency_title');
    $left = get_field('section_agency_text_left');
    $right = get_field('section_agency_text_right');
    $items = get_field('section_agency_items');
    ?>
    <section class="section section-agency">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-lg-3 pb-lg-3 mb-2 pb-1 title section-title">
                        <?php echo $title; ?>
                    </h4>
                </div>
                <div class="col-12 col-lg-5">
                    <?php echo $left; ?>
                </div>
                <div class="col-12 col-lg-5 offset-lg-1 mt-4 mt-lg-0">
                    <?php echo $right; ?>
                </div>
            </div>
            <div class="row list-agency mt-lg-5 pt-lg-2 mt-4 pt-2">
                <?php if(!empty($items)) : ?>
                    <?php foreach ($items as $item_data) : ?>
                        <div class="col-6 col-lg-3 p-lg-2 p-1">
                            <div class="card-agency">
                                <div class="card-agency__img">
                                    <picture>
                                        <img src="<?php echo $item_data['image_desktop']; ?>" alt="<?php echo $item_data['title']; ?>">
                                    </picture>
                                </div>
                                <div class="card-agency__name text-center">
                                    <?php echo $item_data['title']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>