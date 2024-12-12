<?php
$need_post_id = !empty($args['need_post_id']) ? $args['need_post_id'] : get_the_ID();

$list_countries = get_field('section_meet_up_list_countries', $need_post_id);
$list_countries_new = get_field('section_meet_up_list_countries_new', $need_post_id);

$classes = [
    'venezuela',
    'poland-war',
    // 'germany-mainz',
    'germany-stuttgart',
    'italy',
    'japan',
    'antalya',
    'china',
    'thailand',
    // 'poland-wro',
    'swiss',
    'usa',
];

?>
<?php if (get_field('section_meet_up_show', $need_post_id) == true) : ?>

    <section class="section meet-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <h3 class="section-title">
                        <?php the_field('section_meet_up_title', $need_post_id); ?>
                    </h3>
                </div>
                <div class="col-12 px-0">
                    <div class="meet-up-inner">
                        <img class="map" src="<?php the_field('section_meet_up_map', $need_post_id); ?>" alt="map">
                        <?php if(!empty($list_countries_new)) : ?>
                            <?php foreach( $list_countries_new as $key => $item_data ) : ?>
                                <div class="location-info location-info-<?php echo $classes[$key]; ?>">
                                    <p class="title-city"><?php echo $item_data['city']; ?></p>
                                    <p class="title-country"><?php echo $item_data['country']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php endif; ?>