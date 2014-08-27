								<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
								
										<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'FoodRecipe'), get_the_title()); ?>"><?php the_title(); ?></a></h1>
										<p class="meta"><?php _e('By: ', 'FoodRecipe'); the_author_posts_link(); ?> <span>|</span> <span class="comments"><?php comments_popup_link(__('0 Comments', 'FoodRecipe'), __('1 Comment', 'FoodRecipe'), __('% Comments', 'FoodRecipe')); ?></span> <span>|</span> <?php _e('On: ', 'FoodRecipe'); the_time('F j, Y'); ?> <span>|</span> <?php _e('Category', 'FoodRecipe'); ?>: <span class="cats"><?php the_category(', '); ?></span></p>
                                        <?php 
											if(has_post_thumbnail()) 
											{
                                                $image_id = get_post_thumbnail_id();
                                                $image_url = wp_get_attachment_image_src($image_id,'full-size', true);
                                                $pp_lb_check = ( function_exists( 'ot_get_option' ) ) ? ot_get_option('pp_ctrl_for_blog') : false;
                                                if(has_post_thumbnail()){
												?>
		                                        <div class="post-thumb single-img-box">
														<a <?php echo ($pp_lb_check == 'true') ? 'rel="prettyPhoto"' : ''; ?> href="<?php echo ($pp_lb_check == 'true') ? $image_url[0] : get_permalink(); ?>" title="<?php the_title(); ?>">
                                                            <?php the_post_thumbnail('thumbnail-blog'); ?>
		                                                </a>
												</div>
		                                        <?php
                                                }
											}
										?>
                                        <p>
                                        <?php
										echo word_trim(get_the_excerpt(), 50, '...');
										?>
                                         <a href="<?php the_permalink(); ?>" class=" res-more"><?php _e('more', 'FoodRecipe'); ?></a>
                                        </p>
                                        <div class="tags">                                		    <?php the_tags(); ?>                                        </div><!-- end of tags div -->
										<a href="<?php the_permalink(); ?>" class="readmore rightbtn"><?php _e('Read more', 'FoodRecipe'); ?></a>
								</div><!-- end of post div -->