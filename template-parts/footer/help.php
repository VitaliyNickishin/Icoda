<?php
return;
?>
<div id="icoda-toast" class="">
    <div id="desc">
        <p>
            <?php _e('Didn\'t find what you are looking for?', 'icoda'); ?>
        </p>
        <p>
            <?php _e('Drop us a line. We are always ready to help!', 'icoda'); ?>
        </p>
        <button class="btn btn-blue icoda-open-toaster"><?php _e('Get Help', 'icoda'); ?>
        </button>
    </div>
</div>

<style>
    #icoda-toast {
        display: none;
        width: auto;
        margin: 0 auto;
        background-color: #333;
        text-align: center;
        border-radius: 2px;
        padding: 10px;
        position: fixed;
        z-index: 1001999999;
        left: 0;
        margin-left: 30px;
        bottom: 30px;
        min-height: 80px;
        font-size: 14px;
        font-family: "Proxima Nova", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        box-shadow: 0 1px 5px 0 rgb(0 0 0 / 20%);
        color: black;
        background-color: #fff;
        box-sizing: border-box;
    }

    #icoda-toast .icoda-open-toaster {
        padding: 2px;
        margin-top: 5px;
    }

    #icoda-toast.show {
        display: block;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }
</style>