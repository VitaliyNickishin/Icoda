<?php $rows = block_value('expert'); ?>
<section class="section section-expert mt-4 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title"><?php echo __('Our experts', 'icoda'); ?></h3>
                </div>
            </div>

            <div class="row list-leadership">
                <?php foreach ($rows as $key => $value) { ?>
                	<?php foreach ($value as $v) { ?>
										<div class="col-sm-6 col-lg-3">
											<div class="list-leadership-item">

													<div class="leadership-item-avatar" data-bg="<?php echo wp_get_attachment_url($v['photo']); ?>" style="background: center bottom no-repeat;background-size:contain"></div>
													<div class="leadership-item-des">
															<span class="h6"><?= $v['name']; ?></span>
															<span class="leadership-des-position"><?php echo $v['position']; ?></span>
															<span class="leadership-contact-icons">
																	<?php echo ($v['author-page'] ? '<a href="'.$v['author-page'].'"><i class="fas fa-user"></i></a>' : ''); ?>
																	<?php echo ($v['link'] ? '<a href="'.$v['link'].'" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>' : ''); ?>
															</span>
															<span class="leadership-des-text"><? echo $v['description']; ?></span> 
													</div>

											</div>
										</div>
									<?php } ?>
                <?php } ?>
            </div>

        </div>
</section>