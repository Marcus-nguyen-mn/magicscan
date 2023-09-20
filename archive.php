<?php
get_header();
?>
<section class="mc_category mc_category_cust_style mc_archive_cs_defaut">
    <div class="category">
        <div class="category_title">
            <?php echo "News"; ?>
        </div>
        <div class="category_contain">
            <div class='mc-container'>
            <?php if (have_posts()) : ?>
                <div class='mc-row'>
                    <?php while(have_posts()) : the_post(); ?>
                        <a href=<?php the_permalink(); ?> class="mgb mc-col-2 mc-col-lg-3 mc-col-sml-6 mc-col-md-4 mc-col-ct-12">
                            <div class="item-cate">
                                <div class="title-item-story">
                                    <?php the_title(); ?>
                                </div>
                                <div class="thumb-item-story">
                                    <img src='<?php echo get_the_post_thumbnail_url(); ?>' alt='<?php echo get_the_title(); ?>' />
                                </div>
                            </div>
                        </a>
                        <?php endwhile; ?>
                </div>
                <?php 
                    else:
                ?>
                <div class="txt_null">
                    No news at the moment !
                </div>
                <?php endif; ?>
            </div>
            <div class="mc-panigation">
                <?php
                    the_posts_pagination( array(
                    'prev_text' => __( 'Prev', 'dyblockchain' ),
                    'next_text' => __( 'Next', 'dyblockchain' ),
                    ) );
                ?>          
            </div>
        </div>
    </div>
</section>
<?php get_template_part('sections/footer-customize');  ?>

<?php get_footer();?>
