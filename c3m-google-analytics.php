<?php
/*
Plugin Name: C3M Google Analytics
Plugin URI: http://
Description: Adds Google Analytics tracking code to your footer including the new tracking for page load time.  Includes settings page to enter your Google Analytics ID
Author: Chris Olbekson
Version: 0.1
Author URI: http://c3mdigital.com
License: UnLicense <http://unlicense.org>
*/

// Add a menu for our option page
add_action('admin_menu', 'c3m_myplugin_add_page');
function c3m_myplugin_add_page() {
	add_options_page( 'C3M Google Analytics', 'C3M Google Analytics', 'manage_options', 'c3m_myplugin', 'c3m_myplugin_option_page' );
}

// Draw the option page
function c3m_myplugin_option_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2>C3M Google Analytics</h2>
		<form action="options.php" method="post">
			<?php settings_fields('c3m_myplugin_options'); ?>
			<?php do_settings_sections('c3m_myplugin'); ?>
			<input name="Submit" type="submit" value="Save Changes" />
		</form>
	</div>
	<?php
}

// Register and define the settings
add_action('admin_init', 'c3m_myplugin_admin_init');
function c3m_myplugin_admin_init(){
	register_setting(
		'c3m_myplugin_options',
		'c3m_myplugin_options'
	);
	add_settings_section(
		'c3m_myplugin_main',
		'Google Analytics Tracking Code User ID',
		'c3m_myplugin_section_text',
		'c3m_myplugin'
	);
	add_settings_field(
		'c3m_myplugin_text_string',
		'Enter text here',
		'c3m_myplugin_setting_input',
		'c3m_myplugin',
		'c3m_myplugin_main'
	);
}

// Draw the section header
function c3m_myplugin_section_text() {
	echo '<p>Enter your Google Analytics ID here ex: UA-XXXXXX-XX.</p>';
}

// Display and fill the form field
function c3m_myplugin_setting_input() {
	// get option 'text_string' value from the database
	$options = get_option( 'c3m_myplugin_options' );
	$text_string = $options['text_string'];
	// echo the field
	echo "<input id='text_string' name='c3m_myplugin_options[text_string]' type='text' value='$text_string' />";
}


add_action('wp_footer', 'c3m_google_analytics' );
function c3m_google_analytics() {
	$options = get_option( 'c3m_myplugin_options' );
	$text_string = $options['text_string'];
	echo "<script>
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', '".$text_string."']);
	  _gaq.push(['_trackPageview']);
	 _gaq.push(['_trackPageLoadTime']);
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>";
}
