<?php $rows = block_value('row'); ?>
<section class="section section-2 section-goal-tasks">
    <div class="container">
        <div class="row">
            <div class="d-none d-md-block col-md-5">
                <div class="wr-vertical-nav" id="vertical-nav">
                    <?php if ($rows['rows']) : ?>
                        <ul class="vertical-nav sticky">
                            <li>
                                <?php
                                $res = '';
                                $stages = [];
                                $list = '<ul class="collapse show" id="collapseStages">%list%</ul>';
                                foreach ($rows['rows'] as $row) {
                                    if ($row['stage']) {
                                        array_push($stages, "<li><a href=\"#" . cyr_2_lat($row['stage'], '_') . "\">{$row['stage']}. {$row['title']}</a></li>");
                                    }
                                }

                                foreach ($rows['rows'] as $key => $row) :
                                    if (!$row['stage'] && $row['title']) {
                                        if ($key != 0) {
                                            $res .= '</li>';
                                            $res .= '<li>';
                                        }
                                        $res .= '<a href="#' . cyr_2_lat($row['title'], '_') . '">' . $row['title'] . '</a>';
                                        if ($key == 0) {
                                            $res .= '</li>';
                                            $res .= '<li>';
                                            if (!empty($stages)) {
                                                $res .= '<a data-toggle="collapse" href="#collapseStages" role="button" aria-expanded="true" aria-controls="collapseStages">' . __('Stages', 'icoda') . '</a>';
                                                $res .= $list;
                                            }
                                        }
                                    }
                                endforeach;
                                $stages = (string) str_replace('%list%', implode($stages), $list);
                                echo str_replace($list, $stages, $res);
                                ?>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-7">
                <div class="wr-description-project">
                    <div class="des-section">
                        <?php foreach ($rows['rows'] as $key => $row) :
                            if (!$row['stage'] && ($row['title'] || $row['list'])) {
                                if ($key != 0) {
                                    echo '</div>';
                                    echo '<div class="des-section">';
                                }
                                echo '<p id="' . cyr_2_lat($row['title'], '_') . '" class="h4">' . $row['title'] . '</p>';
                                echo ($row['subtitle-bold']) ? '<p style="margin-top: 20px;"><span class="bold">' . $row['subtitle-bold'] . '</span></p>' : '';
                                echo '<div class="sub-text">' . str_replace('<ul>', '<ul class="marker-list">', $row['list']) . '</div>';
                                if ($key == 0) {
                                    echo '</div>';
                                    echo '<div class="des-section">';
                                }
                            } else {

                                echo '<p id="' . cyr_2_lat($row['stage'], '_') . '" class="stage">' . $row['stage'] . '</p>';
                                echo '<p class="h4">' . $row['title'] . '</p>';
                                echo ($row['subtitle-bold']) ? '<p style="margin-top: 20px;"><span class="bold">' . $row['subtitle-bold'] . '</span></p>' : '';
                                echo '<div class="sub-text">' . str_replace('<ul>', '<ul class="marker-list">', $row['list']) . '</div>';
                            }
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    jQuery(document).ready(function() {
        jQuery('.des-section').each(function() {
            if (jQuery(this).children().length < 1) {
                jQuery(this).remove();
            }
        });
        jQuery('.vertical-nav li').each(function() {
            if (jQuery(this).children().length < 1) {
                jQuery(this).remove();
            }
        });
        jQuery("#vertical-nav").stick_in_parent({
            offset_top: 100
        });

    });
</script>