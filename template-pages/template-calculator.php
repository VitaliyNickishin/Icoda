<?php
/* Template Name: Calculator 
Template Post Type: post, page
*/

get_header();

?>

<?php
$calculator_section_1 = get_field('calculator_section_1');
$calculator_data = get_field('calculator_section_3');
?>

<main class="page-calculator">
	<div class="container">
		<div class="row">
			<div class="col-12 mb-2 mb-md-3">
				<?php the_breadcrumbs(); ?>
			</div>
		</div>
	</div>
	
	<section class="section section-cases-hero-new mt-3">
		<div class="section-cases-hero-new__inner position-relative with-gradient with-gradient-pink">
			<div class="bg-hero bg-hero-desktop d-lg-block d-none"></div>
			<div class="bg-hero bg-hero-mobile d-lg-none"></div>
			<div class="container">
				<div class="row">
					<div class="col-12 col-lg-7 pr-lg-3 pr-xl-5">
						<h1 class="h1 mb-4 title">
							<?php echo $calculator_section_1['title']; ?>
						</h1>
						<p class="subtitle pr-lg-5 mr-lg-5 mb-4 undertitle-wrap">
							<!-- <?php the_field('post_case_hero_subtitle'); ?> -->
							<span class="undertitle undertitle-short">
								<?php echo $calculator_section_1['subtitle']; ?>
							</span>
							
						</p>
							<div class="steps-nav mt-4 pt-lg-3">
								<div class="step-circle active" data-step-nav="1">1</div>
								<div class="step-line"></div>
								<div class="step-circle" data-step-nav="2">2</div>
								<div class="step-line"></div>
								<div class="step-circle" data-step-nav="3">3</div>
								<div class="step-line"></div>
								<div class="step-circle" data-step-nav="4">4</div>
								<div class="step-line"></div>
								<div class="step-circle" data-step-nav="5">5</div>
								<div class="step-line"></div>
								<div class="step-circle" data-step-nav="6">6</div>
							</div>
					</div>

					<div class="col-12 col-lg-5 col-xl-4 offset-xl-1 mt-4 pt-4 mt-lg-0 pt-lg-0 pr-xl-0 d-none d-lg-block">
						<div class="text-right calculator-media">
							<?php foreach ($calculator_section_1['media_info'] as $media): ?>
								<div class="media-logo">
									<picture>
										<img data-src="<?php echo $media['media_logo']['url']; ?>" alt="<?php echo $media['logo_alt']; ?>" src="<?php echo $media['media_logo']['url']; ?>" class="lazyloaded">
									</picture>
									<span class="media-title"><?php echo $media['media_text']; ?></span>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="calculator-steps" id="calculator-questions">
		<div class="container">
			<div class="row">
				
				<div class="col-12">
					<div class="steps-box d-flex">
						<div class="steps-box__main d-flex flex-column">
							<form id="calculator-form" data-submit="yes">
								<div class="steps-body mt-lg-5 mt-4 pt-3 pt-lg-3 pb-3 mb-4 pb-lg-5 mb-lg-3">
									<div data-step="1" class="step-first">
										<p class="mb-3 pb-lg-3 step-title">
											<span class="text-primary mr-2">1.</span><?php echo $calculator_data['step_1_title']; ?>
										</p>
										<ul>
											<?php foreach( $calculator_data['step_1_options'] as $key => $item_data ) : ?>
												<li>
													<div class="custom-checkbox">
														<input type="checkbox" id="step_1_<?php echo ($key + 1); ?>" class="checkbox" name="industry" value="<?php echo !empty( $item_data['value_for_sale'] ) ? $item_data['value_for_sale'] : $item_data['text']; ?>" <?php checked(($key === 0)); ?>/>
														<label for="step_1_<?php echo ($key + 1); ?>"><?php echo $item_data['text']; ?></label>
													</div>
												</li>
											<?php endforeach; ?>
											<li>
												<div class="custom-checkbox">
													<input type="checkbox" id="step_1_99" class="checkbox" name="industry" value="other" />
													<label for="step_1_99">
														<textarea id="txta_1" class="form-control" name="other_industry" rows="1" value="" placeholder="<?php _e('Other (Please specify)', 'icoda'); ?>"></textarea>
													</label>
													
												</div>
											</li>
										</ul>
									</div>
									<div data-step="2" class="step-second d-none">
										<p class="mb-3 pb-lg-3 step-title">
											<span class="text-primary mr-2">2.</span>
											<?php echo $calculator_data['step_2_title']; ?>
										</p>
										<ul class="form-row">
											<?php foreach( $calculator_data['step_2_options'] as $key => $item_data ) : ?>
												<li class="col-12 col-md-6">
													<div class="custom-checkbox">
														<input type="checkbox" id="step_2_<?php echo ($key + 1); ?>" class="checkbox" name="achieve" value="<?php echo !empty( $item_data['value_for_sale'] ) ? $item_data['value_for_sale'] : $item_data['text']; ?>" <?php checked(($key === 0)); ?>/>
														<label for="step_2_<?php echo ($key + 1); ?>"><?php echo $item_data['text']; ?></label>
													</div>
												</li>
											<?php endforeach; ?>
											<li class="col-12 col-md-6">
												<div class="custom-checkbox">
													<input type="checkbox" id="step_2_99" class="checkbox" name="achieve" value="other" />
													<label for="step_2_99">
														<textarea id="txta_2" class="form-control" name="other_achieve" rows="1" value="" placeholder="<?php _e('Other (Please specify)', 'icoda'); ?>"></textarea>
													</label>
												</div>
											</li>
										</ul>
									</div>
									<div data-step="3" class="step-third d-none">
										<p class="mb-3 pb-lg-3 step-title">
											<span class="text-primary mr-2">3.</span>
											<?php echo $calculator_data['step_3_title']; ?>
										</p>
										<ul class="form-row">
											<?php foreach( $calculator_data['step_3_options'] as $key => $item_data ) : ?>
												<li class="col-12 col-md-6">
													<div class="custom-checkbox">
														<input type="checkbox" id="step_3_<?php echo ($key + 1); ?>" class="checkbox" name="country" value="<?php echo !empty( $item_data['value_for_sale'] ) ? $item_data['value_for_sale'] : $item_data['text']; ?>" <?php checked(($key === 0)); ?>/>
														<label for="step_3_<?php echo ($key + 1); ?>"><?php echo $item_data['text']; ?></label>
													</div>
												</li>
											<?php endforeach; ?>
											<li class="col-12 col-md-6">
												<div class="custom-checkbox">
													<input type="checkbox" id="step_3_99" class="checkbox" name="country" value="other" />
													<label for="step_3_99">
														<textarea id="txta_3" class="form-control" name="other_country" rows="1" value="" placeholder="<?php _e('Other (Please specify)', 'icoda'); ?>"></textarea>
													</label>
												</div>
											</li>
										</ul>
									</div>
									<div data-step="4" class="step-fourth d-none">
										<p class="mb-3 pb-lg-3 step-title">
											<span class="text-primary mr-2">4.</span>
											<?php echo $calculator_data['step_4_title']; ?>
										</p>
										<ul class="form-row">
											<?php foreach( $calculator_data['step_4_options'] as $key => $item_data ) : ?>
												<li class="col-12 col-md-6">
													<div class="custom-checkbox">
														<input type="checkbox" id="step_4_<?php echo ($key + 1); ?>" class="checkbox multi-choise" name="service[]" value="<?php echo !empty( $item_data['value_for_sale'] ) ? $item_data['value_for_sale'] : $item_data['text']; ?>" <?php checked(($key === 0)); ?>/>
														<label for="step_4_<?php echo ($key + 1); ?>"><?php echo $item_data['text']; ?></label>
													</div>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
									<div data-step="5" class="step-fifth d-none">
										<p class="mb-3 pb-lg-3 step-title">
											<span class="text-primary mr-2">5.</span>
											<?php echo $calculator_data['step_5_title']; ?>
										</p>
										<ul class="form-row">
											<?php foreach( $calculator_data['step_5_options'] as $key => $item_data ) : ?>
												<li class="col-12 col-md-6">
													<div class="custom-checkbox">
														<input type="checkbox" id="step_5_<?php echo ($key + 1); ?>" class="checkbox" name="long" value="<?php echo !empty( $item_data['value_for_sale'] ) ? $item_data['value_for_sale'] : $item_data['text']; ?>" <?php checked(($key === 0)); ?>/>
														<label for="step_5_<?php echo ($key + 1); ?>"><?php echo $item_data['text']; ?></label>
													</div>
												</li>
											<?php endforeach; ?>
											<li class="col-12 col-md-6">
												<div class="custom-checkbox">
													<input type="checkbox" id="step_5_99" class="checkbox" name="long" value="other" />
													<label for="step_5_99">
														<textarea id="txta_5" class="form-control" name="other_long" rows="1" value="" placeholder="<?php _e('Other (Please specify)', 'icoda'); ?>"></textarea>
													</label>
												</div>
											</li>
										</ul>
									</div>
									<div data-step="6" class="step-sixth d-none">
										<p class="mb-3 pb-lg-3 step-title">
											<span class="text-primary mr-2">6.</span>
											<?php echo $calculator_data['step_6_title']; ?>
										</p>
										<div class="form-default form-default-modal">
											<div class="form-row">
												<div class="col-12 col-md-6">
													<input type="text" name="project-name" class="form-control req" placeholder="<?php _e('Project Name', 'icoda'); ?>" required>
												</div>
												<div class="col-12 col-md-6">
													<input type="text" name="name" class="form-control req" placeholder="<?php _e('Your name', 'icoda'); ?>" required>
												</div>
												<div class="col-12 col-md-6">
													<input type="email" name="email" class="form-control req" placeholder="<?php _e('Email', 'icoda'); ?>" required>
												</div>
												<div class="col-12 col-md-6">
													<input type="text" name="telegram" class="form-control req" placeholder="<?php _e('WhatsApp / Telegram', 'icoda'); ?>" required>
												</div>
												
												<div class="col-12">
													<textarea name="message" class="form-control textarea-default" rows="5" placeholder="<?php _e('Additional Information', 'icoda'); ?>"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div data-step="done" class="step-done text-center d-none">
										<p class="text-center mb-3 pb-lg-3 text-done">
											<?php echo $calculator_data['step_thank_you']; ?>
										</p>
										<picture>
											<img src="/wp-content/uploads/2024/10/done.svg" alt="done">
										</picture>
									</div>
								</div>
								<div class="steps-box__footer border-top">
									<div class="step-box__btn d-flex justify-content-between pt-3">
										<button type="button" class="btn btn-prew btn-outline-blue d-none">
											<svg xmlns="http://www.w3.org/2000/svg" width="13" height="9" viewBox="0 0 13 9" fill="none">
												<path d="M4.83984 8.74223C4.60553 8.97655 4.2265 8.97655 3.99219 8.74223L0.173828 4.92387C-0.0604864 4.68956 -0.0604864 4.31053 0.173829 4.07622L3.99219 0.257858C4.2265 0.0235426 4.60553 0.0235427 4.83984 0.257858C5.07416 0.492173 5.07416 0.871199 4.83984 1.10551L2.0459 3.90044L12.5977 3.90044L12.5977 5.09965L2.0459 5.09965L4.83984 7.89458C5.07416 8.12889 5.07416 8.50792 4.83984 8.74223Z" fill="currentColor"/>
											</svg>
											<spna class="ml-1"><?php echo __('Back', 'icoda'); ?></spna>
										</button>
									
										<button type="button" class="btn btn-outline-blue btn-next ml-auto">
											<span class="mr-1"><?php echo __('Next', 'icoda'); ?></span>
											<svg xmlns="http://www.w3.org/2000/svg" width="13" height="9" viewBox="0 0 13 9" fill="none">
												<path d="M8.15625 0.257767C8.39056 0.0234526 8.76959 0.0234526 9.00391 0.257767L12.8223 4.07613C13.0566 4.31044 13.0566 4.68947 12.8223 4.92378L9.00391 8.74214C8.76959 8.97646 8.39056 8.97646 8.15625 8.74214C7.92194 8.50783 7.92194 8.1288 8.15625 7.89449L10.9502 5.09956H0.398438V3.90035H10.9502L8.15625 1.10542C7.92194 0.871109 7.92194 0.492082 8.15625 0.257767Z" fill="currentColor"/>
											</svg>
										</button>

										<button type="submit" class="btn btn-outline-blue btn-apply ml-auto d-none"><?php echo __('Apply now', 'icoda'); ?></button>
									</div>
								</div>

								<input type="hidden" name="lang-source" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
								<input type="hidden" name="is_calculator" value="1" />

							</form>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>

</main>


<?php
get_footer(); ?>