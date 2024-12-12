<?php
$need_post_id = !empty($args['need_post_id']) ? $args['need_post_id'] : get_the_ID();

$list_countries = get_field('section_meet_up_list_countries', $need_post_id);
$list_countries_new = get_field('section_meet_up_list_countries_new', $need_post_id);

$classes = [
    'venezuela',
    'poland-war',
    'germany',
    'georgia',
    'israel',
    'japan',
    'antalya',
    'bali',
    'thailand',
    'poland-wro',
];

?>
<?php if (get_field('section_meet_up_show', $need_post_id) == true) : ?>

    <section class="section meet-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="text">
                        <h3 class="section-title"><?php the_field('section_meet_up_title', $need_post_id); ?></h3>
                    </div>
                </div>
                <div class="col-12 col-lg-4 pl-lg-5 d-none">
                    <div class="text">
                        <h3 class="section-title"><?php the_field('section_meet_up_title', $need_post_id); ?></h3>
                    </div>
                    <ul class="list-countrys">
                        <li><?php echo implode('</li><li>', explode("\n", $list_countries)); ?></li>
                    </ul>
                </div>
                <div class="col-12 px-0">
                    <div class="meet-up-inner">
                        <img class="map" src="<?php the_field('section_meet_up_map', $need_post_id); ?>" alt="map">
                        <?php foreach( $list_countries_new as $key => $item_data ) : ?>
                            <div class="location-info location-info-<?php echo $classes[$key]; ?>">
                                <p class="title-city"><?php echo $item_data['city']; ?></p>
                                <p class="title-country"><?php echo $item_data['country']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php endif; ?>