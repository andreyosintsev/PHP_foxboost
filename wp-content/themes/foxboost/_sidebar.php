<?php
/**
 * sidebar.php
 *
 * The sidebar template file
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
?>
<?php if ( is_active_sidebar('sidebar') ) :  ?>
    <?php dynamic_sidebar('sidebar'); ?>
<?php endif; ?>