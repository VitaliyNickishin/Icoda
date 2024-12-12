<?php

$header_one = icoda_get_items_tree_menu('header-one');
$header_two = icoda_get_items_tree_menu('header-two');
$header_three_one = icoda_get_items_tree_menu('header-three-one');
$header_three_two = icoda_get_items_tree_menu('header-three-two');
$header_three_three = icoda_get_items_tree_menu('header-three-three');
$header_four = icoda_get_items_tree_menu('header-four');
$header_five = icoda_get_items_tree_menu('header-five');
?>

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="mega-menu-inner">
        <div class="col-one menu-wrap">
          <ul>

            <?php foreach ($header_one[0]->childs as $key => $item) : ?>

              <li class="menu-item menu-item-has-children">
                <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
                <i class="custom-arrow" data-action="arrow"></i>

                <?php if (isset($header_one[$item['ID']]) && $header_one[$item['ID']]) : ?>

                  <ul class="sub-menu">

                    <?php foreach ($header_one[$item['ID']]->childs as $item2) : ?>
                      <?php if (trim($item2['title']) !== '') : ?>

                        <li class="menu-item">
                          <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                        </li>

                      <?php endif; ?>
                    <?php endforeach; ?>
                  </ul>


                <?php endif; ?>

              </li>
            <?php endforeach; ?>

          </ul>
        </div>
        <div class="col-two menu-wrap">
          <ul>

            <?php foreach ($header_two[0]->childs as $key => $item) : ?>

              <li class="menu-item menu-item-has-children">
                <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
                <i class="custom-arrow" data-action="arrow"></i>

                <?php if (isset($header_two[$item['ID']]) && $header_two[$item['ID']]) : ?>

                  <ul class="sub-menu">

                    <?php foreach ($header_two[$item['ID']]->childs as $item2) : ?>
                      <?php if (trim($item2['title']) !== '') : ?>

                        <li class="menu-item">
                          <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                        </li>

                      <?php endif; ?>
                    <?php endforeach; ?>
                  </ul>


                <?php endif; ?>

              </li>
            <?php endforeach; ?>

          </ul>
        </div>
        <div class="col-three menu-wrap">
          <ul>

            <?php foreach ($header_three_one[0]->childs as $key => $item) : ?>

              <li class="menu-item menu-item-has-children">
                <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
                <i class="custom-arrow" data-action="arrow"></i>

                <?php if (isset($header_three_one[$item['ID']]) && $header_three_one[$item['ID']]) : ?>

                  <ul class="sub-menu">

                    <?php foreach ($header_three_one[$item['ID']]->childs as $item2) : ?>
                      <?php if (trim($item2['title']) !== '') : ?>

                        <li class="menu-item">
                          <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                        </li>

                      <?php endif; ?>
                    <?php endforeach; ?>
                  </ul>


                <?php endif; ?>

              </li>
            <?php endforeach; ?>

          </ul>

          <ul>
            <?php foreach ($header_three_two[0]->childs as $key => $item) : ?>
              <li class="menu-item">
                <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
                <i class="custom-arrow" data-action="arrow"></i>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="col-four menu-wrap">
          <ul>

            <?php foreach ($header_four[0]->childs as $key => $item) : ?>

              <li class="menu-item menu-item-has-children">
                <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
                <i class="custom-arrow" data-action="arrow"></i>

                <?php if (isset($header_four[$item['ID']]) && $header_four[$item['ID']]) : ?>

                  <ul class="sub-menu">

                    <?php foreach ($header_four[$item['ID']]->childs as $item2) : ?>
                      <?php if (trim($item2['title']) !== '') : ?>

                        <li class="menu-item">
                          <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                        </li>

                      <?php endif; ?>
                    <?php endforeach; ?>
                  </ul>


                <?php endif; ?>

              </li>
            <?php endforeach; ?>

          </ul>

          <ul>

            <?php foreach ($header_three_three[0]->childs as $key => $item) : ?>

              <li class="menu-item menu-item-has-children">
                <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
                <i class="custom-arrow" data-action="arrow"></i>

                <?php if (isset($header_three_three[$item['ID']]) && $header_three_three[$item['ID']]) : ?>

                  <ul class="sub-menu">

                    <?php foreach ($header_three_three[$item['ID']]->childs as $item2) : ?>
                      <?php if (trim($item2['title']) !== '') : ?>

                        <li class="menu-item">
                          <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                        </li>

                      <?php endif; ?>
                    <?php endforeach; ?>
                  </ul>


                <?php endif; ?>

              </li>
            <?php endforeach; ?>

          </ul>
        </div>
        <div class="col-five menu-wrap">

          <ul class="menu-information">

            <?php foreach ($header_five[0]->childs as $key => $item) : ?>

              <li class="menu-item menu-item-has-children">
                <a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a>
                <i class="custom-arrow" data-action="arrow"></i>

                <?php if (isset($header_five[$item['ID']]) && $header_five[$item['ID']]) : ?>

                  <ul class="sub-menu">

                    <?php foreach ($header_five[$item['ID']]->childs as $item2) : ?>
                      <?php if (trim($item2['title']) !== '') : ?>

                        <li class="menu-item">
                          <a href="<?php echo $item2['url']; ?>"><?php echo $item2['title']; ?></a>
                        </li>

                      <?php endif; ?>
                    <?php endforeach; ?>
                  </ul>


                <?php endif; ?>

              </li>
            <?php endforeach; ?>

          </ul>
        </div>

      </div>
    </div>
  </div>
</div>