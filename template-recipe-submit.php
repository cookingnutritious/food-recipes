<?php /** Template Name: Submit Recipe */ $show_message = false;if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "submit-recipe") {	$title = $_POST['title'];	$short_description = $_POST['short-description'];	$description = $_POST['description'].'	                                        [ingredients][method]';	// ADD THE FORM INPUT TO $new_recipe ARRAY	$new_recipe = array(		'post_title'	=>	$title,		'post_content'	=>	$description,		'post_excerpt'	=>	$short_description,		'post_status'	=>	'pending',	// Choose: publish, pending, future, draft, etc.		'post_type'	    =>	'recipe'	);//	if(isset($_POST['tags']))//		$new_recipe['tags_input'] = array($_POST['tags']);	if(is_user_logged_in())	{		global $current_user;		get_currentuserinfo();		$new_recipe['post_author'] = $current_user->ID;	}	//SAVE THE POST	$recipe_id = wp_insert_post($new_recipe);	// Attache Post Meta	if(isset($_POST['yield']))		add_post_meta($recipe_id, 'RECIPE_META_yield', $_POST['yield'], true);	if(isset($_POST['servings']))		add_post_meta($recipe_id, 'RECIPE_META_servings', $_POST['servings'], true);	if(isset($_POST['prep-time']))		add_post_meta($recipe_id, 'RECIPE_META_prep_time', $_POST['prep-time'], true);	if(isset($_POST['cook-time']))		add_post_meta($recipe_id, 'RECIPE_META_cook_time', $_POST['cook-time'], true);	if(isset($_POST['ready-in']))		add_post_meta($recipe_id, 'RECIPE_META_ready_in', $_POST['ready-in'], true);    // =====================    if(isset($_POST['ingredient']))        add_post_meta($recipe_id, 'RECIPE_META_ingredients', $_POST['ingredient'], true);    if(isset($_POST['recipe_step']))        add_post_meta($recipe_id, 'RECIPE_META_method_steps', $_POST['recipe_step'], true);    if(isset($_POST['video_based_recipe']))        add_post_meta($recipe_id, 'RECIPE_META_recipe_video_check', $_POST['video_based_recipe'], true);    if(isset($_POST['video_embed_code']))        add_post_meta($recipe_id, 'RECIPE_META_recipe_video_code', $_POST['video_embed_code'], true);    //===================	// Attach Recipe Taxonomies to created recipe	if(isset($_POST['recipe-type']) && ($_POST['recipe-type'] != "-1") )		wp_set_object_terms( $recipe_id , intval($_POST['recipe-type']), 'recipe_type' );	if(isset($_POST['skill-level']) && ($_POST['skill-level'] != "-1"))		wp_set_object_terms( $recipe_id , intval($_POST['skill-level']), 'skill_level' );	if(isset($_POST['cuisine']) && ($_POST['cuisine'] != "-1"))		wp_set_object_terms( $recipe_id , intval($_POST['cuisine']), 'cuisine' );	if(isset($_POST['course']) && ($_POST['course'] != "-1"))		wp_set_object_terms( $recipe_id , intval($_POST['course']), 'course' );	if($_FILES)	{		$size = intval( $_FILES['recipe-image']['size'] );		if ( $size > 0 )		{			foreach ($_FILES as $file => $array)			{				$newupload = insert_attachment($file,$recipe_id, true);				// $newupload returns the attachment id of the file that				// was just uploaded. Do whatever you want with that now.			}		}	}    $post_tags_pre = $_POST['tags'];    if(!empty($post_tags_pre)){        $post_tags_array = explode(',',$post_tags_pre);        if(is_array($post_tags_array) && !empty($post_tags_array)){            wp_set_post_tags($recipe_id, $post_tags_array);        }    }	$show_message = true;    if(function_exists('ot_get_option')){        $rs_address = ot_get_option('submit_recipe_email_target');        if(!empty($rs_address)){            $current_user = wp_get_current_user();            $rs_submitter_name = $current_user->display_name;            $rs_submitter_email = $current_user->user_email;            $e_reply = 	__("You can contact the submitter ", 'FoodRecipe')                .$rs_submitter_name                . __(" via email, ", 'FoodRecipe')                .$rs_submitter_email;            $rs_subject = __('New recipe has been submitted.', 'FoodRecipe');            $email_html = __("A new recipe has been submitted on your website using recipe submit page.\n\n", 'FoodRecipe');            $email_html.= __('Recipe Title: ','FoodRecipe').$title;            $email_html.= __("\n\nDescription: ",'FoodRecipe').$short_description;            $email_html.= "\n\n".$e_reply;            wp_mail($rs_address, $rs_subject, $email_html, "From: $rs_submitter_email\r\nReply-To: $rs_submitter_email\r\nReturn-Path: $rs_submitter_email\r\n","-f $rs_address");        }    }} // END THE IF STATEMENT THAT STARTED THE WHOLE FORM//POST THE POST YOdo_action('wp_insert_post', 'wp_insert_post');get_header(); ?>						<div id="left-area" class="clearfix">                        		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>								<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">										<h1 class="post-title"><?php the_title(); ?></h1>										<p class="meta"><span class="comments"><?php comments_popup_link(__('0 Comments', 'FoodRecipe'), __('1 Comment', 'FoodRecipe'), __('% Comments', 'FoodRecipe')); ?></span> <span>|</span> <?php __('Last Update:', 'FoodRecipe'); ?> <span> <?php the_time('F j, Y'); ?></span></p>										<?php												if(has_post_thumbnail())												{													?>			                                        <div class="post-thumb single-img-box">															<a rel="prettyPhoto" title="<?php the_title(); ?>" href="<?php $image_id = get_post_thumbnail_id();																	$image_url = wp_get_attachment_image_src($image_id,'full-size', true);																	echo $image_url[0];															?>">			                                                		<?php the_post_thumbnail('thumbnail-blog'); ?>			                                                </a>													</div>		                                        	<?php												}												the_content();										?>							</div><!-- end of post div -->								<?php endwhile; ?>								<?php endif; ?>						        <?php								if(is_user_logged_in()){										if(!$show_message){												?>                                                <a class="logout_link" href="<?php echo wp_logout_url(get_permalink().'#login-signup-forgot'); ?>" title="<?php _e('Logout', 'FoodRecipe'); ?>"><?php _e('Logout', 'FoodRecipe'); ?></a>												<form id="recipe-form" name="recipe-form" action="" method="post" enctype="multipart/form-data">												        <!-- recipe title -->														<fieldset name="recipe-title" class="recipe-title">															<label for="title"><?php _e('Recipe Title','FoodRecipe');?></label>															<input type="text" id="title" value="" tabindex="15" name="title" class="required" />														</fieldset>														<!-- recipe excerpt -->														<fieldset class="content">															<label for="short-description"><?php _e('Short Description','FoodRecipe');?></label>															<textarea id="short-description" tabindex="16" name="short-description" cols="80" rows="3" class="tinymce-enabled required"></textarea>														</fieldset>														<!-- recipe content -->														<fieldset class="content">															<label for="description"><?php _e('Recipe Content','FoodRecipe');?></label>															<?php																$settings = array(																		    'tabindex' => 17,																			'editor_class' => ''																		);																wp_editor( '', 'description', $settings );															?>														</fieldset>														<!-- recipe featured image -->														<fieldset class="recipe-image">															<label for="featured-image"><?php _e('Featured Image','FoodRecipe');?></label>															<input type="file" name="recipe-image" id="recipe-image" size="18" tabindex="1">                                                            <span class="note"><strong>* <?php _e('Image size must be more than 575px in width and 262px in height.','FoodRecipe'); ?></strong></span>														</fieldset>														<fieldset class="incobjs ingre-wrap">                                                            <label><?php _e('Ingredients', 'FoodRecipe'); ?></label>                                                            <input type="text" name="ingredient[]" id="ingredient" size="50">                                                            <span class="more-ingre">+</span>                                                            <span class="note"><?php _e('Use + button on the right to add new ingredient.','FoodRecipe'); ?></span>														</fieldset>                                                        <fieldset class="incobjs steps-wrap">                                                            <label><?php _e('Steps', 'FoodRecipe'); ?></label>                                                            <textarea name="recipe_step[]" id="recipe_step" cols="60" rows="3"></textarea>                                                            <span class="more-ingre">+</span>                                                            <span class="note"><?php _e('Use + button on the right to add new step.','FoodRecipe'); ?></span>                                                        </fieldset>                                                        <fieldset>                                                            <label><?php _e('Video Based Recipe','FoodRecipe'); ?></label>                                                            <select id="video-based" name="video_based_recipe">                                                                <option value="on"><?php _e('Yes','FoodRecipe'); ?></option>                                                                <option value="off" selected><?php _e('No','FoodRecipe'); ?></option>                                                            </select>                                                            <span class="note"><?php _e('A Video Based recipe does not display attached images and only display a video at top.','FoodRecipe'); ?></span>                                                        </fieldset>                                                        <fieldset>                                                            <label for="video-embed-code"><?php _e('Video Embed Code','FoodRecipe'); ?></label>                                                            <textarea name="video_embed_code" id="video-embed-code" cols="60" rows="3"></textarea><br>                                                            <span class="note">* <?php _e('Provide the video embed code and <strong>Modify the width attribute to 575px and height attribute to 262px.</strong>','FoodRecipe');?></span>                                                        </fieldset>														<!-- recipe detail -->														<fieldset name="recipe-detail" class="recipe-detail">															<div>																<label for="yield"><?php _e('Yield','FoodRecipe');?></label>																<input type="text" id="yield" value="" tabindex="19" name="yield" />																<label for="servings"><?php _e('Servings','FoodRecipe');?></label>																<input type="text" id="servings" value="" tabindex="20" name="servings" />															</div>															<div>																<span class="note">* <?php _e('Specify the time in minutes and value greater than 60 will be automatically displayed in hours.','FoodRecipe');?></span>																<label for="prep-time"><?php _e('Prep Time','FoodRecipe');?></label>																<input type="text" id="prep-time" value="" tabindex="21" name="prep-time" />																<label for="cook-time"><?php _e('Cook Time','FoodRecipe');?></label>																<input type="text" id="cook-time" value="" tabindex="22" name="cook-time" />																<label for="ready-in"><?php _e('Ready In','FoodRecipe');?></label>																<input type="text" id="ready-in" value="" tabindex="23" name="ready-in" />															</div>														</fieldset>														<!-- recipe categories -->														<fieldset name="recipe-categories" class="recipe-categories clearfix">															<div class="clearfix">																<label for="tags" class="for-tags"><?php _e('Tags','FoodRecipe');?></label>																<input type="text" id="tags" value="" tabindex="24" name="tags" />		<br>																<span class="note">* <?php _e('Tags keywords should all be in lowercase and separated by commas','FoodRecipe');?></span>															</div>															<div class="clearfix">																<label for="recipe-type"><?php _e('Recipe Type','FoodRecipe');?></label>																<?php wp_dropdown_categories( 'tab_index=25&taxonomy=recipe_type&name=recipe-type&show_option_none='.__('None','FoodRecipe').'&hide_empty=0' ); ?>															</div>															<div class="clearfix">																<label for="cuisine"><?php _e('Cuisine','FoodRecipe');?></label>																<?php wp_dropdown_categories( 'tab_index=26&taxonomy=cuisine&name=cuisine&show_option_none='.__('None','FoodRecipe').'&hide_empty=0' ); ?>															</div>															<div class="clearfix">																<label for="course"><?php _e('Course','FoodRecipe');?></label>																<?php wp_dropdown_categories( 'tab_index=27&taxonomy=course&name=course&show_option_none='.__('None','FoodRecipe').'&hide_empty=0' ); ?>															</div>															<div class="clearfix">																<label for="skill-level"><?php _e('Skill Level','FoodRecipe');?></label>																<?php wp_dropdown_categories( 'tab_index=28&taxonomy=skill_level&name=skill-level&show_option_none='.__('None','FoodRecipe').'&hide_empty=0' ); ?>															</div>														</fieldset>														<fieldset class="submit">															<input type="submit" value="<?php _e('Submit Recipe','FoodRecipe'); ?>" tabindex="40" id="submit" name="submit" class="readmore"/>														</fieldset>														<input type="hidden" name="action" value="submit-recipe" />														<?php wp_nonce_field( 'submit-recipe' ); ?>										        </form>												<?php										} else {											?>											<div class="recipe-message">												<h3><?php _e('Thanks for Submit!','FoodRecipe');?></h3>												<h4><?php echo __('We will publish your Recipe after Review.','FoodRecipe');?></h4>											</div>											<?php										}								} else {									?>										<div class="tabed" id="login-signup-forgot">			                                <ul class="tabs">													<li class="current"><?php _e('Login','FoodRecipe');?><span></span></li>													<?php if(get_option('users_can_register')) : ?>														<li><?php _e('Sign Up','FoodRecipe');?><span></span></li>													<?php endif; ?>													<li><?php _e('Forgot Password','FoodRecipe');?><span></span></li>											</ul>			                                <div class="block current">													<form id="login-form" action="<?php echo wp_login_url(get_permalink()); ?>" method="post">														<p>															<br/>															<label for="username"><?php _e('User Name','FoodRecipe');?></label>															<input type="text" name="log" id="username" tabindex="10" />														</p>														<p>															<label for="password"><?php _e('Password','FoodRecipe');?></label>															<input type="password" name="pwd" id="password"  tabindex="15" />														</p>														<p>															<input type="checkbox" class="checkbox" id="remember" name="rememberme" value="forever" />															<label for="remember" class="checkbox-label"><?php _e('Remember me','FoodRecipe');?></label>															<br/>															<input type="submit" class="readmore" id="login-submit" name="submit" value="<?php _e('Login!','FoodRecipe');?>" />															<input type="hidden" name="redirect_to" value="<?php the_permalink(); ?>" />														</p>													</form>											</div>											<?php if(get_option('users_can_register')) : ?>											<div class="block">													<form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" id="signup-form"  method="post">															<p>																<label for="userName"><?php _e('Username','FoodRecipe');?></label>																<input type="text" id="userName" name="user_login" />															</p>															<p>																<label for="user_email"><?php _e('Email','FoodRecipe');?></label>																<input type="text" id="user_email" name="user_email" />															</p>															<p>																<input type="submit" class="readmore" name="user-submit" value="Sign Up!" />																<?php /*?><input type="hidden" name="redirect_to" value="<?php the_permalink(); ?>" /><?php */?>																<input type="hidden" name="user-cookie" value="1" />															</p>													</form>											</div>			                                <?php endif; ?>											<div class="block">													<form action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" id="forgot-form"  method="post">															<p>																<label for="user_login" class="forgot-email"><?php _e('Username or Email','FoodRecipe'); ?></label>																<input type="text" name="user_login" value="" id="user_login" />															</p>															<p>																<input type="submit" class="readmore" name="user-submit" value="<?php _e('Reset my password','FoodRecipe'); ?>" />																<input type="hidden" name="redirect_to" value="<?php the_permalink(); ?>" />																<input type="hidden" name="user-cookie" value="1" />															</p>													</form>											</div>									</div><!-- end of tabed div -->									<?php								}								?>                        </div><!-- end of left-area -->				        <!-- LEFT AREA ENDS HERE -->	<?php get_sidebar(); ?><?php get_footer(); ?>