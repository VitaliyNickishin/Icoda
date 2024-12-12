<?php
get_header();
?>

<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>

<div class="container section-content">
    <div class="row">
        <div class="col-12 mb-2 mb-md-3">
            <?php the_breadcrumbs(); ?>
        </div>

        <?php if( ! is_category(151) ) : ?>
        <div class="col-12">

            <h2><?php single_cat_title(); ?></h2>

        </div>
        <?php endif; ?>
    </div>
</div>
<div class="article-page">
    <?php
        $service_id = 3823;

        $service_translated_id = icl_object_id( $service_id, 'page', false, ICL_LANGUAGE_CODE );

        $page_object = ( $service_translated_id ) ? get_post( $service_translated_id ) : get_post( $service_id );
        echo apply_filters('the_content', $page_object->post_content);
    ?>
</div>

<?php
get_footer(); ?>