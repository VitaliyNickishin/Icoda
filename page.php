<?php
global $post;

get_header();

?>
    <script>
        window.intercomSettings = {
            app_id: "gdz549ih"
        };
    </script>
    <?php if ($post->post_parent == 3823 || $post->post_parent == 8397 || $post->post_parent == 9154 || $post->post_parent == 5720 || $post->post_parent == 22068 ) : ?>
		<nav class="wr-breadcrumb" aria-label="breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<?php the_breadcrumbs(); ?>
					</div>
				</div>
			</div>
		</nav>
    <?php endif; ?>

	<?php the_content(); ?>

	<?php if ($post->post_parent == 3823 || $post->post_parent == 9154 || $post->post_parent == 5720 || $post->post_parent == 8397 || $post->post_parent == 22068) : ?>

		<?php
		
		if( get_the_ID() == '6598' || get_the_ID() == '6636' || get_the_ID() == '6640' || get_the_ID() == '6642' || get_field( 'load_new_styles' ) === true ) {
			echo do_shortcode( '[contact-form-new]' );
		} else { ?>
		
		<div class="department-form" id="contact-with-us">
			<div class="callback-form">
	            <div class="container">
	                <div class="row">
	                    <div class="col-12 col-lg-8 col-xl-8">
	                        <form class="form-default request-send__form form-default-desctop" method="post">
	                            <div class="form-default-header">
	                                <h3 class="ttl">Send request</h3>
	                                <p>to scale your business to the next level</p>
	                            </div>
	                            <div class="form-row">
	                                <div class="col-12 col-md-6">
	                                    <input type="text" name="name" class="form-control req" placeholder="Your name" required>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <input type="text" name="telegram" class="form-control req" placeholder="WhatsApp / Telegram" required>
	                                </div>
	                                <div class="col-12">
	                                    <input type="email" name="email" class="form-control req" placeholder="Email" required>
	                                </div>
									<div class="col-12">
										<textarea name="message" class="form-control" rows="5" placeholder="<?php _e('Text message', 'icoda'); ?>"></textarea>
									</div>
	                                <?php
	                                do_action( 'anr_captcha_form_field' );
	                                ?>
	                                <div class="col-12">
	                                    <div class="wr-btn text-right">
	                                        <button type="submit" class="btn btn-blue">Apply Now</button>
	                                    </div>
	                                </div>
	                            </div>
	                        </form>

	                    </div>
	                </div>
	            </div>
	        </div>
		</div>
	<?php } ?>

		
	<?php endif; ?>

<?php
get_footer(); ?>