<?php
get_header();
?>
<section class="mc_category mc_category_cust_style">
    <div class="category">
        <div class="category_title">
            <?php echo single_cat_title(); ?>
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
                                    <img src='<?php echo get_field("thumb_fea_rectangle"); ?>' alt='<?php echo get_the_title(); ?>' />
                                </div>
                                <div class="thumb-and-name-author">
                                    <?php if(get_field("mc_main_author_stories")){
                                    ?>
                                    <div class="thumb-author">
                                        <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/avatar-user.jpg" alt="Avata user" />
                                    </div>
                                    <div class="name-author">
                                        <?php echo get_field("mc_main_author_stories"); ?>
                                    </div>
                                    <?php
                                    }else{ ?>
                                    <div class="thumb-author">
                                        <?php 
                                            if(get_field('avata_user', 'user_'.get_the_author_meta('ID') )){
                                        ?>
                                            <img src="<?php echo get_field('avata_user', 'user_'.get_the_author_meta('ID') ); ?>" alt="Avatar user" />
                                        <?php
                                            }else{
                                        ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/avatar-user.jpg" alt="Avata user" />
                                        <?php
                                          }
                                        ?>
                                    </div>
                                    <div class="name-author">
                                        <?php echo get_the_author_meta('first_name'). ' ' . get_the_author_meta('last_name'); ?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="rating-and-chapter">
                                    <div class="rating-story">
                                        <?php echo kk_star_ratings(); ?>
                                        <!-- <div class="rating-star">
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                        </div>
                                        <div class='num-rating'>
                                            3.5
                                        </div> -->
                                    </div>
                                    <div class="chapter-story">
                                        Chapter <?php echo get_field("chapter_current_of_story"); ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php endwhile; ?>
                </div>
                <?php 
                    else:
                ?>
                <div class="txt_null">
                There are currently no stories for this category !
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
