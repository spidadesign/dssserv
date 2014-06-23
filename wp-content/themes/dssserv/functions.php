<?php

add_action('init', 'borough_rewrite');
function borough_rewrite() {
	global $wp_rewrite;
	//add_rewrite_tag('%borough%','([^&]+)');
	add_rewrite_rule('property-search/([^/]+)/?','index.php?pagename=property-search&borough=$matches[1]&type=$matches[2]','top');
	//$wp_rewrite->flush_rules(false);
}
add_filter( 'query_vars', 'borough_query_vars' );

function borough_query_vars($query_vars){
	$query_vars[1] = 'borough';
	return $query_vars;
}

//Rewrite rules for Exclusive Properties
add_action('init', 'ex_rewrite');
function ex_rewrite(){
	global $wp_rewrite;
	add_rewrite_rule('exclusive-property/([^/]+)/?', 'index.php?pagename=exclusive-property&location=$matches[1]', 'top');
	//$wp_rewrite->flush_rules(false);
}
add_filter(	'query_vars', 'ex_query_vars' );
function ex_query_vars($query_vars){
	$query_vars[1] = 'location';
	return $query_vars;
}