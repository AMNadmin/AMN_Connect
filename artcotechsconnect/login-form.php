<?php

/*

If you would like to edit this file, copy it to your current theme's directory and edit it there.

Theme My Login will always look in your theme's directory first, before using this default template.

*/

?>


	<?php $template->the_action_template_message( 'login' ); ?>

	<?php $template->the_errors(); ?>
    <form name="loginform" id="loginform" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
        <p>
            <label for="user_login">Username<br>
            <input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20"></label>
        </p>
        <p>
            <label for="user_pass">Password<br>
            <input type="password" name="pwd" id="user_pass" class="input" value="" size="20"></label>
        </p>
        <p class="forgetmenot">
        	<label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever"> Remember Me</label>
        </p>
		<?php do_action( 'login_form' ); ?>
        <p class="submit">
            <input type="submit" name="wp-submit btn-submit" id="wp-submit<?php $template->the_instance(); ?>" class="button button-primary button-large" value="<?php esc_attr_e( 'Log In' ); ?>">
            <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>">
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="login" />
        </p>
    </form>
    
    <p id="nav">
    	<a href="/wp-login.php?action=register">Register</a> | 	<a href="/?page_id=15&amp;action=lostpassword" title="Password Lost and Found">Lost your password?</a>
    </p>
	<?php //$template->the_action_links( array( 'login' => false ) ); ?>




