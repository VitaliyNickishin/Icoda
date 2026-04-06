<!-- remove .d-none -->
<section class="section-analyzer position-relative has-circle-gradient analyzer-step-1">
    <div class="container px-lg-0">
        <div class="section-analyzer__inner text-center">
            <div class="analyzer-box surface">
                <h1 class="h1 title-hero mb-lg-4 mb-2 text-primary">Is Your Website Visible to AI?</h1>
                <p class="undertitle">Discover how well your website is optimized for AI visibility and get actionable insights to improve it.</p>
                
                <form class="form-check-url section-analyzer__form" action="#" method="post" novalidate>
                    <div class="form-group">
                        <input type="text"
                            id="urlInput"
                            class="form-control site-url"
                            placeholder="Enter your website URL to check AI visibility">
                        <div class="invalid-feedback">
                            <?php _e('Failed to analyze. Please check the URL and try again.', 'icoda'); ?>
                        </div>
                    </div>
                    
                    <button class="btn btn-blue disabled" type="submit" disabled>
                        Analyze
                    </button>
                </form>
            </div>

            <div class="mt-5 d-none progress-analyzing-container">
                <p class="progress-analyzing-text mb-2 pb-1"><?php _e('Analyzing your website…', 'icoda'); ?></p>
                <div class="progress-line">
                    <div class="progress-fill"></div>
                    <div class="progress-dots"></div>
                </div>

                <div class="progress-analyzing-step mt-2">Checking robots.txt</div>
            </div>
            
            <div id="apiError" class="api-error-block d-none mt-3">
                <p id="apiErrorText" class="alert alert-danger"></p>

                <div class="d-flex justify-content-center mx-lg-auto w-lg-50 gap-2 flex-column flex-md-row align-items-center">
                    <button id="retryBtn" class="btn btn-retry btn-report"><?php _e('Retry', 'icoda'); ?></button>
                    <button class="btn btn-report btn-analyze">
                        <span class="ci ci-analyze"><?php _e('Analyze Another URL', 'icoda'); ?></span>
                    </button>
                </div>

                
            </div>
        </div>
    </div>
</section>