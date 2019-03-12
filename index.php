<?php 
/*
Plugin Name: Rj Social media in widget
Plugin URI: http://www.bestthemestar.com
Author: Shehabul Islam Raju
Author URI: http://www.facebook.com/msiraju12
Description: This is social media plugin that's help you to set social media button to your sidebar
Version: 1.0
*/


class zboom_social_share_button extends WP_Widget{

	public function __construct(){

		parent::__construct('zboom_social_share_button', 'Social Media', array('description' => 'go to social option and checked input which profile you want show'));
	}

	public function widget($args, $instance){

			$title 		= $instance['title'] ? $instance['title'] : 'Social Media';
			

			$design = get_option('rj_desing') ? get_option('rj_desing') : 'square' ;

			//====================== set default link =========================
			

			$youtube = get_option('rj_show_youtube');
			
			

			

			$facebook = get_option('rj_show_facebook') ? (get_option('rj_facebook')?get_option('rj_facebook'):'http://www.facebook.com') : ''; 

			$twitter = get_option('rj_show_twitter') ? (get_option('rj_twitter')? get_option('rj_twitter'):'http://www.twitter.com') : '';
			$linkedin = get_option('rj_show_linkedin') ? (get_option('rj_linkedin') ? get_option('rj_linkedin'): 'http://www.linkedin.com')  : '';

			$google = get_option('rj_show_google') ? (get_option('rj_google_plus')? get_option('rj_google_plus'): 'http://plus.google.com') : '';

			$pinterest = get_option('rj_show_pinterest') ? get_option('rj_pinterest') : '';

			$youtube = $youtube ? (get_option('rj_youtube') ? get_option('rj_youtube') : 'http://www.youtube.com') : '';

			$link = $facebook ? '<li><a href="'.$facebook.'"><i class="fa fa-facebook"></i></a></li>' : '';
			$link .= $twitter ? '<li><a href="'.$twitter.'"><i class="fa fa-twitter"></i></a></li>' : '';
			$link .= $linkedin ? '<li><a href="'.$linkedin.'"><i class="fa fa-linkedin"></i></a></li>' : '';
			$link .= $google ? '<li><a href="'.$google.'"><i class="fa fa-google-plus"></i></a></li>' : '';
			$link .= $pinterest ? '<li><a href="'.$pinterest.'"><i class="fa fa-pinterest"></i></a></li>' : '';
			$link .= $youtube ? '<li><a href="'.$youtube.'"><i class="fa fa-youtube"></i></a></li>' : '';
			
			echo $args['before_widget'];
			echo $args['before_title'].$title.$args['after_title'];
			echo "<div class='rj'>";
			echo "<ul class='".$design."'>";
			echo $link;
			echo "</ul>";
			echo "</div>";
			echo $args['after_widget'];
			
	}

	public function form($instance){ 
		
			$title 		= $instance['title'] ? $instance['title'] : 'Social Media';
			
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title</label></p>
		<p><input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		<?php 

	}
}

function zboom_social_share_button(){
	register_widget('zboom_social_share_button');

}
add_action('widgets_init', 'zboom_social_share_button');


function rj_register_font_awesome_other(){
	$plugin_dir = dirname(__FILE__);
	wp_enqueue_style('rj_font_awesome', plugin_dir_url(__FILE__).'css/font-awesome.min.css');
	wp_enqueue_style('rj_css', plugin_dir_url(__FILE__).'css/style.css');
	wp_enqueue_style('thickbox');
	
	wp_enqueue_script('thickbox');
	wp_enqueue_script('imageupload', plugin_dir_url(__FILE__).'js/main.js');
	
}
add_action('wp_enqueue_scripts', 'rj_register_font_awesome_other');
add_action('admin_enqueue_scripts', 'rj_register_font_awesome_other');



/*================================================================================================
:::::::::::::::::::::::::::::::::::::::: CREATE FIELD :::::::::::::::::::::::::::::::::::::::::::::
===================================================================================================*/



function Rj_register_field_for_social_media(){
	add_settings_section('rj_send_field', 'Add Social media profile in widget', 'rj_send_callback', 'rj_social_option');
	
	add_settings_field('rj_facebook', 'Facebook profile link', 'facebook_callback','rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_facebook');
	
	add_settings_field('rj_twitter', 'Twitter profile link', 'twitter_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_twitter');

	add_settings_field('rj_linkedin', 'Linkedin profile link', 'linkedin_callback', 'rj_social_option', 'rj_send_field');
	register_setting('rj_send_field', 'rj_linkedin');	

	add_settings_field('rj_google_plus', 'Google Plus profile link', 'google_plus_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_google_plus');

	add_settings_field('rj_pinterest', 'Pinterest profile link', 'pinterest_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_pinterest');

	add_settings_field('rj_youtube', 'Youtube chanel link', 'youtube_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_youtube');

	// ========================== show callback field =====================================
	//==========================================================================================

	add_settings_field('rj_divide', '', 'alert_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_devide');

	add_settings_field('rj_show_facebook', 'Show Facebook', 'show_facebook_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_show_facebook');

	add_settings_field('rj_show_twitter', 'Show Twitter', 'show_twitter_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_show_twitter');

	add_settings_field('rj_show_linkedin', 'Show Linkedin', 'show_linkedin_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_show_linkedin');

	add_settings_field('rj_show_google', 'Show Google Plus', 'show_google_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_show_google');

	add_settings_field('rj_show_pinterest', 'Show Pinterest', 'show_pinterest_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_show_pinterest');

	add_settings_field('rj_show_youtube', 'Show Youtube', 'show_youtube_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_show_youtube');

	//==================================== Design ==========================================
	//======================================================================================

	add_settings_field('rj_design_alert', '', 'design_alert_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_design_alert');

	add_settings_field('rj_desing', '', 'default_callback', 'rj_social_option', 'rj_send_field');	
	register_setting('rj_send_field', 'rj_desing');
}
add_action('admin_init', 'Rj_register_field_for_social_media');

