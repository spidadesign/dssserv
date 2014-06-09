<?php

add_action('init', 'add_my_rewrite');
function add_my_rewrite() {
	global $wp_rewrite;
	add_rewrite_tag('%borough%','([^&]+)');
	add_rewrite_rule('^borough/([^/]+)','index.php?page_id=18&borough=$matches[1]','top');
	$wp_rewrite->flush_rules(false);
}