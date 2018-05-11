<?php
/**
 * Plugin Name: No Email, IP and URL for Wordpress Comments
 * Plugin URI: https://github.com/alexmoise/No-Email-IP-and-URL-for-Wordpress-Comments
 * GitHub Plugin URI: https://github.com/alexmoise/No-Email-IP-and-URL-for-Wordpress-Comments
 * Description: A very simple plugin to remove Email and Website fields from comments area and also stop collecting the commenter's IP address. Also disables comment system cookie and empties comment notes text. No settings page needed at this moment, although the option to disable/enable that cookie could be nice to have in the admin area.
 * Version: 0.1.3
 * Author: Alex Moise
 * Author URI: https://moise.pro
 */

if ( ! defined( 'ABSPATH' ) ) {	exit(0);}

// remove email and url field from comments
function mo_remove_comment_fields($fields) {
	if(isset($fields['email'])) unset($fields['email']);
	if(isset($fields['url'])) unset($fields['url']);
	return $fields;
}
add_filter('comment_form_default_fields', 'mo_remove_comment_fields');

// empty comment form notes
function mo_empty_comment_form_notes($defaults){
	$defaults['comment_notes_before'] = '';
	return $defaults;
}
add_filter( 'comment_form_defaults', 'mo_empty_comment_form_notes' );

// don't store commenter IP address
function mo_dont_store_commenter_ip( $comment_author_ip ) {
	return '';
}
add_filter( 'pre_comment_user_ip', 'mo_dont_store_commenter_ip' );

// disable comments cookie
add_action('init', 'mo_disable_comment_cookie');
function mo_disable_comment_cookie() {
	remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );
}

?>
