<?php
get_header();
wpb_set_post_views(get_the_ID());
$current_user_id = get_current_user_id();
$main_story_id = get_the_ID();
while(have_posts()) : the_post();
$main_author = get_the_author_meta( 'ID' );
?>
<section class="default_single_post mc_customize_default_single" id="mcDefaultSingleStory" data-url="<?php echo site_url(); ?>">
    <div class="mc_info_story">
        <div class="info_story">
            <div class="mc-container">
                <?php 
                    $term_obj_list = get_the_terms( get_the_ID(), 'status' );
                    if($term_obj_list){
                        $current_term = $term_obj_list[0];
                        if($current_term->slug == 'hoan-thanh'){
                            if(get_field("price_for_full_this_stories") > 0){
                                if(is_bought_story($current_user_id, get_the_ID()) == false){
                    ?>
                    <div class="buy-full-story-man">
                        <div class="buy-full-story-man-txt">
                            <span>Donate </span><span class="price-mon"><?php echo get_field("price_for_full_this_stories"). '$' ?></span> <span> to read this story</span>
                        </div>
                        <div class="buy-full-story-man-button">
                            <button type="button" class="btn-donate-story" id="btnDonateStory">Donate</button>
                        </div>
                    </div>
                <?php  }else{ ?>
                    <div class="buy-full-story-man">
                        <div class="buy-full-story-man-txt-bought">
                            <span>You have donated this story</span>
                        </div>
                    </div>
                               <?php }
                            }
                        }
                    }
                ?>
                <div class="mc-row">
                    <div class="or-mb-2 mc-col-4 mc-col-md-6 mc-col-sml-12">
                        <div class='info-detail-story'>
                            <div class="name-story">
                                <?php echo get_the_title(); ?>
                            </div>
                            <div class="status-st">
                            <?php 
                                $term_obj_list = get_the_terms( get_the_ID(), 'status' );
                                if($term_obj_list){
                                    $current_term = $term_obj_list[0];
                                    if($current_term->slug == 'hoan-thanh'){
                                ?>
                                <p class="dht-tru">Accomplished</p>
                            <?php 
                                    }else{
                                        echo "<p>Publishing</p>";
                                    }
                                }else{
                                    echo "<p>Publishing</p>";
                                }
                            ?>
                            </div>
                            <div class="inter-story">
                                <div class="item-inter">
                                    <div class="rw-inter-st">
                                        <p class="ic-st"><i class="fa-solid fa-eye"></i></p>
                                        <p><?php echo wpb_get_post_views(get_the_ID()); ?></p>
                                    </div>
                                </div>
                                <div class="item-inter">
                                    <div class="rw-inter-st">
                                        <?php echo kk_star_ratings(); ?>
                                        <!-- <p class="ic-st"><i class="fa-solid fa-star"></i></p>
                                        <p>8.3</p> -->
                                    </div>
                                </div>                            
                            </div>
                            <?php if(get_field("mc_main_author_stories")){ ?>
                                <div class="name-author" style="font-size:14px; color:#61ba61; margin-bottom: 20px;font-family: RobotoBold;">
                                    Author: <?php echo get_field("mc_main_author_stories"); ?>
                                </div>
                            <?php }else{ ?>
                            <a href="<?php echo site_url("user/?ms=".get_the_author_meta( 'ID' )); ?>" class="author-st">
                                <div class="img-author">
                                    <?php 
                                        if(get_field('avata_user', 'user_'.get_the_author_meta( 'ID' ) )){
                                    ?>
                                        <img src="<?php echo get_field('avata_user', 'user_'.get_the_author_meta( 'ID' ) ); ?>" alt="<?php echo get_the_author_meta( 'first_name' ). ' ' . get_the_author_meta( 'last_name' ); ?>">
                                    <?php
                                        }else{
                                    ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/avatar-user.jpg" alt="<?php echo get_the_author_meta( 'first_name' ). ' ' . get_the_author_meta( 'last_name' ); ?>" />
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="name-author">
                                    <?php echo get_the_author_meta( 'first_name' ). ' ' . get_the_author_meta( 'last_name' ); ?>
                                </div>
                            </a>
                            <?php } ?>
                            <?php 
                                $categories = get_the_category();
                                if($categories): 
                            ?>
                            <div class="tag-st">
                                <?php foreach ($categories as $category): ?>
                                        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="st-tag"><?php echo $category->cat_name; ?></a>
                                <?php  endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <div class='sumary-st'>
                                <div class="sumary-title">
                                    Summary
                                </div>
                                <div class="sumary-desc">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                            <?php 
                                $args = array(
                                    'post_type' => 'post',
                                    'post_status'=> 'publish',
                                    'posts_per_page' => 6,
                                );
                                $stories_new = new WP_Query( $args );
                                if ( $stories_new->have_posts() ) :
                            ?>
                            <div class="you-might-enjoy-hide-mb you-might-enjoy">
                                <div class="title-you-might-enjoy">
                                    You Might Also Enjoy
                                </div>
                                <div class="splide sg-ymae-slider">
                                    <div class="splide__track">
                                        <div class="splide__list">
                                        <?php while ( $stories_new->have_posts() ) : $stories_new->the_post(); ?>
                                            <div class="item-hot-mb splide__slide">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo get_field("thumb_fea_vertical"); ?>" alt='<?php echo get_the_title(); ?>' />
                                                    <div class="name-chap-hot-mb">
                                                        <p class="name-hot-mb"><?php echo get_the_title(); ?></p>
                                                        <p class="chap-hot-mb">Chapter <?php echo get_field("chapter_current_of_story"); ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php endwhile; ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; // Reset Post Data
                    wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="or-mb-1 mc-col-4 mc-col-md-6 mc-col-sml-12">
                        <div class='img-story'>
                            <img src="<?php echo get_field("thumb_fea_vertical"); ?>" alt='<?php echo get_the_title(); ?>' />
                        </div>
                    </div>
                    <div class="or-mb-3 mc-col-4 mc-col-md-12">
                        <div class="chapter-for-story">
                            <div class="chapter-and-numb">
                                <div class="titl-chap">
                                    Chapter
                                </div>
                                <div class="numb-chap">
                                    <?php echo get_field("chapter_current_of_story"); ?>
                                </div>
                            </div>
                            <?php 
                                $args = array(
                                    'post_type' => 'story',
                                    'post_status' => 'publish',
                                    'meta_query' => array(
                                        array(
                                            'key'     => 'id_story_parent',
                                            'value'   =>  $main_story_id,
                                            'compare' => 'LIKE',
                                        ),
                                    ),
                                    'posts_per_page' => -1,
                                    
                                    ); 
                                    $list_chapters = get_posts( $args );
                            ?>
                            <div class="list-chapter-story">
                                <?php foreach($list_chapters as $item): ?>
                                    <div class="item-chap">
                                        <a href="<?php echo site_url('story/'.$item->post_name); ?>" class="chap">
                                            <p class="num-chap"><?php echo $item->post_title; ?></p>
                                        </a>
                                        <?php 
                                            if ( is_user_logged_in() ) {
                                                $user_id = get_current_user_id();
                                                if($main_author == $user_id){
                                        ?>
                                        <div class="action-chapter">
                                            <a href="<?php echo site_url("/edit-chap?st=".$main_story_id."&chap=".$item->ID); ?>">Edit</a>
                                            <button type="button" class="mc-delete-chap action-delete-chapter" num-ch="<?php echo $item->ID; ?>">Delete</button>
                                        </div>
                                        <?php 
                                            }
                                        } 
                                        ?>
                                    </div>
                                
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $args = array(
                        'post_type' => 'post',
                        'post_status'=> 'publish',
                        'posts_per_page' => 6,
                    );
                    $stories_new2 = new WP_Query( $args );
                    if ( $stories_new2->have_posts() ) :
                ?>
                <div class="you-might-enjoy you-might-enjoy-dis-mb">
                    <div class="title-you-might-enjoy">
                        You Might Also Enjoy
                    </div>
                    <div class="splide sg-ymae-slider-2">
                        <div class="splide__track">
                            <div class="splide__list">
                            <?php while ( $stories_new2->have_posts() ) : $stories_new2->the_post(); ?>
                                <div class="item-hot-mb splide__slide">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_field("thumb_fea_vertical"); ?>" alt='<?php echo get_the_title(); ?>' />
                                        <div class="name-chap-hot-mb">
                                            <p class="name-hot-mb"><?php echo get_the_title(); ?></p>
                                            <p class="chap-hot-mb">Chapter <?php echo get_field("chapter_current_of_story"); ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; // Reset Post Data
                    wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
<?php 
    if ( is_user_logged_in() ) {
        $user_id = get_current_user_id();
        if($main_author == $user_id){
?>
<div class="popup_notice mc_delete_chap_pop" id="deleteChapterPop">
    <div class="overlay-popup" id="overlayDeleteChaprerPop">

    </div>
    <div class="popup_content">
        <div class="txt_notice">
            Do you want to delete this chap ?
        </div>
        <div class="custom-btn-on-pop">
            <div class="btn-no-popup">
                <button type="button" id="subNoDeleteChapterPop">No</a>
            </div>
            <div class="btn-yes-popup">
                <button type="button" id="subDeleteChapterPop">Yes</a>
            </div>
        </div>
        
    </div>
    
</div>
<?php 
    }
} 
?>
<div class="popup_notice mc_buy_story_pop" id="buyStoryPop">
    <div class="overlay-popup" id="overlayBuyStoryPop">

    </div>
    <div class="popup_content">
        <div class="txt_notice">
            <span>Donate <?php echo get_field("price_for_full_this_stories"). '$' ?> to read this story</span>
        </div>
        <div class="custom-btn-on-pop">
            <div class="btn-no-popup">
                <button type="button" id="subNoBuyStory">No</a>
            </div>
            <div class="btn-yes-popup">
                <button type="button" id="subBuyStory" num-st="<?php echo get_the_ID(); ?>" num-at="<?php echo get_the_author_meta( 'ID' ); ?>">Yes</a>
            </div>
        </div>
        
    </div>
    
</div>
<div class="popup_notice mc_pop_have_not_enough_money" id="haveNotEnoughMoney">
    <div class="overlay-popup" id="overlayNotEnoughMoney">

    </div>
    <div class="popup_content">
        <div class="txt_notice">
            You don't have enough money. Please refill !
        </div>
        <div class="custom-btn-on-pop">
            <div class="btn-no-popup">
                <button type="button" id="subNoEnoughMoney">No</a>
            </div>
            <div class="btn-yes-popup">
                <a href="<?php echo site_url('payment'); ?>" id="subRefillMoney">Depositing</a>
            </div>
        </div>
        
    </div>
    
</div>
<?php endwhile; ?>
<?php get_template_part('sections/footer-customize');  ?>

<?php get_footer();?>