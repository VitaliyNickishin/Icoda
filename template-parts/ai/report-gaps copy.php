<!-- Content Gaps -->
<!-- <div class="report-box-wrapper">
    <div class="report-box report-gaps">
        <h2 class="title mb-lg-4 mb-2 has-border">
            <?php _e('Content Gaps', 'icoda'); ?>
        </h2>

        <div class="report-gaps-wrapper d-flex flex-column"> -->
            <!-- Blur all status beside LOW (status-excellent)-->
            <!-- <div class="report-card surface p-3 d-flex flex-column status-excellent">
                <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                    <h3 class="title"><?php _e('No How-To Content', 'icoda'); ?></h3>
                    <div>
                        <span class="badge-status"><?php _e('Low', 'icoda'); ?></span>
                    </div>
                </div>
                <div class="text-muted">
                    <?php _e('Step-by-step guides are highly valued by AI for instructional queries.', 'icoda'); ?>
                </div>
                <div class="text-default mb-0">
                    <?php _e('Create how-to guides relevant to your services.', 'icoda'); ?>
                </div>

            </div> -->

            <!-- <div class="report-card surface p-3 d-flex flex-column status-poor">
                <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                    <h3 class="title"><?php _e('No How-To Content', 'icoda'); ?></h3>
                    <div>
                        <span class="badge-status"><?php _e('High', 'icoda'); ?></span>
                    </div>
                </div>
                <div class="text-muted">
                    <?php _e('Step-by-step guides are highly valued by AI for instructional queries.', 'icoda'); ?>
                </div>
                <div class="text-default mb-0">
                    <?php _e('Create how-to guides relevant to your services.', 'icoda'); ?>
                </div>
            </div> -->

            <!-- <div class="report-card surface p-3 d-flex flex-column status-fair">
                <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                    <h3 class="title"><?php _e('No How-To Content', 'icoda'); ?></h3>
                    <div>
                        <span class="badge-status"><?php _e('Medium', 'icoda'); ?></span>
                    </div>
                </div>
                <div class="text-muted">
                    <?php _e('Step-by-step guides are highly valued by AI for instructional queries.', 'icoda'); ?>
                </div>
                <div class="text-default mb-0">
                    <?php _e('Create how-to guides relevant to your services.', 'icoda'); ?>
                </div>
            </div> -->

            <!-- <div class="content-gaps-btn">
                <button data-toggle="modal" data-target="#get-detailed-report" class="btn btn-blue btn-report">
                    <span class="ci ci-message"><?php _e('Unlock all content gaps', 'icoda'); ?></span>
                </button>
            </div>
        </div>
    </div>
</div> -->
<?php
$content_gaps = $data['content_gaps'] ?? [];
 $report_cards = [
        'excellent' => [
            'class' => 'excellent',
        ],
        'high' => [
            'class' => 'high',
        ],
        'medium' => [
            'class' => 'medium',
        ],
    ];
?>

<div class="report-box-wrapper">
    <div class="report-box report-gaps">
        <h2 class="title mb-lg-4 mb-2 has-border">
            <?php _e('Content Gaps', 'icoda'); ?>
        </h2>

        <div class="report-gaps-wrapper d-flex flex-column">

            
                <?php foreach ($report_cards as $card) : 
                    
                    // Определяем класс как в JS
                    $impactClass = 'excellent';

                    if ($element['impact'] === 'high') {
                        $impactClass = 'poor';
                    } elseif ($element['impact'] === 'medium') {
                        $impactClass = 'fair';
                    }

                ?>
                    <div class="report-card surface p-3 d-flex flex-column status-<?php echo esc_attr($impactClass); ?>">
                        
                        <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                            
                            <h3 class="title">
                                <?php echo esc_html($element['title']); ?>
                            </h3>

                            <div>
                                <span class="badge-status">
                                    <?php echo esc_html(ucfirst($element['impact'])); ?>
                                </span>
                            </div>

                        </div>

                        <div class="text-muted">
                            <?php echo esc_html($element['description']); ?>
                        </div>

                        <div class="text-default mb-0">
                            <?php echo esc_html($element['action']); ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            

            <div class="content-gaps-btn">
                <button data-toggle="modal" data-target="#get-detailed-report" class="btn btn-blue btn-report">
                    <span class="ci ci-message">
                        <?php _e('Unlock all content gaps', 'icoda'); ?>
                    </span>
                </button>
            </div>

        </div>
    </div>
</div>