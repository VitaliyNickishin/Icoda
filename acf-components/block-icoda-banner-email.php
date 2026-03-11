<?php
$block_banner = get_field('block_banner');
?>
<div class="block-banner block-banner-email my-lg-5 my-4 <?php if ($block_banner['banner_large']) : ?>banner-large <?php endif; ?>">
    <div class="container">
        <div class="block-banner-email__inner">
            <?php if ($block_banner['with_gradient']) : ?>
                <div class="banner-with-gradient"></div>
            <?php endif; ?>
            
            <div class="block-banner-email__content">
                <p class="banner-title mb-2"><?php echo $block_banner['banner_title']; ?></p>
                <p class="banner-description mb-3 pb-1"><?php echo $block_banner['banner_description']; ?></p>
                <?php if (!$block_banner['pay_with_stripe']) : ?>
                    <form class="block-banner-email__form form-default form-default-desctop" action="#" method="post" novalidate>
                        <div class="form-group m-0">
                            <?php /*
                            <label class="mb-1 form-label" for="your-email"><?php _e('Your Email', 'icoda'); ?></label>
                            */ ?>
                            <input
                                type="email"
                                name="email"
                                class="form-control input-email m-0 req"
                                placeholder="Your Email">
                        </div>
                        
                        <button class="btn btn-blue send-email" type="submit">
                            <?php echo $block_banner['banner_btn_text']; ?>
                        </button>
                    </form>
                <?php else : ?>
                    <button class="btn btn-blue stripe-pay-btn" type="button">
                        <?php echo $block_banner['banner_btn_text']; ?>
                    </button>
                <?php endif; ?>
            </div>
            <div class="block-banner-email__image">
                <div class="banner-img">
                    <picture>
                        <img 
                            data-src="<?php if (!empty($block_banner['image']['url'])) { echo $block_banner['image']['url']; } ?>" 
                            alt="<?php if (!empty($block_banner['text_under_image'])){ echo $block_banner['text_under_image']; } ?>" 
                            src="<?php if (!empty($block_banner['image']['url'])) { echo $block_banner['image']['url']; } ?>" 
                            class="lazyloaded"
                            
                            >
                    </picture>
                </div>
                
                <svg viewBox="0 0 262 262">
                    <defs>
                        <path
                            id="bottomArc"
                            d="M 0 131 A 131 131 0 0 0 262 131"
                            fill="transparent"
                            />
                    </defs>

                    <text>
                        <textPath href="#bottomArc" startOffset="50%" text-anchor="middle">
                            <?php echo $block_banner['text_under_image']; ?>
                        </textPath>
                    </text>
                </svg>
            </div>
        </div>
        
    </div>
</div>