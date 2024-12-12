<?php if( ! empty( block_value('title') ) || ! empty( block_value('description') ) ) : ?>
    <!-- start   -->
    <section class="section section-1 title-descr_block 22">
        <div class="container">
            <div class="row">
                <?php if (!empty($_GET['postv2'])) : ?>
                    <div class="col-12">
                <?php else : ?>
                    <div class="col-12 col-lg-<?php echo (has_category('academy') || has_category('academy-zh-hans') || has_category('academy-ru') || has_category('academy-es')) ? '10' : '8'; ?> col-xl-<?php echo (has_category('academy') || has_category('academy-zh-hans') || has_category('academy-ru') || has_category('academy-es')) ? '10' : '8'; ?>">
                <?php endif; ?>

                    <?php if(block_value('title')) : ?> <<?php block_field('title-tag'); ?>> <?php block_field('title'); ?> </<?php block_field('title-tag'); ?>> <?php endif; ?>

                    <?php if (!empty($_GET['postv2'])) : ?>
                        <?php get_template_part( 'template-parts/article-date' ); ?>
                    <?php endif; ?>


                    <div class="article-main-content sub-text <?php echo block_value('className'); ?>"><?php
                        // block_field('description');

                        if( ! empty( $_GET['test-paragraphs'] ) ) {
                            $content = block_value('description');
                            $content = preg_replace( '|</p>(\s+)<p>|Uis', '</p><p>&nbsp;</p><p>', $content );
                            echo $content;
                        } else {
                            $content = block_value('description');
                            if( has_shortcode( $content, 'embed' ) ) {
                                echo apply_filters( 'the_content', str_replace('<ul>', '<ul class="marker-list">', block_value('description')) );
                            } else {
                                echo str_replace('<ul>', '<ul class="marker-list">', block_value('description'));
                            }
                        }

                    ?></div>
                </div>
            </div>
        </div>
    </section>
    <!-- end -->
<?php endif; ?>