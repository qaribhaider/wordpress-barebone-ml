<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hug2k16
 */
?>
<div class="blog-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if (is_single()) {
        the_title('<h2 class="blog-post-title">', '</h1>');
    } else {
        the_title('<h2 class="blog-post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
    }

    if ('post' === get_post_type()) :
        ?>
        <p class="blog-post-meta">
            <?php hug2k16_posted_on(); ?>
        </p><!-- .entry-meta -->
    <?php endif;
    ?>

    <?php
    the_content(sprintf(
                    /* translators: %s: Name of current post. */
                    wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'hug2k16'), array('span' => array('class' => array()))), the_title('<span class="screen-reader-text">"', '"</span>', false)
    ));

    wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'hug2k16'),
        'after' => '</div>',
    ));
    ?>

    <footer class="entry-footer">
        <?php hug2k16_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</div>
