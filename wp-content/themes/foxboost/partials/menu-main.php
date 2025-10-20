<?php
/**
 * menu-main.php
 *
 * The partial for displaying the main menu in header and footer.
 *
 * @link        https://foxboost.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
?>
<?php

    $menu_items_class = $args['menu-items'];
    $menu_item_class = $args['menu-item'];
    $menu_item_current_class = $args['menu-item-current'];
    $menu_item_link_class = $args['menu-item-link'];


    $categories = get_categories( array(
        'taxonomy'     => 'category',
        'hide_empty'   => false,
        'parent'       => 0,
        'orderby'      => 'name',
        'order'        => 'ASC',
    ) );

    $current_cat_id = get_queried_object_id();

    if ( ! empty( $categories ) ) {
        ?>
        <ul class="<?php echo $menu_items_class; ?>">
            <?php foreach($categories as $category) {
                if ($category->term_id === 1) continue;
                if ($category->count == 0) continue;
                $link = get_category_link($category->term_id);
                $class_current = ($category->term_id == $current_cat_id) ? ' '. $menu_item_current_class : '';

                echo '<li class="' .$menu_item_class .' '. $class_current. '">
                    <a class="'. $menu_item_link_class .'" 
                        href="' .esc_url( $link ). '" 
                        title="' . esc_html( $category->name ) . '" 
                        aria-label="' . esc_html( $category->name ) . '">' .
                    esc_html( $category->name ).'
                    </a>
             </li>';
            }?>
        </ul>
    <?php } ?>