<?php

// $header_one = icoda_get_items_tree_menu('header-one');
$header_one = icoda_get_items_tree_menu('header-one-new');
// $header_one_two = icoda_get_items_tree_menu('header-one-two');
$header_one_two = icoda_get_items_tree_menu('header-one-two-new');
// $header_two = icoda_get_items_tree_menu('header-two');
$header_two = icoda_get_items_tree_menu('header-two-new');
// $header_two_two = icoda_get_items_tree_menu('header-two-two');
// $header_three_one = icoda_get_items_tree_menu('header-three-one');
$header_three_one = icoda_get_items_tree_menu('header-three-one-new');
// $header_three_two = icoda_get_items_tree_menu('header-three-two');
$header_three_two = icoda_get_items_tree_menu('header-three-two-new');
// $header_three_three = icoda_get_items_tree_menu('header-three-three');
// $header_four = icoda_get_items_tree_menu('header-four');
$header_four = icoda_get_items_tree_menu('header-four-new');
// $header_four_two = icoda_get_items_tree_menu('header-four-two');
$header_four_two = icoda_get_items_tree_menu('header-four-two-new');
$header_five = icoda_get_items_tree_menu('header-five-new');

// echo "<pre>";
// var_dump($header_one);
// var_dump($header_one_two);
// echo "</pre>";
?>

