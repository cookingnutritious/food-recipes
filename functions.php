<?php
	// Remove Option Tree Settings Menu
    add_filter( 'ot_show_pages', '__return_false' );
    add_filter( 'ot_show_new_layout', '__return_false' );

	/**
	* Theme Options
	*/
	include_once( 'theme-options.php' );

	/********* Define Constants **********/
	define('SHORTCODES', get_template_directory() . '/functions/shortcodes/');
	define('WIDGETS', get_template_directory() . '/functions/widgets/');


	/********* Add Theme Support **********/

	if( function_exists( 'add_theme_support' ) ) {
			add_theme_support('automatic-feed-links');
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'menus' );
            add_theme_support( 'custom-background' );

            /*	Add Custom Header  */
            $header_img_args = array(
                'flex-width'    => true,
                'width'         => 463,
                'height'        => 117,
                'default-image' => get_template_directory_uri() . '/images/header-image.png',
            );
            add_theme_support( 'custom-header', $header_img_args );
}


/********* Function to Register Sidebars **********/

    get_template_part('functions/widgetized-areas');



	/********* Adding Default Thumbnail Sizes for different areas of the website **********/
	if( function_exists( 'add_theme_support' ) ) {

        add_image_size( 'thumbnail-blog', 575, 262, true); // for blog pages
        add_image_size( 'recipe-listing', 250, 212, true); // For recipe listing page
        add_image_size( 'portfolio-thumb', 220, 140, true); // for the portfolio template
        add_image_size( 'portfolio-main', 940, '', false); // for the single portfolio page
        add_image_size( 'full-size', '', '', false);
        add_image_size( 'sidebar-tabs', 63, 53, true);
        add_image_size( 'recipe-4column-thumb', 222, 144, true);
        add_image_size( 'single-carousel-thumb', 132, 104, true);
        add_image_size( 'li-slider-thumb', 515, 262, true);
        add_image_size( 'bs-slider-thumb', 903, 386, true);
        add_image_size( 'weekly-special-thumb', 122, 132, true);
        add_image_size( 'most-rated-thumb', 63, 53, true);
        add_image_size( 'recipe-slider-widget', 302, 196, true);
        add_image_size( 'weekly-for-res', 251, 132, true);
        add_image_size( 'user-listing-thumb', 250, 212, true);
        add_image_size( 'recipe-author-thumb', 84, 78, true);
	}

	/********* text domain loading for translation fix **********/
	load_theme_textdomain( 'FoodRecipe', get_template_directory(). '/languages' );

	/********* Custom Menu Support **********/

	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
	  		array(
	  		  'main-menu' => __('Main Menu', 'FoodRecipe'),
	  		  'social-menu' => __('Social Menu', 'FoodRecipe')
	  		)
	  	);
	}


/*-----------------------------------------------------------------------------------*/
//	Shortcodes
/*-----------------------------------------------------------------------------------*/

	require_once(SHORTCODES . 'columns.php');
	require_once(SHORTCODES . 'elements.php');
	require_once(SHORTCODES . 'typography.php');


/*-----------------------------------------------------------------------------------*/
//	Widgets
/*-----------------------------------------------------------------------------------*/

	require_once(WIDGETS . 'recipe-tabs-widget.php');
	require_once(WIDGETS . 'news-and-events.php');
	require_once(WIDGETS . 'custom-archive-widget.php');
	require_once(WIDGETS . 'recipe-types-widget.php');
	require_once(WIDGETS . 'weekly-special-widget.php');
	require_once(WIDGETS . 'homepage-ad-widget.php');
	require_once(WIDGETS . 'sidebar-ad-widget.php');
	require_once(WIDGETS . 'recent-recipe-footer-widget.php');
	require_once(WIDGETS . 'twitter-footer-widget.php');
	require_once(WIDGETS . 'recipes-slider-cousin-widget.php');
	require_once(WIDGETS . 'recipes-slider-recipe-type-widget.php');
	require_once(WIDGETS . 'footer-info-widget.php');

/*-----------------------------------------------------------------------------------*/
//	Register Widgets
/*-----------------------------------------------------------------------------------*/

        add_action( 'widgets_init', 'recipe_load_widgets' );
        function recipe_load_widgets() {
            register_widget( 'Recipe_Sidebar_Tabed_Widget' );
            register_widget( 'Recipe_News_And_Events_Widget' );
            register_widget( 'Recipe_Archive_Widget' );
            register_widget( 'Recipe_Types_Widget' );
            register_widget( 'Weekly_Special_Widget' );
            register_widget( 'Homepage_Ad_Widget' );
            register_widget( 'Sidebar_Ad_Widget' );
            register_widget( 'Recent_Recipe_Footer_Widget' );
            register_widget( 'Twitter_Footer_Widget' );
            register_widget( 'Recipes_from_Cousins' );
            register_widget( 'Recipes_from_Recipe_Type' );
            register_widget( 'Footer_Info_Widget' );
        }

