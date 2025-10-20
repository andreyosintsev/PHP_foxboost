<?php
/**
 * sidebar.php
 *
 * The sidebar template file
 *
 * There no sidebar in current project,
 * that's why this template file is for using as dummy only.
 *
 * @link        https://foxboost.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
?>
<?php if ( is_active_sidebar('sidebar') ) :  ?>
    <?php dynamic_sidebar('sidebar'); ?>
<?php endif; ?>