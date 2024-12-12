<section class="section section-2 <?php echo block_value('className'); ?>">
    <div class="container">
        <div class="row">
            <?php
            if (block_value('title')) {
                echo '<div class="col-12"><p class="h3">' . block_value('title') . '</p></div>';
            }
            ?>
            <div class="col-12">
                <div class="wr-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo __('Event', 'icoda'); ?></th>
                                <th scope="col"><?php echo __('Country', 'icoda'); ?></th>
                                <th scope="col"><?php echo __('City', 'icoda'); ?></th>
                                <th scope="col"><?php echo __('Dates', 'icoda'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php reset_block_rows('row'); ?>
                            <?php while (block_rows('row')) : block_row('row'); ?>
                                <tr>
                                    <th scope="row"><?php block_sub_field('event'); ?></th>
                                    <td><span class="m-ttl"><?php echo __('Country', 'icoda'); ?></span> <?php block_sub_field('country'); ?></td>
                                    <td><span class="m-ttl"><?php echo __('City', 'icoda'); ?></span> <?php block_sub_field('city'); ?></td>
                                    <td><span class="m-ttl"><?php echo __('Dates', 'icoda'); ?></span> <?php block_sub_field('date'); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>