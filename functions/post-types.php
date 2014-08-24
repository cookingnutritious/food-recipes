<?php/*-----------------------------------------------------------------------------------*/// Custome Recipe Post Type/*-----------------------------------------------------------------------------------*/if(!function_exists('create_recipe')){    add_action( 'init', 'create_recipe' );    function create_recipe() {        $labels = array(            'name' => __('Recipes', 'FoodRecipe'),            'singular_name' => __('Recipe', 'FoodRecipe'),            'add_new' => __('Add New', 'FoodRecipe'), __('Recipe', 'FoodRecipe'),            'add_new_item' => __('Recipe', 'FoodRecipe'),            'edit_item' => __('Edit Recipe', 'FoodRecipe'),            'new_item' => __('New Recipe', 'FoodRecipe'),            'view_item' => __('View Recipe', 'FoodRecipe'),            'search_items' => __('Search Recipes', 'FoodRecipe'),            'not_found' =>  __('No Recipes found', 'FoodRecipe'),            'not_found_in_trash' => __('No Recipes found in Trash', 'FoodRecipe'),            'parent_item_colon' => ''        );        $supports = array(            'title',            'editor',            'thumbnail',            'categories',            'comments',            'excerpt',            'author'        );        register_post_type( 'recipe',            array(                'labels' => $labels,                'public' => true,                'menu_position' => 5,                'hierarchical' => false,                'supports' => $supports,                'taxonomies' => array('recipe-type', 'post_tag'),                'rewrite' => array( 'slug' => __('recipe', 'FoodRecipe') )            )        );    }}// Custom Texonomy Recipe Types for Recipeif(!function_exists('build_taxonomies')){    add_action( 'init', 'build_taxonomies', 0 );    function build_taxonomies() {        // Recipe Type Custom Taxonomy        $recipe_type_labels = array(            'name' => __('Recipe Types', 'FoodRecipe'),            'singular_name' => __('Recipe Type', 'FoodRecipe'),            'search_items' => __('Search Recipe Types', 'FoodRecipe'),            'all_items' => __('All Recipe Types', 'FoodRecipe'),            'parent_item' => __('Parent Recipe Type', 'FoodRecipe'),            'parent_item_colon' =>__('Parent Recipe Type:', 'FoodRecipe'),            'edit_item' => __('Edit Recipe Type', 'FoodRecipe'),            'update_item' => __('Update Recipe Type', 'FoodRecipe'),            'add_new_item' => __('Add New Recipe Type', 'FoodRecipe'),            'new_item_name' => __('Recipe Type Name', 'FoodRecipe'),            'menu_name' => __('Recipe Types', 'FoodRecipe')        );        register_taxonomy(            'recipe_type',            'recipe',            array(                'hierarchical' => true,                'labels' => $recipe_type_labels,                'query_var' => true,                'rewrite' => array( 'slug' => __('recipe-type', 'FoodRecipe') )            )        );        // Cuisine Custom Taxonomy        $cuisines_labels = array(            'name' => __('Cuisines', 'FoodRecipe'),            'singular_name' => __('Cuisine', 'FoodRecipe'),            'search_items' => __('Search Cuisines', 'FoodRecipe'),            'all_items' => __('All Cuisines', 'FoodRecipe'),            'parent_item' => __('Parent Cuisine', 'FoodRecipe'),            'parent_item_colon' =>__('Parent Cuisine:', 'FoodRecipe'),            'edit_item' => __('Edit Cuisine', 'FoodRecipe'),            'update_item' => __('Update Cuisine', 'FoodRecipe'),            'add_new_item' => __('Add New Cuisine', 'FoodRecipe'),            'new_item_name' => __('Cuisine Name', 'FoodRecipe'),            'menu_name' => __('Cuisines', 'FoodRecipe')        );        register_taxonomy(            'cuisine',            'recipe',            array(                'hierarchical' => true,                'labels' => $cuisines_labels,                'query_var' => true,                'rewrite' => array( 'slug' => __('cuisine', 'FoodRecipe') )            )        );        // Courses Custom Taxonomy        $courses_labels = array(            'name' => __('Courses', 'FoodRecipe'),            'singular_name' => __('Course', 'FoodRecipe'),            'search_items' => __('Search Courses', 'FoodRecipe'),            'all_items' => __('All Courses', 'FoodRecipe'),            'parent_item' => __('Parent Course', 'FoodRecipe'),            'parent_item_colon' =>__('Parent Course:', 'FoodRecipe'),            'edit_item' => __('Edit Course', 'FoodRecipe'),            'update_item' => __('Update Course', 'FoodRecipe'),            'add_new_item' => __('Add New Course', 'FoodRecipe'),            'new_item_name' => __('Course Name', 'FoodRecipe'),            'menu_name' => __('Courses', 'FoodRecipe')        );        register_taxonomy(            'course',            'recipe',            array(                'hierarchical' => true,                'labels' => $courses_labels,                'query_var' => true,                'rewrite' => array( 'slug' => __('course', 'FoodRecipe') )            )        );        // Ingredients Custom Taxonomy        $ingredients_labels = array(            'name' => __('Ingredients', 'FoodRecipe'),            'singular_name' => __('Ingredient', 'FoodRecipe'),            'search_items' => __('Search Ingredients', 'FoodRecipe'),            'all_items' => __('All Ingredients', 'FoodRecipe'),            'parent_item' => __('Parent Ingredient', 'FoodRecipe'),            'parent_item_colon' =>__('Parent Ingredient:', 'FoodRecipe'),            'edit_item' => __('Edit Ingredient', 'FoodRecipe'),            'update_item' => __('Update Ingredient', 'FoodRecipe'),            'add_new_item' => __('Add New Ingredient', 'FoodRecipe'),            'new_item_name' => __('Ingredient Name', 'FoodRecipe'),            'menu_name' => __('Ingredients', 'FoodRecipe')        );        register_taxonomy(            'ingredient',            'recipe',            array(                'hierarchical' => true,                'labels' => $ingredients_labels,                'query_var' => true,                'rewrite' => array( 'slug' => __('ingredient', 'FoodRecipe') )            )        );        // Skill Level        $skill_levels_labels = array(            'name' => __('Skill Levels', 'FoodRecipe'),            'singular_name' => __('Skill Level', 'FoodRecipe'),            'search_items' => __('Search Skill Levels', 'FoodRecipe'),            'all_items' => __('All Skill Levels', 'FoodRecipe'),            'parent_item' => __('Parent Skill Level', 'FoodRecipe'),            'parent_item_colon' =>__('Parent Skill Level:', 'FoodRecipe'),            'edit_item' => __('Edit Skill Level', 'FoodRecipe'),            'update_item' => __('Update Skill Level', 'FoodRecipe'),            'add_new_item' => __('Add New Skill Level', 'FoodRecipe'),            'new_item_name' => __('Skill Level Name', 'FoodRecipe'),            'menu_name' => __('Skill Levels', 'FoodRecipe')        );        register_taxonomy(            'skill_level',            'recipe',            array(                'hierarchical' => true,                'labels' => $skill_levels_labels,                'query_var' => true,                'rewrite' => array( 'slug' => __('skill-level', 'FoodRecipe') )            )        );    }}/* Add Custom Columns */if(!function_exists('recipe_edit_columns')){    function recipe_edit_columns($columns){        $columns = array(            "cb" => "<input type=\"checkbox\" />",            "title" => __( 'Recipe Title', 'FoodRecipe' ),            "thumb" => __( 'Thumbnail', 'FoodRecipe' ),            "id" => __( 'Recipe ID', 'FoodRecipe' ),            "date" => __( 'Publish Time', 'FoodRecipe' )        );        return $columns;    }    add_filter("manage_edit-recipe_columns", "recipe_edit_columns");}if(!function_exists('recipe_custom_columns')){    function recipe_custom_columns($column){        global $post;        switch ($column)        {            case 'thumb':                if(has_post_thumbnail($post->ID))                {                    $image_id = get_post_thumbnail_id();                    $image_url = wp_get_attachment_url($image_id);                    ?>                    <a href="<?php the_permalink(); ?>" target="_blank">                        <?php the_post_thumbnail('sidebar-tabs'); ?>                    </a>                <?php                }                else                {                    _e('No Thumbnail', 'FoodRecipe');                }                break;            case 'id':                echo $post->ID;                break;        }    }    add_action("manage_posts_custom_column",  "recipe_custom_columns");}/*-----------------------------------------------------------------------------------*//*	Add Recipes in RSS Feed/*-----------------------------------------------------------------------------------*/if(!function_exists('my_recipes_feed')){    function my_recipes_feed($qv) {        if (isset($qv['feed']) && !isset($qv['post_type']))            $qv['post_type'] = array('post', 'recipe');        return $qv;    }    add_filter('request', 'my_recipes_feed');}function alter_recipe_singular($single_template) {    global $post;    if ($post->post_type == 'recipe') {        remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds        remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed    }    return $single_template;}add_filter( 'single_template', 'alter_recipe_singular' );/*-----------------------------------------------------------------------------------*//*	Add Thumbnails in RSS Feed/*-----------------------------------------------------------------------------------*/if(!function_exists('rss_post_thumbnail_excerpt')){    function rss_post_thumbnail_excerpt($content) {        global $post;        if(has_post_thumbnail($post->ID)) {            $content = '<p>' . get_the_post_thumbnail($post->ID, 'recipe-listing') .'</p>' . get_the_excerpt();        }        return $content;    }    add_filter('the_excerpt_rss', 'rss_post_thumbnail_excerpt');}if(!function_exists('rss_post_thumbnail')){    function rss_post_thumbnail($content) {        global $post;        if(has_post_thumbnail($post->ID)) {            $content = '<p>' . get_the_post_thumbnail($post->ID, 'recipe-listing') .'</p>' . do_shortcode(get_the_content());        }        return $content;    }    add_filter('the_content_feed', 'rss_post_thumbnail');}?>