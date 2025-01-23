<?php $title = get_field('post_faq_title'); ?>
<?php $faq_items = get_field('post_faq_items'); ?>


<section class="section section-faq">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="h3 title mb-4 text-uppercase text-center">
          <?php echo $title; ?>
        </h3>
        
        <div
          class="accordion accordion-faq"
          data-action="accordion-faq"
          >
          <?php if (!empty($faq_items)) : ?>
              <?php foreach ($faq_items as $key => $faq_item) : ?>
                <div class="tab <?php if ($key === 0) : ?>active<?php endif;?> ">
                  <input
                    id="tabfaq-<?php echo $key; ?>"
                    type="checkbox"
                    name="faq[1][]"
                    value="<?php echo $faq_item['question']; ?>"
                    <?php if ($key === 0) : ?>checked<?php endif;?>
                  />
                  <label for="tabfaq-<?php echo $key; ?>" data-lang="title_tabfaq_first">
                    <?php echo $faq_item['question']; ?>
                  </label>
                  <div class="tab-content">
                    <p data-lang="description_tabfaq_first">
                      <?php echo $faq_item['answer']; ?>
                    </p>
                  </div>
                </div>
              <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>	
</section>