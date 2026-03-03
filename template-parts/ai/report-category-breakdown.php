<?php
    $category_config = [
        'ai_access' => [
            'label' => __('AI Access Control', 'icoda'),
        ],
        'content_structure' => [
            'label' => __('Content Structure', 'icoda'),
        ],
        'structured_data' => [
            'label' => __('Structured Data', 'icoda'),
        ],
        'technical' => [
            'label' => __('Technical Infrastructure', 'icoda'),
        ],
    ];
?>

<div class="report-box-wrapper">
    <div class="report-box category-breakdown">
        <div class="col-12 px-lg-2">
            <h2 class="title mb-lg-4 mb-2 has-border"><?php _e('Category Breakdown', 'icoda'); ?></h2>
        </div>
        <div class="category-breakdown-wrapper">
            <?php foreach ($category_config as $key => $config): ?>
                <div class="category-box surface p-3">
                    <p class="text-muted"><?php echo esc_html($config['label']); ?></p>
                    <div class="category-circle" 
                        data-key="<?php echo esc_attr($key); ?>"
                        data-score="0"
                        >
                        <div class="circle">
                            <svg viewBox="0 0 120 120">
                                <circle class="bg" cx="60" cy="60" r="50"></circle>
                                <circle class="progress" cx="60" cy="60" r="50"></circle>
                                <circle class="marker" cx="0" cy="0" r="3"></circle>
                            </svg>
                            <span class="percent">0%</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>