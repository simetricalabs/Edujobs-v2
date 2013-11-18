<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');

$user = elgg_get_logged_in_user_entity();

$uguid = get_input('uguid');

// check if user can upload CV
if (check_if_user_is_teacher($user) && $user->guid==$uguid) { 
	elgg_register_title_button('edujobs','teachers/addlanguage');
	
    $title = elgg_echo('edujobs:cv:add5:simple');
    
    elgg_push_breadcrumb(elgg_echo('edujobs'), 'edujobs/jobs'); 
    elgg_push_breadcrumb(elgg_echo('edujobs:label:mycv'), 'edujobs/teachers/mycv'); 
    elgg_push_breadcrumb(elgg_echo('edujobs:cv:add5:simple'));

	if (check_if_user_has_cv($user))	{
		$content = elgg_list_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => 'educvlang',
			'limit' => 0,
			'full_view' => false,
			'count' => false,
			'pagination' => false,
			'owner_guid' => $user->guid,
		));					
	}	
	
	if (!$content) {
		$content = elgg_echo('edujobs:teachers:user:emptycvlang');
	} 

	$options = array(
		'filter_context' => 'all',
		'content' => $content,
		'title' => $title,
		'sidebar' => elgg_view('edujobs/cv_sidebar', array('user_guid' => $uguid, 'selected' => 'cv5')),
		'filter_override' => elgg_view('edujobs/nav', array('selected' => $selected))
	);

	$body = elgg_view_layout('content', $options);

	echo elgg_view_page($title, $body);
} 
else    {  
    register_error(elgg_echo('edujobs:cv:noaccessforpost'));  
    forward(REFERER);    
}





