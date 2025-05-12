<form id="event-filters-form" action="">
    
    <div class="event-filters-wrap">
        <button class="btn button-mobile-filter d-lg-none d-flex justify-content-between">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/filter-mobile.svg" alt="filter mobile" />
            <span>Filter | Sort</span>
            <img class="button-mobile-filter-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/button-mobile-filter-arrow.svg" alt="Drop arrow" />
        </button>
        <div class="event-filters d-none d-lg-flex mt-2 mt-lg-0">
            <div class="event-filters-dropdowns d-lg-flex">
                <!-- @todo after choose .selected-item add class .active to .dropdown-list -->
                <div class="dropdown-list">
                    <label class="for-dropdown event-filters-button has-drop-arrow">
                        <input class="checkbox" type="checkbox" name="dropdown">
                        <div class="selected event-filters-selected">
                            <span class="event-filters-button-name">
                                Selected Value
                            </span>
                            <a href="#">
                                <img class="close-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/close-icon.svg" alt="Remove filter" />
                            </a>
                        </div>

                        <div class="selected-default">
                            <div class="event-filters-button-name">
                                Location
                            </div>
                            <img class="arrow-select" src="<?php echo get_template_directory_uri(); ?>/assets/images/drop-arrow.svg" alt="Drop arrow" />
                        </div>
                    </label>
                    <div class="section-dropdown event-filters-dropdown">
                        
                        <div class="dropdown-list-wrapper">
                            <a href="#" class="select-item active" data-value="" data-name="">
                                <div class="select-wrapper">
                                    <div class="select-name">
                                        <span class="country-name">Any country</span>
                                    </div>
                                    <!-- <svg class="checked">
                                        <use xlink:href="#checked"></use>
                                    </svg> -->
                                </div>
                            </a>
                            <a href="#" class="select-item " data-value="argentina" data-name="Argentina">
                                <div class="select-wrapper">
                                    <div class="select-name">
                                        <span class="country-name">Argentina</span>
                                    </div>
                                    <!-- <svg class="checked">
                                        <use xlink:href="#checked"></use>
                                    </svg> -->
                                </div>
                            
                            </a>
                            <a href="#" class="select-item " data-value="bali" data-name="Bali">
                                <div class="select-wrapper">
                                    <div class="select-name">
                                        <span class="country-name">Bali</span>
                                    </div>
                                    <!-- <svg class="checked">
                                        <use xlink:href="#checked"></use>
                                    </svg> -->
                                </div>
                            
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dropdown-list">
                    <label class="for-dropdown event-filters-button has-drop-arrow">
                        <input class="checkbox" type="checkbox" name="dropdown">
                        <div class="selected event-filters-selected">
                            <span class="event-filters-button-name">
                                Selected Value
                            </span>
                            <a href="#">
                                <img class="close-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/close-icon.svg" alt="Remove filter" />
                            </a>
                        </div>

                        <div class="selected-default">
                            <span class="event-filters-button-name">
                                Date
                            </span>
                            <img class="arrow-select" src="<?php echo get_template_directory_uri(); ?>/assets/images/drop-arrow.svg" alt="Drop arrow" />
                        </div>
                    </label>
                    <div class="section-dropdown event-filters-dropdown">
                        
                        <a href="#" class="select-item " data-value="all" data-name="Any date">
                            <div class="select-wrapper">
                                <div class="select-name">
                                    <span class="country-name">Any date</span>
                                </div>
                                <!-- <svg class="checked">
                                    <use xlink:href="#checked"></use>
                                </svg> -->
                            </div>
                        
                        </a>

                        <a href="#" class="select-item " data-value="week" data-name="In a week">
                            <div class="select-wrapper">
                                <div class="select-name">
                                    <span class="country-name">In a week</span>
                                </div>
                                <!-- <svg class="checked">
                                    <use xlink:href="#checked"></use>
                                </svg> -->
                            </div>
                        
                        </a>

                        <a href="#" class="select-item " data-value="month" data-name="Within a month">
                            <div class="select-wrapper">
                                <div class="select-name">
                                    <span class="country-name">Within a month</span>
                                </div>
                                <!-- <svg class="checked">
                                    <use xlink:href="#checked"></use>
                                </svg> -->
                            </div>
                        
                        </a>


                    </div>
                </div>

                <div class="dropdown-list">
                    <label class="for-dropdown event-filters-button">
                        <input class="checkbox" type="checkbox" name="dropdown">
                        <div class="selected event-filters-selected">
                            <span class="event-filters-button-name">
                                Selected Value
                            </span>
                            <a href="#">
                                <img class="close-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/close-icon.svg" alt="Remove filter" />
                            </a>
                        </div>

                        <div class="selected-default">
                            <span class="event-filters-button-name">
                                Topics
                            </span>
                            <img class="arrow-select" src="<?php echo get_template_directory_uri(); ?>/assets/images/drop-arrow.svg" alt="Drop arrow" />
                        </div>
                    </label>
                    <div class="section-dropdown event-filters-dropdown">
                        
                        <a href="#" class="select-item " data-value="all" data-name="Any topics">
                            <div class="select-wrapper">
                                <div class="select-name">
                                    <span class="country-name">Any topics</span>
                                </div>
                                <!-- <svg class="checked">
                                    <use xlink:href="#checked"></use>
                                </svg> -->
                            </div>
                        
                        </a>

                        <a href="#" class="select-item " data-value="ai" data-name="AI">
                            <div class="select-wrapper">
                                <div class="select-name">
                                    <span class="country-name">AI</span>
                                </div>
                                <!-- <svg class="checked">
                                    <use xlink:href="#checked"></use>
                                </svg> -->
                            </div>
                        
                        </a>

                        <a href="#" class="select-item " data-value="banking" data-name="Banking">
                            <div class="select-wrapper">
                                <div class="select-name">
                                    <span class="country-name">Banking</span>
                                </div>
                                <!-- <svg class="checked">
                                    <use xlink:href="#checked"></use>
                                </svg> -->
                            </div>
                        
                        </a>
                    </div>
                </div>


            </div>

            <div class="ml-lg-4 mt-2 mt-lg-0 event-filters-togglers w-100 d-lg-flex justify-content-between">
                
                <label class="toggler-wrapper flex-lg-row flex-row-reverse">
                    <div class="toggler" data-href="#" data-filter="online">
                        <input type="checkbox" class="toggler-status">
                        <div class="rounded-full"></div>
                    </div>
                    <span class="toggler-name ml-lg-2 mr-2 mr-lg-0">
                        Online
                    </span>
                </label>

                <label class="toggler-wrapper flex-lg-row flex-row-reverse">
                    <div class="toggler" data-href="#" data-filter="with_promocode">
                        <input type="checkbox" class="toggler-status">
                        <div class="rounded-full"></div>
                    </div>
                    <span class="toggler-name ml-lg-2 mr-2 mr-lg-0">
                        With promo codes
                    </span>
                </label>

            </div>
        </div>
    </div>
    
</form>