<section class="section py-lg-4 section-map-global">
    <div class="container">
        <div class="section-map-global__imgage">
            <img src="/wp-content/uploads/2026/06/map.svg" alt="Global Coverage Map">
        </div>
        
        <div class="section-map-global__content">
            <h2 class="title h1 mb-3 mt-lg-5 text-lg-left text-center fw-bold">
                <?php
                    printf(
                        __( 'Put Your %s on the Global Map' ),
                        '<span class="text-primary">Event</span><br>'
                    );
                ?>    
            </h2>
            
            <div class="section-map-global__actions d-flex gap-3 justify-content-center justify-content-lg-start">
                
                <a class="btn btn-blue d-flex align-items-center justify-content-center" 
                    href="" 
                    onclick="Calendly.initPopupWidget({url: 'https://calendly.com/mak-icoda/30min'});return false;"
                >
                    <?php _e('Book a Call', 'icoda'); ?>
                </a>
                <a href="#"
                    data-modal="#callback" 
                    class="btn btn-outline-blue open-modal"
                >
                    <?php _e('Submit Your Event', 'icoda'); ?>
                </a>
                
            </div>
        </div>
    </div>
</section>