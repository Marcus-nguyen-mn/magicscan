<?php
/**
 * template name: 404 Page
 */
get_header();
?>
<section class="mc_main page_404">
    <div class="mc-container">
        <div class="error-contain">
            <?php the_content(); ?>
            <div class="mc-btn-go-home">
                <a href="<?php echo site_url(); ?>">Return to Homepage</a>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('sections/footer-customize');  ?>
<?php get_footer();?>