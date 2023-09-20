<?php
/**
 * The template for displaying search results pages
 *
 */

get_header();
?>
<section class="mc-search-page">
    <div class="mc-search-page-contain">
        <div class="search-page-head">
            <div class="bg-head-search">
                <div class="content-on-search-head">
                    <div class="title-search-head">
                        <?php 
                            $allsearch =new WP_Query("s=$s&showposts=-1");
                            printf( __( 'Search Results For: %s'), '<span>' . esc_html( get_search_query() ));
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="search-page-results">
            <div class="category_contain">
                <div class='mc-container'>
                <?php if (have_posts()) : ?>
                    <div class='mc-row'>
                    <?php while(have_posts()) : the_post(); 
                    if (get_post_type() === 'post'):
                        $one_cate = '';
                        $link_one_cate = '';
                        $categories = get_the_category(get_the_ID());
                        foreach( $categories as $category ) {
                            $one_cate = $category->name;
                            $link_one_cate = get_category_link( $category->term_id );
                        }
                    ?>
                            <a href=<?php the_permalink(); ?> class="mgb mc-col-2 mc-col-lg-3 mc-col-sml-6 mc-col-md-4 mc-col-ct-12">
                                <div class="item-cate">
                                    <div class="title-item-story">
                                        <?php the_title(); ?>
                                    </div>
                                    <div class="thumb-item-story">
                                        <img src='<?php echo get_field("thumb_fea_rectangle"); ?>' alt='<?php echo get_the_title(); ?>' />
                                    </div>
                                    <div class="thumb-and-name-author">
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
                            <?php endif;endwhile; ?>
                    </div>
                    <?php else: ?>
                    <div class="not-found-search">
                        <?php echo "There were no results for your search term" ?>
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
    </div>
</section>
<?php get_template_part('sections/footer-customize');  ?>
<?php
get_footer();
 ?>