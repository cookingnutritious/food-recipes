<?php if (have_posts()) while (have_posts()) : the_post(); ?>
    <?php
    $video_check = rwmb_meta('RECIPE_META_recipe_video_check');
    $video_url = rwmb_meta('RECIPE_META_recipe_video_code');
    if($video_check == 'on' && !empty($video_url)){
        echo '<div class="full-vid">';
        echo $video_url;
        echo '</div><span class="w-pet-border"></span>';
       }
    ?>

<div id="left-area" class="clearfix hrecipe" itemscope itemtype="http://schema.org/Recipe">

    <!-- Starting Default Loop -->


        <h1 class="title fn" itemprop="name"><?php the_title(); ?></h1>
        <!-- for Schema.org microdata -->
        <meta itemprop="url" content="<?php the_permalink(); ?>">
        <meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>" />
        <span class="published"><?php the_time('Y-m-d'); ?></span>
        <meta itemprop="image" content="<?php
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_image_src($image_id,'recipe-listing', true);
        echo $image_url[0];
        ?>" />
        <meta itemprop="thumbnail" content="<?php echo $image_url[0]; ?>" />

        <!-- Recipe Categorization Information -->
        <ul class="recipe-cat-info clearfix">
            <li>
                <?php echo get_the_term_list( $post->ID, 'cuisine', __('Cuisine: ', 'FoodRecipe'), ', ', ''); ?>
            </li>
            <li>
                <?php echo get_the_term_list( $post->ID, 'course', __(' Course: ', 'FoodRecipe'), ', ', ''); ?>
            </li>
            <li>
                <?php echo get_the_term_list( $post->ID, 'skill_level', __('Skill Level: ', 'FoodRecipe'), ', ', ''); ?>
            </li>
        </ul>

        <?php
            $video_check = rwmb_meta('RECIPE_META_recipe_video_check');
            if($video_check == 'on'){
                $video_url = rwmb_meta('RECIPE_META_recipe_video_code');
            }
        ?>
            <!-- Recipe Single Image -->
            <div class="single-img-box">
                <div class="single-slider cycle-slideshow  " data-cycle-pager=".cycle-pager">
                    <?php
                    $recipe_images = rwmb_meta('RECIPE_META_more_images_recipe', 'type=image');
                    $images_count = count($recipe_images);
                    if($images_count > 0)
                    {
                        foreach($recipe_images as $image)
                        {
                            $imageID = get_attachment_id_from_src($image['full_url']);
                            echo wp_get_attachment_image($imageID, 'thumbnail-blog', false, array( 'class' => 'photo', 'itemprop' => 'image' ));
                        }
                    }
                    else
                    {
                        if(has_post_thumbnail()){
                            the_post_thumbnail('thumbnail-blog', array( 'class'	=> 'photo', 'itemprop' => 'image' ));
                        }
                    }
                    ?>
                </div>
                <div class="img-nav cycle-pager"></div>
            </div>

        <?php get_template_part('functions/recipe-info'); ?>

        <span class="w-pet-border"></span>

        <div class="info-left instructions" itemprop="about">

            <?php the_content(); ?>

            <div class="recipe-tags clearfix">
                <span class="type"><?php echo get_the_term_list( $post->ID, 'recipe_type', __(' Recipe Type: ', 'FoodRecipe'), ', ', ''); ?></span>
                <span class="tags"><?php the_tags(__('Tags: ', 'FoodRecipe'),', ',''); ?> </span>
                <span class="ingredient"><?php echo get_the_term_list( $post->ID, 'ingredient', __(' Ingredients: ', 'FoodRecipe'), ', ', ''); ?></span>
                <!-- Share Icons -->
                <?php
                $social_check = ( function_exists( 'ot_get_option' ) ) ? ot_get_option('recipe_show_social_icons') : false;
                if($social_check == 'show_social')
                    get_template_part('inc/share');
                ?>
            </div>

        </div><!-- end of info-left div -->

        <div class="info-right">

            <!-- Cook Info -->
            <?php get_template_part('inc/cook-info'); ?>

            <!-- Rating Icons -->
            <?php get_template_part('inc/rating'); ?>

            <!-- Including More Recipes part -->
            <?php get_template_part('inc/more-recipes-loop'); ?>

            <!-- Including Nutritional Info part -->
            <?php get_template_part('inc/nutritional-info'); ?>

            <?php if ( !dynamic_sidebar( 'Recipe Right Advertisement Area' )) : endif; ?>

        </div><!-- end of info-right div -->


        <span class="w-pet-border"></span>

    <?php

    if (!get_comments_number()==0) {
        ?>
        <h3 class="blue"><?php _e('Recipe Comments ', 'FoodRecipe');?></h3>
    <?php
    }
    ?>


    <!-- Default Comments -->
    <div class="comments">
        <?php comments_template('',true); ?>
    </div><!-- end of comments div -->

</div><!-- end of left-area -->
<!-- LEFT AREA ENDS HERE -->

<?php endwhile; ?>

<div id="sidebar">
    <?php if ( ! dynamic_sidebar( 'Recipe Single Sidebar' )) : endif; ?>
</div>