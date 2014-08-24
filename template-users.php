<?php/** Template Name: All Users List*/get_header(); ?>    <div id="left-area" class="users-listing clearfix">        <h1><?php the_title(); ?></span></h1>        <span class="w-pet-border"></span><br />        <?php        if(have_posts()):            while(have_posts()):                the_post();                $content_data = get_the_content();                if(!empty($content_data)){                    ?>                    <div <?php post_class(); ?> id="page-<?php the_ID(); ?>">                        <?php                        if(has_post_thumbnail())                        {                            ?>                            <div class="post-thumb single-img-box">                                <a rel="prettyPhoto" title="<?php the_title(); ?>" href="<?php $image_id = get_post_thumbnail_id();                                $image_url = wp_get_attachment_image_src($image_id,'full-size', true);                                echo $image_url[0];                                ?>">                                    <?php the_post_thumbnail('thumbnail-blog'); ?>                                </a>                            </div>                        <?php                        }                        the_content();                        ?>                    </div><!-- end of post div -->                <?php                }            endwhile;        endif;        ?>        <br/>        <?php        $head_id = 0;        if( function_exists( 'ot_get_option' ) ) {            $head_id = ot_get_option( 'listing_head_chef_id' );            $subs_included = ot_get_option( 'skip_subscriber_from_listing' );        }        if($head_id){            $user_data = get_userdata($head_id);            $get_photo_url = get_user_meta($head_id, 'photo', true);            $user_description = get_user_meta($head_id, 'description', true);            $user_designation = get_user_meta($head_id, 'user_designation', true);            $user_website = get_user_meta($head_id, 'url', true);            $user_twitter = get_user_meta($head_id, 'twitter', true);            $user_facebook = get_user_meta($head_id, 'facebook', true);            $user_google = get_user_meta($head_id, 'google', true);            $user_linkedin = get_user_meta($head_id, 'linkedin', true);            $user_youtube = get_user_meta($head_id, 'youtube', true);            $user_page_link = get_author_posts_url($head_id);        ?>        <div class="user-head-wrap">            <figure class="author-wrap">                <a href="<?php echo $user_page_link; ?>">                    <?php                    if($get_photo_url){                        $attachment_id = get_attachment_id_from_src($get_photo_url);                        $user_thumb = wp_get_attachment_image_src( $attachment_id, 'user-listing-thumb', false );                        if($user_thumb){                            ?>                            <img src="<?php echo $user_thumb[0]; ?>" alt="<?php echo $user_data->display_name; ?>" />                        <?php                        } else {                            echo '<img src="'.get_template_directory_uri().'/images/noimage.png" alt="'.$user_data->display_name.'" />';                        }                    } else {                        echo '<img src="'.get_template_directory_uri().'/images/noimage.png" alt="'.$user_data->display_name.'" />';                    }                    ?>                </a>            </figure>            <div class="head-contents-wrap">                <h3 class="user-listing-heading"><a href="<?php echo $user_page_link; ?>"><?php echo $user_data->display_name; ?></a> <?php echo ($user_designation) ? '<span class="head-designation">'.$user_designation.' //</span>' : ''; ?></h3>                <p class="counts">Posts: <?php echo count_user_posts($head_id); ?> <span>//</span> Recipes: <?php echo count_user_posts_by_type($head_id, 'recipe'); ?></p>                <?php                echo '<p class="user-description">'.word_trim($user_description, 28, '...').'</p>';                ?>                <div class="head-bottom">                    <a class="head-readmore readmore" href="<?php echo $user_page_link; ?>">Read more</a>                    <p class="social">                        <?php                        echo ($user_website) ? '<a class="url" href="'.$user_website.'"></a>' : '';                        echo ($user_twitter) ? '<a class="twitter" href="'.$user_twitter.'"></a>' : '';                        echo ($user_facebook) ? '<a class="facebook" href="'.$user_facebook.'"></a>' : '';                        echo ($user_google) ? '<a class="google" href="'.$user_google.'"></a>' : '';                        echo ($user_linkedin) ? '<a class="linkedin" href="'.$user_linkedin.'"></a>' : '';                        echo ($user_youtube) ? '<a class="youtube" href="'.$user_youtube.'"></a>' : '';                        ?>                    </p>                </div>            </div>        </div>        <?php        }        ?>        <div class="user-listing-wrap">        <?php        $all_users = get_users();        foreach($all_users as $user){            //var_dump($user);            if($user->ID == $head_id) continue;            if($subs_included == 'false'){                if($user->roles[0] == 'subscriber') continue;            }            $get_photo_url = get_user_meta($user->ID, 'photo', true);            $user_description = get_user_meta($user->ID, 'description', true);            $user_designation = get_user_meta($user->ID, 'user_designation', true);            $user_website = get_user_meta($user->ID, 'url', true);            $user_twitter = get_user_meta($user->ID, 'twitter', true);            $user_facebook = get_user_meta($user->ID, 'facebook', true);            $user_google = get_user_meta($user->ID, 'google', true);            $user_linkedin = get_user_meta($user->ID, 'linkedin', true);            $user_youtube = get_user_meta($user->ID, 'youtube', true);            $user_page_link = get_author_posts_url($user->ID);            ?>            <div class="user-list-col">                <h3 class="user-listing-heading"><a href="<?php echo $user_page_link; ?>"><?php echo $user->display_name; ?></a></h3>                <figure class="author-wrap">                    <a href="<?php echo $user_page_link; ?>">                        <?php                        if($get_photo_url){                            $attachment_id = get_attachment_id_from_src($get_photo_url);                            $user_thumb = wp_get_attachment_image_src( $attachment_id, 'user-listing-thumb', false );                            if($user_thumb){                        ?>                            <img src="<?php echo $user_thumb[0]; ?>" alt="<?php echo $user->display_name; ?>" />                        <?php                            } else {                                echo '<img src="'.get_template_directory_uri().'/images/noimage.png" alt="'.$user->display_name.'" />';                            }                        } else {                            echo '<img src="'.get_template_directory_uri().'/images/noimage.png" alt="'.$user->display_name.'" />';                        }                        ?>                    </a>                </figure>                <h5 class="user-role"><?php echo ($user_designation) ? $user_designation.' //' : '&nbsp;'; ?></h5>                <p class="counts">Posts: <?php echo count_user_posts($user->ID); ?> <span>//</span> Recipes: <?php echo count_user_posts_by_type($user->ID, 'recipe'); ?></p>                <?php                echo '<p class="user-description">'.word_trim($user_description, 11, '...<a href="'.$user_page_link.'">more</a>').'</p>';                ?>                <p class="social">                    <?php                    echo ($user_website) ? '<a class="url" href="'.$user_website.'"></a>' : '';                    echo ($user_twitter) ? '<a class="twitter" href="'.$user_twitter.'"></a>' : '';                    echo ($user_facebook) ? '<a class="facebook" href="'.$user_facebook.'"></a>' : '';                    echo ($user_google) ? '<a class="google" href="'.$user_google.'"></a>' : '';                    echo ($user_linkedin) ? '<a class="linkedin" href="'.$user_linkedin.'"></a>' : '';                    echo ($user_youtube) ? '<a class="youtube" href="'.$user_youtube.'"></a>' : '';                    ?>                </p>            </div>            <?php        }        ?>        </div>    </div><!-- end of left-area -->    <!-- LEFT AREA ENDS HERE -->    <div id="sidebar">        <?php if ( ! dynamic_sidebar( 'Users Listing Sidebar' )) : endif; ?>    </div><?php get_footer(); ?>