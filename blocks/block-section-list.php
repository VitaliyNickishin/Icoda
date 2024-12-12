<?php
if (!block_rows('list')) {
    return;
}

$list = block_value( 'list' );
$has_data = false;
foreach( $list['rows'] as $list_item ) {
    if( ! empty( $list_item['content'] ) || ! empty( $list_item['title'] ) ) {
        $has_data = true;
        break;
    }
}

if( ! $has_data ) {
    echo "<!-- No data -->";
    return;
}

?>
<section class="section section-list">
    <div class="container">
        <div class="row">

            <?php $i = 0; ?>
            <?php while (block_rows('list')) :
                block_row('list'); ?>
                <?php $content = block_sub_value('content'); ?>
                <?php
                if( empty( $content ) && empty( block_sub_value('title') ) ) {
                    continue;
                }
                ?>
                <?php if( ! empty( $content ) ) { ?>
                <?php
                $content = explode("-----", $content);
                ?>
                   <?php
                        foreach( $content as $key => $list_item ) {
                            $list_item_tmp = trim( $list_item );
                            $list_item_tmp = explode("\n", $list_item_tmp);

                            if( ! empty( $list_item_tmp ) ) {
                                $content[ $key ] = implode(' <span class="br"></span>', $list_item_tmp);
                            }
                        }
                    ?>
                <?php } ?>

                <div class="col-12 col-lg-6">
                    <?php if( $i % 2 === 0 ) : ?><div class="l-list n-list"><?php else : ?> <div class="r-list n-list"> <?php endif; ?>

                        <?php if( ! empty( block_sub_value('with_background') ) ) : ?>
                            <div class="bg-line-u"></div>
                        <?php endif; ?>


                        <p class="h3 title"><?php block_sub_field('title'); ?></p>


                        <?php if( ! empty( $content ) ) : ?>
                        <ul class="marker-list">
                            <?php foreach( $content as $content_item_li) : ?>
                                <?php
                                        $content_item_li_tmp = trim(str_replace('<br>', '', trim($content_item_li)));
                                    ?>
                                <?php if(empty( $content_item_li_tmp )) : ?>
                                    <?php echo $content_item_li; ?>
                                <?php else : ?>
                                <li><?php echo $content_item_li; ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <?php $i++; ?>
            <?php endwhile;
            reset_block_rows('list'); ?>

        </div>
    </div>
</section>