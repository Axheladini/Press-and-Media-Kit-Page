<?php 
/**
 * Create setting page for plugin inside Dashboard
 *
 * @package stoked press page
 * @since stokes press page 1.0
 */

add_action( 'admin_menu', 'wps_press_page_add_admin_menu' );
add_action( 'admin_init', 'wps_press_page_settings_init' );


function wps_press_page_add_admin_menu(  ) { 

	add_menu_page('Press & Media Kit', 'Press & Media Kit', 'manage_options', 'wps_press_page', '', 'dashicons-welcome-widgets-menus');
	add_submenu_page( 'wps_press_page', 'Press Page Options', 'Press Page Options', 'manage_options', 'wps_press_page', 'wps_press_page_options_page');
    add_submenu_page( 'wps_press_page', 'All Resources', 'All Resources', 'manage_options', 'edit.php?post_type=resources');
	add_submenu_page( 'wps_press_page', 'New Resource', 'New Resource', 'manage_options', 'post-new.php?post_type=resources');
	add_submenu_page( 'wps_press_page', 'All Articles', 'All Articles', 'manage_options', 'edit.php?post_type=articles');
	add_submenu_page( 'wps_press_page', 'New Article', 'New Article', 'manage_options', 'post-new.php?post_type=articles');
	add_submenu_page( 'wps_press_page', 'All Press Releases', 'All Press Releases', 'manage_options', 'edit.php?post_type=pressreeleases');
	add_submenu_page( 'wps_press_page', 'New Press Release', 'New Press Release', 'manage_options', 'post-new.php?post_type=pressreeleases');
}
	

