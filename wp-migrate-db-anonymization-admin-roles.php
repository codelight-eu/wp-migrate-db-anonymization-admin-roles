<?php
/*
Plugin Name: WP Migrate DB Pro Extended
Plugin URI: https://codelight.eu
Description: Prevents anonymizing Administrator, Editor and Shop Manager roles. Uses example.org domains for user emails.
Author: Codelight
Version: 1.1
Author URI: https://codelight.eu
*/


/**
 * Prevents anonymizing Administrator, Editor and Shop Manager roles
 */
add_filter( 'wpmdb_anonymization_user_whitelisted', function ( $whitelisted, $user ) {

	if ( in_array( 'administrator', (array) $user->roles ) ||
	     in_array( 'editor', (array) $user->roles ) ||
	     in_array( 'shop_manager', (array) $user->roles ||
	                               user_can( $user, 'manage_options' )
	     )
	) {
		return true;
	}

	return $whitelisted;

}, 10, 2 );


/**
 * Uses safeEmail with example domains
 */
add_filter( 'wpmdb_anonymization_config', function ( $config ) {

	$config['users']['user_email'] = array(
		'constraint'     => 'WPMDB\\Anonymization\\Config\\Constraint::is_not_whitelisted_user',
		'fake_data_type' => 'safeEmail',
	);

	$config['comments']['comment_author_email'] = array(
		'fake_data_type' => 'safeEmail',
	);

	$config['usermeta']['meta_value'] = replaceEmailFilter( array( 'meta_key' => 'billing_email' ), $config['usermeta']['meta_value'] );
	$config['usermeta']['meta_value'] = replaceEmailFilter( array( 'meta_key' => 'Payer PayPal address' ), $config['usermeta']['meta_value'] );
	$config['postmeta']['meta_value'] = replaceEmailFilter( array( 'meta_key' => '_billing_email' ), $config['postmeta']['meta_value'] );
	$config['postmeta']['meta_value'] = replaceEmailFilter( array( 'meta_key' => 'Payer PayPal address' ), $config['postmeta']['meta_value'] );

	return $config;

} );

function replaceEmailFilter( $constraint, $array ) {
	foreach ( $array as $key => $val ) {
		if ( $val['constraint'] === $constraint ) {
			$array[ $key ] = array(
				'constraint'     => $constraint,
				'fake_data_type' => 'safeEmail',
			);
		}
	}

	return $array;
}