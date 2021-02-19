<div class="wrap bookplus-wrap">
    <h1 class="wp-heading-inline"><?php _e('Settings'); ?></h1>
    <hr class="wp-header-end">

    <?php
        self::$settings_api->show_navigation();
        self::$settings_api->show_forms();
    ?>
</div>