/*-----------------------------------------------------------------------------------*/
//	Weekly Special Recipe Widget function
/*-----------------------------------------------------------------------------------*/
    if(!function_exists('generate_weekly_recipe')){
        function generate_weekly_recipe($select_id, $name, $post_type, $selected = 0) {
            $label = '--Choose One--';
            $recipe = get_posts(array('post_type'=> $post_type, 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1));
            echo '<select style="width:224px;" name="'. $name .'" id="'.$select_id.'">';
            echo '<option value = "" >'.$label.' </option>';
            foreach ($recipe as $post) {
                echo '<option value="', $post->ID, '"', $selected == $post->ID ? ' selected="selected"' : '', '>', $post->post_title, '</option>';
            }
            echo '</select>';
        }
    }



/*-----------------------------------------------------------------------------------*/
//	Widget titles styling.
/*-----------------------------------------------------------------------------------*/

add_filter('widget_title', 'recipe_widget_title');

function recipe_widget_title($title) {
    // Cut the title to 2 parts
    $title_parts = explode(' ', $title, 2);

    // Throw first word inside a span
    $title = '<span>'.$title_parts[0].'</span>';

    // Add the remaining words if any
    if(isset($title_parts[1]))
        $title .= ' '.$title_parts[1];

    return $title;
}


/*-----------------------------------------------------------------------------------*/
//	Metabox
/*-----------------------------------------------------------------------------------*/

	// Re-define meta box path and URL
	define( 'RWMB_URL', trailingslashit( get_template_directory_uri().'/meta-box' ) );
	define( 'RWMB_DIR', trailingslashit( get_template_directory().'/meta-box' ) );

	// Include the meta box script
	require_once RWMB_DIR . 'meta-box.php';
	include get_template_directory().'/config-meta-boxes.php';


    /*-----------------------------------------------------------------------------------*/
    /*	Editor Styles
    /*-----------------------------------------------------------------------------------*/
    add_editor_style('/inc/custom-editor-style.css');



    /*-----------------------------------------------------------------------------------*/
    /*	 send message function to process contact form submition
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/send-message');



    /*-----------------------------------------------------------------------------------*/
    /*	 Ratting Functions
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/rating-fn');


    /*-----------------------------------------------------------------------------------*/
    //	Sliders Customization
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/slider-customized');


    /*-----------------------------------------------------------------------------------*/
    //	Theme Pagination Method
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/pagination');


    /*-----------------------------------------------------------------------------------*/
    //	WordTrim function
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/wordtrim');


    /*-----------------------------------------------------------------------------------*/
    /*	 Comment Callback
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/comment-callback');


    /*-----------------------------------------------------------------------------------*/
    // Custome Recipe Post Type
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/post-types');


    /*-----------------------------------------------------------------------------------*/
    /*	For Loading Required JS and Files
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/scripts');


    /*-----------------------------------------------------------------------------------*/
    /*	For Loading Required CSS Files
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/styles');


    /*-----------------------------------------------------------------------------------*/
    /*	Additional information on author page
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/author-addition');


    /*-----------------------------------------------------------------------------------*/
    /*	Additional information on author page
    /*-----------------------------------------------------------------------------------*/

    get_template_part('functions/slide-customized');


    /*-----------------------------------------------------------------------------------*/
    /*	Insert Attachment Method for Recipe Submit Template
    /*-----------------------------------------------------------------------------------*/
    if(!function_exists('insert_attachment')){
        function insert_attachment($file_handler,$post_id,$setthumb = false )
        {
            // check to make sure its a successful upload
            if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');

            $attach_id = media_handle_upload( $file_handler, $post_id );

            if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);

            return $attach_id;
        }
    }


    /*-----------------------------------------------------------------------------------*/
    /*	Convert number of Minutes to Hours
    /*-----------------------------------------------------------------------------------*/
    if(!function_exists('convert_to_hours')){
        function convert_to_hours($time)
        {
            $time = intval($time);

            if($time > 60 )
            {
                $hours = floor($time/60);
                $minutes = $time - ($hours * 60);
                if($minutes == 0) { $minutes = '00'; }
                if($minutes < 10) { $minutes = '0'.$minutes; }
                return "$hours:$minutes ".__('h','FoodRecipe');
            }
            return $time.__('m','FoodRecipe');
        }
    }



    /*-----------------------------------------------------------------------------------*/
    /*	Content Width
    /*-----------------------------------------------------------------------------------*/

    if ( ! isset( $content_width ) ) $content_width = 590;


    /*-----------------------------------------------------------------------------------*/
    // Adding Taxonomies in search
    /*-----------------------------------------------------------------------------------*/