<nav>
  <?php if(!empty($header_one) && !empty($header_one[0])) : ?>


      <ul class="main-menu">

        <?php foreach ($header_one[0]->childs as $key => $item) : ?>

          <li class="menu-item menu-item-has-children">
            <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
            <i class="custom-arrow" data-action="arrow"></i>
            
              <?php if (isset($header_one[$item['ID']]) && $header_one[$item['ID']]) : ?>

              <ul class="sub-menu">
                <li class="sub-menu-col first-col">
                  <ul>
                    <li class="sub-menu-title"><?php _e('Growth & promotion', 'icoda'); ?></li>
                      <?php foreach ($header_one[$item['ID']]->childs as $item2) : ?>
                        <?php if (trim($item2['title']) !== '') : ?>

                          <li class="menu-item">
                            <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                          </li>

                        <?php endif; ?>
                      <?php endforeach; ?>
                  </ul>
                  
                </li>
                <li class="sub-menu-col second-col">
                  <?php if(!empty($header_one_two) && !empty($header_one_two[0])) : ?>
                  <ul>
                    <li class="sub-menu-title"><?php _e('Brand & Reputation', 'icoda'); ?></li>
                    <?php foreach ($header_one_two[0]->childs as $key_2 => $item_2) : ?>
                        <li class="menu-item">
                          <a href="<?php echo $item_2['url']; ?>"><?php echo $item_2['title']; ?></a>
                        </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?> 
                </li>
                <li class="sub-menu-col third-col">
                  <?php get_template_part('template-parts/menu/sub-menu-banner'); ?>
                </li>
              </ul>
              <?php endif; ?>
          </li>
        <?php endforeach; ?>

        <?php foreach ($header_two[0]->childs as $key => $item) : ?>

          <li class="menu-item menu-item-has-children">
            <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
            <i class="custom-arrow" data-action="arrow"></i>

            <?php if (isset($header_two[$item['ID']]) && $header_two[$item['ID']]) : ?>

              <ul class="sub-menu">
                 <li class="sub-menu-col first-col">
                  <ul>
                      <?php foreach ($header_two[$item['ID']]->childs as $item2) : ?>
                      <?php if (trim($item2['title']) !== '') : ?>

                        <li class="menu-item">
                          <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                        </li>

                      <?php endif; ?>
                    <?php endforeach; ?>
                  </ul>
                 </li>
                 <li class="sub-menu-col">
                  <?php get_template_part('template-parts/menu/sub-menu-banner'); ?>
                 </li>
              </ul>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>

        
        <?php foreach ($header_three_one[0]->childs as $key => $item) : ?>

          <li class="menu-item menu-item-has-children">
            <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
            <i class="custom-arrow" data-action="arrow"></i>

            <?php if (isset($header_three_one[$item['ID']]) && $header_three_one[$item['ID']]) : ?>

              <ul class="sub-menu">
                 <li class="sub-menu-col first-col">
                  <ul>
                    <li class="sub-menu-title"><?php _e('Services', 'icoda'); ?></li>
                      <?php foreach ($header_three_one[$item['ID']]->childs as $item2) : ?>
                        <?php if (trim($item2['title']) !== '') : ?>

                          <li class="menu-item">
                            <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                          </li>

                        <?php endif; ?>
                      <?php endforeach; ?>
                  </ul>
                 </li>
                 <li class="sub-menu-col second-col">
                  <ul>
                    <li class="sub-menu-title"><?php _e('Industries', 'icoda'); ?></li>
                    
                      <?php foreach ($header_three_two[0]->childs as $item2) : ?>
                        <?php if (trim($item2['title']) !== '') : ?>

                          <li class="menu-item">
                            <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                          </li>

                        <?php endif; ?>
                      <?php endforeach; ?>
                  </ul>
                 </li>
                 
                 <!-- <li class="sub-menu-col third-col"> -->
                  <?php /* get_template_part('template-parts/_partials/book-info'); */?>
                 <!-- </li> -->
                 
              </ul>


            <?php endif; ?>

          </li>
        <?php endforeach; ?>

        <?php foreach ($header_four[0]->childs as $key => $item) : ?>

          <li class="menu-item menu-item-has-children">
            <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
            <i class="custom-arrow" data-action="arrow"></i>
            
              <?php if (isset($header_four[$item['ID']]) && $header_four[$item['ID']]) : ?>

              <ul class="sub-menu">
                <li class="sub-menu-col first-col">
                  <ul>
                    <li class="sub-menu-title"><?php _e('Info', 'icoda'); ?></li>
                      <?php foreach ($header_four[$item['ID']]->childs as $item2) : ?>
                        <?php if (trim($item2['title']) !== '') : ?>

                          <li class="menu-item">
                            <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                          </li>

                        <?php endif; ?>
                      <?php endforeach; ?>
                  </ul>
                  
                </li>
                <li class="sub-menu-col second-col">
                  <?php if(!empty($header_four_two) && !empty($header_four_two[0])) : ?>
                  <ul>
                    <li class="sub-menu-title"><?php _e('Insights', 'icoda'); ?></li>
                    <?php foreach ($header_four_two[0]->childs as $key_2 => $item_2) : ?>
                        <li class="menu-item">
                          <a href="<?php echo $item_2['url']; ?>"><?php echo $item_2['title']; ?></a>
                        </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?> 
                </li>
                <li class="sub-menu-col third-col">
                  <ul class="sub-menu-media">
                    <li>
                      <div class="media-logo d-flex" title="Top Crypto Marketing Agency 2025">
                        <picture>
                            <img data-src="/wp-content/uploads/2024/11/clutch-logo.svg" alt="Top Crypto Marketing Agency 2025" src="/wp-content/uploads/2024/11/clutch-logo.svg" class=" lazyloaded">
                        </picture>
                        <span class="media-title">
                          <?php _e('Top Crypto Marketing Agency 2025', 'icoda'); ?>
                        </span>
                      </div>
                    </li>
                    <li>
                      <div class="media-logo d-flex" title="Top Rated Trustpilot Agency">
                        <picture>
                            <img data-src="/wp-content/uploads/2024/11/trustpilot-logo.svg" alt="Best Web Design Company" src="/wp-content/uploads/2024/11/trustpilot-logo.svg" class=" lazyloaded">
                        </picture>
                        <span class="media-title">
                          <?php _e('Top Rated Trustpilot Agency', 'icoda'); ?>
                        </span>
                      </div>
                    </li>
                  </ul>
                  
                </li>
              </ul>
              <?php endif; ?>
          </li>
        <?php endforeach; ?>

        <?php if(!empty($header_five)  && !empty($header_five[0])) : ?>
            

        <?php foreach ($header_five[0]->childs as $key => $item) : ?>

          <li class="menu-item">
            <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
            

          </li>
        <?php endforeach; ?>

            
          <?php endif; ?>
          <li class="mega-menu-mobile-contact d-lg-none mt-5">
            <a href="<?php echo home_url('/contact-us/'); ?>" class="btn btn-blue w-100"><?php _e('Contact Us', 'icoda'); ?></a>
          </li>

      </ul>

    <?php endif; ?>
</nav>

