<?php
/*
Plugin Name: WP Migrate DB Anonymization Admin Roles
Plugin URI: https://codelight.eu
Description: Prevents anonymizing Administrator, Editor and Shop Manager roles
Author: Codelight
Version: 1.0
Author URI: https://codelight.eu
*/

add_filter('wpmdb_anonymization_user_whitelisted', function($whitelisted, $user) {

	if (in_array('administrator', (array) $user->roles) || 
		in_array('editor', (array) $user->roles) || 
		in_array('shop_manager', (array) $user->roles ||
		user_can($user, 'manage_options')	
	)
	) {
		return true;
	}

	return $whitelisted;

}, 10, 2);