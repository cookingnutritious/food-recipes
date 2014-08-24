<?php

if(!function_exists('send_message')){
    /*-----------------------------------------------------------------------------------*/
    /*	 send message function to process contact form submition
    /*-----------------------------------------------------------------------------------*/
    add_action( 'wp_ajax_nopriv_send_message', 'send_message' );
    add_action( 'wp_ajax_send_message', 'send_message' );

    function send_message()
    {
        if(isset($_POST['email'])):

            $sname = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $address = $_POST['target'];

            if(get_magic_quotes_gpc()) {
                $message = stripslashes($message);
            }

            $e_subject = __('You have Received a message from ', 'FoodRecipe') . $sname . '.';

            $e_body = __('You have Received a message from ', 'FoodRecipe')
                .$sname
                . '\n'
                .__('Their additional message is as follows.', 'FoodRecipe')
                ."\r\n\n";

            $e_content = "\" $message \"\r\n\n";

            $e_reply = 	__("You can contact ", 'FoodRecipe')
                .$sname
                . __(" via email, ", 'FoodRecipe')
                .$email;


            $msg = $e_body . $e_content . $e_reply;

            if(wp_mail($address, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n","-f $address")){

                _e('Message Sent Successfully!', 'FoodRecipe');

            } else {?>
                <div class="message-sent-error clearfix">
                    <?php  _e('***ERROR*** Message Not Sent. Try Again!', 'FoodRecipe'); ?>
                </div>
            <?php }

        else:

            ?>
            <div class="message-sent-error clearfix">
                <?php  _e('Message Sending Failed!', 'FoodRecipe'); ?>
            </div>
        <?php
        endif;

        die;
    }
}

?>