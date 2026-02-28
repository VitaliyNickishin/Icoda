<!-- Recommendations -->
<div class="report-box-wrapper">
    <div class="report-box report-recommendation">
        <h2 class="title mb-lg-4 mb-2 has-border">
            <?php _e('Recommendations', 'icoda'); ?>
        </h2>

        <?php
            $block_tabs['nav_tabs'] = [
                ['nav_tab_title' => '24 All'],
                ['nav_tab_title' => '12 High Impact'],
                ['nav_tab_title' => '12 Quick Wins']
            ];

            $block_tabs['tab_contents'] = [

                // TAB 1 — All (24)
                [
                    'cards' => [

                        [
                            'status_class' => 'status-excellent',
                            'title' => 'Add llms.txt File',
                            'badge' => 'Low',
                            'id' => 'add_llms_txt',
                            'description' => 'Consider adding llms.txt - an emerging standard for AI crawler instructions. Early adopters may get indexing benefits.',
                            'time' => '10min',
                            'roi' => '5/10',
                            'impact' => '10/20'
                        ],

                        [
                            'status_class' => 'status-fair',
                            'title' => 'Add Article Schema',
                            'badge' => 'Medium',
                            'id' => 'add_article_schema',
                            'description' => 'Add Article schema to your blog posts for proper attribution when AI cites your content.',
                            'time' => '10min',
                            'roi' => '5/10',
                            'impact' => '10/20'
                        ],

                        [
                            'status_class' => 'status-poor',
                            'title' => 'Fix Missing Meta Tags',
                            'badge' => 'High',
                            'id' => 'fix_meta_tags',
                            'description' => 'Meta tags help AI and search engines understand your pages correctly.',
                            'time' => '20min',
                            'roi' => '7/10',
                            'impact' => '15/20'
                        ]

                    ]
                ],


                // TAB 2 — High Impact (12)
                [
                    'cards' => [

                        [
                            'status_class' => 'status-poor',
                            'title' => 'Improve Structured Data',
                            'badge' => 'High',
                            'id' => 'structured_data',
                            'description' => 'Improve structured data markup for better AI indexing.',
                            'time' => '30min',
                            'roi' => '8/10',
                            'impact' => '18/20'
                        ]

                    ]
                ],


                // TAB 3 — Quick Wins (12)
                [
                    'cards' => [

                        [
                            'status_class' => 'status-excellent',
                            'title' => 'Optimize Titles',
                            'badge' => 'Low',
                            'id' => 'optimize_titles',
                            'description' => 'Improve page titles to help AI understand page topics.',
                            'time' => '5min',
                            'roi' => '4/10',
                            'impact' => '6/20'
                        ]

                    ]
                ]

            ];
        ?>

        <nav>
            <div class="nav nav-tabs border-0 mb-2 mb-lg-4" id="nav-tab" role="tablist">
                <?php if (!empty($block_tabs['nav_tabs'])) : ?>
                    <?php foreach ($block_tabs['nav_tabs'] as $index => $nav_tab) : ?>
                        <button class="nav-link badge-status badge-status_primary <?php if ($index === 0) : ?>active<?php endif; ?>" id="nav-<?php echo $index; ?>-tab" data-toggle="tab" data-target="#nav-<?php echo $index; ?>" type="button" role="tab" aria-controls="nav-<?php echo $index; ?>" aria-selected="true">
                            <?php echo $nav_tab['nav_tab_title']; ?>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </nav>

        
        <!-- <div class="content-recommendation-wrapper d-flex flex-column"> -->
        <!-- Blur only status HIGH (status-poor)-->
        <!-- <div class="report-card surface p-3 d-flex flex-column status-excellent">
            <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                <h3 class="title"><?php _e('Add llms.txt File', 'icoda'); ?></h3>
                <div>
                    <span class="badge-status"><?php _e('Low', 'icoda'); ?></span>
                </div>
            </div>
            <div class="text-muted">
                <div><?php _e('ID:', 'icoda'); ?><span>add_llms_txt</span> </div>
                <div><?php _e('Consider adding llms.txt - an emerging standard for AI crawler instructions. Early adopters may get indexing benefits..', 'icoda'); ?></div>
            </div>
            <div class="recommendation-info d-flex align-items-lg-center flex-column flex-lg-row">
                <div class="slot-info time">
                    <span>10min</span>
                </div>
                <div class="slot-info roi">
                    <span><?php _e('ROI:', 'icoda'); ?></span>
                    <span>5/10</span>
                </div>
                <div class="slot-info impact">
                    <span><?php _e('ROI:', 'icoda'); ?></span>
                    <span>10/20</span>
                </div>
            </div>

        </div> -->

        <!-- <div class="report-card surface p-3 d-flex flex-column status-fair">
            <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                <h3 class="title"><?php _e('Add Article Schema', 'icoda'); ?></h3>
                <div>
                    <span class="badge-status"><?php _e('Medium', 'icoda'); ?></span>
                </div>
            </div>
            <div class="text-muted">
                <div><?php _e('ID:', 'icoda'); ?><span>add_article_schema</span> </div>
                <div><?php _e('Add Article schema to your blog posts for proper attribution when AI cites your content.', 'icoda'); ?></div>
            </div>
            <div class="recommendation-info d-flex align-items-lg-center flex-column flex-lg-row">
                <div class="slot-info time">
                    <span>10min</span>
                </div>
                <div class="slot-info roi">
                    <span><?php _e('ROI:', 'icoda'); ?></span>
                    <span>5/10</span>
                </div>
                <div class="slot-info impact">
                    <span><?php _e('ROI:', 'icoda'); ?></span>
                    <span>10/20</span>
                </div>
            </div>

        </div> -->

        <!-- <div class="report-card surface p-3 d-flex flex-column status-poor">
            <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                <h3 class="title"><?php _e('Add Article Schema', 'icoda'); ?></h3>
                <div>
                    <span class="badge-status"><?php _e('High', 'icoda'); ?></span>
                </div>
            </div>
            <div class="text-muted">
                <div><?php _e('ID:', 'icoda'); ?><span>add_article_schema</span> </div>
                <div><?php _e('Add Article schema to your blog posts for proper attribution when AI cites your content.', 'icoda'); ?></div>
            </div>
            <div class="recommendation-info d-flex align-items-lg-center flex-column flex-lg-row">
                <div class="slot-info time">
                    <span>10min</span>
                </div>
                <div class="slot-info roi">
                    <span><?php _e('ROI:', 'icoda'); ?></span>
                    <span>5/10</span>
                </div>
                <div class="slot-info impact">
                    <span><?php _e('ROI:', 'icoda'); ?></span>
                    <span>10/20</span>
                </div>
            </div>

        </div> -->
        <!-- </div> -->

        <div class="tab-content" id="nav-tabContent">

            <?php foreach ($block_tabs['tab_contents'] as $index => $tab_content) : ?>

                <div class="tab-pane fade <?php if ($index === 0) : ?>show active<?php endif; ?>"
                    id="nav-<?php echo $index; ?>"
                    role="tabpanel"
                    aria-labelledby="nav-<?php echo $index; ?>-tab">
                    <div class="report-recommendation-wrapper d-flex flex-column">
                        <?php foreach ($tab_content['cards'] as $card) : ?>
                            <div class="report-card surface p-3 d-flex flex-column <?php echo $card['status_class']; ?>">
                                <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                                    <h3 class="title"><?php echo $card['title']; ?></h3>
                                    <div>
                                        <span class="badge-status"><?php echo $card['badge']; ?></span>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <div>
                                        <?php _e('ID:', 'icoda'); ?>
                                        <span><?php echo $card['id']; ?></span>
                                    </div>
                                    <div>
                                        <?php echo $card['description']; ?>
                                    </div>
                                </div>

                                <div class="recommendation-info d-flex align-items-lg-center flex-column flex-lg-row">
                                    <div class="slot-info ci ci-clock">
                                        <span><?php echo $card['time']; ?></span>
                                    </div>
                                    <div class="slot-info ci ci-roi">
                                        <span><?php _e('ROI:', 'icoda'); ?></span>
                                        <span><?php echo $card['roi']; ?></span>
                                    </div>
                                    <div class="slot-info ci ci-impact">
                                        <span><?php _e('Impact:', 'icoda'); ?></span>
                                        <span><?php echo $card['impact']; ?></span>
                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>

        <div class="content-recommendation-btn mt-1 mt-lg-4 mx-auto">
            <button data-toggle="modal" data-target="#get-detailed-report" class="btn btn-blue btn-report">
                <span class="ci ci-message"><?php _e('Unlock all recommendations', 'icoda'); ?></span>
            </button>
        </div>

        
    </div>
</div>

<div class="report-box-wrapper">
    <div class="report-box report-recommendation">
        <h2 class="title mb-lg-4 mb-2 has-border">
            <?php _e('Recommendations', 'icoda'); ?>
        </h2>
        <div class="report-recommendation-wrapper d-flex flex-column">
            <div class="report-card surface p-3 d-flex flex-column status-primary">
                <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                    <h3 class="title"><?php _e('Great Job!', 'icoda'); ?></h3>
                    
                </div>
                <div class="text-muted">
                    <div><?php _e('No specific recommendations at this time. Your site is performing well!', 'icoda'); ?></div>
                </div>
                
            </div>
        </div>
    </div>
</div>