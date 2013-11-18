<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

//gatekeeper();
elgg_load_library('elgg:edujobs');

$owner = get_user_by_username(get_input('uname'));	// get cv user
$user = elgg_get_logged_in_user_entity();	// get logged-in user

elgg_push_breadcrumb(elgg_echo('edujobs'),'edujobs/jobs');

if ($user != null && $user->custom_profile_type == COLEGIO_PROFILE_TYPE_GUID)	{
	elgg_push_breadcrumb(elgg_echo('edujobs:teachers'),'edujobs/teachers/view');
}
elgg_push_breadcrumb(elgg_echo('edujobs:cv', array($owner->name)));

// build sidebar 
$sidebar = '';


$title = elgg_echo('edujobs:cv', array($owner->name));

if (check_if_user_has_cv($owner))	{
	$options_special = array(
		'type' => 'object', 
		'limit' => 0, 
		'full_view' => false,
		'count' => false,
		'pagination' => false,
		'owner_guid' => $owner->guid,
	);
	
	//get user experience
	$options_special[subtype] = 'educvwe';
	$options_special[order_by_metadata] = array(
		array( 'name' => 'cvwe_period_now', 'direction' => 'DESC', 'as' => 'integer' ),
		array( 'name' => 'cvwe_period_to', 'direction' => 'DESC'),
	);
	$content_we = elgg_list_entities_from_metadata($options_special);
	
	//get user education
	$options_special[subtype] = 'educvedu';
	$options_special[order_by_metadata] = array(
		array( 'name' => 'cvedu_time_currently', 'direction' => 'DESC', 'as' => 'integer' ),
		array( 'name' => 'cvedu_time_to', 'direction' => 'DESC'),
	);	
	$content_edu = elgg_list_entities_from_metadata($options_special);	
	
	//get user language
	$options_special[subtype] = 'educvlang';
	$options_special[order_by_metadata] = array();	
	$content_lang = elgg_list_entities_from_metadata($options_special);		
	
	//get user portfolio
	$options_special[subtype] = 'educvport';
	$content_port = elgg_list_entities_from_metadata($options_special);			
		
	$content = elgg_list_entities_from_metadata(array(
		'type' => 'object',
		'subtype' => 'educv',
		'limit' => 1,
		'full_view' => true,
		'count' => false,
		'pagination' => false,
		'owner_guid' => $owner->guid,
		'content_we' => $content_we,
		'content_edu' => $content_edu,
		'content_lang' => $content_lang,
		'content_port' => $content_port,
	));	
}

if (!$content) {
	$content = elgg_echo('edujobs:teachers:user:emptycv');
} 

$options = array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
	
	'filter_override' => elgg_view('edujobs/nav', array('selected' => $selected))
);

$body = elgg_view_layout('content', $options);

echo elgg_view_page($title, $body);