function wps_press_page_settings_init(  ) { 

	register_setting( 'wps_ps_page', 'wps_press_page_press_page_section' );

	add_settings_section(
		'wps_press_page_press_page_section', 
		__( 'For more detailed page fill all fields', 'wps_press_page' ), 
		'wps_press_page_settings_section_callback', 
		'wps_ps_page'
	);
    

	add_settings_field( 
		'wps_press_page_company_name', 
		__( 'Company Name:', 'wps_press_page' ), 
		'wps_press_page_company_name_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);

    add_settings_field( 
		'wps_press_page_company_email', 
		__( 'Company email:', 'wps_press_page' ), 
		'wps_press_page_company_email_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);

	add_settings_field( 
		'wps_press_page_company_domain', 
		__( 'Web domain:', 'wps_press_page' ), 
		'wps_press_page_company_domain_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);

	add_settings_field( 
		'wps_press_page_company_phone', 
		__( 'Phone:', 'wps_press_page' ), 
		'wps_press_page_company_phone_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);

	add_settings_field( 
		'wps_press_page_company_founded', 
		__( 'Founded:', 'wps_press_page' ), 
		'wps_press_page_company_founded_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_employees', 
		__( 'Number of employees:', 'wps_press_page' ), 
		'wps_press_page_company_employees_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_address', 
		__( 'Full Address:', 'wps_press_page' ), 
		'wps_press_page_company_address_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);

   add_settings_field( 
		'wps_press_page_company_about', 
		__( 'Short About:', 'wps_press_page' ), 
		'wps_press_page_company_about_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
    add_settings_field( 
		'wps_press_page_company_facebook', 
		__( 'Facebook:', 'wps_press_page' ), 
		'wps_press_page_company_facebook_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_twitter', 
		__( 'Twitter:', 'wps_press_page' ), 
		'wps_press_page_company_twitter_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_linkedin', 
		__( 'Linkedin:', 'wps_press_page' ), 
		'wps_press_page_company_linkedin_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_youtube', 
		__( 'Youtube:', 'wps_press_page' ), 
		'wps_press_page_company_youtube_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_googleplus', 
		__( 'Google +:', 'wps_press_page' ), 
		'wps_press_page_company_google_plus_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_behance', 
		__( 'Behance:', 'wps_press_page' ), 
		'wps_press_page_company_behance_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_dribble', 
		__( 'Drible:', 'wps_press_page' ), 
		'wps_press_page_company_dribble_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_instagram', 
		__( 'Instagram:', 'wps_press_page' ), 
		'wps_press_page_company_instagram_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_tumblr', 
		__( 'Tumblr:', 'wps_press_page' ), 
		'wps_press_page_company_tumblr_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_pinterest', 
		__( 'Pinterest:', 'wps_press_page' ), 
		'wps_press_page_company_pinterest_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
	add_settings_field( 
		'wps_press_page_company_maps', 
		__( 'Google maps embeded code:', 'wps_press_page' ), 
		'wps_press_page_company_maps_render', 
		'wps_ps_page', 
		'wps_press_page_press_page_section' 
	);
}

function wps_press_page_company_name_render(  ) { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_name" value="<?php echo esc_html($options['wps_press_page_company_name']); ?>">
	<?php

}

function wps_press_page_company_email_render(  ) { 

	$options = get_option( 'wps_press_page_press_page_section' ); 
	?>
    
	<input type="email" name="wps_press_page_company_email" value=" <?php echo sanitize_email($options['wps_press_page_company_email']); ?>">
	<?php
}

function wps_press_page_company_domain_render(  ) { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_domain" value="<?php echo esc_url($options['wps_press_page_company_domain']); ?>">
	<?php
}
function wps_press_page_company_phone_render(  ) { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_phone" value="<?php echo esc_html($options['wps_press_page_company_phone']); ?>">
	<?php
}

function wps_press_page_company_founded_render(  ) { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="date" name="wps_press_page_company_founded" value="<?php echo esc_html($options['wps_press_page_company_founded']); ?>">
	<?php
}

function wps_press_page_company_employees_render(  ) { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_employees" value="<?php echo esc_html($options['wps_press_page_company_employees']); ?>">
	<?php
}


function wps_press_page_company_address_render(  ) { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_address" value="<?php echo  esc_html($options['wps_press_page_company_address']); ?>" class="address_input">
	<?php
}

function wps_press_page_company_about_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<textarea rows="7" cols="80" name="wps_press_page_company_about">
	<?php echo esc_html($options['wps_press_page_company_about']);?> 
	</textarea>
	<?php
}

function wps_press_page_company_facebook_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_facebook" value="<?php echo esc_url($options['wps_press_page_company_facebook']); ?>" class="fb_input">
	<?php
}
function wps_press_page_company_twitter_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_twitter" value="<?php echo esc_url($options['wps_press_page_company_twitter']); ?>" class="tw_input">
	<?php
}
function wps_press_page_company_linkedin_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_linkedin" value="<?php echo esc_url($options['wps_press_page_company_linkedin']); ?>" class="li_input">
	<?php
}
function wps_press_page_company_youtube_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_youtube" value="<?php echo esc_url($options['wps_press_page_company_youtube']); ?>" class="youtube_input">
	<?php
}
function wps_press_page_company_google_plus_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_googleplus" value="<?php echo esc_url($options['wps_press_page_company_googleplus']); ?>" class="gplus_input">
	<?php
}

function wps_press_page_company_behance_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_behance" value="<?php echo esc_url($options['wps_press_page_company_behance']); ?>" class="gplus_input">
	<?php
}

function wps_press_page_company_dribble_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_dribble" value="<?php echo esc_url($options['wps_press_page_company_dribble']); ?>" class="gplus_input">
	<?php
}

function wps_press_page_company_instagram_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_instagram" value="<?php echo esc_url($options['wps_press_page_company_instagram']); ?>" class="gplus_input">
	<?php
}

function wps_press_page_company_tumblr_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_tumblr" value="<?php echo esc_url($options['wps_press_page_company_tumblr']); ?>" class="gplus_input">
	<?php
}
function wps_press_page_company_pinterest_render() { 
$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<input type="text" name="wps_press_page_company_pinterest" value="<?php echo esc_url($options['wps_press_page_company_pinterest']); ?>" class="gplus_input">
	<?php
}


function wps_press_page_company_maps_render() { 

	$options = get_option( 'wps_press_page_press_page_section' );
	?>
	<textarea rows="7" cols="80" name="wps_press_page_company_maps">
	<?php echo esc_textarea($options['wps_press_page_company_maps']);?> 
	</textarea>
	<?php
}