if(!function_exists('atom_search_where')){
    function atom_search_where($where){
        global $wpdb;
        if (is_search())
            $where .= "OR (t.name LIKE '%".get_search_query()."%' AND {$wpdb->posts}.post_status = 'publish')";
        return $where;
    }
    add_filter('posts_where','atom_search_where');
}



if(!function_exists('atom_search_join')){
    function atom_search_join($join){
        global $wpdb;
        if (is_search())
            $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
        return $join;
    }
    add_filter('posts_join', 'atom_search_join');
}



if(!function_exists('atom_search_groupby')){
    function atom_search_groupby($groupby){
        global $wpdb;

        // we need to group on post ID
        $groupby_id = "{$wpdb->posts}.ID";
        if(!is_search() || strpos($groupby, $groupby_id) !== false) return $groupby;

        // groupby was empty, use ours
        if(!strlen(trim($groupby))) return $groupby_id;

        // wasn't empty, append ours
        return $groupby.", ".$groupby_id;
    }
    add_filter('posts_groupby', 'atom_search_groupby');
}



    /*-----------------------------------------------------------------------------------*/
    /*	Author page post type combined with post pagi fix.
    /*-----------------------------------------------------------------------------------*/

    if ( !function_exists( 'author_page_404_fix' ) ) {
        function author_page_404_fix( $query ) {
            if ( $query->is_main_query() && (is_author() || is_tag() || is_category()) && !is_404() ) {
                $my_post_type = get_query_var( 'post_type' );
                if ( empty( $my_post_type ) ) {
                    $post_types = array( 'post' , 'recipe' );
                    $query->set('post_type', $post_types );
                }
            }
        }
        add_action( 'pre_get_posts', 'author_page_404_fix' );
    }



    /*-----------------------------------------------------------------------------------*/
    /*	Skin Related Code For Demo
    /*-----------------------------------------------------------------------------------*/
    if(isset($_GET['skin'])){
        $theme_skin = $_GET['skin'];
        setcookie('skin',$theme_skin, time() + 600 );
    }


    /*-----------------------------------------------------------------------------------*/
    /*	Adding admin styles
    /*-----------------------------------------------------------------------------------*/
    if(!function_exists('customAdmin')){
        function customAdmin() {
            $url = get_template_directory_uri().'/inc/wp-admin.css';
            echo '<link rel="stylesheet" type="text/css" href="' . $url . '" />';
        }
        add_action('admin_head', 'customAdmin');
    }


    /*-----------------------------------------------------------------------------------*/
    /*	Recipe count in users column
    /*-----------------------------------------------------------------------------------*/
    if(!function_exists('recipe_manage_users_columns')){
        add_action('manage_users_columns','recipe_manage_users_columns');
        function recipe_manage_users_columns($column_headers) {
            //unset($column_headers['posts']);
            $column_headers['custom_posts'] = 'Recipes';
            return $column_headers;
        }
    }


    if(!function_exists('recipe_manage_users_custom_column')){
        add_action('manage_users_custom_column','recipe_manage_users_custom_column',10,3);
        function recipe_manage_users_custom_column($custom_column,$column_name,$user_id) {
            if ($column_name=='custom_posts') {
                $counts = _recipe_get_author_post_type_counts();
                $custom_column = array();
                if (isset($counts[$user_id]) && is_array($counts[$user_id]))
                    foreach($counts[$user_id] as $count) {
                        $link = admin_url() . "edit.php?post_type=" . $count['type']. "&author=".$user_id;
                        //admin_url() . "edit.php?author=" . $user->ID;
                        $custom_column[] = "\t{$count['count']}";
                    }
                $custom_column = implode("\n",$custom_column);
                if (empty($custom_column))
                    $custom_column = "0";
                $custom_column = "\n{$custom_column}\n";
            }
            return $custom_column;
        }
    }


    if(!function_exists('_recipe_get_author_post_type_counts')){
        function _recipe_get_author_post_type_counts() {
            static $counts;
            if (!isset($counts)) {
                global $wpdb;
                global $wp_post_types;
                $sql = "SELECT post_type, post_author, COUNT(*) AS post_count FROM $wpdb->posts
                            WHERE post_type NOT IN ('page','post','nav_menu_item') AND post_status IN ('publish','pending', 'draft')
                            GROUP BY post_type, post_author";

                $posts = $wpdb->get_results($sql);
                foreach($posts as $post) {
                    $post_type_object = $wp_post_types[$post_type = $post->post_type];
                    if (!empty($post_type_object->label))
                        $label = $post_type_object->label;
                    else if (!empty($post_type_object->label->name))
                        $label = $post_type_object->label->name;
                    else
                        $label = ucfirst(str_replace(array('-','_'),' ',$post_type));
                    if (!isset($counts[$post_author = $post->post_author]))
                        $counts[$post_author] = array();
                    $counts[$post_author][] = array(
                        'label' => $label,
                        'count' => $post->post_count,
                        'type' => $post->post_type,
                    );
                }
            }
            return $counts;
        }
    }




    // Get image id from src function

    if(!function_exists('get_attachment_id_from_src')){
        function get_attachment_id_from_src ($image_src) {

            global $wpdb;
            $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
            $id = $wpdb->get_var($query);
            return $id;

        }
    }


    // Count user recipes
    function count_user_posts_by_type( $userid, $post_type = 'recipe' ) {
        global $wpdb;

        $where = get_posts_by_author_sql( $post_type, true, $userid );

        $count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts $where" );

        return apply_filters( 'get_usernumposts', $count, $userid );
    }



