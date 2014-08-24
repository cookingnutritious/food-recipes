<?php
/* ------------------------------------------------------------------------*
 * TYPOGRAPHY
 * ------------------------------------------------------------------------*/
// [ingredients] short code
if(!function_exists('show_ingredients')){
    function show_ingredients($atts, $content = null) {

        extract(shortcode_atts(array(
            'title' => ''
        ), $atts));

        global $post;

        $ingredients = rwmb_meta('RECIPE_META_ingredients');

        $ingredients_count = count($ingredients);


        if(empty($title))
        {
            $ingredients_html = '<h3 class="blue">'.__('Ingredients','FoodRecipe').'</h3>';
        }else{
            $ingredients_html = '<h3 class="blue">'.$title.'</h3>';
        }

        if( $ingredients_count >= 1 )
        {
            $ingredients_html .= '<ul>';
            foreach($ingredients as $ingredient){
                $ingredients_html .= '<li class="ingredient" itemprop="ingredients">';
                $ingredients_html .= $ingredient;
                $ingredients_html .= '</li>';
            }

            $ingredients_html .= '</ul>';
        }
        else
        {
            $ingredients_html .= '<p>';
            $ingredients_html .= __('No Ingredients Found ! ','FoodRecipe');
            $ingredients_html .= '</p>';
        }

        return $ingredients_html;
    }
    add_shortcode('ingredients', 'show_ingredients');
}


// [method] short code
if(!function_exists('show_method_steps')){
    function show_method_steps($atts, $content = null) {

        extract(shortcode_atts(array(
            'title' => ''
        ), $atts));

        global $post;

        $method_steps = rwmb_meta('RECIPE_META_method_steps');
        if(is_array($method_steps)) : $steps_count = count($method_steps); else : $steps_count = 0; endif;
        if(empty($title))
        {
            $method_html = '<h3 class="blue">'.__('Method','FoodRecipe').'</h3>';
        }else{
            $method_html = '<h3 class="blue">'.$title.'</h3>';
        }

        $method_html .= '<div>';

        if( $steps_count >= 1 )
        {
            $i = 1;
            foreach($method_steps as $step){
                $method_html .= '<h4 class="red me-steps"><span class="stepcheck"></span>'.__('Step ','FoodRecipe').($i++).'</h4>';
                $method_html .= '<p class="instructions" itemprop="recipeInstructions">';
                $method_html .= $step;
                $method_html .= '</p>';
            }
        } else {
            $method_html .= '<p>'.__('No Steps Found ! ','FoodRecipe').'</p>';
        }

        $method_html .= '</div>';

        return $method_html;
    }
    add_shortcode('method', 'show_method_steps');
}



// Red Heading Shortcode
if(!function_exists('show_red_heading')){
    function show_red_heading($atts, $content = null) {
        extract(shortcode_atts(array(
            'border' => false,
        ), $atts));

        global $bot_border;

        if($border == 'true')
            $bot_border = '<span class="w-pet-border"></span>';

        return '<h3 class="red-heading">'.$content.'</h3>'.$bot_border;
    }
    add_shortcode('red_heading', 'show_red_heading');
}


// Blue Heading Shortcode
if(!function_exists('show_blue_heading')){
    function show_blue_heading($atts, $content = null) {
        extract(shortcode_atts(array(
            'border' => false,
        ), $atts));

        global $bot_border;

        if($border == true)
            $bot_border = '<span class="w-pet-border"></span>';

        return '<h3 class="blue">'.$content.'</h3>'.$bot_border;
    }
    add_shortcode('blue_heading', 'show_blue_heading');
}


// Recipe Steps Heading Shortcode
if(!function_exists('show_step_head')){
    function show_step_head($atts, $content = null) {
        return '<h4 class="red">'.$content.'</h4>';
    }
    add_shortcode('step_head', 'show_step_head');
}


// Blockquote Left Aligned
if(!function_exists('show_blockquote')){
    function show_blockquote($atts, $content = null) {
        extract(shortcode_atts(array(
            'width' => '',
            'align' => ''
        ), $atts));

        global $align_class, $mwidth, $end_quote;

        if($width)
            $mwidth = $width.'px';
        else {
            $mwidth = 'auto';
            $end_quote = '<span class="end-quote"></span>';
        }

        if($align == 'left')
            $align_class = 'leftalign';
        if($align == 'right')
            $align_class = 'rightalign';
        if($align == 'none')
            $align_class = 'noalign';

        return '<blockquote class="'.$align_class.'" style="width:'. $mwidth .';"><p>'.$content.' '.$end_quote.'</p></blockquote>';
    }
    add_shortcode('blockquote', 'show_blockquote');
}


// Prettyphoto frame for image
if(!function_exists('ppframe_fn')){
    function ppframe_fn($atts, $content = null) {
        extract(shortcode_atts(array(
            'imageurl' => '',
            'title' => ''
        ), $atts));

        global $Image_URL, $image_title;

        if($imageurl){
            $Image_URL = 'href="'.$imageurl.'"';
        }

        if($title){
            $image_title = 'title="'.$title.' "';
        }

        return '<a '.$Image_URL.' '.$image_title.' rel="prettyphoto">'.$content.'</a>';
    }
    add_shortcode('ppframe', 'ppframe_fn');
}


?>