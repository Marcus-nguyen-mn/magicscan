<?php
get_header();
?>
<section class="default_single_post">
    <div class="mc-container">
        <div class="single_contain">
            <div class="mc-row mc-mg--15">
                <div class="mc-col-8 mc-pdx-15 mc-col-sm-12">
                <?php 
                    if(have_posts()):
                        while(have_posts()) : the_post();
                    ?>
                    <div class="detail_post">
                        <div class="title_sg_post"><?php the_title(); ?></div>
                        <div class="rg-auth-2">
                            <?php echo get_the_date(); ?>
                        </div>
                    </div>
                    <?php 
                    endwhile;
                        endif;
                    ?>
                    <?php 
                        if(have_posts()):
                            while(have_posts()) : the_post();
                        ?>
                        <div class="content-single">
                            <?php the_content(); ?>
                        </div>
                       <?php 
                    endwhile;
                        endif;
                    ?> 
                </div>
                <div class="mc-col-4 mc-pdx-15 mc-col-sm-12">
                    <div class="mcqc_news_1">
                        <div class="stk-banenr">
                            <div class="title-post-new-mc">
                                <?php echo "Bài viết mới nhất" ?>
                            </div>
                            <?php 
                                $args = array( 
                                    'post_type'=>  'post',
                                    'post_status' => 'publish',
                                    'posts_per_page' => 4,
                                );
                                $post_one_1 = new WP_Query( $args );
                                if ( $post_one_1->have_posts() ) :
                                while ( $post_one_1->have_posts() ) : $post_one_1->the_post();
                            ?>
                            <a href="<?php the_permalink(); ?>" class="ns-first-post-c2">
                                <div class="ns-thumb-post-c2">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt=" <?php echo get_the_title(); ?>">
                                </div>
                                <div class="ns-title-post-c2">
                                    <?php echo get_the_title(); ?>
                                </div>
                                <div class="date-side">
                                    <?php echo get_the_date(); ?>
                                </div>
                            </a>
                            <?php 
                                endwhile;
                                endif;
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_template_part('sections/home/section-4');  ?>
</section>

<?php get_footer();?>