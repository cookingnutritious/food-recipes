<?php

/********* Starting Weekly Special Recipe Widget For Sidebar and Home Page Bottom Area *********/
if(!class_exists('Weekly_Special_Widget')){
    class Weekly_Special_Widget extends WP_Widget {

        function Weekly_Special_Widget(){
            $widget_ops = array( 'classname' => 'Weekly_Special_Widget', 'description' => __('Show one weekly special recipe', 'FoodRecipe'));
            $this->WP_Widget( 'weekly_special', __('Food Recipe: Weekly Special Recipe', 'FoodRecipe'), $widget_ops );
        }


        /********* Starting Weekly Special Recipe Widget Function *********/

        function widget($args,  $instance) {
            extract($args);

            $title = apply_filters('widget_title', $instance['title']);
            $weekly_recipe =  $instance['weekly-recipe'];

            if ( empty($title) )
                $title = false;

            $special_post = (array)$instance['weekly-recipe'];

            echo   '<div class="widget wk-special clearfix nostylewt">';
            if($title):
                echo '<h2 class="w-bot-border">';
                echo $title;
                echo '</h2>';
            endif;
            $special_args = array( 'post_type'=>'recipe', 'posts_per_page'=>1, 'post__in' => $special_post );

            $special_query = new WP_Query( $special_args );

            if ( $special_query->have_posts() )
                while ( $special_query->have_posts() ) :
                    $special_query->the_post();

                    if(has_post_thumbnail()){
                        ?>
                        <div class="img-box for-all">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('weekly-special-thumb'); ?></a>
                        </div>
                        <?php
                    }
           ?>
                        <div class="for-res">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('weekly-for-res'); ?></a>
                        </div>
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <p><?php echo word_trim(get_the_excerpt(), 21, '...'); echo '<a href="'; the_permalink(); echo '"> '. __('more', 'FoodRecipe').'</a>'; ?></p>
                        <a href="<?php the_permalink(); ?>" class="readmore"><?php _e('Read More', 'FoodRecipe'); ?></a>
                    <?php
                endwhile;
            echo '</div><!-- end of weekly spcial widget -->';
        }


        /********* Starting Weekly Special Recipe Widget Admin From *********/

        function form($instance)
        {
            $instance = wp_parse_args( (array) $instance, array('title'=> __('Weekly Special', 'FoodRecipe'),'weekly-recipe'=> '' ) );

            $title= esc_attr($instance['title']);
            $weekly_recipe =  $instance['weekly-recipe'];

            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'FoodRecipe'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <?php $id_value =  $this->get_field_id('weekly-recipe'); $name_value = $this->get_field_name('weekly-recipe'); ?>
                <label for="<?php echo $id_value; ?>"><?php _e('Weekly Special Recipe', 'FoodRecipe'); ?></label>
                <?php   generate_weekly_recipe($id_value, $name_value, 'recipe', $weekly_recipe); ?>
            </p>

        <?php
        }


        /********* Starting Weekly Special Recipe Widget Update Function *********/

        function update($new_instance, $old_instance)
        {
            $instance=$old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['weekly-recipe'] = strip_tags($new_instance['weekly-recipe']);

            return $instance;
        }

    }
}


?>