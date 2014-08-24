<?php
/**

 * Registering meta boxes

 *

 * All the definitions of meta boxes are listed below with comments.

 * Please read them CAREFULLY.

 *

 * You also should read the changelog to know what has been changed before updating.

 *

 * For more information, please visit: 

 * @link http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html

 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'RECIPE_META_';

global $meta_boxes;

$meta_boxes = array();


// Metabox for additional recipe information
$meta_boxes[] = array(
	'id'		=> 'recipe_additional',
	'title'		=> __('Recipe Information', 'FoodRecipe'),
	'pages'		=> array( 'recipe' ),
	'priority' => 'high',
	'fields'	=> array(
        array(
            'name'		=> __('Video Based Recipe', 'FoodRecipe'),
            'desc'      =>  __('<strong>A Video Based recipe does not display attached images and only display a video at top.</strong>', 'FoocRecipe'),
            'id'		=> $prefix . 'recipe_video_check',
            'type'		=> 'radio',
            'options'   => array( 'on' => __('Yes ', 'FoodRecipe'), 'off'   =>  __('No ', 'FoodRecipe')),
            'std'   =>  'off'
        ),
        array(
            'name'		=> __('Video Embed Code', 'FoodRecipe'),
            'id'		=> $prefix . 'recipe_video_code',
            'desc'		=> __('Provide the video embed code and <strong>Modify the width attribute to 575px and height attribute to 323px. 16:9 Ratio</strong>', 'FoodRecipe'),
            'clone'		=> false,
            'type'		=> 'textarea',
            'std'		=> ''
        ),
        array(
			'name'	=> __('Attach Images', 'FoodRecipe'),
			'desc'	=> __('Upload recipe images here. <strong>Minimum required size for an image is 575px in width and 262px in height.</strong> These Images will appear in slider on recipe page.<strong> Please do not forget to provide featured image for this recipe using <em>Featured Image</em> metabox in right sidebar</strong> as featured image will be displayed on homepage, recipe listings and widgets. ', 'FoodRecipe'),
			'id'	=> "{$prefix}more_images_recipe",
			'type'	=> 'image_advanced'
		),
		array(
			'name'		=> __('Yield', 'FoodRecipe'),
			'id'		=> $prefix . 'yield',
			'desc'		=> __('How much/many does this recipe produce?', 'FoodRecipe'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Servings', 'FoodRecipe'),
			'id'		=> $prefix . 'servings',
			'desc'		=> __('How many servings?', 'FoodRecipe'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Prep Time', 'FoodRecipe'),
			'id'		=> $prefix . 'prep_time',
			'desc'		=> __('How Many Minutes ?  Minutes Above 60 will be displayed in hours.', 'FoodRecipe'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Cook Time', 'FoodRecipe'),
			'id'		=> $prefix . 'cook_time',
			'desc'		=> __('How Many Minutes ?  Minutes Above 60 will be displayed in hours.', 'FoodRecipe'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Ready In', 'FoodRecipe'),
			'id'		=> $prefix . 'ready_in',
			'desc'		=> __('How Many Minutes ?  Minutes Above 60 will be displayed in hours.', 'FoodRecipe'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Ingredients', 'FoodRecipe'),
			'id'		=> $prefix . 'ingredients',
			'desc'		=> __('You can add list of ingredients here. Use <strong>+ button</strong> on the right to add new ingredient. <strong>To display the list you need to write [ingredients] short code in your content editor.</strong>', 'FoodRecipe'),
			'clone'		=> true,
			'type'		=> 'textarea',
			'std'		=> '',
            'rows'      => 1
		),
		array(
			'name'		=> __('Method Steps', 'FoodRecipe'),
			'id'		=> $prefix . 'method_steps',
			'desc'		=> __('You can add list of recipe method steps here. Use <strong>+ button</strong> on the right to add new step. <strong>To display the list you need to write [method] short code in your content editor.</strong>', 'FoodRecipe'),
			'clone'		=> true,
			'type'		=> 'textarea',
			'std'		=> ''
		),
        array(
            'name'		=> __('Nutrient Name', 'FoodRecipe'),
            'id'		=> $prefix . 'nut_name',
            'desc'		=> __('Enter the name of nutritional Item Name. Use <strong>+ button</strong> on the right to add new Nutrient Name', 'FoodRecipe'),
            'clone'		=> true,
            'type'		=> 'text',
            'std'		=> ''
        ),
        array(
            'name'		=> __('Mass', 'FoodRecipe'),
            'id'		=> $prefix . 'nut_mass',
            'desc'		=> __('Enter Nutrient Mass. Use <strong>+ button</strong> on the right to add new Mass Value.', 'FoodRecipe'),
            'clone'		=> true,
            'type'		=> 'text',
            'std'		=> ''
        )
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function RECIPE_META_register_meta_boxes(){
	global $meta_boxes;
    $meta_boxes = apply_filters('framework_theme_meta', $meta_boxes);

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'RECIPE_META_register_meta_boxes' );