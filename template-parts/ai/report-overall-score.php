<!-- Overall Score -->
<?php
    $gauge_config = [
        'ai_access' => [
            'label' => __('AI Access', 'icoda'),
            'color' => '#F31212',
        ],
        'content_structure' => [
            'label' => __('Content Structure', 'icoda'),
            'color' => '#fe8c3a',
        ],
        'technical' => [
            'label' => __('Technical Readiness', 'icoda'),
            'color' => '#07BD47',
        ],
    ];

    $gauge_status = [
        'poor' => [
            'label' => __('Poor', 'icoda'),
        ],
        'fair' => [
            'label' => __('Fair', 'icoda'),
        ],
        'good' => [
            'label' => __('Good', 'icoda'),
        ],
        'excellent' => [
            'label' => __('Excellent', 'icoda'),
        ],
    ];
?>
<div class="report-box-wrapper">
    <div class="report-box overall-score">
        <div class="row mx-lg-n2">
            <div class="col-12">
                <h2 class="title mb-lg-4 mb-2 has-border"><?php _e('Overall Score', 'icoda'); ?></h2>
            </div>
            
            <?php foreach ($gauge_config as $key => $config): ?>
                <div class="col-12 col-lg-4 px-lg-2">
                    <div class="score-card surface">
                        <div class="gauge"
                            data-key="<?php echo esc_attr($key); ?>"
                            data-color="<?php echo esc_attr($config['color']); ?>"
                            data-score="0">

                            <svg viewBox="0 0 295 190">
                                <path class="gauge-bg"
                                    d="M35 155 A110 110 0 0 1 260 155" />
                                <path class="gauge-fill"
                                    d="M35 155 A110 110 0 0 1 260 155" />
                                <circle class="gauge-dot" r="4" />
                                <rect class="gauge-pointer"
                                    width="2"
                                    height="101"
                                    rx="2" />
                            </svg>

                            <div class="gauge-value">0</div>
                            <div class="gauge-label">
                                <?php echo esc_html($config['label']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="col-12">
                <ul class="status-dot-list mt-lg-4 mt-2">
                    <?php foreach ($gauge_status as $key => $status): ?>
                        <li>
                            <span class="status-dot status-dot_<?php echo esc_attr($key); ?>">
                                <?php echo esc_html($status['label']); ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>