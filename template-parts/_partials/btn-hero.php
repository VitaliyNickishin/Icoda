<?php
// victorsmith04/intro-call
// oy--5/talk-to-our-expert
?>

<?php if ( !empty($_GET['section_hero_new'])) : ?>
    <div class="section-hero-new__btn d-flex flex-column flex-sm-row">
        <a href="#" data-modal="#callback" class="btn btn-blue open-modal">
            <?php echo __('Get Your Proposal', 'icoda'); ?>
        </a>
        <a class="btn d-flex align-items-center justify-content-center btn-outline-blue" href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/oy--5/talk-to-our-expert'});return false;"><?php echo __('Book Intro Call', 'icoda'); ?></a>
    </div>
<?php elseif ( true || ICL_LANGUAGE_CODE === 'en' || !empty($_GET['section_hero_new_has_gradient'])) : ?>
    <div class="section-hero-new__btn d-flex flex-column flex-sm-row">
        <a href="#" data-modal="#callback" class="btn btn-blue open-modal">
            <?php echo __('Get Your Proposal', 'icoda'); ?>
        </a>
        <a class="btn d-flex align-items-center justify-content-center btn-outline-blue" href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/oy--5/talk-to-our-expert'});return false;"><?php echo __('Book Intro Call', 'icoda'); ?></a>
    </div>
<?php else : ?>
    <div class="btn-wrap has-highlight">
        <a href="#" data-modal="#callback" class="btn btn-blue open-modal">
            <?php echo __('Get Your Proposal', 'icoda'); ?>
        </a>
        <?php /* ?><a href="https://t.me/icoda" target="_blank" class="link-hover-underline mt-2 mt-md-4 text-center"><?php echo __('or contact us on Telegram', 'icoda'); ?></a><?php */ ?>

        <?php /* ?><a class="link-hover-underline mt-2 mt-md-4 text-center" href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/post-7ms/30min'});return false;">Book Intro Call</a><?php */ ?>

        <a class="link-hover-underline mt-2 mt-md-4 text-center" href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/oy--5/talk-to-our-expert'});return false;"><?php echo __('Book Intro Call', 'icoda'); ?></a>

        <?php /* ?><div class="calendly-inline-widget" data-url="https://calendly.com/oy--5/talk-to-our-expert" style="min-width:320px;height:700px;"></div><?php */ ?>
    </div>
<?php endif; ?>