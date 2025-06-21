<?php
$template_directory_uri = get_template_directory_uri();

function icoda_select_all_locations()
{
    global $wpdb;
    $values = $wpdb->get_results("SELECT meta_value FROM $wpdb->postmeta as wppm JOIN $wpdb->posts as wpp on wpp.ID = wppm.post_id where wpp.post_type='event' AND wppm.meta_key='country'");

    $values = array_map(function ($v) {
        return $v->meta_value;
    }, $values);

    return $values;
}

$locations = icoda_select_all_locations();
$topics = get_terms([
    'taxonomy' => 'events_cat',
]);
?>
<form id="event-filters-form" action="">

    <div class="event-filters-wrap">
        <button class="btn button-mobile-filter d-lg-none d-flex justify-content-between">
            <img src="<?php echo $template_directory_uri; ?>/assets/images/filter-mobile.svg" alt="filter mobile" />
            <span><?php _e('Filter | Sort', 'icoda'); ?></span>
            <img class="button-mobile-filter-arrow" src="<?php echo $template_directory_uri; ?>/assets/images/button-mobile-filter-arrow.svg" alt="Drop arrow" />
        </button>
        <div class="event-filters d-none d-lg-flex mt-2 mt-lg-0">
            <div class="event-filters-dropdowns d-lg-flex">
                <!-- @todo after choose .selected-item add class .active to .dropdown-list -->
                <div class="dropdown-list" data-key="country">
                    <label class="for-dropdown event-filters-button has-drop-arrow">
                        <input class="checkbox" type="checkbox" name="dropdown">
                        <div class="selected event-filters-selected">
                            <span class="event-filters-button-name">
                                <?php _e('Selected Value', 'icoda'); ?>
                            </span>
                            <a href="#" class="reset-events-dropdown">
                                <img class="close-icon" src="<?php echo $template_directory_uri; ?>/assets/images/close-icon.svg" alt="Remove filter" />
                            </a>
                        </div>

                        <div class="selected-default">
                            <div class="event-filters-button-name">
                                <?php _e('Location', 'icoda'); ?>
                            </div>
                            <img class="arrow-select" src="<?php echo $template_directory_uri; ?>/assets/images/drop-arrow.svg" alt="Drop arrow" />
                        </div>
                    </label>
                    <div class="section-dropdown event-filters-dropdown">

                        <div class="dropdown-list-wrapper">
                            <a href="#" class="select-item active" data-value="any-country" data-name="<?php _e('Any country', 'icoda'); ?>">
                                <div class="select-wrapper">
                                    <div class="select-name">
                                        <span class="country-name"><?php _e('Any country', 'icoda'); ?></span>
                                    </div>
                                </div>
                            </a>
                            <?php foreach ($locations as $l): ?>
                                <a href="#" class="select-item " data-value="<?php echo $l; ?>" data-name="<?php echo $l; ?>">
                                    <div class="select-wrapper">
                                        <div class="select-name">
                                            <span class="country-name"><?php echo $l; ?></span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="dropdown-list" data-key="date">
                    <label class="for-dropdown event-filters-button has-drop-arrow">
                        <input class="checkbox" type="checkbox" name="dropdown">
                        <div class="selected event-filters-selected">
                            <span class="event-filters-button-name">
                                <?php _e('Selected Value', 'icoda'); ?>
                            </span>
                            <a href="#" class="reset-events-dropdown">
                                <img class="close-icon" src="<?php echo $template_directory_uri; ?>/assets/images/close-icon.svg" alt="Remove filter" />
                            </a>
                        </div>

                        <div class="selected-default">
                            <span class="event-filters-button-name">
                                <?php _e('Date', 'icoda'); ?>
                            </span>
                            <img class="arrow-select" src="<?php echo $template_directory_uri; ?>/assets/images/drop-arrow.svg" alt="Drop arrow" />
                        </div>
                    </label>
                    <div class="section-dropdown event-filters-dropdown">

                        <a href="#" class="select-item " data-value="any-date" data-name="<?php _e('Any date', 'icoda'); ?>">
                            <div class="select-wrapper">
                                <div class="select-name">
                                    <span class="country-name"><?php _e('Any date', 'icoda'); ?></span>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="select-item " data-value="week" data-name="<?php _e('In a week', 'icoda'); ?>">
                            <div class="select-wrapper">
                                <div class="select-name">
                                    <span class="country-name"><?php _e('In a week', 'icoda'); ?></span>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="select-item " data-value="month" data-name="<?php _e('Within a month', 'icoda'); ?>">
                            <div class="select-wrapper">
                                <div class="select-name">
                                    <span class="country-name"><?php _e('Within a month', 'icoda'); ?></span>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="dropdown-list" data-key="topic">
                    <label class="for-dropdown event-filters-button">
                        <input class="checkbox" type="checkbox" name="dropdown">
                        <div class="selected event-filters-selected">
                            <span class="event-filters-button-name">
                                <?php _e('Selected Value', 'icoda'); ?>
                            </span>
                            <a href="#" class="reset-events-dropdown">
                                <img class="close-icon" src="<?php echo $template_directory_uri; ?>/assets/images/close-icon.svg" alt="Remove filter" />
                            </a>
                        </div>

                        <div class="selected-default">
                            <span class="event-filters-button-name">
                                <?php _e('Topics', 'icoda'); ?>
                            </span>
                            <img class="arrow-select" src="<?php echo $template_directory_uri; ?>/assets/images/drop-arrow.svg" alt="Drop arrow" />
                        </div>
                    </label>
                    <div class="section-dropdown event-filters-dropdown">

                        <a href="#" class="select-item " data-value="any-topic" data-name="<?php _e('Any topics', 'icoda'); ?>">
                            <div class="select-wrapper">
                                <div class="select-name">
                                    <span class="country-name"><?php _e('Any topics', 'icoda'); ?></span>
                                </div>
                            </div>
                        </a>

                        <?php foreach ($topics as $t): ?>
                            <a href="#" class="select-item " data-value="<?php echo $t->term_id; ?>" data-name="<?php echo $t->name; ?>">
                                <div class="select-wrapper">
                                    <div class="select-name">
                                        <span class="country-name"><?php echo $t->name; ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>


            </div>

            <div class="ml-lg-4 mt-2 mt-lg-0 event-filters-togglers w-100 d-lg-flex justify-content-between">

                <label class="toggler-wrapper flex-lg-row flex-row-reverse">
                    <div class="toggler" data-href="#" data-filter="online">
                        <input type="checkbox" class="toggler-status" name="online">
                        <div class="rounded-full"></div>
                    </div>
                    <span class="toggler-name ml-lg-2 mr-2 mr-lg-0">
                        <?php _e('Online', 'icoda'); ?>
                    </span>
                </label>

                <label class="toggler-wrapper flex-lg-row flex-row-reverse">
                    <div class="toggler" data-href="#" data-filter="with_promocode">
                        <input type="checkbox" class="toggler-status" name="with_promocode">
                        <div class="rounded-full"></div>
                    </div>
                    <span class="toggler-name ml-lg-2 mr-2 mr-lg-0">
                        <?php _e('With promo codes', 'icoda'); ?>
                    </span>
                </label>
            </div>
        </div>
    </div>
</form>