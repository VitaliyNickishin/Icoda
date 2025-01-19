<?php
/* Template Name: Calculator 
Template Post Type: post, page
*/

get_header();

?>

<?php
$calculator_section_1 = get_field('calculator_section_1');
$calculator_section_2 = get_field('calculator_section_2');

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
	<section class="calculator-section calculator-hero">
		<div class="container">
			<div class="row article-card-full">
				<div class="col-12 col-lg-6">
					<div class="content">
						<h1 class="h4 title">
							<?php echo $calculator_section_1['title']; ?>							
						</h1>
						<p class="undertitle">
							<?php echo $calculator_section_1['subtitle']; ?>
						</p>
						<div class="description">
							<?php echo $calculator_section_1['description']; ?>
						</div>
						<div class="btn-wrap mt-lg-5 d-none d-lg-block">
							<a href="#calculator-questions" class="btn btn-blue"><?php echo $calculator_section_1['button_text']; ?></a>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<div class="img-hero mb-3 mb-lg-0">
						<img src="/wp-content/uploads/2024/11/image-577.png" alt="calculator-hero">
					</div>
					<div class="btn-wrap mt-3 d-lg-none">
						<a href="#calculator-questions" class="btn btn-blue"><?php echo $calculator_section_1['button_text']; ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="calculator-questions" id="calculator-questions">
		<div class="container">
			<div class="row">
				<div class="col-12 offset-lg-1 col-lg-10">
					<div class="content">
						<h2 class="h4 title text-center mb-4 pb-lg-3 pb-2 font-weight-normal">
							<?php echo $calculator_data['title']; ?> <?php if(!empty($calculator_data['title_bold_part'])) : ?><span class="font-weight-bold"><?php echo $calculator_data['title_bold_part']; ?></span><?php endif; ?>
						</h1>
					</div>
				</div>
				<div class="col-12 offset-lg-1 col-lg-10 px-md-0">
					<div class="steps-box d-flex">
						<div class="steps-box__main d-flex flex-column">
							<div class="steps-box__header">
								<p class="steps-count text-center mb-lg-1 mb-2"><?php echo sprintf(__('Question %s of %s', 'icoda'), '<span class="current-step-number">1</span>', '6'); ?></p>
								<div class="progress border">
									<div class="progress-bar progress-bar-animated" role="progressbar" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<form id="calculator-form" data-submit="yes">
								<div class="steps-body mt-lg-4 mt-3 pt-lg-3">
										<div data-step="1" class="step-first">
											<p class="text-center mb-3 pb-lg-3 step-title"><?php echo $calculator_data['step_1_title']; ?></p>
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
														<label for="step_1_99"><?php _e('Other (write your own version)', 'icoda'); ?></label>
														<textarea id="txta_1" class="form-control" name="other_industry" rows="4" value=""></textarea>
													</div>
												</li>
											</ul>
										</div>
										<div data-step="2" class="step-second d-none">
											<p class="text-center mb-3 pb-lg-3 step-title"><?php echo $calculator_data['step_2_title']; ?></p>
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
														<label for="step_2_99"><?php _e('Other (write your own version)', 'icoda'); ?></label>
														<textarea id="txta_2" class="form-control" name="other_achieve" rows="4" value=""></textarea>
													</div>
												</li>
											</ul>
										</div>
										<div data-step="3" class="step-third d-none">
											<p class="text-center mb-3 pb-lg-3 step-title"><?php echo $calculator_data['step_3_title']; ?></p>
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
														<label for="step_3_99"><?php _e('Other (write your own version)', 'icoda'); ?></label>
														<textarea id="txta_3" class="form-control" name="other_country" rows="4" value=""></textarea>
													</div>
												</li>
											</ul>
										</div>
										<div data-step="4" class="step-fourth d-none">
											<p class="text-center mb-3 pb-lg-3 step-title"><?php echo $calculator_data['step_4_title']; ?></p>
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
											<p class="text-center mb-3 pb-lg-3 step-title"><?php echo $calculator_data['step_5_title']; ?></p>
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
														<label for="step_5_99"><?php _e('Other (write your own version)', 'icoda'); ?></label>
														<textarea id="txta_5" class="form-control" name="other_long" rows="4" value=""></textarea>
													</div>
												</li>
											</ul>
										</div>
										<div data-step="6" class="step-sixth d-none">
											<p class="text-center mb-3 pb-lg-3 step-title"><?php echo $calculator_data['step_6_title']; ?></p>
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
														<input type="text" name="telegram" class="form-control req" placeholder="<?php _e('WhatsApp / Telegram / Skype', 'icoda'); ?>" required>
													</div>
													
													<div class="col-12">
														<textarea name="message" class="form-control" rows="5" placeholder="<?php _e('Additional Information', 'icoda'); ?>"></textarea>
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
								<div class="steps-box__footer pt-3 d-flex justify-content-between mt-auto">
									
									<button type="button" class="btn btn-prew d-none">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M5.24237 12.5532L16.449 23.7594C16.6094 23.9196 16.7939 24 17.0022 24C17.2106 24 17.3951 23.9196 17.5554 23.7594L18.7576 22.5569C18.9181 22.3966 18.998 22.2125 18.998 22.0038C18.998 21.795 18.9181 21.6109 18.7576 21.4506L9.30669 11.9997L18.7576 2.5487C18.9181 2.38841 18.998 2.20395 18.998 1.99582C18.998 1.78718 18.9181 1.60272 18.7576 1.44243L17.5553 0.240391C17.395 0.0799332 17.2105 0 17.0021 0C16.7938 0 16.6094 0.0801029 16.449 0.240391L5.24296 11.4466C5.08275 11.6068 5.00257 11.7914 5.00257 11.9997C5.00257 12.2081 5.08216 12.3926 5.24237 12.5532Z" fill="#A3A3A3"/>
										</svg>
									</button>
									
									<button type="button" class="btn btn-blue btn-next ml-auto"><?php echo __('Next', 'icoda'); ?></button>

									<button type="submit" class="btn btn-blue btn-apply ml-auto d-none"><?php echo __('Apply now', 'icoda'); ?></button>
								</div>

								<input type="hidden" name="lang-source" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
								<input type="hidden" name="is_calculator" value="1" />

							</form>
						</div>
						<div class="steps-box__aside d-none d-lg-block">
							<picture>
								<img src="/wp-content/uploads/2024/11/marketing-plan.png" alt="marketing plan">
							</picture>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="calculator-section calculator-consultation">
		<div class="container">
			<div class="row article-card-full">
				<div class="col-12 col-lg-6">
					<div class="content">
						<h2 class="h4 title">
							<?php echo $calculator_section_2['title']; ?>
						</h2>
						<p class="undertitle">
							<?php echo $calculator_section_2['subtitle']; ?>
						</p>
						<div class="description">
							<?php if(!empty($calculator_section_2['description'])) : ?>
								<?php echo $calculator_section_2['description']; ?>
							<?php endif; ?>
						</div>
						<div class="btn-wrap mt-lg-5 d-none d-lg-block">
							<a href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/oy--5/talk-to-our-expert'});return false;" class="btn btn-blue"><?php echo __('Book Intro Call', 'icoda'); ?></a>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-6 d-lg-flex align-items-lg-center">
					<div class="img-hero mt-4 mt-lg-0 mb-3 mb-lg-0">
						<img src="/wp-content/uploads/2024/11/consultation.png" alt="Exclusive Consultation with ICODA">
					</div>
					<div class="btn-wrap mt-3 d-lg-none">
						<a href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/oy--5/talk-to-our-expert'});return false;" class="btn btn-blue"><?php echo __('Book Intro Call', 'icoda'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	
</main>


<?php
get_footer(); ?>