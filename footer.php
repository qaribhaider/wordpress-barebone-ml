<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SqhrPortfolio
 */
?>

</div><!-- /.container -->

<footer class="blog-footer">
    <p><a href="<?php echo esc_url(__('https://wordpress.org/', 'sqhrportfolio')); ?>"><?php printf(esc_html__('Proudly powered by %s', 'sqhrportfolio'), 'WordPress'); ?></a></p>
</footer>

<?php wp_footer(); ?>
</body>
</html>
