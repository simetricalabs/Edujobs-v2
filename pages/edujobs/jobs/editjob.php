<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');

$job_guid = get_input('guid');
$job = get_entity($job_guid);

if (!elgg_instanceof($job, 'object', 'edujobs')) {
	register_error(elgg_echo('edujobs:edit:job:doesnt_exit'));
	forward(REFERRER);
}

if (!$job->canEdit()) {
	register_error(elgg_echo('edujobs:edit:job:novalid'));
	forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();

elgg_push_breadcrumb(elgg_echo('edujobs'), 'edujobs/jobs'); 

$title = elgg_echo('edujobs:edit:job');
elgg_push_breadcrumb($title);

$form_vars = array('name' => 'edujobspost', 'enctype' => 'multipart/form-data');
		    
$vars = jobs_prepare_form_vars($job);
$content = elgg_view_form('edujobs/jobs/add', $form_vars, $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);
