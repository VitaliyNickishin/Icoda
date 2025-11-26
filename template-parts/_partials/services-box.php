<?php /* <div class="services-box">
    <div class="row justify-content-end">
        <div class="serv-box hidden">
            <p></p>
        </div>
        <div class="serv-box hidden">
            <p></p>
        </div>
        <div class="serv-box">
            <p><?php _e('iGaming', 'icoda'); ?></p>
        </div>
        <div class="serv-box">
            <p><?php _e('Token Sale', 'icoda'); ?></p>
        </div>
    </div>

    <div class="row">
        <div class="serv-box">
            <p><?php _e('DeFi', 'icoda'); ?></p>
        </div>
        <div class="serv-box">
            <p><?php _e('Meme', 'icoda'); ?></p>
        </div>
        <div class="serv-box">
            <p><?php _e('Exchanges', 'icoda'); ?></p>
        </div>
        <div class="serv-box hidden">
            <p></p>
        </div>
    </div>

    <div class="row">
        <div class="serv-box">
            <p><?php _e('GameFi', 'icoda'); ?></p>
        </div>
        <div class="serv-box">
            <p><?php _e('Wallets', 'icoda'); ?></p>
        </div>
        <div class="serv-box hidden">
            <p></p>
        </div>
        <div class="serv-box hidden">
            <p></p>
        </div>
    </div>
</div>
*/ ?>

<?php
$data = get_field('home_gradient_services');
?>
<div class="services-box d-flex">
    <?php foreach ($data as $item_data) : ?>
        <?php
        $services = explode("\n", $item_data['values']);
        $services_url = explode("\n", $item_data['services_url']);
        $services_url = array_map('trim', $services_url);
        ?>
        <div class=" <?php echo !empty($item_data['align_from_end']) ? ' d-flex flex-column justify-content-end ' : ''; ?>">
            <?php foreach ($services as $key => $value) : ?>
                <?php if( $key === 0 && !empty($item_data['align_from_end']) ) : ?>
                    <div class="serv-box hidden">
                        <p></p>
                    </div>
                <?php endif; ?>
                <?php if(!empty($services_url[$key]) && $services_url[$key] !== '-'): ?>
                    <a href="<?php echo $services_url[$key]; ?>" class="serv-box">
                        <p><?php echo $value; ?></p>
                    </a>
                <?php else : ?>
                    <div class="serv-box">
                        <p><?php echo $value; ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>