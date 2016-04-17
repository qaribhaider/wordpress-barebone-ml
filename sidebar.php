<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hug2k16
 */
if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
</div>

</div><!-- /.row -->
