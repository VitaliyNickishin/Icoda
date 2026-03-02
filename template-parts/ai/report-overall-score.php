<!-- Overall Score -->
<div class="report-box-wrapper">
    <div class="report-box overall-score">
        <div class="row mx-lg-n2">
            <div class="col-12">
                <h2 class="title mb-lg-4 mb-2 has-border"><?php _e('Overall Score', 'icoda'); ?></h2>
            </div>
            
            <div class="col-12 col-lg-4 px-lg-2">
                <div class="score-card surface">
                    <div class="gauge" data-value="35" data-color="#F31212">
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

                        <div class="gauge-value" data-map="ai-access-score">35</div>
                        <div class="gauge-label">AI Access</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 px-lg-2 mt-1 mt-lg-0">
                <div class="score-card surface">
                    <div class="gauge" data-value="65" data-color="#fe8c3a">
                        <svg viewBox="0 0 295 190">
                            <!-- фон -->
                            <path class="gauge-bg"
                                    d="M35 155 A110 110 0 0 1 260 155" />
                            
                            <!-- активная дуга -->
                            <path class="gauge-fill"
                                    d="M35 155 A110 110 0 0 1 260 155" />
                            <!-- белая точка -->
                            <circle class="gauge-dot" r="4" />
                            <!-- стрелка -->
                            <rect class="gauge-pointer"
                                width="2"
                                height="101"
                                rx="2" />
                        </svg>
                        <div class="gauge-value" data-map="content-structure-score">65</div>
                        <div class="gauge-label">Content Structure</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 px-lg-2 mt-1 mt-lg-0">
                <div class="score-card surface">
                    <div class="gauge" data-value="100" data-color="#07BD47">
                        <svg viewBox="0 0 295 190">
                            <!-- фон -->
                            <path class="gauge-bg"
                                    d="M35 155 A110 110 0 0 1 260 155" />
                            
                            <!-- активная дуга -->
                            <path class="gauge-fill"
                                    d="M35 155 A110 110 0 0 1 260 155" />
                            <!-- белая точка -->
                            <circle class="gauge-dot" r="4" />
                            <!-- стрелка -->
                            <rect class="gauge-pointer"
                                width="2"
                                height="101"
                                rx="2" />
                        </svg>
                        <div class="gauge-value" data-map="technical-score">100</div>
                        <div class="gauge-label">Technical Readiness</div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <ul class="status-dot-list mt-lg-4 mt-2">
                    <li><span class="status-dot status-dot_poor">Poor</span></li>
                    <li><span class="status-dot status-dot_fair">Fair</span></li>
                    <li><span class="status-dot status-dot_good">Good</span></li>
                    <li><span class="status-dot status-dot_excellent">Excellent</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>