<div class="cookname" itemscope itemtype="http://schema.org/Person">		<div class="img-box">				<a itemprop="author" class="imgc" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">						<?php                        $photo_link = get_the_author_meta( 'photo', get_the_author_meta('ID') );                        if(!empty($photo_link)){                            $attachment_id = get_attachment_id_from_src($photo_link);                            $user_thumb = wp_get_attachment_image_src( $attachment_id, 'recipe-author-thumb', false );                            ?>                            <img class="auth-photo" src="<?php echo $user_thumb[0]; ?>" alt="<?php echo get_the_author_meta('nickname'); ?>" />                        <?php                        } else {                            if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('user_email'), '78' ); }                        }                        ?>				</a>				<div class="share">					<?php					$twitter_author_link = get_the_author_meta( 'twitter' );					$facebook_author_link = get_the_author_meta( 'facebook' );					$google_author_link = get_the_author_meta( 'google' );					if(!empty($twitter_author_link))					{						?>						<a class="twitter" href="<?php echo $twitter_author_link; ?>"></a>						<?php					}					if(!empty($facebook_author_link))					{						?>						<a class="facebook" href="<?php echo $facebook_author_link; ?>"></a>						<?php					}					if(!empty($google_author_link))					{						?>						<a class="google" rel="me" href="<?php echo $google_author_link; ?>"></a>						<?php                    }					?>				</div>		</div>		<div class="cook-info author vcard">				<h5 itemprop="name" class="fn given-name url"><?php the_author_posts_link(); ?></h5>				<p itemprop="description" ><?php echo word_trim(get_the_author_meta( 'user_description' ),6,'..'); ?></p>				<a itemprop="url" class="url" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php _e('More From This Chef &raquo;', 'FoodRecipe');?></a>		</div></div><!-- end of cookname div -->