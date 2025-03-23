<?php
// $post_object_id = get_queried_object_id();
$sidebar_data = [
    'image' => get_field('case_sidebar_image'),
    'title' => get_field('case_sidebar_title'),
    'text' => get_field('case_sidebar_text'),
    'info_title' => get_field('case_sidebar_info_title'),
    'info_items' => get_field('case_sidebar_info_items'),
    'promo_title' => get_field('case_sidebar_promo_title'),
    'promo_text' => get_field('case_sidebar_promo_text'),
];
$t_uri = get_template_directory_uri();
?>
<div data-sticky-sidebar-case class="wrap-sticky">
    <div class="section-cases-sidebar">


        <?php if (is_page_template('template-posts/new-blog-post.php')): ?>
            <?php
            $overwrite_table_of_content = get_field('overwrite_table_of_content', get_the_ID());
            ?>
            <div class="table-of-content" style="display: none;">
                <div class="box">
                    <p class="title mb-2 pb-1"><?php _e('Table of Content', 'icoda'); ?></p>
                    <?php if ($overwrite_table_of_content) : ?>
                        <?php
                        $custom_table_of_content = get_field('custom_table_of_content', get_the_ID());
                        ?>
                        <ol class="list-table is-overwritten">
                            <?php foreach ($custom_table_of_content as $item_data): ?>
                                <li><a href="#<?php echo $item_data['anchor']; ?>"><?php echo $item_data['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ol>
                    <?php else : ?>
                        <ol class="list-table">
                        </ol>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>


        <?php if (is_page_template('template-posts/new-case.php')): ?>
            <div class="box-company-about">
                <div class="box">
                    <div class="box-header">
                        <img class="logo" src="<?php echo $sidebar_data['image']['url']; ?>" alt="<?php echo $sidebar_data['image']['alt']; ?>" />
                    </div>
                    <div class="box-body mt-3 pt-1">
                        <p class="h6 title fw-semibold mb-1">
                            <?php echo $sidebar_data['title']; ?>
                        </p>
                        <?php echo $sidebar_data['text']; ?>
                    </div>
                    <div class="box-footer mt-3 pt-1">
                        <p class="h6 title fw-semibold mb-1"><?php echo $sidebar_data['info_title']; ?></p>
                        <ul class="list-services-perfomed">
                            <?php foreach ($sidebar_data['info_items'] as $item_data) : ?>
                                <li>
                                    <a href="<?php echo $item_data['link']; ?>">
                                        <span class="mr-1"><?php echo $item_data['title']; ?></span>
                                        <img src="<?php echo $t_uri; ?>/assets/images/arrow-more.svg" alt="Arrow" />
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="mt-3 pt-1 pt-lg-3">
            <div class="box-feedback text-lg-left text-center">
                <h2 class="mb-2 pb-1 section-title text-white"><?php echo $sidebar_data['promo_title']; ?></p>
                </h2>
                <p class="text-white"><?php echo $sidebar_data['promo_text']; ?></p>
                <div class="btn-wrap mt-3 pt-1">
                    <a href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/oy--5/talk-to-our-expert'});return false;" class="btn btn-outline-white"><?php echo __('Book Intro Call', 'icoda'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>