function wps_press_page_settings_section_callback(  ) { 

    	//echo __( 'This section description', 'wps_press_page' );

}


function wps_press_page_options_page() { 
   
    $options = get_option('wps_press_page_press_page_section');

     if (isset($_POST["saveOptions"])) 
     {  
          $verify = check_admin_referer('wps_press_page_setting_page_save','wps_press_page_nonce_fieldd');
          if ($verify == '1')
          {
             $options['wps_press_page_company_name'] = sanitize_text_field($_POST["wps_press_page_company_name"]);
             $options['wps_press_page_company_domain'] = esc_url_raw($_POST["wps_press_page_company_domain"]); 

             /*Validate eMail*/
             $wps_company_email = $options['wps_press_page_company_email'];
             if(is_email($wps_company_email)){ $options['wps_press_page_company_email'] = $wps_company_email; }
             else{$options['wps_press_page_company_email'] = ""; }
              


             $options['wps_press_page_company_address'] = sanitize_text_field($_POST["wps_press_page_company_address"]); 
             
             /*Validate number of employees*/
             $wps_nr_employees = intval($_POST["wps_press_page_company_employees"]);
             if(!$wps_nr_employees) { $options['wps_press_page_company_employees'] = " "; }
             else { $options['wps_press_page_company_employees'] = $wps_nr_employees; }
             
             /*Validate date*/
             $wps_company_foundet = $_POST['wps_press_page_company_founded'];
             if(strtotime($wps_company_foundet)){ $options['wps_press_page_company_founded'] = $_POST['wps_press_page_company_founded']; }
             else{ $options['wps_press_page_company_founded'] = " "; }
           

             /*Validate phone number*/
             $wps_phone_number =  $_POST['wps_press_page_company_phone'];
             if (preg_match('/^[0-9\.\++ ]+$/',$wps_phone_number))
             { $options['wps_press_page_company_phone'] = $wps_phone_number; }
             else { $options['wps_press_page_company_phone']  = "";}


             $options['wps_press_page_company_about'] = esc_textarea($_POST["wps_press_page_company_about"]); 
             $options['wps_press_page_company_facebook'] = esc_url_raw($_POST["wps_press_page_company_facebook"]);
             $options['wps_press_page_company_twitter'] = esc_url_raw($_POST["wps_press_page_company_twitter"]);
             $options['wps_press_page_company_linkedin'] = esc_url_raw($_POST["wps_press_page_company_linkedin"]);
             $options['wps_press_page_company_youtube'] = esc_url_raw($_POST["wps_press_page_company_youtube"]);
             $options['wps_press_page_company_googleplus'] = esc_url_raw($_POST["wps_press_page_company_googleplus"]);
             $options['wps_press_page_company_behance'] = esc_url_raw($_POST["wps_press_page_company_behance"]);
             $options['wps_press_page_company_dribble'] = esc_url_raw($_POST["wps_press_page_company_dribble"]);
             $options['wps_press_page_company_instagram'] = esc_url_raw($_POST["wps_press_page_company_instagram"]);
             $options['wps_press_page_company_tumblr'] = esc_url_raw($_POST["wps_press_page_company_tumblr"]);
             $options['wps_press_page_company_pinterest'] = esc_url_raw($_POST["wps_press_page_company_pinterest"]);
             $options['wps_press_page_company_maps'] = stripslashes($_POST["wps_press_page_company_maps"]);
  
             update_option( 'wps_press_page_press_page_section', $options ); 
          }
          else 
          {
          	echo "You are not allowed to save these settings";
          }
         
        
     } 
   
   
	?>
<div class="wps_content wps_options_page">
	<form action='' method='post'>

       <?php wp_nonce_field('wps_press_page_setting_page_save','wps_press_page_nonce_fieldd'); ?> 

		<h1 id="option_page_name">Press and Media Kit Page - general options</h1>
		<hr>

		<?php  do_settings_sections( 'wps_ps_page' ); ?>




    <input type="submit" value="SAVE OPTIONS" name="saveOptions" class="button-primary" style="margin-left:15px !important;" />
	</form>
</div>
	<?php

}