/*-----------------------------------------------------------------------------------*/
/*	Adding ID column for user listings.
/*-----------------------------------------------------------------------------------*/

add_filter('manage_users_columns', 'inspiry_add_user_id_column');
function inspiry_add_user_id_column($columns) {
    $columns['user_id'] = 'User ID';
    return $columns;
}

add_action('manage_users_custom_column',  'inspity_show_user_id_column_content', 10, 3);
function inspity_show_user_id_column_content($value, $column_name, $user_id) {
    $user = get_userdata( $user_id );
    if ( 'user_id' == $column_name )
        return $user_id;
    return $value;
}



/*-----------------------------------------------------------------------------------*/
/*	Necessary Plugins activation functionality.
/*-----------------------------------------------------------------------------------*/

// Including TGM plugin activation class.
require_once('inc/class-tgm-plugin-activation.php');

// hooking plugin activation function with TGM plugin.
add_action( 'tgmpa_register', 'foodrecipes_register_required_plugins' );


function foodrecipes_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name' 		=> 'OptionTree',
            'slug' 		=> 'option-tree',
            'required' 	=> true
        ),array(
            'name' 		=> 'WP-post-view',
            'slug' 		=> 'wp-post-view',
            'required' 	=> false
        )


    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'FoodRecipe';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'       		=> 'FoodRecipe',         	// Text domain - likely want to be the same as your theme.
        'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
        'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
        'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
        'menu'         		=> 'install-required-plugins', 	// Menu slug
        'has_notices'      	=> true,                       	// Show admin notices or not
        'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
        'message' 			=> '',							// Message to output right before the plugins table
        'strings'      		=> array(
            'page_title'                       			=> __( 'Install Required Plugins', 'FoodRecipe' ),
            'menu_title'                       			=> __( 'Install Plugins', 'FoodRecipe' ),
            'installing'                       			=> __( 'Installing Plugin: %s', 'FoodRecipe' ), // %1$s = plugin name
            'oops'                             			=> __( 'Something went wrong with the plugin API.', 'FoodRecipe' ),
            'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'FoodRecipe' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'FoodRecipe' ), // %1$s = plugin name(s)
            'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'FoodRecipe' ), // %1$s = plugin name(s)
            'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'FoodRecipe' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'FoodRecipe' ), // %1$s = plugin name(s)
            'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'FoodRecipe' ), // %1$s = plugin name(s)
            'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'FoodRecipe' ), // %1$s = plugin name(s)
            'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'FoodRecipe' ), // %1$s = plugin name(s)
            'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'FoodRecipe' ),
            'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'FoodRecipe' ),
            'return'                           			=> __( 'Return to Required Plugins Installer', 'FoodRecipe' ),
            'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'FoodRecipe' ),
            'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'FoodRecipe' ), // %1$s = dashboard link
            'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}


?>