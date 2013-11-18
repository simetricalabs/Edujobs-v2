<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');


//get entity
$job = get_entity(get_input('guid'));
if (!$job) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}

$title = $job->title;

$page_owner =$job->getOwnerEntity();

// generate breadcrumbs
elgg_push_breadcrumb(elgg_echo('edujobs'), 'edujobs/jobs');  
$crumbs_title = $page_owner->username;
/*
if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "edujobs/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "edujobs/owner/$page_owner->username");
}
* */

elgg_push_breadcrumb($title);

$sidebar = '';

//default view
$content = elgg_view_entity($job, array('full_view' => true));
if ($job->comments_on != 'Off') {
    $content .= elgg_view_comments($job);
}     

$body = elgg_view_layout('content', array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
));
echo elgg_view_page($title, $body);