/*
====================================================================================================
::::::::::::::::::::::::::::::::::::::::::: SOCIAL MEDIA LINK INPUT ::::::::::::::::::::::::::::::::
=====================================================================================================
*/

// callback function for Facebook field
function facebook_callback(){
	?>
		<input type="text" name="rj_facebook" value="<?php echo esc_url(get_option('rj_facebook')); ?>" class="regular-text"/>
	<?php
}

// Twitter Text Callback function
function twitter_callback(){ ?>
	<input type="text" name="rj_twitter" value="<?php echo esc_url(get_option('rj_twitter')); ?>" class="regular-text" />
<?php
}

// Linkedin Text Callback function
function linkedin_callback(){ ?>
	<input type="text" name="rj_linkedin" value="<?php echo esc_url(get_option('rj_linkedin')); ?>" class="regular-text" />
<?php
}

// Google plus Text Callback function
function google_plus_callback(){ ?>
	<input type="text" name="rj_google_plus" value="<?php echo esc_url(get_option('rj_google_plus')); ?>" class="regular-text" />
<?php
}

// Pinterest Text Callback function
function pinterest_callback(){ ?>
	<input type="text" name="rj_pinterest" value="<?php echo esc_url(get_option('rj_pinterest')); ?>" class="regular-text" />
<?php
}

// Pinterest Text Callback function
function youtube_callback(){ ?>
	<input type="text" name="rj_youtube" value="<?php echo esc_url(get_option('rj_youtube')); ?>" class="regular-text" />
<?php
}

/*
===================================================================================================
::::::::::::::::::::::::::::::: SHOW OR HIDE SOCIAL MEDIA LINK CALLBACK ::::::::::::::::::::::::::::
====================================================================================================
*/

function alert_callback(){
	echo "<h3>Select which network you want to show . please show max 4 items</h3>";
}

function show_facebook_callback(){
	?>
		<input type="checkbox" name="rj_show_facebook" <?php checked(get_option('rj_show_facebook'), 1) ?> value="1" />
	<?php
}

function show_twitter_callback(){
	?>
		<input type="checkbox" name="rj_show_twitter" <?php checked(get_option('rj_show_twitter'), 1) ?> value="1" />
	<?php
}

function show_linkedin_callback(){
	?>
		<input type="checkbox" name="rj_show_linkedin" <?php checked(get_option('rj_show_linkedin'), 1) ?> value="1" />
	<?php
}


function show_google_callback(){
	?>
		<input type="checkbox" name="rj_show_google" <?php checked(get_option('rj_show_google'), 1) ?> value="1" />
	<?php
}
function show_pinterest_callback(){
	?>
		<input type="checkbox" name="rj_show_pinterest" <?php checked(get_option('rj_show_pinterest'), 1) ?> value="1" />
	<?php
}

function show_youtube_callback(){
	?>
		<input type="checkbox" name="rj_show_youtube" <?php checked(get_option('rj_show_youtube'), 1) ?> value="1" />
	<?php
}
/*
========================================================================================
::::::::::::::::::::::::::::::::: Desing Callback :::::::::::::::::::::::::::::::::::::::
=========================================================================================
*/
function design_alert_callback(){
	echo "<h4>Select a design thats you like.</h4>";
}

function default_callback(){
	$design = esc_html(get_option('rj_desing')) ? esc_html(get_option('rj_desing')): 'square';

	?>
		<input <?php if($design == 'square'){ echo 'checked'; } ?> type="radio" name="rj_desing" value="square" />
		<img src="<?php echo plugin_dir_url(__FILE__).'img/square.png' ?>" /><br>

		<input <?php if($design == 'round'){ echo 'checked'; } ?> type="radio" name="rj_desing" value="round" />
		<img src="<?php echo plugin_dir_url(__FILE__).'img/round.png' ?>" /><br>

		<input <?php if($design == 'samebg'){ echo 'checked'; } ?> type="radio" name="rj_desing" value="samebg" />
		<img src="<?php echo plugin_dir_url(__FILE__).'img/samebg.png' ?>" /><br>
	<?php 
}
/*
===========================================================================================================
:::::::::::::::::::::::::::::::::::::::: SEND CALLBACK FUNCTION ::::::::::::::::::::::::::::::::::::::::::::
============================================================================================================
*/

// callback form add settings section
function rj_send_callback(){
	echo '';
}

//Create Menu
function Rj_create_menu(){
	$admin = 'manage_options';
	add_menu_page('Social Media Options', 'Social Option', $admin, 'rj_social_option', 'Rj_menu_callback', '', '58' );
}
add_action('admin_menu', 'Rj_create_menu');

//  Menu options callback // menu items callback
function Rj_menu_callback(){ ?>
		<?php echo settings_errors(); ?>
	<h1>Widget Social media Options</h1>
	<form class="rj_form" action="options.php" method="POST">
		<?php
			do_settings_sections('rj_social_option');
			
			settings_fields('rj_send_field');
			
			submit_button();
		?>
	</form>
	
	<?php
}