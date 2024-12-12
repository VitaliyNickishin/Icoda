<?php
// error_reporting(E_ALL);
// ini_set('display_errors','on');
if (!block_rows('services')) {
    return;
}

if (!block_value('title')) {
    return;
}

if( ! function_exists( 'callback_empty_filter' ) ) {
    function callback_empty_filter( $var ) {
        $var = trim( $var );
        return ! empty( $var );
    }
}

$learn_more_status = ! empty( block_value('disable_learn_more') ) ? 'disable' : 'active';
$with_video = ! empty( block_value('with_video') ) ? true : false;
$tag_wrapper = $learn_more_status == 'active' ? 'a' : 'div';
?>
<?php
$show_thumbnail = block_value('show_thumbanil');
$icoda_gb_services = get_field('icoda_gb_services', 'option');
?>
<section class="section section-masonry-gray bg-color-light-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text">
                    <p class="h3"><?php block_field('title'); ?></p>
                    <?php if( ! empty( block_value('description') ) ) : ?>
                    <p class="sub-text"><?php block_field('description'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div id="id2" class="row grid-masonry">
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 grid-sizer"></div>

            <?php if( ! empty( $_GET['new_services'] ) && !empty( $icoda_gb_services ) ) : ?>

                <?php foreach( $icoda_gb_services as $item_row_data ) : ?>
                    <?php $is_hot = !empty( $item_row_data['is_hot'] ) ? true : false; ?>
                    <?php
                    if( ! empty( $item_row_data['custom_title'] ) ) {
                        $title = $item_row_data['custom_title'];
                    } elseif( ! empty( $item_row_data['post_obj'] ) ) {
                        $title = get_the_title( $item_row_data['post_obj'] );
                    }
                    ?>
                    <?php $description = $item_row_data['description']; ?>
                    <?php $description = explode("\n", $description); ?>
                    <?php $description = array_filter( $description, 'callback_empty_filter' ); ?>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 grid-item">
                        <?php $item_post_id = $item_row_data['post_obj']; ?>
                        <?php $item = ! empty( $item_post_id ) ? get_post($item_post_id) : false;  ?>
                        <?php
                            $featured_image_id = $item_row_data['featured_image'];
                            if(!empty( $featured_image_id )) {
                                $thumbnail = wp_get_attachment_image_url( $featured_image_id, 'full' );
                            } else {
                                $thumbnail = get_stylesheet_directory_uri(  ) . '/images/temp-pic.jpg';
                            }
                        ?>

                        <?php if ( ! empty( $item ) || $learn_more_status == 'disable' ) : ?>

                            <?php
                                if( function_exists('icl_object_id')) {
                                    $translated_post = icl_object_id( $item->ID, $item->post_type, false, ICL_LANGUAGE_CODE );
                                    if( ! empty( $translated_post ) ) {
                                        $translated_post = get_post( $translated_post );
                                        if( ! empty( $translated_post ) ) {
                                            $item = $translated_post;
                                        }
                                    }
                                }
                            ?>

                            <?php $title_value = ! empty( trim( $title ) ) ? $title : $item->post_title; ?>

                            <?php
                            if( ! empty( get_the_post_thumbnail_url( $item->ID ) ) ) {
                                $thumbnail = get_the_post_thumbnail_url( $item->ID );
                            }
                            ?>

                            <?php if($with_video) : ?>

                                <a href="#" class="service-card service-card-img link-video link-video-modal" data-toggle="modal" data-target="#videoModalCenter" data-video="https://www.youtube.com/embed/<?php echo $item_row_data['video_id']; ?>">
                                    <span class="wr-img">
                                        <img src="<?php echo $thumbnail; ?>" alt="temp-pic">
                                        <span class="ico-play"></span>
                                    </span>
                                    <span class="service-card-des">
                                        <span class="h6"><?php echo $title_value; ?></span>
                                        <?php if( ! empty( $description ) ) : ?>
                                            <span class="sub-text">
                                                <span class="p"><?php echo implode('</span><span class="p">', $description); ?></span>
                                            </span>
                                        <?php endif; ?>
                                        <?php if( $learn_more_status == 'active' ) : ?>
                                            <span class="service-card-footer">
                                                    <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                            </span>
                                        <?php endif; ?>
                                    </span>
                                </a>

                            <?php else : ?>

                                <<?php echo $tag_wrapper; ?> href="<?php echo get_permalink($item->ID); ?>" class="service-card <?php if (true || $is_hot) {
                                                                                                            echo ' hot ';
                                                                                                        }
                                                                                                        if ($show_thumbnail) {
                                                                                                            echo ' service-card-img ';
                                                                                                        } ?>">
                                    <?php if ($show_thumbnail) : ?>
                                        <span class="wr-img">
                                            <img src="<?php echo $thumbnail; ?>" alt="temp-pic">
                                        </span>
                                    <?php endif; ?>

                                    <span class="h6"><?php echo $title_value; ?></span>
                                    <span class="sub-text">
                                        <span class="p">
                                            <?php
                                            echo implode('</span><span class="p">', $description);
                                            ?>
                                        </span>
                                    </span>
                                    <span class="service-card-footer mt-4">
                                        <?php if( $learn_more_status == 'active' ) : ?>
                                            <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                        <?php endif; ?>
                                        
                                        <?php if ($is_hot) : ?>
                                            <span class="label-hot"><?php echo __('hot', 'icoda'); ?></span>
                                        <?php endif; ?>
                                    </span>
                                </<?php echo $tag_wrapper; ?>>

                            <?php endif; ?>

                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>

            <?php else : ?>
                <?php while (block_rows('services')) :
                    block_row('services'); ?>
                    <?php $is_hot = block_sub_value('is-hot', false) == true ? true : false; ?>
                    <?php $title = block_sub_value('title'); ?>
                    <?php $description = block_sub_value('description'); ?>
                    <?php $description = explode("\n", $description); ?>
                    <?php $description = array_filter( $description, 'callback_empty_filter' ); ?>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 grid-item">
                        <?php $item_post = block_sub_field('service', false); ?>
                        <?php $item_page = block_sub_field('service_page', false); ?>
                        <?php $item = ! empty( $item_post ) ? $item_post : ( ! empty( $item_page ) ? $item_page : false );  ?>
                        <?php
                            $featured_image_id = block_sub_field('featured_image', false);
                            if(!empty( $featured_image_id )) {
                                $thumbnail = wp_get_attachment_image_url( $featured_image_id, 'full' );
                            } else {
                                $thumbnail = get_stylesheet_directory_uri(  ) . '/images/temp-pic.jpg';
                            }
                        ?>

                        <?php if ( ! empty( $item ) || $learn_more_status == 'disable' ) : ?>

                            <?php
                                if( function_exists('icl_object_id')) {
                                    $translated_post = icl_object_id( $item->ID, $item->post_type, false, ICL_LANGUAGE_CODE );
                                    if( ! empty( $translated_post ) ) {
                                        $translated_post = get_post( $translated_post );
                                        if( ! empty( $translated_post ) ) {
                                            $item = $translated_post;
                                        }
                                    }
                                }
                            ?>

                            <?php $title_value = ! empty( trim( $title ) ) ? $title : $item->post_title; ?>

                            <?php
                            if( ! empty( get_the_post_thumbnail_url( $item->ID ) ) ) {
                                $thumbnail = get_the_post_thumbnail_url( $item->ID );
                            }
                            ?>

                            <?php if($with_video) : ?>

                                <a href="#" class="service-card service-card-img link-video link-video-modal" data-toggle="modal" data-target="#videoModalCenter" data-video="https://www.youtube.com/embed/<?php echo block_sub_field('video_id', false) ?>">
                                    <span class="wr-img">
                                        <img src="<?php echo $thumbnail; ?>" alt="temp-pic">
                                        <span class="ico-play"></span>
                                    </span>
                                    <span class="service-card-des">
                                        <span class="h6"><?php echo $title_value; ?></span>
                                        <?php if( ! empty( $description ) ) : ?>
                                            <span class="sub-text">
                                                <span class="p"><?php echo implode('</span><span class="p">', $description); ?></span>
                                            </span>
                                        <?php endif; ?>
                                        <?php if( $learn_more_status == 'active' ) : ?>
                                            <span class="service-card-footer">
                                                    <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                            </span>
                                        <?php endif; ?>
                                    </span>
                                </a>

                            <?php else : ?>

                                <<?php echo $tag_wrapper; ?> href="<?php echo get_permalink($item->ID); ?>" class="service-card <?php if (true || $is_hot) {
                                                                                                            echo ' hot ';
                                                                                                        }
                                                                                                        if ($show_thumbnail) {
                                                                                                            echo ' service-card-img ';
                                                                                                        } ?>">
                                    <?php if ($show_thumbnail) : ?>
                                        <span class="wr-img">
                                            <img src="<?php echo $thumbnail; ?>" alt="temp-pic">
                                        </span>
                                    <?php endif; ?>

                                    <span class="h6"><?php echo $title_value; ?></span>
                                    <span class="sub-text">
                                        <span class="p">
                                            <?php
                                            echo implode('</span><span class="p">', $description);
                                            ?>
                                        </span>
                                    </span>
                                    <span class="service-card-footer mt-4">
                                        <?php if( $learn_more_status == 'active' ) : ?>
                                            <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                        <?php endif; ?>
                                        
                                        <?php if ($is_hot) : ?>
                                            <span class="label-hot"><?php echo __('hot', 'icoda'); ?></span>
                                        <?php endif; ?>
                                    </span>
                                </<?php echo $tag_wrapper; ?>>

                            <?php endif; ?>

                        <?php endif; ?>
                    </div>

                <?php endwhile;
                reset_block_rows('services'); ?>
            <?php endif; ?>
        </div>

        <?php if (block_field('show-button', false)) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="text-center wr-btn">
                        <a href="#contact-with-us" class="btn btn-blue"><?php _e('Contact Us', 'icoda'); ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>